<?php
class Events_model extends CI_Model{

    protected $log = 'log';
    protected $user = 'user';
    protected $agenda = 'agenda';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('backfront/log_model', 'logs');
    }

    public function getAllEvents()
    {
        return $this->db->select('a.*')
            ->from($this->agenda.' a')
            ->order_by('a.start_date', 'ASC')
            ->get()->result();
    }

    public function getEvents($key, $where=false)
    {
        if(!$where)
            $where = 'id = '.$key;

        return $this->db->select()
            ->from($this->agenda)
            ->where($where)
            ->get()->result();
    }

    public function setEvents($data)
    {
        $this->db->trans_begin();
        $this->db->set($data)->insert($this->agenda);
        if(count($id = $this->db->select_max('id')->from($this->agenda)->get()->result())!=1) {
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
                'date'=>moment()->format(NO_TZ_MYSQL),
                'action'=>'Enregistrement de l\'évènement : '.$id[0]->id.'. - Nom du '.role_tostring(session_data('role')).' :'.session_data('firstname').' '.session_data('lastname'));
            $this->logs->save($field);
            return true;
        }
    }

    public function updateState($key, $active=true)
    {
        if($active)
            $active = 1;
        else
            $active = 0;

        return $this->db->update($this->agenda, array('state'=>$active), array('id'=>$key));
    }

    public function updateEvents($data, $key)
    {
        $this->db->trans_begin();
        $this->db->set($data)->where('id', $key)->update($this->agenda);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }
        else {
            $this->db->trans_commit();
            $field = array('motivation'=>'',
                'author'=>session_data('id'),
                'date'=>moment()->format(NO_TZ_MYSQL),
                'action'=>'Modification de l\'évènement : '.$key.'. - Nom du '.role_tostring(session_data('role')).' :'.session_data('firstname').' '.session_data('lastname'));
            $this->logs->save($field);
            return true;
        }
    }
}