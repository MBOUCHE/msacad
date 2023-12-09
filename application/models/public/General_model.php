<?php
class General_model extends CI_Model
{

    protected $table = 'lesson';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllInscription()
    {
        return $this
            ->db->select('*')
            ->where('state ','2')
            ->count_all_results('registration');
            //->count('registration');
    }
    public function getAllLesson()
    {
        return $this
            ->db->select('*')
            ->where('state',1)
            ->count_all_results('lesson');
    }
    public function getAllMember()
    {
        return $this
            ->db->select('*')
            ->count_all('user');
    }
    public function getAllVisits()
    {
        return $this
            ->db->query('SELECT SUM(view_page) visits FROM visitors')->result()[0]->visits;
    }
    public function getAllVisitors()
    {
        return $this
            ->db->query('SELECT COUNT(*) AS visitors FROM visitors')->result()[0]->visitors;
    }

    public function updateVisit(){
        $this->db->query("UPDATE settings SET visit = visit +1");
    }

    public function newVisitor(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = moment()->format('Y-m-d H:i:s');
        return $this->db->query("
            INSERT INTO visitors(ip, last_visite) VALUES (?,?)
            ON DUPLICATE KEY UPDATE view_page = view_page + 1",array($ip,$date));
    }
}