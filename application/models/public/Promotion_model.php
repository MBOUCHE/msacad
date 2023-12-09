<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
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
        $this->load->model('backfront/lesson_model', 'lesson');
    }

    public function get($id, $state='')
    {
        $query="";
        if ($state=='' or !in_array($state, array('-1', '0', '1', '2')))
        {
            if (is_integer($id))
            {
                $query=$this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id where promotion.id=?', $id);
            }
            else
            {
                $query=$this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id where promotion.code=?', $id);
            }
        } else
        {
            if (is_integer($id))
                $query=$this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id where promotion.id=? and promotion.state=?', array($id, $state));
            else
                $query=$this->db->query('select promotion.*, lesson.label from promotion inner join lesson on promotion.lesson = lesson.id where promotion.code=? and promotion.state=?', array($id, $state));
        }
        return (!empty($query->result())?$query->result()[0]:null);
    }

    public function getList()
    {
        $query=$this->db->query('
              select promotion.*, lesson.label as label
              from lesson, promotion
              where promotion.lesson=lesson.id
              order by promotion.start_date DESC ');
        $promos=array();
        array_push($promos, $query->first_row('array'));
        while ($row=$query->next_row('array'))
            array_push($promos, $row);
        return $promos;
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

    public function getStudents($id)
    {
        $sql="select distinct(user.id), number_id, firstname, lastname, mail, sexe from user
                inner join user_role on user.id = user_role.user
                inner join registration on user.id = registration.user
                inner join promotion on promotion.id=registration.promotion
                where user_role.role=? and promotion.id=? order by user.lastname asc";
        $query=$this->db->query($sql, array(STUDENT, $id))->result();
        return $query;
    }

    public function getInfo($id='')
    {
   
        if ($id!='')
        {
            $promotion=$this->get($id);
            
            $lesson=$this->lesson->get($promotion->lesson);
            
            $result=(object) (array('promotion'=>$promotion,'lesson'=>$lesson));
            return $result;
            
        }
        else
        {
            $promotion=$this->get($id);
            $lesson=$this->lesson->get($promotion->lesson);
            $result=(object) (array('promotion'=>$promotion,'lesson'=>$lesson));
            return $result;
        }
    }

    public function getAllocatedPromo($id, $state="")
    {
        if ($state!='')
        {
            $query=$this->db->query('
            SELECT promotion.*, lesson.label
            FROM promotion
            LEFT JOIN lesson ON promotion.lesson = lesson.id
            LEFT JOIN lesson_allocation ON promotion.lesson = lesson_allocation.lesson
            WHERE promotion.state=? AND lesson_allocation.user=?', array($state, $id));
        } else
        {
            $query=$this->db->query('SELECT promotion.*, lesson.label FROM promotion LEFT JOIN lesson ON promotion.lesson = lesson.id LEFT JOIN lesson_allocation ON promotion.lesson = lesson_allocation.lesson WHERE lesson_allocation.user=?', $id);
        }
        return (!empty($query->result()) ? $query->result() : null);
    }

    public function getEvaluatedPromotions()
    {
        $query=$this->db->query('SELECT DISTINCT (promotion.id), promotion.*, lesson.label
        FROM evaluation_results er
        INNER JOIN promotion ON er.promotion = promotion.id
        INNER JOIN lesson ON promotion.lesson = lesson.id
        INNER JOIN registration ON registration.promotion = promotion.id');

        return (!empty($query->result()) ? $query->result() : null);
    }

    public function getPromotionById($id=false)
    {
        return $this->db->select('code')->from('promotion')->where(array('id'=>$id))->get()->result();
    }


}