<?php
class Log_model extends CI_Model{

    protected $table = 'log';
    protected $user = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function getLogs()
    {
        return $this
            ->db->select('*')
            ->from($this->table)
            ->order_by("date","DESC")
            ->get();
    }

    public function userName($id){
        return $this->db->query("select user.firstname, user.lastname from user WHERE user.id = ".$id)->row();
    }

    public function nameAuthor($id){
        return $this->db->select('*')->from($this->log)->get()->result();
/*
        //var_dump($id);
        return $this->db->select('firstname', 'lastname')->from($this->user)->where(array('id'=>$id))->get();
        //var_dump($return->result());*/
    }

    public function save($field){
        return $this->db->set($field)->insert($this->table);
    }
}