<?php
class moderator_model extends CI_Model
{
    protected $user = 'user';
    protected $backUserId = array();
    public function __construct()
    {
        parent::__construct();
        $this->backUserId = $this->backUserId();
    }

    public function getUser()
    {
        return $this->db->query('SELECT u.* FROM user u WHERE u.id NOT IN (SELECT DISTINCT u.id FROM user u LEFT JOIN user_role ur ON ur.user = u.id WHERE ur.role > 4) ORDER BY CASE u.state WHEN \'0\' then 0 WHEN \'1\' then 1 else 2 END, u.lastname ASC, u.firstname ASC')
            ->result();
    }

    public function getNewUser()
    {
        return $this->db->query('SELECT u.* FROM user u WHERE u.id NOT IN (SELECT DISTINCT u.id FROM user u LEFT JOIN user_role ur ON ur.user = u.id WHERE ur.role > 4) AND u.state=\'0\' ORDER BY u.lastname ASC, u.firstname ASC')
            ->result();
    }

    public function getNbUserPerMonth()
    {
        $month = array();
        for($i=1; $i<13; $i++)
        {
            $month[$i] = (int)$this->db->select('COUNT(*)')->from('user')
                ->where('month(register_date)', $i)
                ->where('year(register_date)', moment()->format('Y'))
                ->where_not_in('id', $this->backUserId)
                ->get()->result()[0]->{'COUNT(*)'};
        }
        return $month;
    }

    public function getNbUserPerState()
    {
        $state = array();
        for($i=-1; $i<2; $i++)
        {
            $state[$i] = (int)$this->db->select('COUNT(*)')->from('user')
                ->where('state', (string)$i)
                ->where_not_in('id', $this->backUserId)
                ->get()->result()[0]->{'COUNT(*)'};
        }
        return $state;
    }
	public function getNbPost()
    {
        return $this->db->select()->from('post')->where("visible",'1')->get()->result();
    }
    public function getNbComment()
    {
        return $this->db->select()->from('comment')->where("visible",'1')->get()->result();
    }
    private function backUserId()
    {
        $notUsers = $this->db->select('u.id user')->from('user u')
            ->join('user_role ur', 'ur.user=u.id')
            ->where('ur.role > 4')->get()->result();
        foreach ($notUsers as $key=>$item) {
            $users[$key] = $item->user;
        }
        return $users;
    }
}