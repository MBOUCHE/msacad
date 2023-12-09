<?php
class LessonA_model extends CI_Model
{

    protected $table = 'lesson';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllocations($trainer)
    {
        return $this->db->query('select * from lesson_allocation where user=?', $trainer)->result();
    }

}