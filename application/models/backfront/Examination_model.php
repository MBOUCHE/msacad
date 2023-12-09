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
    
    public function getMarkPublishDate($promotion){
    
    	$query=$this->db->query('SELECT date
		FROM evaluation_results
		WHERE promotion =?
		ORDER BY date DESC 
		LIMIT 1', $promotion);
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
        //var_dump($marks);die();
        foreach  ($marks as $result)
        {
            foreach ($result->marks as $mark)
            {
                $this->db->query("insert into note (evaluation, student, value, promotion) values (?, ?, ?, ?)", array($mark->ev, $result->student, castNumberId($mark->value, 2, 2), $promotion));
                $this->setReady($promotion, $mark->ev);
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
    echo "<pre>";
    //var_dump($marks);die();
        
        $this->db->trans_begin();
        foreach  ($marks as $result)
        {
            foreach ($result->marks as $mark)
            {
                if ($this->isMarked($mark->ev, $promotion,$result->student))
                    $this->db->query("update note set value=? where student=? and promotion=? and evaluation=? ", array(castNumberId($mark->value, 2, 2), $result->student, $promotion, $mark->ev));
                else
                    $this->db->query("insert into note (evaluation, student, value, promotion) values (?, ?, ?, ?)", array($mark->ev, $result->student, castNumberId($mark->value, 2, 2), $promotion));
                    
                $this->setReady($promotion, $mark->ev);
            }
        }
        if ($this->db->trans_status()==TRUE)
        {
            $this->db->trans_commit();

return             $this->db->query("select * from evaluation_results where promotion=? and evaluation=?", array($promotion, $mark->ev))->num_rows();
            return true;
        } else
        {
            $this->db->trans_rollback();
            return false;
        }
        echo "</pre>";
    }

    public function isMarked($id, $promo,$stud=0)
    {
    	$s= "";
    	if($stud!=0)
    		$s = " AND student = $stud";
        return ($this->db->query("select * from note where evaluation=? and promotion=? $s", array($id, $promo))->num_rows()>0?true:false);
    }

    public function getMarks($student, $promotion)
    {
        $query="";
        if (is_integer($promotion))
        {
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent from note inner join evaluation on note.evaluation = evaluation.id where note.promotion=? and note.student=?  ORDER BY note.evaluation ASC', array($student,$promotion));
        } else
        {
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent from note inner join promotion on note.promotion=promotion.id inner join evaluation on note.evaluation = evaluation.id where promotion.code=? and note.student=?  ORDER BY note.evaluation ASC', array($promotion, $student));
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
            $query=$this->db->query('select note.*, evaluation.ev_percent as percent from note inner join promotion on note.promotion=promotion.id inner join evaluation on note.evaluation = evaluation.id where promotion.code=? and note.student=? and note.evaluation=?', array($promotion, $student, $eval));
        }
        return (!empty($query->result())?$query->result()[0]:null);
    }

    public function getEvaluations($promotion, $exa=false)
    {
        $query="";
        if (!$exa)
        {
            if (is_integer($promotion))
            {
                $query=$this->db->query('
                select distinct ev.id, ev.lesson, ev.ev_percent,ev.label,ev.code 
                from evaluation  ev
                inner join note on ev.id = note.evaluation
                where note.promotion=?
                ORDER BY ev.id ASC', $promotion);
            } else
            {
                $query=$this->db->query('
                select distinct ev.id, ev.lesson, ev.ev_percent,ev.label,ev.code 
                from evaluation  ev
                inner join note on ev.id = note.evaluation 
                inner join promotion on note.promotion=promotion.id 
                where promotion.code=?
                ORDER BY ev.id ASC', $promotion);
            }
        } else
        {
            if (is_integer($promotion))
            {
                $query=$this->db->query('
                select evaluation.* 
                from evaluation 
                inner join note on evaluation.id = note.evaluation 
                where note.promotion=? and note.evaluation=?', array($promotion, $exa));
            } else
            {
                $query=$this->db->query('
                select evaluation.* 
                from evaluation inner join note on evaluation.id = note.evaluation inner join promotion on note.promotion=promotion.id where promotion.code=? and note.evaluation=?', array($promotion, $exa));
            }
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function getEvaluation($promotion, $eval)
    {
        $query="";
        if (is_integer($promotion))
        {
            $query=$this->db->query('select evaluation.* from evaluation inner join note on evaluation.id = note.evaluation where note.promotion=? and note.evaluation=?', array($promotion, $eval));
        } else
        {
            $query=$this->db->query('select evaluation.* from evaluation inner join note on evaluation.id = note.evaluation inner join promotion on note.promotion=promotion.id where promotion.code=? and note.evaluation=?', array($promotion, $eval));
        }
        return (!empty($query->result())?$query->result():null);
    }

    public function setReady($promotion, $evaluation=0)
    {
        if ($this->db->query("select * from evaluation_results where promotion=? and evaluation=?", array($promotion, $evaluation))->num_rows()<1)
            $this->db->query('insert into evaluation_results(promotion, ready, published, evaluation) values (?, ?, ?, ?)', array($promotion, 1, 0, $evaluation));
        else
            $this->db->query('update evaluation_results set ready=? where promotion=? and evaluation=?', array(1, $promotion, $evaluation));
    }

    public function plannings()
    {
        $query=$this->db->query('select ep.*, doc.path as link from evaluation_plannings as ep left join document as doc on ep.document=doc.id order by ep.publish_date desc');
        return (!empty($query->result())?$query->result():null);
    }

    public function getResults($promotion,$publish=0)
    {
        if($publish==0){
            $query=$this->db->query("
              select evaluation.* from evaluation
              left join evaluation_results as er on evaluation.id=er.evaluation
              where er.promotion=? and er.ready=1", array($promotion));
            return !empty($query->result())?$query->result():null;
        }
        else{
            $query=$this->db->query("
              select evaluation.* from evaluation
              left join evaluation_results as er on evaluation.id=er.evaluation
              where er.promotion=? and er.ready=1 and er.published=?", array($promotion,$publish));
            return !empty($query->result())?$query->result():null;
        }

    }

    public function evaExist($promotion, $exam)
    {
        return $this->db->query('select p.* from promotion as p left join lesson as l on p.lesson = l.id left join evaluation as e on l.id = e.lesson where p.code=? and e.code=?', array($promotion, $exam))->num_rows()==1?true:false;
    }

    public function getExaId($lessonCode, $codeEval)
    {
        return $this->db->query('select * from evaluation where code=? and lesson=?', array($codeEval, $lessonCode))->result()[0]->id;
        //return $this->db->query('select * from evaluation where code=? and lesson=(select lesson from promotion where code=?)', array($code, $promo))->result()[0]->id;
    }

    public function published($eval,$promotion)
    {
        return ($this->db->query("select * from evaluation_results where evaluation=? and promotion=? and published=1", array($eval,$promotion))->num_rows()>0?true:false);
    }
}