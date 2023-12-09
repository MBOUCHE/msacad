<?php
class Auth_model extends CI_Model{

    protected $table = 'user';
    protected $data = array();
    protected $tableRole = 'user_role';

    public function __construct()
    {
        parent::__construct();
    }

    public function auth($data=false, $id = '')
    {
        if(!$data And $id)
        {
            $id = explode(';;', $id);
            $data['remember'] = false;
            if(count($id)==2)
                $user = $this->db->select('u.id, u.firstname, u.lastname, ur.role')
                    ->from($this->table.' u')
                    ->join($this->tableRole.' ur', 'ur.user = u.id', 'left')
                    ->where(array('SHA1(u.id)' => $id[0], 'ur.role'=>$id[1], 'ur.locked'=>1))
                    ->get()->result();
        }
        elseif(is_array($data) And isset($data['pwd'], $data['mail']))
        {
            $user = $this->db->select('u.id, u.firstname, u.lastname, ur.role')
                ->from($this->table.' u')
                ->join($this->tableRole.' ur', 'ur.user = u.id', 'left')
                ->where('ur.role >= '.MANAGER)
                ->where(array('u.pwd'=>sha1($data['pwd']), 'ur.locked'=>1))
                ->where('(u.mail = \''.$data['mail'].'\' OR u.number_id = \''.$data['mail'].'\')')
                ->get()->result();
        }

        if(isset($user) And count($user)==1 )
        {

            $user = $user[0];
            $this->db->set('last_connexion',  moment()->format('Y-m-d H:i:s'))->where('id', $user->id)->update($this->table);
            $this->data = array(
                'id'=>$user->id,
                'firstname'=>$user->firstname,
                'lastname'=>$user->lastname,
                'role'=>$user->role,
                'connect'=>true,
                'sudo'=>true,
            );
            set_session_data($this->data);
            if($data['remember'])
            {
                set_cookie('multisoft', sha1($user->id).';;'.$user->role, 3600*24*365);
            }
            return true;
        }
        return false;
    }

    public function getRole($id)
    {
        return $this->db->select('role')
            ->from($this->tableRole)
            ->where(array('user'=>$id))
            ->order_by('role', 'ASC')
            ->get()->result();
    }

}