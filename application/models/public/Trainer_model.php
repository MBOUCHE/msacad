<?php
class Trainer_model extends CI_Model
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    public function getAll(){

        return $this->db->query("
        SELECT u.*
                FROM user u
                LEFT JOIN user_role ur ON ur.user = u.id
                WHERE ur.role = ".TRAINER." AND ur.locked=1 order by u.lastname");
    }
}