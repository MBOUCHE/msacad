<?php

class Notification_model extends CI_Model{

    protected $table = 'notification';
    protected $tableNotifModel = 'notification_model';
    protected $tableUser = 'user';
    protected $tableUserRole = 'user_role';
    protected $tableNotifView = 'notification_views';
    protected $notificationView = 'notification_views';
    protected $tableRegistration = 'registration';

    function __construct()
    {
        parent::__construct();
    }

    public function saveModel($key, $value='')
    {
        return $this->db->set($key, $value)->insert($this->tableNotifModel);
    }

    public function updateModel($key, $content)
    {
        return $this->db->set('content', $content)
            ->where('id', $key)
            ->update($this->tableNotifModel);
    }

    public function getAllModel()
    {
        return $this->db->select()
            ->from($this->tableNotifModel)
            ->get()->result();
    }

    public function getMyNotif(){
        return $this->db->query("
            SELECT nv.id, n.content, n.url, n.send_date, us.firstname, us.lastname
            FROM notification_views nv
              INNER JOIN notification n ON n.id = nv.notification
              INNER JOIN user us ON us.id = n.sender
              INNER JOIN user ur ON ur.id = nv.user
            WHERE ur.id = ? AND ((n.target = ? AND n.promotion=0) OR (n.target = ? AND n.promotion=2) OR (n.promotion = -1 AND n.target = ?) OR (n.target = 1  AND n.promotion=0)) 
            ORDER BY n.send_date DESC
            ", array(session_data('id'),session_data('role'),session_data('role'),session_data('id')))->result();

        /*return $this->db->distinct()->select('nv.id, u.firstname, u.lastname, n.content, n.url, n.send_date')
            ->from($this->table.' n')
            ->join($this->tableNotifView.' nv', 'nv.notification = n.id', 'left')
            ->join($this->tableUser.' u', 'nv.user = u.id', 'left')
            ->where('u.id = '.session_data('id'))
            ->order_by('n.send_date', 'desc')
            ->get()->result();*/
    }

    public function getOneModel($id)
    {
        return $this->db->select()
            ->from($this->tableNotifModel)
            ->where('id', $id)
            ->get()->result()[0];
    }

    public function newNotif()
    {
        if(session_data('connect') And (session_data('role')<0 Or session_data('role')>6)) return false;
       return $this->db->query("
            SELECT nv.id, n.content, n.url, n.send_date, us.firstname, us.lastname
            FROM notification_views nv
              INNER JOIN notification n ON n.id = nv.notification
              INNER JOIN user us ON us.id = n.sender
              INNER JOIN user ur ON ur.id = nv.user
            WHERE ur.id = ? AND ((n.target = ? AND n.promotion=0) OR (n.target = ? AND n.promotion=2) OR (n.promotion = -1 AND n.target = ?) OR (n.target = 1  AND n.promotion=0)) AND nv.viewed = ?
            ORDER BY n.send_date DESC
            ", array(session_data('id'),session_data('role'),session_data('role'),session_data('id'),'0'))->result();

        return $this->db->distinct()->select('nv.id, u.firstname, u.lastname, n.content, n.url, n.send_date')
            ->from($this->table.' n')
            ->join($this->tableNotifView.' nv', 'nv.notification = n.id', 'left')
            ->join($this->tableUser.' u', 'nv.user = u.id', 'left')
            ->where('u.id = '.session_data('id'))
            ->where('nv.viewed = \'0\'')
            ->order_by('n.send_date', 'desc')
            ->get()->result();
    }

    public function notificationView(array $data = array())
    {
        if($data) {
            $this->db->trans_begin();
            foreach($data as $id) {
                $this->db->set('viewed', '1')->where('id', $id)->update($this->tableNotifView);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
        return false;
    }

    public function publish(array $data = array())
    {
        if(isset($data['promotion']) And $data['promotion']===-1){
            if(is_string($data['target'])){
                $data['target'] = explode(';',$data['target']);
            }
            if(is_array($data['target'])) {
                $user = array();
                foreach($data['target'] as $key => $item){
                    $user[$key] = new stdClass();
                    $user[$key]->user = $item;
                }
                $data['target'] = implode(';', $data['target']);
            }
        }elseif($data['target'] == 0){
            $user = $this->db->select('id user')->from($this->tableUser)->get()->result();
        }elseif($data['target'] == 2){
            $user = $this->db->select('u.id user')
                ->from($this->tableUser.' u, '.$this->tableRegistration.' rg, '.$this->tableUserRole.' ur')
                ->where('ur.role = '.$data['target'].' AND rg.promotion = '.$data['promotion'].' AND ur.user = u.id AND rg.user = ur.user')
                ->get()->result();
        }else{
            $user = $this->db->select('u.id user')
                ->from($this->tableUser.' u')
                ->join($this->tableUserRole.' ur', 'ur.user = u.id', 'left')
                ->where('ur.role = '.$data['target'])
                ->get()->result();
        }

        $data['send_date'] = moment()->format('Y-m-d H:i:s');
        $this->db->trans_begin();
        $this->db->set($data)->insert($this->table);
        $notif = $this->db->select_max('id')->from($this->table)->get()->result()[0]->id;

        foreach($user as $item) {
            $this->db->set(array(
                'user'  => $item->user,
                'notification'  => $notif
            ))->insert($this->notificationView);
        }

        if($this->db->trans_status()===FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            return true;
        }
        return false;
    }
   
}