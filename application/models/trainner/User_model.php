<?php


class User_model extends CI_Model
{
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

    public function getUsers($field=null, $order=null)
    {
        $orderby="ASC";
        if(isset($order))
        {
            $order = mb_strtoupper($order);
            if (in_array($order, array("ASC", "DESC")))
                $orderby=$order;
        }

        $fieldOrder="register_date";
        if(isset($field))
        {
            if (in_array($field, array("id", "firstname", "lastname", "birth_date", "birth_place", "last_connexion", "nationality")))
                $fieldOrder=$field;
        }

        return $this->db->query("select DISTINCT(user.id)  as uid , user.* from user
                                    inner join user_role
                                    on user.id=user_role.user
                                    where user_role.role>?  order by $fieldOrder $orderby", array(MEMBER))->result();
    }

    public function lock($id)
    {
        $user=$this->db->query('select * from user where id=?', $id)->result()[0];
        if (isset($user) and is_object($user) and !empty($user)){
            $this->db->trans_begin();
            if ($user->state=='0' or $user->state=='1')
            {
                $this->db->query('update user set state=? where id=?', array('-1', $user->id));
                $this->notification->publish(array(
                    "sender"=>$this->userId,
                    "content"=>"Votre compte utilisateur a été suspendu.",
                    "send_date"=>moment()->format('Y-m-d H:i:s'),
                    "target"=>$id,
                    "promotion"=>-1,
                    "url"=>""
                ));
                $this->logm->save(array(
                    "motivation"=>"",
                    "author"=>$this->userId,
                    "date"=>moment()->format('Y-m-d H:i:s'),
                    "action"=>"Suspension du compte utiliateur de ".($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname)." ".ucfirst($user->firstname)."."
                ));
            } else
            {
                $this->db->query('update user set state=? where id=?', array('1', $user->id));
                $this->notification->publish(array(
                    "sender"=>$this->userId,
                    "content"=>"Votre compte utilisateur a été réactivé.",
                    "send_date"=>moment()->format('Y-m-d H:i:s'),
                    "target"=>$id,
                    "promotion"=>-1,
                    "url"=>""
                ));
                $this->logm->save(array(
                    "motivation"=>"",
                    "author"=>$this->userId,
                    "date"=>moment()->format('Y-m-d H:i:s'),
                    "action"=>"Réactivation du compte utiliateur de ".($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname)." ".ucfirst($user->firstname)."."
                ));
            }
            if ($this->db->trans_status()==TRUE)
            {
                $this->db->trans_commit();
                return $user;
            } else
            {
                $this->db->trans_rollback();
                return "Une erreur s'est produite lors de la ".($user->state==-1?'réactivation':'suspension')." du compte utilisateur de ".($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname)." ".ucfirst($user->firstname).".";
            }
        } else
        {
            return "Cet utilisateur n'existe pas.";
        }
    }

    public function getUser($id)
    {
        return $this->db->query('select * from user where id=?', $id);
    }

    public function getUserRoles($id)
    {
        return $this->db->query('select user_role.role as role from user_role inner join user on user.id=user_role.user where user.id=? and user_role.role>? order by role asc', array($id, 1));
    }


}