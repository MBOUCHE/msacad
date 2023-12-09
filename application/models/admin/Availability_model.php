<?php


class Availability_model extends CI_Model
{
    protected $data;
    protected $table;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->table="availability";
        $this->userId=session_data('id');
    }

    public function getPromotions()
    {
        return $this->db->query('select * from promotion where state !=? and state !=?', array('-1','2'))->result();
    }

    public function getPromotionsNumber()
    {
        return $this->db->query('select * from promotion where state !=? and state !=?',array('-1','2'))->num_rows();
    }

    public function getPeriodNumber()
    {
        return $this->db->query('select * from period')->num_rows();
    }

    public function getAvailabilities()
    {
        return $this->db->query('select * from availability where start_date<CURRENT_DATE ');
    }

    public function getAvailability($user, $day, $period, $start_date)
    {
        $jr='';
        switch ($day)
        {
            case 1: $jr='lundi'; break;
            case 2: $jr='mardi'; break;
            case 3: $jr='mercredi'; break;
            case 4: $jr='jeudi'; break;
            case 5: $jr='vendredi'; break;
            case 6: $jr='samedi'; break;
        }
        $query=$this->db->query('select available from availability where user=? and day=? and period=? and start_date=?', array($user, $jr, $period, $start_date));
        $nbr=$query->num_rows();
        if ($nbr>0)
        {
            return $query->row(0)->available;
        }else
        {
            return 0;
        }
    }

    public function getUsers($pid)
    {
        return $this->db->query('select distinct(user) from registration where promotion=?', $pid)->result();
    }

    public function getLesson($pid)
    {
        return $this->db->query('select lesson.label as label from lesson, promotion where promotion.lesson=lesson.id and promotion.id=?', $pid)->row(0)->label;
    }

    public function getCode($pid)
    {
        return $this->db->query('select code  from promotion where id=?', $pid)->row(0)->code;
    }

    public function getPeriod($period)
    {
        return $this->db->query('select id, start, end from period where id=?', $period)->result()[0];
    }

    public function getPeriods()
    {
        return $this->db->query('select id, start, end from period')->result();
    }

    public function getLessonId($pid)
    {
        return $this->db->query('select lesson.id as id from lesson, promotion where promotion.lesson=lesson.id and promotion.id=?', $pid)->row(0)->id;
    }

    public function getTrainers($lesson)
    {
        return $this->db->query('select user.id, user.firstname, user.lastname
                                    from user, lesson_allocation
                                    where user.id=lesson_allocation.user
                                    and lesson_allocation.lesson=?', $lesson)->result();
    }
}