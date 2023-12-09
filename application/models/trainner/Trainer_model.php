<?php
class Trainer_model extends CI_Model
{
    protected $table;
    protected $mail;
    protected $pwd;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
        $this->mail = 'multisoftacademy@gmail.com';
        $this->pwd = 'msoft2009';
        $this->log = "log";
        $this->userId=session_data('id');
        $this->load->helper("email_helper");
        $this->load->helper("message_helper");
        $this->load->helper("general_helper");
        $this->load->model("admin/notification_model", "notification");
        $this->load->model("admin/log_model", "logm");
        $this->load->model("admin/lesson_model", "lesson");
    }

    public function save($data = array())
    {
        if (isset($data['phone']) And !empty($this->db->select('id')->from($this->table)->where('phone', $data['phone'])->get()->result())) {
            return 'Ce numero de téléphone existe déjà.';
        }
        if (isset($data['mail']) And !empty($this->db->select('id')->from($this->table)->where('mail', $data['mail'])->get()->result())) {
            return 'Cet e-mail existe déjà.';
        }

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
            ->set('number_id', newNumberId($nbrUser+1))
            ->set('register_date', moment()->format('Y-m-d H:i:s'))
            ->set('state', '0')
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
                          values(?, ?, ?)', array(' a enregistré '.$names->firstname.' '.$names->lastname.' à la plateforme.', $this->userId, date('d-m-Y').'.'  ));
        $this->db->query('insert into notification(sender, content, send_date, target, url,promotion)
                                      values(?, ?, ?, ?, ?,?)', array(1, "Vous avez bien été inscrit", moment()->format('Y-m-d H:i:s'), $userId, '#',-1));
        $this->db->select_max('id');
        $notifId=$this->db->get('notification')->result()[0]->id;
        $this->db->query('insert into notification_views(user, notification)
                                      values(?, ?)', array($userId, $notifId));

        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array(' a enregistré '.$names->firstname.' '.$names->lastname.' en tant que formateur', $this->userId, moment()->format('Y-m-d H:i:s')  ));
        $this->db->query('insert into notification(sender, content, send_date, target, url,promotion)
                                      values(?, ?, ?, ?, ?,?)', array($this->userId, "Vous avez un nouveau statut: Formateur.", moment()->format('Y-m-d H:i:s'), $userId, '#',-1));
        $this->db->select_max('id');
        $notifId=$this->db->get('notification')->result()[0]->id;
        $this->db->query('insert into notification_views(user, notification)
                                      values(?, ?)', array($userId, $notifId));
        /*
         *
         * Fin d'inserttion
         */







        $lId = $this->db->query("select id from user where mail='{$data['mail']}'");
        $lId2 = $lId->row();


        $nbr = $this->db->query('SELECT user, role FROM user_role WHERE user=? AND role=?', array($lId2->id, MEMBER))->num_rows();
        if ($nbr == 0) //Si l'utilisateur n'a pas encore de role formateur
        {
            $this->db->set('user', $lId2->id)->set('role', MEMBER)->insert('user_role');
        }

        $this->db->set('user', $lId2->id)->set('role', TRAINER)->insert('user_role');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Echec d'enregistrement du formateur.";
        } else {
            $u=$this->getTrainer($lId2->id);
            $user=$u->result()[0];
            $title="Bienvenue dans la plateforme.";
            $message=($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname).", Votre inscription a bien &eacute;t&eacute; enregistr&eacute;e. Veuillez utiliser les param&egrave;tres suivants pour <a href='".base_url('account/login')."'>activer votre compte</a> : <br>Votre login : <b>" . $data['mail'] . "</b><br>Votre mot de passe : <b>" . $data['pwd'];
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));
            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'enregistrement du formateur : Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        }
    }

    public function getAll($field=null, $order=null){
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
        return $this->db->query("
        SELECT u.*, ur.user, ur.id urId, ur.locked
                FROM user u, user_role ur
                WHERE ur.role = ".TRAINER." AND u.id = ur.user  order by ".$fieldOrder. " ". $orderby );
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

        return $user=$this->db->query("select id, firstname, lastname from user order by $fieldOrder $orderby");

    }

    public function getTrainer($id=false, $idLa=false){
        //var_dump($id); die(0);
        if($id){
            return $this->db->query('
                SELECT *
                FROM user u
                LEFT JOIN user_role ur ON ur.user=u.id
                WHERE ur.role = '.TRAINER.' and u.id = '.$id.';
                ');
        }elseif($idLa){
            $idT = $this->db->select('user')->from('lesson_allocation')->where(array('id'=>$idLa))->get()->result();
            if(!empty($idT)){
                return $this->db->select(array('id', 'firstname', 'lastname'))->from('user')->where(array('id'=>$idT[0]->user))->get()->result();
            }else{
                return 1;
            }
        }else{
            return 0;
        }

    }

    public function allocation($data=array())
    {
        if ($this->db->query('select id from lesson_allocation where user=? and lesson=? and locked=?', array($data['user'], $data['lesson'], '0'))->num_rows()>0)
            return "Ce formateur a déjà été assigné à cet enseignement.";
        else if ($this->db->query('select id from lesson_allocation where user=? and lesson=? and locked=?', array($data['user'], $data['lesson'], '1'))->num_rows()>0)
            return "Ce formateur a déjà été assigné à cet enseignement et actuellement il est suspendu.";

        $trainer=$this->getTrainer($data['user'])->result()[0];
        $lesson=$this->lesson->get($data['lesson'])->result()[0];
        $this->db->trans_begin();
        if($this->db->query('select * from user_role where user=? and role=?', array($data['user'], TRAINER))->num_rows()==0)
        {
            $this->db->query('insert into user_role(user, role) values (?, ?)', array($data['user'], TRAINER));
        }
        $this->db->set('user', $data['user'])
            ->set('lesson', $data['lesson'])
            ->set('start_date', $data['start_date'])
            ->insert('lesson_allocation');
        $this->logm->save(array(
                "motivation"=>"",
                "author"=>$this->userId,
                "date"=>moment()->format('Y-m-d H:i:s'),
                "action"=>" a aloué ".($trainer->sexe==1?"M. ":"Mme ").$trainer->firstname." ".mb_strtoupper($trainer->lastname)." à l'enseignement ".mb_strtoupper($lesson->label)."."
            )
        );
        $this->notification->publish(array(
            "sender"=>$this->userId,
            "content"=>"Vous avez avez été aloué l'enseignement ".mb_strtoupper($lesson->label).".",
            "send_date"=>moment()->format('Y-m-d H:i:s'),
            "target"=>$data['user'],
            "promotion"=>-1,
            "url"=>"#"
        ));

        if($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            return true;
            $user=$this->getTrainer($data['user']);
            $title="Nouvelle allocation";
            $message=($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname).", Vous &ecirc;tes &agrave; pr&eacute;sent formateur de <b>".mb_strtoupper($lesson->label)."</b> &agrave; Multisoft Academy.";
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));
            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'allocation du formateur: Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        } else
        {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function getLessonSlip($id){

        return  $this->db->query('SELECT l.label, l.fees, l.duration, l.type, l.code, l.id as lId, la.locked, la.start_date, la.end_date, la.id as laId
                                FROM lesson_allocation la
                                  LEFT JOIN user u on u.id = la.user
                                  LEFT JOIN lesson l ON l.id = la.lesson
                                WHERE u.id =? ',array($id))->result();
    }

    public function savePhoto($photo, $id){
        $photo = array('photo'=>$photo);
        return $this->db->update($this->table, $photo, "id = ".$id);
        //return $this->db->query('UPDATE user SET  =  WHERE id = 1')
    }

    public function shelve($idLa=false){
        if($idLa){
            return $this->db->update('lesson_allocation', array('end_date'=>date('Y-m-d'), 'locked'=>'1'), 'id ='.$idLa);
        }else{
            return false;
        }
    }

    public function unshelve($idLa=false){
        if($idLa){
            return $this->db->update('lesson_allocation', array('start_date'=>date('Y-m-d'), 'locked'=>'0'), 'id ='.$idLa);
        }else{
            return false;
        }
    }

    public function getNotTrainers($field=null, $order=null){
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

        return $this->db->query("select DISTINCT (id), firstname, lastname, phone, mail, register_date 
                                    from user
                                    where id not in (select DISTINCT (user) from user_role where role=?)
                                    and (state=? or state=?)
                                    order by $fieldOrder $orderby", array(TRAINER, '0', '1'));
    }

    public function getUser($id){
        return $this->db->query('select * from user where id=? ',  $id);
    }

    public function shelveF($idUr=false){
        if($idUr){
            return $this->db->update('user_role', array('locked'=>'0'), 'id ='.$idUr);
        }else{
            return false;
        }
    }

    public function unshelveF($idUr=false){
        if($idUr){
            return $this->db->update('user_role', array('locked'=>'1'), 'id ='.$idUr);
        }else{
            return false;
        }
    }

    public function getTrainerF($id=false, $idUr)
    {
        if($id) {
            return $this->db->query('select * from user, user_role where user.id=user_role.user and user.id=? and user_role.role=?', array($id, TRAINER))->result()[0];
        }elseif($idUr){
            $idT = $this->db->select('user')->from('user_role')->where(array('id'=>$idUr))->get()->result();
            if(!empty($idT)){
                return $this->db->select(array('id', 'firstname', 'lastname'))->from('user')->where(array('id'=>$idT[0]->user))->get()->result();
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }

    public function log($id = false){
        return $this->db->select('*')->from($this->log)->where(array('author'=>$id))->order_by('date','DESC')->get()->result();
    }

    public function lessonSlip($code=null){
        if($code!=null){
            return $this->db->query("
            select lesson_slip.id,lesson_slip.content, lesson_slip.session, u.firstname, u.lastname, l.label, s.day, period.start,
              period.end, s.duration,lesson_slip.locked, s.start_date,s.code
            FROM lesson_slip
            LEFT JOIN sessions s on s.id = lesson_slip.session
              LEFT JOIN promotion p ON p.id = s.promotion
            LEFT JOIN lesson l on l.id = p.lesson
              LEFT JOIN period on period.id = s.period
            LEFT JOIN user u ON u.id = s.user
            WHERE s.code = ?
            ORDER BY s.start_date DESC
        ",array($code))->result();
        }
        else{
            return $this->db->query("
                select lesson_slip.id,lesson_slip.content, lesson_slip.session,
                  u.firstname, u.lastname, s.day, period.start, s.promotion,
                  period.end, s.duration,lesson_slip.locked, s.start_date,s.code
                FROM lesson_slip
                  LEFT JOIN sessions s on s.id = lesson_slip.session
                  LEFT JOIN period on period.id = s.period
                  LEFT JOIN user u ON u.id = s.user
                ORDER BY s.start_date DESC
        ")->result();
        }

    }
    
     public function update($session, $content)
    {
        return $this->db->query('update lesson_slip set content=? ,locked=? where session=?', array($content, 1, $session));
    }

}