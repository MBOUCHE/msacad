<?php
class Lesson_model extends CI_Model
{

    protected $table = 'lesson';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data=array())
    {
        //var_dump($this->db->select('*')->from($this->table)->where(array('code'=>$data['code']))->get()->result()); die();
        if(!empty($this->db->select('*')->from($this->table)->where(array('code'=>$data['code']))->get()->result()))
        {
            return 'Ce code existe déjà.';
        }else{
            return $this->db->set($data)->insert($this->table);
        }
    }

    public function getAll()
    {

        return $this
            ->db->select('*')
            ->from($this->table)
            ->where('state != 0')
            ->order_by("label", "ASC")
            ->get();
        //$return = $this->db->get($this->table)->result();
        //var_dump($return); die(0);

    }

    public function getL($id=false, $type="all")
    {
        $query="";
        if (is_integer(intval($id)) and !is_bool($id))
        {
            if ($type=="all")
                $query=$this->db->query('select * from lesson where id=?', array(intval($id)));
            else
                $query=$this->db->query('select * from lesson where id=? and type=?', array(intval($id), $type));
            return !empty($query->result())?$query->result()[0]:null;
        } else
        {
            if ($type=="all")
                $query=$this->db->query('select * from lesson');
            else
                $query=$this->db->query('select * from lesson where type=?', $type);
            return !empty($query->result())?$query->result():null;
        }
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, array('id' => $id));
    }

    public  function updateTable($data, $id){
        return $this->db->update($this->table, $data, "id = ".$id);
    }

    public function retrieveLessons()
    {
        $lessons=$this->db->query('select id, label, code, fees from lesson where state != 0');
        $less=array();
        if(!empty($lessons->result())){
            array_push($less, $lessons->first_row('array'));
            while($row=$lessons->next_row('array'))
                array_push($less, $row);
        }

        $cours=array('allLess'=>$less);
        //array_push($less, $lessons);
        return $cours;
    }

    public function delete($id){
        return $this->db->update($this->table, array('state'=>0), 'id = '.$id);
    }

    public function getLessonByLessonAll($idLa=false){
        if($idLa){
            //var_dump($idLa); die(0);
            $idLesson = $this->db->select('lesson')->from('lesson_allocation')->where(array('id'=>$idLa))->get()->result();
            //var_dump($idLesson); die(0);
            if(!empty($idLesson)){
                return $this->db->select('*')->from('lesson')->where(array('id'=>$idLesson[0]->lesson))->get()->result();
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }
}