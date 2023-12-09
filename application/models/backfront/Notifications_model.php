<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notifications_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

   public function getNotification($numberId=null)
   {

       if($numberId==null){
           return $this->db->query("

           SELECT nv.id, n.content, n.url, n.send_date, us.firstname, us.lastname
            FROM notification_views nv
              INNER JOIN notification n ON n.id = nv.notification
              INNER JOIN user us ON us.id = n.sender
              INNER JOIN user ur ON ur.id = nv.user
            WHERE ur.id = ? AND ((n.target = ? AND n.promotion=0) OR (n.target = ? AND n.promotion=2) OR (n.promotion = -1 AND n.target = ?) OR (n.target = 1  AND n.promotion=0))
            ORDER BY n.send_date DESC
            ", array(session_data('id'),session_data('role'),session_data('role'),session_data('id')))->result();

           $select = 'nv.id, u.firstname, u.lastname, n.content, n.url, n.send_date';
           return $this->db->distinct()->select($select)
               ->from('notification n')
               ->join('notification_views nv', 'nv.notification = n.id', 'left')
               ->join('user u', 'nv.user = u.id', 'left')
               ->where('u.id = '.session_data('id'))
               ->order_by('n.send_date', 'desc')
               ->get()->result();
       }
       else
       {
             return $this->db->query("
            SELECT nv.id, n.content, n.url, n.send_date, us.firstname, us.lastname
            FROM notification_views nv
              INNER JOIN notification n ON n.id = nv.notification
              INNER JOIN user us ON us.id = n.sender
              INNER JOIN user ur ON ur.id = nv.user
            WHERE ur.id = ? AND ((n.target = ? AND n.promotion=0) OR (n.target = ? AND n.promotion=2) OR (n.promotion = -1 AND n.target = ?) OR (n.target = 1  AND n.promotion=0))
            ORDER BY n.send_date DESC
            ", array(session_data('id'),session_data('role'),session_data('role'),session_data('id'),$numberId))->result();

           $select = 'nv.id, u.firstname, u.lastname, n.content, n.url, n.send_date';
           return $this->db->distinct()->select($select)
               ->from('notification n')
               ->join('notification_views nv', 'nv.notification = n.id', 'left')
               ->join('user u', 'nv.user = u.id', 'left')
               ->where('u.number_id',$numberId)
               ->order_by('n.send_date', 'desc')
               ->get()->result();
       }

   }

    public function notificationView(array $data = array())
    {
        if($data) {
            $this->db->trans_begin();
            foreach($data as $id) {
                $this->db->set('viewed', '1')->where('id', $id)->update('notification_views');
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
        if(isset($data['promotion']) And $data['promotion']==-1){
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
            $user = $this->db->select('id user')->from('user')->get()->result();
        }elseif($data['target'] == 2){
            $user = $this->db->select('u.id user')
                ->from('user u')
                ->join('user_role ur', 'ur.user = u.id', 'left')
                ->join('registration rg', 'rg.user = ur.user', 'left')
                ->where('ur.role = '.$data['target'].' AND rg.promotion = '.$data['promotion'])
                ->get()->result();
        }else{
            $user = $this->db->select('u.id user')
                ->from('user u')
                ->join('user_role ur', 'ur.user = u.id', 'left')
                ->where('ur.role = '.$data['target'])
                ->get()->result();
        }

        $data['send_date'] = moment()->format('Y-m-d H:i:s');
        $this->db->trans_begin();
        $this->db->set($data)->insert('notification');
        $notif = $this->db->select_max('id')->from('notification')->get()->result()[0]->id;

        foreach($user as $item) {
            $this->db->set(array(
                'user'  => $item->user,
                'notification'  => $notif
            ))->insert('notification_views');
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