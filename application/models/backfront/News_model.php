<?php
class News_model extends CI_Model{

    protected $log = 'log';
    protected $user = 'user';
    protected $news = 'news';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backfront/log_model', 'logs');
    }

    public function getAllNews()
    {
        return $this->db->select('n.*')
            ->from($this->news.' n')
            ->order_by('n.state', 'desc')
            ->order_by('n.save_date', 'desc')
            ->get()->result();
    }

    public function getNews($key)
    {
        return $this->db->select()
            ->from($this->news)
            ->where('id', $key)
            ->get()->result();
    }

    public function setNews($data)
    {
        $data['save_date'] = moment()->format('Y-m-d H:i:s');

        $this->db->trans_begin();
        $this->db->set($data)->insert($this->news);
        if(count($id = $this->db->select_max('id')->from($this->news)->get()->result())!=1) {
            $this->db->trans_rollback();
            return false;
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }
        else {
            $this->db->trans_commit();
            $field = array('motivation'=>'',
                'author'=>session_data('id'),
                'date'=>moment(date($data['save_date'], 'Y-m-d H:i:s'))->format('Y-m-d H:i:s'),
                'action'=>'Enregistrement de la nouvelle :'.$id[0]->id.'. Nom du '.role_tostring(session_data('role')).' :'.session_data('firstname').' '.session_data('lastname'));
            $this->logs->save($field);
            return true;
        }
    }

    public function updateNews($data, $key)
    {
        $data['save_date'] = moment()->format('Y-m-d H:i:s');
        return $this->db->set($data)
            ->where('id', $key)
            ->update($this->news);
    }

    public function updateState($key, $active=true)
    {
        if($active)
            $active = 1;
        else
            $active = 0;

        return $this->db->update($this->news, array('state'=>$active), array('id'=>$key));
    }

    public function updateShowSlider($key, $active=true)
    {
        if($active)
            $active = 1;
        else
            $active = 0;

        return $this->db->update($this->news, array('show_in_slider'=>$active), array('id'=>$key));
    }
}