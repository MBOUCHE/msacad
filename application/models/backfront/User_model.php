<?php
class User_model extends CI_Model{

    protected $table = 'user';
    protected $data = array();
    protected $roles = array(MEMBER, STUDENT, TRAINER, MODERATOR);
    protected $tableRole = 'user_role';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backfront/notifications_model', 'notification');
        //$this->load->model('backfront/log_model', 'log');
        $this->userId=session_data('id');
    }

    public function signUp($data = array()){

        //echo mailView(array('mail'=>array('title'=>'ceci est le titre','message'=>'ceci est le message')));
        //return !empty($this->db->select('id')->from($this->table)->where('phone', $data['phone'])->get()->result());
        if (isset($data['phone']) And !empty($this->db->select('id')->from($this->table)->where('phone', $data['phone'])->get()->result())) {
            return 'Ce numero de téléphone existe déjà.';
        }
        if (isset($data['mail']) And !empty($this->db->select('id')->from($this->table)->where('mail', $data['mail'])->get()->result())) {
            return 'Cet e-mail existe déjà.';
        }

        $title="Bienvenue dans la Plateforme MULTISOFT ACADEMY.";
        $message=($data['sexe']==0?'Mme ':'M. ').mb_strtoupper($data['lastname']).' '.ucwords($data['firstname']).', Le Centre de Formation Professionnelle vous souhaite la bienvenue dans sa plateforme en ligne.<br> Utilisez les informations de compte suivantes pour vous connecter : <br>
            Login :  <b>'.$data['mail'].'</b><br>
            Mot de passe : <b>'.$data['pwd'].'</b><br>
            Cliquer sur <a target="_blank" href="'.base_url('account/login').'">ce lien</a> pour vous connecter.';


        if($data['pwd'] != $data['npwd'])
            return 'Les mots de passe ne sont pas identiques';

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
            ->set('login', $data['mail'])
            ->set('pwd', sha1($data['pwd']))
            ->set('register_date', moment()->format('Y-m-d H:i:s'))
            ->set('state', '0')
            ->set('school', 'none')
            ->set('number_id', newNumberId($nbrUser+1))
            ->set('school_area', 'none')
            ->set('school_level', 'none')
            ->set('avatar', 'assets/img/img_avatar.png')
            ->set('photo', 'assets/img/img_avatar.png')
            ->set('last_connexion', "null")
            ->insert($this->table);

        /**
         *
         * Insertion des les logs et notification
         *
         */

        $identifier=$this->db->select('id,number_id')->from('user')->where('mail', $data['mail'])->get()->result()[0];
        $userId=$identifier->id;
        $number_id=$identifier->number_id;
        $names=$this->db->query('select firstname, lastname from user where mail=?', $data['mail'])->row();
        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array($names->firstname.' '.$names->lastname.' s\' inscrit(e) à la plateforme.', $userId, moment()->format('Y-m-d H:i:s').'.'  ));
        $this->db->query('insert into notification(sender, content, send_date, target, url,promotion)
                                      values(?, ?, ?, ?, ?,?)', array(1, "Bienvenue dans la plateforme MULTISOFT ACADEMY.", moment()->format('Y-m-d H:i:s'), $userId, '#',-1));
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

            $title="Bienvenue dans la Plateforme MULTISOFT ACADEMY.";
            $message=($data['sexe']==0?'Mme ':'M. ').mb_strtoupper($data['lastname']).' '.ucwords($data['firstname']).', Le Centre de Formation Professionnelle vous souhaite la bienvenue dans sa plateforme en ligne.<br> Utilisez les informations de compte suivantes pour vous connecter : <br>
            Login :  <b>'.$data['mail'].'</b><br>
            Mot de passe : <b>'.$data['pwd'].'</b><br>
            Cliquer sur <a target="_blank" href="'.base_url('account/login').'">ce lien</a> pour vous connecter.';

            $data = (object)$data;
            $sent = sendMail(array("user"=>$data, "title"=>$title, "message"=>$message));

            if (is_bool($sent) And $sent) {
                $this->db->trans_commit();
                $result=array('id'=>$userId, 'status'=>true,'number_id'=>$number_id);
                return $result;
            } else {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de l'enregistrement de l'apprenant: Echec d'envoi de l'e-mail. Veuillez vérifier votre connexion Internet.";
            }
        }
    }

    public function auth($data=false, $id='')
    {
        $select = 'u.id, u.number_id, u.avatar, u.firstname, u.lastname, u.state, ur.role, ur.locked';

        if(!$data And $id)
        {
            $data['remember'] = false;
                $user = $this->db->select($select)
                    ->from($this->table.' u')
                    ->join($this->tableRole.' ur', 'ur.user = u.id', 'left')
                    ->where('ur.role <= '.MODERATOR)
                    ->where(array('SHA1(u.id)' => $id))
                    ->get()->result();
        }
        elseif(is_array($data) And isset($data['pwd'], $data['mail']))
        {
            $user = $this->db->select($select)
                ->from($this->table.' u')
                ->join($this->tableRole.' ur', 'ur.user = u.id', 'left')
                ->where('ur.role <= '.MODERATOR)
                ->where(array('u.pwd'=>sha1($data['pwd'])))
                ->where('(u.mail = \''.$data['mail'].'\' OR u.number_id = \''.$data['mail'].'\')')
                ->get()->result();
        }

        if(isset($user))
        {
            if(count($user)>1){
                $role = array();
                $key = 0;

                foreach($user as $key=>$item)
                {

                    if($item->locked!=0 && $item->state !='-1')
                        $role[count($role)] = $item->role;
                }
                if(empty($role))
                    return -1;

                $this->data = $this->user_data_session($user[$key], 1, $role);
                $this->db->set('last_connexion', moment()->format('Y-m-d H:i:s') )->where('id', $user[0]->id)->update($this->table);
                if(($user[$key]->state == '0'))
                {
                    $this->data['new'] = true;
                }


                set_session_data($this->data);
                if($data['remember'])
                {
                    set_cookie('msa_user', sha1(session_data('id')), 3600*24*365);
                }
                return 1;
            }
            elseif(count($user)==1){
                $user = $user[0];

                if($user->locked==0 or $user->state =='-1')
                    return -1;

                $this->db->set('last_connexion',  moment()->format('Y-m-d H:i:s'))->where('id', $user->id)->update($this->table);
                $this->data = $this->user_data_session($user, false,array($user->role));
                if(($user->state == '0'))
                {
                    $this->data['new'] = true;
                }
                set_session_data($this->data);

                if($data['remember'])
                {
                    set_cookie('msa_user', sha1(session_data('id')), 3600*24*365);
                }
                return 1;
            }
        }
        return 0;
    }

    public function androAuth($login,$pass){
        return $this->db->query("SELECT * FROM user WHERE number_id=? AND pwd=sha1(?)",array($login,$pass))->result();
    }

    public function getRole($user, $role=0)
    {
        $query="";
        if ($role!=0)
        {
            if(in_array($role, $this->roles))
            {
                $query="select * from " . $this->tableRole . " where user=" . $user . " and role= ".$role;
            } else
            {
                return "Rôle non reconnu.";
            }
        } else
        {
            $query="select * from " . $this->tableRole . " where user=" . $user;
        }
        $result=$this->db->query($query)->result();
        return ((is_array($result) and !empty($result))?$result:"Une erreur s'est produite.");
    }

    public function getUser($id)
    {
        if (is_integer($id))
            return $this->db->query('select * from user where id=?', $id)->result();
        else
            return $this->db->query("select * from user where number_id=? or mail=?", array($id, $id))->result();
    }

    public function getUsers()
    {
        return $this->db->query('SELECT u.id uid, u.* FROM user u WHERE u.id NOT IN (SELECT DISTINCT u.id FROM user u LEFT JOIN user_role ur ON ur.user = u.id WHERE ur.role > 1)')->result();
    }

    public function getAllUsers()
    {
        return $this->db
            ->distinct()->select('u.*')
            ->from('user u')
            ->join('user_role ur', 'ur.user = u.id')
            ->where('ur.role > 1')
            ->get()->result();
    }

    public function getUserNotif(){
        return $this->db->query("
            SELECT nv.id, n.content, n.url, n.send_date, us.firstname, us.lastname
            FROM notification_views nv
              INNER JOIN notification n ON n.id = nv.notification
              INNER JOIN user us ON us.id = n.sender
              INNER JOIN user ur ON ur.id = nv.user
            WHERE ur.id = ? AND ((n.target = ? AND n.promotion=0) OR (n.target = ? AND n.promotion=2) OR (n.promotion = -1 AND n.target = ?) OR (n.target = 1  AND n.promotion=0)) AND nv.viewed = ?
            ORDER BY n.send_date DESC
            ", array(session_data('id'),session_data('role'),session_data('role'),session_data('id'),'0'))->result();

    }

    public function complete($data=array())
    {
        //insérer log
        $this->db->trans_begin();
        $this->db->where('id', $data['id'])
            ->set('pwd', $data['pwd'])
            ->set('question', $data['question'])
            ->set('answer', $data['answer'])
            ->set('avatar', $data['avatar'])
            ->set('mcq', $data['mcq'])
            ->set('state', '1')
            ->update($this->table);
        if ($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            set_session_data(array('new'=>false));
            return true;
        } else
        {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function userExist($value, $field="id")
    {
        if (in_array($field, $this->db->query("select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where table_name = 'user' order by ORDINAL_POSITION")->result_array()[0]))
        {
            $fieldset=$field;
        } else
        {
            $fieldset=$field;
        }
        return ($this->db->query("select * from user where $fieldset=?", $value)->num_rows()>0?1:0);
    }

    public function resetPassword($id, $pwd)
    {
        //Insérer log
        return $this->db->where('id', $id)->set('pwd', sha1($pwd))->update($this->table);
    }

    public function userUpdateState($id, $active=true)
    {
        if($active)
            $active = '1';
        else
            $active = '-1';

        return $this->db
            ->set('state', $active)
            ->where('id', $id)
            ->update('user');
    }

    public function issetUser($id, $answer)
    {
        if (is_integer(intval($id)))
            return ($this->db->query('select * from user where id=? and answer=?', array($id, $answer))->num_rows()==1?1:0);
        //return "select * from user where id=$id and answer='$answer'";
        else
            return ($this->db->query("select * from user where (number_id=? or mail=?) and answer=?", array($id, $id, $answer))->num_rows()==1?1:0);
        //return "select * from user where (number_id='$id' or mail='$id') and answer='$answer'";
    }

    public function savePhoto($photo, $id){
        $photo = array('avatar'=>$photo);
        return $this->db->update($this->table, $photo, "id = ".$id);
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
            ->set('school', $data['school'])
            ->set('school_area', $data['school_area'])
            ->set('school_level', $data['school_level'])
            ->set('pwd', sha1($pwd))
            ->update($this->table);
        $this->logM->save(array(
            "motivation"=>"",
            "author"=>$this->userId,
            "date"=>moment()->format('Y-m-d H:i:s'),
            "action"=>"Modification du profil"
        ));
        $this->notification->publish(array(
            "sender"=>$this->userId,
            "content"=>"Votre profil a été modifié avec succès.",
            "send_date"=>moment()->format('Y-m-d H:i:s'),
            "target"=>$this->userId,
            "promotion"=>-1,
            "url"=>base_url('admin/loggedUserProfile/').$this->userId
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

    public function infoAccountForModerator()
    {
        return $this->db->query('SELECT u.* FROM user u WHERE u.id NOT IN (SELECT DISTINCT u.id FROM user u LEFT JOIN user_role ur ON ur.user = u.id WHERE ur.role > 4) ORDER BY CASE u.state WHEN \'0\' then 0 WHEN \'1\' then 1 else 2 END, u.lastname ASC, u.firstname ASC ')->result();
    }

    /**
     * @param false|int $role
     * @param false|array $roles
     */
    private function user_data_session($user, $role=1, $roles=false)
    {
        return array(
            'id'    =>$user->id,
            'new'   => false,
            'role'  =>($role)?$role:$user->role,
            'roles' =>$roles,
            'avatar'    =>$user->avatar,
            'connect'   =>true,
            'lastname'  =>mb_strtoupper($user->lastname),
            'firstname' =>ucwords(mb_strtolower($user->firstname)),
            'matricule' =>$user->number_id,
            'plink' =>mb_strtolower($user->number_id).'/'.permalink($user->firstname.' '.$user->lastname)
        );
    }

    public function hourDispense($iduser=false){
        if($iduser){
            //$iduser = (string)$iduser;
            return $this->db->select_sum('duration')->from('sessions')->where('user', (int)$iduser)->get()->result();
        }else return false;
    }

    public function lessonSlip(){
        return $this->db->query("
            select lesson_slip.content, lesson_slip.session, u.firstname, u.lastname,  s.day, period.start,
              period.end, s.duration,lesson_slip.locked, s.start_date,s.promotion
            FROM lesson_slip
            LEFT JOIN sessions s on s.id = lesson_slip.session
              LEFT JOIN period on period.id = s.period
            LEFT JOIN user u ON u.id = s.user

            WHERE u.id = ".session_data('id')."
            ORDER BY s.start_date DESC
        ")->result();
    }
    
     public function lessons(){
        return  $this->db->query('SELECT l.*, la.locked, la.start_date, la.end_date, la.id as laId
                        FROM lesson_allocation la
        LEFT JOIN lesson l ON la.lesson = l.id
        LEFT JOIN user ON user.id = la.user
        WHERE user.id = ? AND la.locked = ?
        ORDER BY l.label ASC
        ',array(session_data("id"),'0'))->result();
    }



}