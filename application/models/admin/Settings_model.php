<?php
class Settings_model extends CI_Model{

    protected $table;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->table='settings';
        $this->userId=session_data('id');
        $this->load->model('admin/log_model', 'logm');
    }

    public function getSettings()
    {
        return $this->db->query('select * from settings')->result()[0];
    }


    public function save($data=array())
    {
        $this->db->trans_begin();
        $this->db->set($data)->update($this->table);
        $this->logm->save(array(
            "motivation"=>"",
            "author"=>$this->userId,
            "date"=>date('Y-m-d h:i:s'),
            "action"=>" a modifié les paramètres du système."
            ));
        if($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            return true;
        }else
        {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function getMinRegInstallment()
    {
        $query=$this->db->query('select reg_instalment as inst from settings');
        return !empty($query->result())?$query->result()[0]->inst:40;
    }
}