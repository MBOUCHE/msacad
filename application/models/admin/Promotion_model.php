<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Harrys Crosswell
 * Date: 14/07/2017
 * Time: 17:20
 */

class Promotion_model extends CI_Model
{
    protected  $data;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->userId=session_data('id');
        $this->load->model('admin/notification_model','notification');
    }

    public function getList()
    {
        $query=$this->db->query("
              select promotion.*, lesson.label as label
              from lesson, promotion
              where promotion.lesson=lesson.id
              order by  CASE promotion.state WHEN '0' then 0 WHEN '1' then 1 WHEN '2' then 2 else 5 END, promotion.start_date DESC ");
        $promos=array();
        array_push($promos, $query->first_row('array'));
        while ($row=$query->next_row('array'))
            array_push($promos, $row);
        return $promos;
    }
    
    public function getAvPromos()
    {
        $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.state=? or promotion.state=?', array('0', '1'));
        return (!empty($query->result()) ? $query->result() : null);
    }

    public function get($id=false, $state='')
    {
        $query="";
        if ($id)
        {
            if ($state=='' or !in_array($state, array('-1', '0', '1', '2')))
            {
                if (is_integer($id))
                {
                    $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.id=? ORDER BY promotion.id DESC', $id);
                }
                else
                {
                    $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.code=? ORDER BY promotion.id DESC', $id);
                }
            } else
            {
                if (is_integer($id))
                    $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.id=? and promotion.state=? ORDER BY promotion.id DESC', array($id, $state));
                else
                    $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.code=? and promotion.state=? ORDER BY promotion.id DESC', array($id, $state));
            }
            return (!empty($query->result())?$query->result()[0]:null);
        } else
        {
            if ($state=='' or !in_array($state, array('-1', '0', '1', '2')))
            {
                $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id ORDER BY promotion.id DESC');
            } else
            {
                $query=$this->db->query('select promotion.*, lesson.label, lesson.code as lCode, lesson.id as lid from promotion inner join lesson on promotion.lesson = lesson.id where promotion.state=? ORDER BY promotion.id DESC', $state);
            }
            return (!empty($query->result()) ? $query->result() : null);
        }
    }
    
    


    public function printStudent($id)
    {
        $sql="select promotion.code as code, promotion.id as pid, promotion.state as pstate, user.id as uid, user.firstname as firstname, user.lastname as lastname, user.number_id as number_id, registration.registration_date as reg_date, lesson.label as label
            from promotion
            LEFT JOIN registration ON registration.promotion = promotion.id
            LEFT JOIN user ON user.id = registration.user
            LEFT JOIN lesson ON lesson.id = promotion.lesson
             LEFT JOIN user_role ON user_role.user = user.id
             WHERE user_role.role = ? and promotion.id=?
            ORDER BY user.lastname";
        $query=$this->db->query($sql, array(STUDENT, $id));
        $promos=array();
        array_push($promos, $query->first_row('array'));
        while ($row=$query->next_row('array'))
            array_push($promos, $row);
        return $promos;
    }

    public function getPromoInfo($pcode)
    {
        $lesson=$this->db->query("select label from lesson where id in (select lesson from promotion where code=?)", $pcode)->row(0)->label;
        $lessonId=$this->db->query("select lesson from promotion where code=?", $pcode)->row(0)->lesson;
        $promos=$this->db->query("select id, code from promotion where lesson=? and (state=? or state=?) and code!=?", array($lessonId, '0', '1', $pcode));
        $promoList=array('lesson'=>$lesson);
        $promoSet=array($promos->first_row('array'));
        while($row=$promos->next_row('array'))
            array_push($promoSet, $row);
        $promoList['promoList']=$promoSet;
        return $promoList;
    }

    public function changePromo($promo, $newPromo, $student)
    {
        $this->db->trans_begin();
        $promoId=$this->db->query("select id from promotion where code=?", $promo)->row();
        $this->db->query("update registration set promotion=? where user=? and promotion=?", array($newPromo, $student, $promoId->id));

        $userId=$this->db->select('id')->from('user')->where('id', $student)->get()->result()[0]->id;
        $names=$this->db->query('select firstname, lastname from user where id=?', $student)->row();
        $nPromo=$this->db->query("select code from promotion where id=?", $newPromo)->row();
        $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', array(' a déplacé '.$names->firstname.' '.$names->lastname.' de la promotion '.$promo.' vers la promotion '.$nPromo->code.'.', $this->userId, moment()->format("Y-m-d H:i:s").'.'  ));
        $this->notification->publish(array("sender"=>$this->userId, "content"=>'Vous avez été déplacé de la promotion '.$promo.' vers la promotion '.$nPromo->code.'.', "send_date"=>moment()->format("Y-m-d H:i:s"), "target"=>$student, "promotion"=>-1, "url"=>""));
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

    public function lock($pid)
    {
        $state=$this->db->query('select state from promotion where id=?', $pid)->result()[0]->state;
        if ($state!=NULL)
        {
            if ($state=='0')
            {
                return ($this->db->query('update promotion set state=? where id=?', array('1', $pid))==true? 1:null);
            } else if ($state=='1')
            {
                return ($this->db->query('update promotion set state=? where id=?', array('-1', $pid))==true? 3:null);
            } else if ($state=='-1')
            {
                return ($this->db->query('update promotion set state=? where id=?', array('1', $pid))==true? 2:null);
            } else
            {
                return "Cet état n'est pas reconnu.";
            }
        }else
        {
            return "Cette promotion n'existe pas.";
        }
    }

    public function endPromo($pid)
    {

        $state=$this->db->query('select state from promotion where id=?', $pid)->row(0)->state;
        if ($state!=NULL)
        {
            $this->db->trans_begin();
            $this->db->query('update promotion set state=?, end_date=CURRENT_DATE where id=?', array('2', $pid));
            $this->db->query('update registration set state=? where promotion=?', array('2', $pid));
             $this->db->query('update registration set state=?where promotion=? and installment< amount', array('-1',$pid));
            $curPromo=$this->db->query('select code from promotion where id=?', $pid)->result()[0]->code;
            $log=array(" a mis fin à la promotion ".$curPromo.".",$this->userId ,moment()->format("Y-m-d H:i:s"));
            $this->db->query('insert into log(action, author, date)
                          values(?, ?, ?)', $log);
            $this->notification->publish(array("sender"=>$this->userId, "content"=>"Votre promotion(".$curPromo.") est achevée.", "send_date"=>moment()->format("Y-m-d H:i:s"), "target"=>STUDENT, "promotion"=>$pid, "url"=>""));
            if($this->db->trans_status()==TRUE)
            {
                $this->db->trans_commit();
                return true;
            }else
            {
                $this->db->trans_rollback();
                return "Une erreur est survenur lors de l'achèvement de cette promotion.";
            }
        }else
        {
            return "Cette promotion n'existe pas.";
        }
    }

    public function getInfo($id='')
    {
        if ($id!='')
        {
            $promotion=$this->get($id);
            $lesson=$this->lesson->getL(intval($promotion->lesson));
            $result=(object) (array('promotion'=>$promotion,'lesson'=>$lesson));
            //var_dump('Avec id', $lesson); die();
            return $result;
        } else
        {
            $promotion=$this->get($id);
            $lesson=$this->lesson->getL(intval($promotion->lesson));
            $result=(object) (array('promotion'=>$promotion,'lesson'=>$lesson));
            //var_dump('Avec id', $lesson); die();
            return $result;
        }
    }
    
   

    public function getAllocatedPromo($id, $state="")
    {
        if ($state!='')
        {
            $query=$this->db->query('SELECT promotion.*, lesson.label FROM promotion LEFT JOIN lesson ON promotion.lesson = lesson.id LEFT JOIN lesson_allocation ON promotion.lesson = lesson_allocation.lesson WHERE promotion.state=? AND lesson_allocation.user=?', array($state, $id));
        } else
        {
            $query=$this->db->query('SELECT promotion.*, lesson.label FROM promotion LEFT JOIN lesson ON promotion.lesson = lesson.id LEFT JOIN lesson_allocation ON promotion.lesson = lesson_allocation.lesson WHERE lesson_allocation.user=?', $id);
        }
        return (!empty($query->result()) ? $query->result() : null);
    }

    public function getStudentPromotions($id, $state="")
    {
        if ($state!='')
        {
            $query=$this->db->query('SELECT promotion.*, lesson.label
                FROM promotion
                LEFT JOIN lesson ON promotion.lesson = lesson.id
                LEFT JOIN registration ON promotion.id = registration.promotion
                WHERE promotion.state=? AND registration.user=?', array($state, $id));
        } else
        {
            $query=$this->db->query('SELECT promotion.*, lesson.label
                FROM promotion
                LEFT JOIN lesson ON promotion.lesson = lesson.id
                LEFT JOIN registration ON promotion.id = registration.promotion
                WHERE registration.user=?', $id);
        }
        return (!empty($query->result()) ? $query->result() : null);
    }

    public function all($state="")
    {
        if ($state=='' or !in_array($state, array('-1', '0', '1', '2')))
        {
            return $this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id')->result();
        } else
        {
            return $this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id')->result();
        }
    }

    public function getStudents($id, $regState=null)
    {
        if ($regState==null or !in_array($regState, array('-1', '0', '1', '2')))
        {
            $sql="select distinct(user.id), number_id, firstname, lastname, mail, sexe, photo, registration_date from user
                    inner join user_role on user.id = user_role.user
                    inner join registration on user.id = registration.user
                    inner join promotion on promotion.id=registration.promotion
                    where user_role.role=? and promotion.id=? order by user.lastname asc";
            $query=$this->db->query($sql, array(STUDENT, $id))->result();
        }
        else {

            $sql="select distinct(user.id), number_id, firstname, lastname, mail, sexe, photo, registration_date
            from user
            inner join user_role on user.id = user_role.user
            inner join registration on user.id = registration.user
            inner join promotion on promotion.id=registration.promotion
            where user_role.role=? and promotion.id=? and registration.state=? order by user.lastname asc";
            $query=$this->db->query($sql, array(STUDENT, $id, $regState))->result();

        }
        return $query;
    }

    public function getStudent($id, $student, $regState=null)
    {
        if ($regState==null or !in_array($regState, array('-1', '0', '1', '2'))) {
            $sql = "SELECT DISTINCT(user.id), number_id, firstname, lastname, birth_date, birth_place, mail, sexe, photo, registration_date FROM user
                    INNER JOIN user_role ON user.id = user_role.user
                    INNER JOIN registration ON user.id = registration.user
                    INNER JOIN promotion ON promotion.id=registration.promotion
                    WHERE user_role.role=? AND promotion.id=? AND registration.user=? ORDER BY user.lastname ASC";
            $query=$this->db->query($sql, array(STUDENT, $id, $student));
        }
        else {
            $sql="select distinct(user.id), number_id, firstname, lastname, birth_date, birth_place, mail, sexe, photo, registration_date from user
                inner join user_role on user.id = user_role.user
                inner join registration on user.id = registration.user
                inner join promotion on promotion.id=registration.promotion
                where user_role.role=? and promotion.id=? and registration.state=? and registration.user=? order by user.lastname asc";
            $query=$this->db->query($sql, array(STUDENT, $id, $regState, $student));
        }
        return !empty($query->result())?$query->result()[0]:null;
    }

    public function getOpenedPromo($lesson)
    {
        $query=$this->db->query('select * from promotion where lesson=? and state=? limit 0,1', array($lesson, '0'));
        return !empty($query->result())?$query->result()[0]:null;
    }

    public function create($lesson)
    {
          $this->db->select_max('id');
        $promoNbr = $this->db->get('promotion')->result()[0]->id;

        //$promoNbr=$this->db->query('select id from promotion where year(start_date)=year(CURRENT_DATE)')->num_rows();
        if (!empty($this->db->query('insert into promotion(code, lesson, state,start_date) values (?, ?, ?,CURRENT_DATE )', array(promotionCode($promoNbr+1), $lesson, '0'))))
            return $this->db->query('select MAX(id) as id from promotion where lesson=?', $lesson)->result()[0]->id;
        else
            return null;
    }
      public function lessonProgression($promotion=false){
        return $this->db->query("
            SELECT SUM(duration) AS sumDuration
            FROM sessions
            WHERE promotion LIKE '%#$promotion#%'
        ")->result()[0];
        return $this->db->select('sum(duration) sumDuration')->from($this->sessions)->where(array('promotion'=>$promotion))->get()->result()[0];
    }
}