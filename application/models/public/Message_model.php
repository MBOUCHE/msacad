<?php
class Message_model extends CI_Model
{

    protected $table = 'message';
    protected $user = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id=null,$type=MSG_APPRECIATION)
    {
        if($id!=null){
            return $this
                ->db->query("
            SELECT u.avatar,u.number_id,u.firstname,u.lastname,u.id AS userId, u.register_date, m.*
            FROM message m
            INNER JOIN user u ON u.id = m.user
            WHERE m.id = ? AND m.type = ?
            ",array($id,$type))->result();
        }
        return $this
            ->db->query("
            SELECT u.avatar,u.number_id,u.firstname,u.lastname,u.id AS userId, u.register_date,m.*
            FROM message m
            INNER JOIN user u ON u.id = m.user
            WHERE m.type = ?
            ORDER BY m.save_date DESC
            ",array($type))->result();
    }

    public function getRequets($id=null){
        if($id!=null){
            return $this
                ->db->query("
            SELECT u.avatar,u.firstname,u.lastname,u.id AS userId, u.register_date, m.*
            FROM message m
            INNER JOIN user u ON u.id = m.user
            WHERE m.user = ? AND m.type = ?
            ORDER BY m.save_date DESC
            ",array($id,MSG_REQUETE))->result();
        }
        return $this
            ->db->query("
            SELECT u.avatar,u.firstname,u.lastname,u.id AS userId, u.register_date,m.*
            FROM message m
            INNER JOIN user u ON u.id = m.user
            WHERE m.type = ?
            ORDER BY m.save_date DESC
            ",array(MSG_REQUETE))->result();
    }

    public function responseRequest($id,$response){
        return $this->db->update('message',array('response'=>$response,'state'=>1),array('id'=>$id));
    }


    public function save($field){
        return $this->db->set($field)->insert($this->table);
    }

    public function setState($state,$id){
        return $this->db->set('state', $state)
            ->where('id', $id)
            ->update($this->table);
    }
    public function updateContent($content,$id){
        return $this->db->set('content', $content)
            ->where('id', $id)
            ->update($this->table);
    }
}