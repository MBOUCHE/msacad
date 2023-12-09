<?php
class Search_model extends CI_Model{

    protected $document = 'document';
    protected $lesson = 'lesson';
    protected $promotion = 'promotion';
    protected $registration = 'registration';
    protected $user = 'user';
    protected $userRole = 'user_role';
    protected $news = 'news';
    protected $agenda = 'agenda';
    protected $posts = 'post';

    public function __construct()
    {
        parent::__construct();
    }

    public function document($texte='')
    {
        return $this->db->select()
            ->from($this->document)
            ->like('name', $texte)
            ->get()->result();
    }

    public function lesson($texte='',$type=null)
    {
        if($type==null){
            return $this->db->select()
                ->from($this->lesson)
                ->like('code', $texte)
                ->or_like('label', $texte)
                ->get()->result();
        }
        else{
            return $this->db->select()
                ->from($this->lesson)
                ->like('code', $texte)
                ->or_like('label', $texte)
                ->where('type', $type)
                ->get()->result();
        }

    }

    public function promotion($texte='')
    {
        return $this->db->select('p.*, l.label')
            ->from($this->promotion.' p')
            ->join($this->lesson.' l', 'p.lesson=l.id', 'left')
            ->like('p.code', $texte)
            ->get()->result_array();
    }

    public function registration($texte='')
    {
        return $this->db->select('u.id userId, u.photo, u.lastname, u.firstname, r.code, l.id lId, l.label, l.fees, r.installment, r.registration_date reg_date,  r.dead_line, u.phone, r.id regId, r.validate_date val_date, r.state')
            ->from($this->registration.' r')
            ->join($this->user.' u', 'r.user = u.id', 'left')
            ->join($this->lesson.' l', 'r.lesson = l.id', 'left')
            ->like('r.code', $texte)
            ->order_by('r.registration_date', 'desc')
            ->get()->result_array();
    }

    public function user($texte='')
    {
        return $this->db->select('DISTINCT(u.id) uid, u.*')
            ->from($this->user.' u')
            ->join($this->userRole.' ur', 'u.id=ur.user', 'left')
            ->where(array('ur.role > 1'))
            ->like('number_id', $texte)
            ->or_like('firstname', $texte)
            ->or_like('lastname', $texte)
            ->get()->result();
    }

    public function news($texte){
	return $this->db->select()
            ->from($this->news)
            ->order_by("save_date","DESC")
            ->like('title', $texte)
            ->or_like('content', $texte)
            ->where('show_in_slider !=', 1)
            ->where('state', 1)
            ->get()
            ->result();
            
    }
    public function events($texte){
        return $this->db->query("SELECT * FROM agenda WHERE state = ? AND start_date > CURRENT_DATE AND (title LIKE ? OR content LIKE ?) ORDER BY start_date ASC ",array(1,"%$texte%","%$texte%"))->result();
    }

    public function posts($texte){
        return $this
            ->db->query("
            SELECT p.*, u.firstname, u.lastname,u.id as userId
            FROM post p
            LEFT JOIN user u ON u.id = p.user
            WHERE p.visible=? AND (p.title LIKE ? OR p.content LIKE ?) ORDER BY p.post_date DESC",array('1',"%$texte%","%$texte%"))->result();
    }
}