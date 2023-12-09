<?php
class Registration_model extends CI_Model
{

    protected $inscription = 'inscription';
    protected $lesson = 'lesson';
    protected $registration = 'registration';
    protected $tableCode = 'codes';
    protected $tablePromotion = 'promotion';


    public function __construct()
    {
        parent:: __construct();
    }

    public function getLesson($id){
        return  $this->db->query('
            SELECT lesson.*, registration.registration_date,registration.amount,registration.installment, promotion.id as promId, promotion.code as promCode, promotion.state as promState, registration.state as regState
            FROM registration
            LEFT JOIN promotion ON registration.promotion = promotion.id
            LEFT JOIN lesson ON registration.lesson = lesson.id
            WHERE registration.user = ? AND registration.state != ? AND registration.state != ? ', array($id,'-1','0'))->result();
    }

    public function getRegistrationOfUser($user){

        return $this->db->query("
            SELECT reg.*, p.code as pCode, l.label, l.code as lCode
            FROM registration reg
            LEFT JOIN lesson l ON l.id = reg.lesson
            LEFT JOIN promotion p ON p.id = reg.promotion
            WHERE reg.user = ? ORDER BY CASE reg.state WHEN '0' then 0 WHEN '1' then 1 WHEN '2' then 2 else 5 END, reg.registration_date DESC
        ",array($user))->result();

    }

    public function getVagues()
    {
        return $this->db->query("
        SELECT promotion.code, promotion.id promo_id
        FROM promotion
        LEFT JOIN lesson ON promotion.lesson = lesson.id
        LEFT JOIN lesson_allocation la on la.lesson = lesson.id
        LEFT JOIN user ON user.id = la.user
        WHERE promotion.state!='-1' AND user.id = ".session_data('id').";
        ")->result();

    }
}