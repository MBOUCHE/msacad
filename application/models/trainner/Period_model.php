<?php
class Period_model extends CI_Model{

    protected $table = 'period';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data=array())
    {
        return $this->db->set($data)->insert($this->table);
    }

    public function lyst()
    {
        return $this->db->get($this->table);
    }

    public function updateTable($post, $id){
        return $this->db->update($this->table, $post, "id = ".$id);
    }
    
      public function get($period)
    {
        $query=$this->db->query('select * from period where id=?', intval($period));
        return !empty($query->result())?$query->result()[0]:null;
    }

}