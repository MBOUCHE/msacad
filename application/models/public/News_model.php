<?php
define("MAX_NEWS_PER_PAGE", 10);
define("MAX_SLIDE_PER_PAGE", 6);
class News_model extends CI_Model
{

    protected $table = 'news';
    protected $transact = 'transaction';
    protected $log = 'log';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id=null,$page=0,$limit=MAX_NEWS_PER_PAGE){
        if($id==null) {
            return $this->db->select()
                ->from($this->table)
                ->order_by("save_date","DESC")
                ->limit($limit,$page*$limit)
                ->where('state', 1)
                ->where('show_in_slider !=', 1)
                ->get()
                ->result();
        }else{
            return $this->db->select()
                ->from($this->table)
                ->order_by("save_date","DESC")
                ->limit($limit,$page*$limit)
                ->where('id', $id)
                ->where('state', 1)
                ->get()->result();
        }
    }
    public function getSlides($limit=MAX_NEWS_PER_PAGE){
        return $this->db->select()
            ->from($this->table)
            ->order_by("save_date","DESC")
            ->limit($limit)
            ->where('state', 1)
            ->where('show_in_slider', 1)
            ->get()->result();

    }

    public function count(){
        return $this->db
            ->where('state', 1)
            ->where('show_in_slider !=', 1)->count_all_results($this->table);
    }

}