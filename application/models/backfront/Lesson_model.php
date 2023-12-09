<?php
class Lesson_model extends CI_Model
{

    protected $table = 'lesson';

    public function __construct()
    {
        parent::__construct();
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

    public function getByType($type)
    {

        return $this
            ->db->select('*')
            ->from($this->table)
            ->where('state != 0')
            ->where('type', $type)
            ->order_by('top','DESC')
            ->order_by("label", "ASC")
            ->get();
    }


    public function get($id)
    {
        return $this->db->query('select * from lesson where id=?', array($id))->result()[0];
    }

    public  function updateTable($data, $id){
        return $this->db->update($this->table, $data, "id = ".$id);
    }

    public function retrieveLessons()
    {
        $lessons=$this->db->query('select id, label, code, fees from lesson where state != 0');
        $less=array();
        array_push($less, $lessons->first_row('array'));
        while($row=$lessons->next_row('array'))
            array_push($less, $row);
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

    public function getTrainerLesson($id){
        return  $this->db->query('SELECT l.label, l.fees, l.duration, l.type, l.code, la.locked, la.start_date, la.end_date, la.id as laId
                        FROM lesson_allocation la
        LEFT JOIN lesson l ON la.lesson = l.id
        LEFT JOIN user ON user.id = la.user
        WHERE user.id = '.session_data("id").';
        ')->result();
    }

}