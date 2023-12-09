<?php
class Student_model extends CI_Model
{
    protected $table;
    protected $mail;
    protected $pwd;
    protected $userId;
    protected $log;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
        $this->mail = 'multisoftacademy@gmail.com';
        $this->pwd = 'msoft2009';
        $this->log = 'log';
        $this->load->helper("email_helper");
        $this->load->helper("message_helper");
        $this->load->helper("general_helper");
        $this->userId= session_data('id');
    }

    public function correctData($data){
        if (isset($data['phone']) And !empty($this->db->select('id')->from($this->table)->where('phone', $data['phone'])->get()->result()))
        {
            return $result=array('msg'=>'Ce numero de téléphone existe déjà.', 'status'=>false);
        }
        if (isset($data['mail']) And !empty($this->db->select('id')->from($this->table)->where('mail', $data['mail'])->get()->result()))
        {
            return $result=array('msg'=>'Cet e-mail existe déjà.', 'status'=>false);

        }

        return true;
    }

    public function saveUser($data=array()){
         $this->db->select_max('id');
        $nbrUser = $this->db->get('user')->result()[0]->id;

        //$nbrUser = $this->db->query('select id from user')->num_rows();
        $ret =  $this->db->set('firstname', $data['firstname'])
            ->set('lastname', strtoupper($data['lastname']))
            ->set('birth_date', $data['birth_date'])
            ->set('birth_place', $data['birth_place'])
            ->set('nationality', $data['nationality'])
            ->set('sexe', $data['sexe'])
            ->set('address', $data['address'])
            ->set('phone', $data['phone'])
            ->set('mail', $data['mail'])
            ->set('question', $data['question'])
            ->set('answer', $data['answer'])
            ->set('login', $data['login'])
            ->set('pwd', sha1($data['pwd']))
            ->set('register_date', moment()->format('Y-m-d H:i:s'))
            ->set('state', '0')
            ->set('school', $data['school'])
            ->set('number_id', newNumberId($nbrUser+1))
            ->set('school_area', $data['school_area'])
            ->set('school_level', $data['school_level'])
            ->set('avatar', 'assets/img/img_avatar.png')
            ->set('photo', 'assets/img/img_avatar.png')
            ->set('last_connexion', null)
            ->insert($this->table);

        $userId=$this->db->select('id')->from('user')->where('mail', $data['mail'])->get()->result()[0]->id;

        if($userId)
            $this->db->query("INSERT INTO user_role(user, role) VALUES (?,?)",array($userId,MEMBER));

        return $userId;

    }

    public function save($data = array())
    {

        $this->db->trans_begin();
 $this->db->select_max('id');
        $nbrUser = $this->db->get('user')->result()[0]->id;

        //$nbrUser = $this->db->query('select id from user')->num_rows();
        $this->db->set('firstname', $data['firstname'])
            ->set('lastname', strtoupper($data['lastname']))
            ->set('birth_date', $data['birth_date'])
            ->set('birth_place', $data['birth_place'])
            ->set('nationality', $data['nationality'])
            ->set('sexe', $data['sexe'])
            ->set('address', $data['address'])
            ->set('phone', $data['phone'])
            ->set('mail', $data['mail'])
            ->set('question', $data['question'])
            ->set('answer', $data['answer'])
            ->set('login', $data['login'])
            ->set('pwd', sha1($data['pwd']))
            ->set('register_date', date('Y-m-d'))
            ->set('state', '0')
            ->set('school', $data['school'])
            ->set('number_id', newNumberId($nbrUser+1))
            ->set('school_area', $data['school_area'])
            ->set('school_level', $data['school_level'])
            ->set('avatar', 'assets/img/img_avatar.png')
            ->set('photo', 'assets/img/img_avatar.png')
            ->set('last_connexion', null)
            ->insert($this->table);

        /**
         *
         * Insertion des les logs et notification
         *
         */

        $userId=$this->db->select('id')->from('user')->where('mail', $data['mail'])->get()->result()[0]->id;
        $names=$this->db->query('select firstname, lastname from user where mail=?', $data['mail'])->row();

        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array(' Enregistrement de <b> '.$names->firstname.' '.$names->lastname.' </b>à la plateforme.', $this->userId, moment()->format('Y-m-d H:i:s')));

        $this->db->query('insert into notification(sender, content, send_date, target, url)
                                      values(?, ?, ?, ?, ?)', array($this->userId, "Vous avez bien été inscrit", moment()->format('Y-m-d H:i:s'), $userId, 'nothing'));
        $this->db->select_max('id');
        $notifId=$this->db->get('notification')->result()[0]->id;
        $this->db->query('insert into notification_views(user, notification)
                                      values(?, ?)', array($userId, $notifId));
        /**
         *
         * Fin d'inserttion
         */

        $lId = $this->db->query("select id from user where mail='{$data['mail']}'");
        $lId2 = $lId->row();
        $this->db->set('user', $lId2->id)->set('role', MEMBER)->insert('user_role');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Echec d'enregistrement de l'utilisateur";
        } else {
            $user=(object) ($this->getUser($lId2->id));
            $title="Cr&eacute;ation de votre compte";
            $message=($user->sexe==0?'Mme <b>':'M. <b>').mb_strtoupper($user->lastname).' '.ucwords($user->firstname)."</b>, Votre inscription a bien &eacute;t&eacute; enregistr&eacute;e. Veuillez utiliser les param&egrave;tres suivants pour <a href='".base_url('admin/admin/save')."'>activer votre compte</a> : <br>Votre login : <b>" . $data['mail'] . "</b><br>Votre mot de passe : <b>" . $data['pwd'];
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));
            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                $result=array('id'=>$userId, 'status'=>true);
                return $result;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'enregistrement de l'apprenant: Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        }
    }

    public function lyst()
    {

        return $this->db->query('
                SELECT u.id, u.state, u.photo, u.firstname, u.lastname, u.mail, u.phone, u.register_date, u.number_id
                FROM user u
                LEFT JOIN user_role ur ON ur.user=u.id
                WHERE ur.role = '.STUDENT.';
                ');
    }

    public function getUser($userId)
    {
        if($userId<=0) return null;
        $user=$this->db->query('select * from user where id=?', $userId)->row_array();
        return $user;
    }

    public function getStudent($id){
        //var_dump($id); die(0);
        return $this->db->query('
                SELECT *
                FROM user u
                LEFT JOIN user_role ur ON ur.user=u.id
                WHERE ur.role = '.STUDENT.' and u.id = '.$id.';
                ');
    }

    public function lystStudentCard($id=false, $mode=false){

        if($mode == false){
            if($id != false){
                return $this->db->query('
                SELECT  r.*, p.code promCode, l.label, l.code, user.*
                  FROM registration r
                    LEFT JOIN user on user.id = r.user
                    LEFT JOIN lesson l on l.id = r.lesson
                    LEFT JOIN promotion p on p.id = r.promotion
                  WHERE r.lesson = '.$id.' and r.state <> \'-1\' AND r.card = 0;
                ');
            }else{
                return $this->db->query('
                SELECT  r.*, p.code promCode, l.label, l.code, user.*
                  FROM registration r
                    LEFT JOIN user on user.id = r.user
                    LEFT JOIN lesson l on l.id = r.lesson
                    LEFT JOIN promotion p on p.id = r.promotion
                  WHERE r.state <> \'-1\' AND r.card = 0
                ');
            }
        }elseif($mode == 'cours'){
            if($id != false){
                return $this->db->query('
                SELECT  r.*, p.code promCode, l.label, l.code, user.*
                  FROM registration r
                    LEFT JOIN user on user.id = r.user
                    LEFT JOIN lesson l on l.id = r.lesson
                    LEFT JOIN promotion p on p.id = r.promotion
                  WHERE r.lesson = '.$id.' and r.state <> \'-1\' AND r.card = 0 ;
                ');
            }else{
                return $this->db->query('
                SELECT  r.*, p.code promCode, l.label, l.code, user.*
                  FROM registration r
                    LEFT JOIN user on user.id = r.user
                    LEFT JOIN lesson l on l.id = r.lesson
                    LEFT JOIN promotion p on p.id = r.promotion
                  WHERE r.state <> \'-1\' AND r.card = 0 
                ');
            }
        }

    }

    public function savePhoto($photo, $id){
        $photo = array('photo'=>$photo);
        return $this->db->update($this->table, $photo, "id = ".$id);
        //return $this->db->query('UPDATE user SET  =  WHERE id = 1')
    }

    public function log($id = false){
        return $this->db->select('*')->from($this->log)->where(array('author'=>$id))->order_by('date','DESC')->get()->result();
    }

    public function getLesson($id){
        return  $this->db->query('
            SELECT lesson.*, registration.registration_date, promotion.code as promCode
            FROM registration
            LEFT JOIN promotion ON registration.promotion = promotion.id
            LEFT JOIN lesson ON registration.lesson = lesson.id
            WHERE registration.user = '.$id)->result();
    }

    public function getPromotion($id){
        return  $this->db->query('
            SELECT promotion.*, lesson.id lId, lesson.label lLabel, lesson.code lCode, lesson.duration lDuration, lesson.fees lFees, lesson.type Ltype
            FROM promotion, lesson
            WHERE promotion.id in (SELECT registration.promotion
                                    FROM registration
                                    WHERE registration.user = '.$id.'
                                    and registration.state <> \'-1\')
            AND lesson.id in (SELECT promotion.lesson FROM promotion)');
    }

    public function getUsers($field=null, $order=null)
    {
        $orderby="ASC";
        if(isset($order))
        {
            if (in_array($order, array("ASC", "DESC")))
                $orderby=$order;
        }

        $fieldOrder="register_date";
        if(isset($field))
        {
            if (in_array($field, array("id", "firstname", "lastname", "birth_date", "birth_place", "last_connexion", "nationality")))
                $fieldOrder=$field;
        }

        $user=$this->db->query("select id, firstname, lastname from user order by $fieldOrder $orderby");
        $users=array();
        array_push($users, $user->first_row('array'));
        while($row=$user->next_row('array'))
            array_push($users, $row);
        return $users;
    }
}