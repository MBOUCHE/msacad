<?php
class Moderator_model extends CI_Model
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
        $this->load->model('admin/notification_model', 'notification');
        $this->load->model('admin/log_model', 'logm');
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
        /*
         *
         * Fin d'inserttion
         */

        $lId = $this->db->query("select * from user where mail='{$data['mail']}'");
        $lId2 = $lId->row();


        $nbr = $this->db->query('SELECT user, role FROM user_role WHERE user=? AND role=?', array($lId2->id, MEMBER))->num_rows();
        if ($nbr == 0) //Si l'utilisateur n'a pas encore de role modérateur
        {
            $this->db->set('user', $lId2->id)->set('role', MEMBER)->insert('user_role');
        }

        $this->db->set('user', $lId2->id)->set('role', MODERATOR)->insert('user_role');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Echec d'enregistrement du modérateur.";
        } else {
            $user=$lId2;
            $title="Bienvenue dans la plateforme.";
            $message=($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname).", Votre inscription a bien &eacute;t&eacute; enregistr&eacute;e. Veuillez utiliser les param&egrave;tres suivants pour <a href='".base_url('account/login')."'>activer votre compte</a> : <br>Votre login : <b>" . $data['mail'] . "</b><br>Votre mot de passe : <b>" . $data['pwd'];
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));
            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'enregistrement du modérateur : Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        }
    }

    public function getAll(){
        return $this->db->query('
                SELECT u.*, ur.user, ur.id urId, ur.locked
                FROM user u, user_role ur
                WHERE ur.role = '.MODERATOR.' AND u.id = ur.user;
            ');

    }

    public function regModerator($data=array())
    {
        $this->db->trans_begin();
        $this->db->query('insert into user_role(user, role) values(?, ?)', array($data['id'], MODERATOR));

        /**
         *
         * Insertion des logs et notification
         *
         */
        /*$names = $this->db->query('SELECT firstname, lastname, sexe FROM user WHERE id=?', $data['id'])->row();
        $this->notification->publish(array("sender"=>$this->userId, "content"=>"Félicitations ".($names->sexe==1?"M. ":"Mme ").($names->firstname." ".$names->lastname)." ! Vous êtes à présent modérateur à Multisoft Academy.", "send_date"=>date('Y-m-d'), "target"=>MANAGER, "promotion"=>"", "url"=>""));
        $this->logm->save(array(
            "motivation"=>"",
            "author"=>$this->userId,
            "date"=>date('Y-m-d h:i:s'),
            "action"=>"Ajout de ".($names->sexe==1?"M. ":"Mme ").($names->firstname." ".$names->lastname)." aux modérateurs de Multisoft Academy."
        ));*/
        /*
         *
         * Fin d'inserttion
         */

        if ($this->db->trans_status() == TRUE) {
            $user=$this->getModerator($data['id']);
            $title="Nouveau poste";
            $message=($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname).", Vous &ecirc;tes &agrave; pr&eacute;sent <b>mod&eacute;rateur</b> &agrave; Multisoft Academy.";
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));

            if (is_bool($sent) and $sent) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'ajout du nouveau modérateur: Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function getModerator($id=false, $idUr=false)
    {
        if($id) {
            return $this->db->query('select * from user, user_role where user.id=user_role.user and user.id=? and user_role.role=?', array($id, MODERATOR))->result()[0];
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


    public function getUser($id)
    {
        return $this->db->query('select * from user where id=? and state=?', array($id, '1'))->result()[0];
    }

    public function getNotModerators($field=null, $order=null)
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

        return $this->db->query("select DISTINCT (id), firstname, lastname, phone, mail, register_date 
                                    from user
                                    where id not in (select DISTINCT (user) from user_role where role=?)
                                    and (state=? or state=?)
                                    order by $fieldOrder $orderby", array(MODERATOR, '0', '1'))->result();
    }

    public function shelve($idUr=false){
        if($idUr){
            return $this->db->update('user_role', array('locked'=>'0'), 'id ='.$idUr);
        }else{
            return false;
        }
    }
    public function log($id = false){
        return $this->db->select('*')->from($this->log)->where(array('author'=>$id))->get()->result();
    }

    public function unshelve($idUr=false){
        if($idUr){
            return $this->db->update('user_role', array('locked'=>'1'), 'id ='.$idUr);
        }else{
            return false;
        }
    }

}