<?php
class Role_model extends CI_Model
{

    protected $table = 'role';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data=array())
    {
        if(isset($data['label']) And !empty($this->db->select('*')->from($this->table)->where('label', $data['label'])->get()->result()))
        {
            return 'Ce role existe déjà';
        }
        return $this->db->set($data)->insert($this->table);
    }

    public function lyst()
    {
        return $this->db->get($this->table);

    }

}