<?php
class Adminfolder_model extends CI_Model
{

    protected $user = 'user';

    public function __construct()
    {
        parent::__construct();
    }

   public function searchVal($val){
       //return $this->db->select('*')->from($this->user)->get()->result();

       $t = $val;
       $val = "%".$val."%";
       //$installment=$this->db->query('select fees as fees from lesson where id=?', $data['lesson'])->row();

       return $this->db->query("select user.id, user.firstname, user.lastname, user.number_id
                                from user, user_role
                                where user.id=user_role.user and user_role.role = 2
                                AND (user.firstname LIKE '".$val."' OR user.lastname LIKE '".$val."')")->result();

   }

    public function searchLesson($idA=false){
        return $this->db->query('select user.id, user.firstname, user.lastname, registration.user, registration.lesson, lesson.id, lesson.label, lesson.fees, registration.installment
                                from user, user_role, registration, lesson, promotion
                                where user.id=user_role.user and user_role.role = 2
                                AND user.id = registration.user
                                      AND registration.lesson = lesson.id
                                      and user.id = '.$idA.'
                                      AND registration.state = \'2\'
                                AND lesson.id = promotion.lesson
                                AND promotion.state = \'2\'')->result();
    }
}