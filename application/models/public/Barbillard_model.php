<?php
class Barbillard_model extends CI_Model
{

    private $table = "mailing";

    public function getStudentList(){
        $list=$this->db
            ->query("
                select user.id as userId, user.photo as photo, user.lastname as lastname,
                  user.firstname as firstname,user.phone as phone, user.number_id, user.mail,
                  registration.code as code,
                  lesson.id as lId, lesson.label as label, lesson.code as lcode, registration.amount as fees,
                  registration.installment as installment, registration.registration_date as reg_date,
                  registration.dead_line as dead_line,  registration.id as regId,
                  registration.promotion,
                  registration.validate_date as val_date, registration.state as state,
                  registration.slice_number, promotion.code as pcode
                from  registration
                  LEFT JOIN user ON registration.user = user.id
                  LEFT JOIN lesson ON registration.lesson = lesson.id
                   LEFT OUTER JOIN promotion ON registration.promotion=promotion.id
                WHERE registration.state != '-1' and registration.state != '0'
                order by user.lastname ASC, user.firstname ASC, CASE registration.state
                WHEN '1' then 0 WHEN '0' then 1 WHEN '2' then 2  else 5 END,
                registration.registration_date desc;")->result();
        return $list;
    }

}