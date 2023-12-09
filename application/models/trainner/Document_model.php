<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model
{
    protected $table = 'document';
    protected $tableUser = 'user';
    protected $tableCode = 'codes';
    protected $tableRole = 'role';
    protected $notification = 'notification';
    protected $tableUserRole = 'user_role';
    protected $tablePromotion = 'promotion';
    protected $notificationView = 'notification_views';
    protected $tableRegistration = 'registration';

    function __construct()
    {
        parent::__construct();
    }

    public function save($data=array())
    {
        return $this->db->set($data)->insert($this->table);
    }

    public function getAll($id=false)
    {
        if(!$id) {
            return $this->db->select()
                ->from($this->table)
                ->get()->result();
        }elseif(is_numeric($id)){
            return $this->db->select()
                ->from($this->table)
                ->where('id', $id)
                ->get()->result();
        }
        return false;
    }

    public function getRoles($id=false)
    {
        if(!$id) {
            return $this->db->select()
                ->from($this->tableRole)
                ->get()->result();
        }else{
            return $this->db->select()
                ->from($this->tableRole)
                ->where('id', $id)
                ->get()->result();
        }
    }

    public function getVagues()
    {
        return $this->db->select('pr.id promo_id, pr.code')
            ->from($this->tablePromotion.' pr')
            ->where('state', '1')
            ->get()->result();
    }

    public function publish(array $data = array(), $id)
    {
        if(isset($data['promotion']) And $data['promotion']===-1){
            if(is_array($data['target'])) {
                $user = $data['target'];
                $data['target'] = implode(';', $data['target']);
            }
            else{
                $user = array($data['target']);
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
        $this->db->set($data)->insert($this->notification);
        $this->db->set('last_publish_date', moment()->format('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update($this->table);
        $notif = $this->db->select_max('id')->from($this->notification)->get()->result()[0]->id;

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