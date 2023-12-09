<?php

class Admin_model extends CI_Model
{
    protected $table = 'user';
    protected $tableRegistration = 'registration';
    protected $tableNotif = 'notification';
    protected $tableNotifView = 'notification_views';
    protected $mail;
    protected $pwd;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
        $this->mail = 'multisoftacademy@gmail.com';
        $this->pwd = 'msoft2009';
        $this->userId=session_data('id');
        $this->load->helper("email_helper");
        $this->load->helper("message_helper");
        $this->load->helper("general_helper");
        $this->load->model('admin/notification_model', 'notification');
        $this->load->model('admin/log_model', 'logm');
    }

    public function save($data = array())
    {
        if (isset($data['phone']) And empty($this->db->select('id')->from($this->table)->where('phone', $data['phone']))) {
            return 'Ce numero de téléphone existe déjà.';
        }
        if (isset($data['mail']) And empty($this->db->select('id')->from($this->table)->where('mail', $data['mail']))) {
            return 'Cet e-mail existe déjà.';
        }

        $this->db->trans_begin();
        $nbrUser = $this->db->query('select id from user')->num_rows();
        $this->db->set('firstname', $data['firstname'])
            ->set('lastname', strtoupper($data['lastname']))
            ->set('birth_date', $data['birth_date'])
            ->set('birth_place', $data['birth_place'])
            ->set('nationality', $data['nationality'])
            ->set('address', $data['address'])
            ->set('phone', $data['phone'])
            ->set('mail', $data['mail'])
            ->set('question', $data['question'])
            ->set('answer', $data['answer'])
            ->set('login', $data['login'])
            ->set('pwd', sha1($data['pwd']))
            ->set('register_date', moment()->format('Y-m-d H:i:s'))
            ->set('state', '0')
            ->set('number_id', newNumberId($nbrUser +1))
            ->set('avatar', 'assets/img/img_avatar.png')
            ->set('photo', 'assets/img/img_avatar.png')
            ->set('last_connexion', "null")
            ->insert($this->table);







        /**
         *
         * Insertion des logs et notification
         *
         */
        $userId=$this->db->select('id')->from('user')->where('mail', $data['mail'])->get()->result()[0]->id;
        $names=$this->db->query('select firstname, lastname from user where mail=?', $data['mail'])->row();

        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array(' a enregistré '.$names->firstname.' '.$names->lastname.' à la plateforme.', $this->userId, date('d-m-Y').'.'  ));
        $this->db->query('insert into notification(sender, content, send_date, target, url)
                                      values(?, ?, ?, ?, ?)', array($this->userId, "Vous avez bien été inscrit", moment()->format('Y-m-d H:i:s'), $userId, ''));
        $this->db->select_max('id');
        $notifId=$this->db->get('notification')->result()[0]->id;
        $this->db->query('insert into notification_views(user, notification)
                                      values(?, ?)', array($userId, $notifId));

        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array(' a enregistré '.$names->firstname.' '.$names->lastname.' en tant qu\'administrateur.', $this->userId, moment()->format('Y-m-d H:i:s')));
        $this->db->query('insert into notification(sender, content, send_date, target, url)
                                      values(?, ?, ?, ?, ?)', array($this->userId, "Vous avez un nouveau statut: Administrateur.", moment()->format('Y-m-d H:i:s'), $userId, 'nothing'));
        $this->db->select_max('id');
        $notifId=$this->db->get('notification')->result()[0]->id;
        $this->db->query('insert into notification_views(user, notification)
                                      values(?, ?)', array($userId, $notifId));
        /*
         *
         * Fin d'insertion
         */







        $lId = $this->db->query("select id from user where mail='{$data['mail']}'");
        $lId2 = $lId->row();
        $nbr = $this->db->query('SELECT user, role FROM user_role WHERE user=? AND role=?', array($data['id'], MEMBER))->num_rows();
        if ($nbr == 0) //Si l'utilisateur n'a pas encore de role apprenant
        {
            $this->db->set('user', $lId2->id)->set('role', MEMBER)->insert('user_role');
        }

        $this->db->set('user', $lId2->id)->set('role', ADMIN)->insert('user_role');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Echec d'enregistrement de l'administrateur";
        } else {
            $u=$this->getAdmin($lId2->id);
            $user=$u->result()[0];
            $title="Votre inscription";
            $message=($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname).", Votre inscription a bien &eacute;t&eacute; enregistr&eacute;e. Veuillez utiliser les param&egrave;tres suivants pour <a href='".base_url('admin/admin/save')."'>activer votre compte</a> : <br>Votre login : <b>" . $data['mail'] . "</b><br>Votre mot de passe : <b>" . $data['pwd'] . ".";
            $sent = sendMail(array('user'=>$user, 'title'=>$title, 'message'=>$message));
            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'enregistrement de l'administrateur: Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        }
    }


    public function getInscrit()
    {
        return $this->db->select()
            ->from($this->tableRegistration)
            ->where('state', '0')
            ->get()->result();
    }

    public function getAdmin($id)
    {
        return $this->db->query('select user.* from user inner join user_role on user.id=user_role.user where user.id=? and (user_role.role=? or user_role.role=?)', array($id, '5', '6'));
    }

    public function savePhoto($photo, $id){
        $photo = array('photo'=>$photo);
        return $this->db->update($this->table, $photo, "id = ".$id);
        //return $this->db->query('UPDATE user SET  =  WHERE id = 1')
    }

    public function modify($data=array())
    {
        if ($this->db->query('select * from user where id=? and pwd=?', array(session_data('id'), sha1($data['pwd'])))->num_rows()!=1)
            return "Mot de passe erroné.";

        if ($this->db->query('select * from user where id!=? and mail=?', array(session_data('id'), $data['mail']))->num_rows()>0)
            return "Cet e-mail est déjà utilisé.";

        if ($this->db->query('select * from user where id!=? and phone=?', array(session_data('id'), $data['mail']))->num_rows()>0)
            return "Cet numero de téléphone est déjà utilisé.";

        $pwd="";
        if ($data['pwd']=="" and $data['npwd']!="")
            return "Vous devez entrer l'ancien mot de passe pour pouvoir le modifier.";
        else if ($data['pwd']!="" and $data['npwd']!="")
            $pwd=$data['npwd'];
        else if ($data['pwd']!="" and $data['npwd']=="")
            $pwd=$data['pwd'];
        else
            return "Le mot de passe ne peut pas être vide.";

        $this->db->trans_begin();
        $this->db->where('id', session_data('id'))
                 ->set('firstname', $data['firstname'])
                 ->set('lastname', $data['lastname'])
                 ->set('birth_date', $data['birth_date'])
                 ->set('birth_place', $data['birth_place'])
                 ->set('nationality', $data['nationality'])
                 ->set('address', $data['address'])
                 ->set('phone', $data['phone'])
                 ->set('mail', $data['mail'])
                 ->set('pwd', sha1($pwd))
                 ->update($this->table);
        $this->logm->save(array(
            "motivation"=>"",
            "author"=>$this->userId,
            "date"=>date('Y-m-d h:i:s'),
            "action"=>"Modification du profil"
        ));
        $this->notification->publish(array(
            "sender"=>$this->userId,
            "content"=>"Votre profil a été modifié avec succès.",
            "send_date"=>date("Y-m-d"),
            "target"=>ADMIN,
            "promotion"=>"",
            "url"=>base_url('admin/loggedUserProfile/').$this->userId
        ));

        $this->notification->publish(array(
            "sender"=>$this->userId,
            "content"=>"Votre profil a été modifié avec succès.",
            "send_date"=>date("Y-m-d"),
            "target"=>MANAGER,
            "promotion"=>"",
            "url"=>'admin/loggedUserProfile/'.$this->userId
        ));
        if ($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return "Une erreur s'est produit lors de la modification de votre profil.";
        }
    }
}