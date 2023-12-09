<?php
class Material_model extends CI_Model
{

    protected $table = 'material';
    protected $transact = 'transaction';
    protected $log = 'log';

    public function __construct()
    {
        parent::__construct();
    }

    public function saveM($data=array(), $type=false)
    {
        //var_dump($data); var_dump($type);
        $test = array('name'=>$data['name'], 'type'=>$data['type'], 'packaging'=>$data['packaging']);
        $name = $this->db->select('*')->from($this->table)->where($test)->get()->result();
        //var_dump($name);
        if(empty($data)) {
            return 'Le tableau est vide';
        }elseif(!empty($name)){//le materiel existe deja
            return intval($name[0]->id, 10);
            //var_dump(intval($name[0]->id, 10));
        }elseif($type == "retrait"){
            return false;
        }elseif($type == "ajout" and $this->db->set($data)->insert($this->table)){//le materiel nexiste pas
            return $this->db->query('select MAX(id) AS maxid from material')->row();
            //var_dump($this->db->query('select MAX(id) AS maxid from material')->row()); die(0);
        }else{
            return false;
        }
    }

    public function saveT($trans=array(), $matQty=false, $id=false){
        if(empty($trans)){
            return 'Le tableau est vide';
        }elseif($this->db->set('qty', $matQty, FALSE)->where('id', $id)->update($this->table)){
            return $this->db->set($trans)->insert($this->transact);
        }
    }

    public function lyst()
    {
        //return $this->db->get($this->table);
        //return $this->db->query('select material.id, material.name, material.type, material.packaging, transaction.id as idT, transaction.type as TP, transaction.date as dateReg, transaction.qty from material, transaction where material.id = transaction.material');
        return $this->db->query('select material.id, material.name, material.type, material.packaging, material.qty from material ORDER BY material.id DESC');
        ;
        //var_dump($this->db->query('select material.name, material.type, material.packaging, transaction.type, transaction.date as dateReg, transaction.qty from material, transaction where material.id = transaction.material')->row());
        //die(0);

    }

    public function userId($id){
        return $this->db->query('select TRANSACTION.USER from transaction WHERE transaction.user = '.$id)->row();
    }

    public function selectAll($id=false, $idT=false)
    {
        //return $this->db->get_where($this->table, array('id' => $id));
        return $this->db->query('select material.id, material.name, material.type, material.packaging from material where material.id = '.$id );
    }

    public  function updateMat($data, $id){
        return $this->db->update($this->table, $data, "id = ".$id);
    }

    public function updateTrans($data, $id){
        return $this->db->update($this->transact, $data, "id = ".$id);
    }

    public function selectId($id){
        return $this->db->query('select transaction.id from transaction WHERE transaction.material = '.$id)->row();
    }


    public function saveLog($dataLog){
        return $this->db->set($dataLog)->insert($this->log);
    }

    public function inventory($id=false){
        if($id == false){
            return $this->db->query('SELECT material.id, material.name, material.packaging, material.type as matType, transaction.qty, transaction.date as transDate, transaction.type as transType, transaction.user FROM material, transaction WHERE material.id in (SELECT transaction.material FROM material) ORDER BY material.id DESC');
        }
    }

    public function userName($id){
        return $this->db->query("select user.firstname, user.lastname from user WHERE user.id = ".$id)->row();
    }

    public function currentStock($id){
        $add = intval($this->db->query("SELECT sum(qty) as qtySum from transaction WHERE transaction.type='ajout' and transaction.material = ".$id)->row()->qtySum);
        $remove = intval($this->db->query("SELECT sum(qty) as qtySum from transaction WHERE transaction.type='retrait' and transaction.material = ".$id)->row()->qtySum);
        if(empty($remove)){
            return $add;
        }elseif(!empty($remove)){
            return $add - $remove;
        }
    }

    public function lastQtyMaterial($id){
        return intval($this->db->select('qty')->from($this->table)->where('id', $id)->get()->result()[0]->qty);
    }

}