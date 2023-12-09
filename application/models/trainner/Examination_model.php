<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination_model extends CI_Model
{
    protected  $data;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->userId=session_data('id');
        $this->load->model('admin/notification_model', 'notification');
        $this->load->model('admin/log_model', 'logm');
    }

    public function getAll($lesson='')
    {
        if ($lesson=='' or !is_integer(intval($lesson)))
            return $this->db->query('select * from evaluation')->result();
        else
            return $this->db->query('select * from evaluation where lesson=?', $lesson)->result();
    }
    
     public function getMarkPublishDate($promotion){
    
    	$query=$this->db->query('SELECT date
		FROM evaluation_results
		WHERE promotion =?
		ORDER BY date DESC 
		LIMIT 1', $promotion);
	return (!empty($query->result())?$query->result():null);
    }

    public function get($promotion)
    {
        $query="";
        if (is_integer(intval($promotion)))
        {
            $query=$this->db->query('select * from note where promotion=? order by note.student', $promotion);
        } else
        {
            $query=$this->db->query('select note.* from note inner join promotion on note.promotion=promotion.id where promotion.code=? order by note.student', $promotion);
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function getPEvals($promotion)
    {
        $query="";
        if (is_integer(intval($promotion)))
        {
            $query=$this->db->query('select evaluation.id from evaluation inner join lesson on evaluation.lesson = lesson.id inner join promotion on lesson.id = promotion.lesson where promotion.id=?', $promotion);
        } else
        {
            $query=$this->db->query('select evaluation.id from evaluation inner join lesson on evaluation.lesson = lesson.id inner join promotion on lesson.id = promotion.lesson where promotion.code=?', $promotion);
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function getDistinctEvaluations($promotion)
    {
        $query="";
        if (is_integer(intval($promotion)))
        {
            $query=$this->db->query('select distinct(evaluation) from note where promotion=?', $promotion);
        } else
        {
            $query=$this->db->query('select distinct(note.evaluation) from note inner join promotion on note.promotion=promotion.id where promotion.code=?', $promotion);
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function save($promotion, $marks=array())
    {
        $this->db->trans_begin();
        foreach  ($marks as $result)
        {
            foreach ($result->marks as $mark)
            {
                if (!$this->isMarked($mark->ev, $promotion))
                    $this->db->query("insert into note (evaluation, student, value, promotion) values (?, ?, ?, ?)", array($mark->ev, $result->student, castNumberId($mark->value, 2, 2), $promotion));
            }
        }
        if ($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            return true;
        } else
        {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function update($promotion, $marks=array())
    {
        $this->db->trans_begin();
        foreach  ($marks as $result)
        {
            foreach ($result->marks as $mark)
            { //var_dump($mark);
                $this->db->query("update note set value=? where student=? and promotion=? and evaluation=? ", array(castNumberId($mark->value, 2, 2), $result->student, $promotion, $mark->ev));
            }
        } //die();
        if ($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();
            return true;
        } else
        {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function isMarked($id, $promo)
    {
        return ($this->db->query("select * from note where evaluation=? and promotion=?", array($id, $promo))->num_rows()>0?true:false);
    }

    public function getMarks($student, $promotion)
    {
        //var_dump($student, $promotion); die();
        $query="";
        if (is_integer($promotion))
        {
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent, evaluation.label, evaluation.code from note inner join evaluation on note.evaluation = evaluation.id where note.promotion=? and note.student=? ORDER BY note.evaluation ASC', array($promotion, $student));
        } else
        {
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent from note inner join promotion on note.promotion=promotion.id inner join evaluation on note.evaluation = evaluation.id where promotion.code=? and note.student=? ORDER BY note.evaluation ASC', array($promotion, $student));
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function getMark($student, $promotion, $eval)
    {
        $query="";
        if (is_integer($promotion))
        {
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent from note inner join evaluation on note.evaluation = evaluation.id where note.promotion=? and note.student=? and note.evaluation=?', array($student,$promotion, $eval));
        } else
        {
            $query=$this->db->query('
                select note.*, evaluation.ev_percent as percent
                from note
                inner join promotion on note.promotion=promotion.id
                inner join evaluation on note.evaluation = evaluation.id
                where promotion.code=? and note.student=? and note.evaluation=?', array($promotion, $student, $eval));
        }
        //var_dump($query->result());die();
        return (!empty($query->result())?$query->result()[0]:null);
    }

    public function getEvaluations($promotion)
    {
        $query="";
        if (is_integer($promotion))
        {
            $query=$this->db->query('
            select distinct ev.id, ev.lesson, ev.ev_percent,ev.label,ev.code 
            from evaluation ev
            inner join note on ev.id = note.evaluation 
            where note.promotion=?
            ORDER BY ev.id ASC', $promotion);
        } else
        {
            $query=$this->db->query('
            select distinct ev.id, ev.lesson, ev.ev_percent,ev.label,ev.code 
            from evaluation ev
            inner join note on ev.id = note.evaluation 
            inner join promotion on note.promotion=promotion.id 
            where promotion.code=?
            ORDER BY ev.id ASC', $promotion);
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function getEvaluation($promotion, $eval)
    {
        $query=$this->db->query('select * from evaluation where id=?', array($eval));
        //var_dump($query->result());

        return (!empty($query->result())?$query->result():null);
    }

    public function getPFromEvals()
    {
        $query=$this->db->query('SELECT promotion.*, lesson.label 
        FROM promotion 
        LEFT JOIN lesson ON promotion.lesson = lesson.id 
        where promotion.code in 
        (select distinct(promotion.code) 
        from promotion 
        inner join evaluation_results as er on er.promotion=promotion.id) 
        ORDER BY promotion.start_date DESC ');
        return !empty($query->result()) ? $query->result() : null;
    }

    private function getDPFromEval()
    {
        $query=$this->db->query('select distinct(promotion) from evaluation_results');
        //var_dump($query->result());
        return !empty($query->result()) ? $query->result() : null;
    }

    public function getResults()
    {
        $id_user=session_data('id');
        return $this->db->select('e_wave.code_wave,evaluation.code')
        ->from('evaluation')
        ->join('lesson','lesson.id=evaluation.lesson')
        ->join('e_wave','e_wave.id_lesson=evaluation.lesson')
        ->where('e_wave.id_user='.$id_user)
        ->get()->result_array();
    }

    public function publish($promotion, $eval="")
    {
        if ($eval=="")
            return ($this->db->query('update evaluation_results set published=1, date=? where promotion=?', array(moment()->format('Y-m-d H:i:s'),$promotion))==true ? true : false);
        else
            return ($this->db->query('update evaluation_results set published=1, date=? where promotion=? and evaluation=(select id from evaluation where code=? and lesson=(select lesson from promotion where id=?))', array(moment()->format('Y-m-d H:i:s'),$promotion, permalink($eval), $promotion))==true ? true : false);
    }

    public function generate($data=array())
    {
        //var_dump($data); die();
        return $this->db->query('insert into evaluation_plannings(week, document, publish_date) values (?, ?, ?)', array($data['week'], $data['document'], moment()->format('Y-m-d H:i:s')));
    }

    public function plannings()
    {
        $query=$this->db->query('select ep.*, doc.path as link from evaluation_plannings as ep left join document as doc on ep.document=doc.id ORDER BY ep.publish_date DESC ');
        return (!empty($query->result())?$query->result():null);
    }

    public function evaExist($promotion, $exam)
    {
        return $this->db->query('select p.* from promotion as p left join lesson as l on p.lesson = l.id left join evaluation as e on l.id = e.lesson where p.code=? and e.code=?', array($promotion, $exam))->num_rows()==1?true:false;
    }

    public function getExaId($lessonCode, $codeEval)
    {
        return $this->db->query('select * from evaluation where code=? and lesson=?', array($codeEval, $lessonCode))->result()[0]->id;
    }

    public function publishedEvals($promotion)
    {
        $query=$this->db->query('select * from evaluation_results where promotion=? and published=1', $promotion);
        return !empty($query->result()) ? $query->result() : null;
    }
}