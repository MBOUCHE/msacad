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
            ->order_by('top','ASC')
            ->order_by("label", "ASC")
            ->get();
    }
    
     public function getEvaluations($code){
        $list = $this->db->query("
            SELECT evaluation.code ,evaluation.ev_percent,evaluation.label
             FROM evaluation
             LEFT JOIN lesson ON lesson.id = evaluation.lesson
             WHERE lesson.code = ?
             ORDER BY evaluation.id ASC
        ", array($code))->result();

        return $list;
    }
    
    public function getByType($type)
    {

        return $this
            ->db->select('*')
            ->from($this->table)
            ->where('state != 0')
            ->where('type', $type)
            ->order_by('top','ASC')
            ->order_by("label", "ASC")
            ->get();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, array('code' => $id));
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

    public function saveRegistration($data=array())
    {
        //
        /* Erreur si l'apprenant est dÃ©jÃ  inscrit Ã  ce cours/filiÃ¨re avec une promotion ouverte ou en cours
        */
        $registered = $this->db->query('select count(*) as reg from registration where user=? and promotion in (select id from promotion where lesson=? and (state=? or state=?))', array($data['id'], $data['lesson'], '1', '0'))->row();
        if ($registered->reg > 0) {
            return "Cet apprenant est déjà  inscrit à cet enseignement avec une promotion ouverte ou en cours.";
        }


    }
}