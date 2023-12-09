<?php
define("MAX_EVENTS_PER_PAGE", 20);
class Events_model extends CI_Model{

    protected $log = 'log';
    protected $user = 'user';
    protected $agenda = 'agenda';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id=null,$page=0,$limit=MAX_EVENTS_PER_PAGE){
        if($id==null) {

             return $this->db->query("SELECT * FROM agenda WHERE state = ? AND start_date > CURRENT_DATE ORDER BY start_date ASC LIMIT ? OFFSET ?",array(1,$limit,$page*$limit))->result();

        }else{
            return $this->db->query("SELECT * FROM agenda WHERE state = ? AND id=? AND start_date > CURRENT_DATE ORDER BY start_date ASC",array(1,$id))->result();
        }
    }

    public function count(){
        return $this->db->count_all($this->agenda);
    }

}