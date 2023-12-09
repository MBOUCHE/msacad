<?php
class Registration_model extends CI_Model
{

    protected $inscription = 'inscription';
    protected $lesson = 'lesson';
    protected $registration = 'registration';
    protected $userId;
    protected $mail;
    protected $pwd;

    public function __construct()
    {
        parent:: __construct();
        $this->userId=session_data('id');
        $this->mail = 'multisoftacademy@gmail.com';
        $this->pwd = 'msoft2009';
        $this->load->helper('general_helper');
        $this->load->helper('email_helper');
        $this->load->helper('message_helper');
        $this->load->model('admin/notification_model', 'notification');
        $this->load->model('admin/log_model', 'logm');
    }

    public function regList($idR=false){
        if(is_bool($idR)){
            $list=$this->db->query("select user.id as userId, user.photo as photo, user.lastname as lastname, user.firstname as firstname,
                                  registration.code as code,
                                  lesson.id as lId, lesson.label as label, registration.amount as fees,
                                  registration.installment as installment, registration.registration_date as reg_date,
                                  registration.dead_line as dead_line, user.phone as phone, registration.id as regId,registration.promotion,
                                  registration.validate_date as val_date, registration.state as state, registration.slice_number, promotion.code as pcode
                                from  registration
                                  LEFT JOIN user ON registration.user = user.id
                                  LEFT JOIN lesson ON registration.lesson = lesson.id
                                  LEFT OUTER JOIN promotion ON registration.promotion=promotion.id
                                order by CASE registration.state WHEN '1' then 0 WHEN '0' then 1 WHEN '2' then 2  else 5 END, registration.registration_date desc;")->result_array();
            return $list;
        }else{
            $list=$this->db->query('select user.id as userId, user.photo as photo, user.lastname as lastname, user.firstname as firstname,
                              registration.code as code,  lesson.id as lId, lesson.label as label, registration.amount as fees,
                              registration.installment as installment, registration.registration_date as reg_date,
                              registration.dead_line as dead_line, user.phone as phone, registration.id as regId,registration.promotion,
                              registration.validate_date as val_date, registration.state as state, registration.slice_number
                                from  registration
                                  LEFT JOIN user ON registration.user = user.id
                                  LEFT JOIN lesson ON registration.lesson = lesson.id
                                  WHERE registration.id = '.$idR.'
                                order by registration.registration_date desc;')->result_array();
            return $list;
        }
    }

    public function save($data)
    {
     $this->db->select_max('id');
        $regNbr = $this->db->get('registration')->result()[0]->id;
        
        //$regNbr=$this->db->query('select * from registration where lesson=?', $data->lesson)->num_rows();
        if ($this->db->query('insert into registration(code, registration_date, state, installment, user, dead_line, promotion, validate_date, lesson, slice_number, card, amount)
                                  values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array(registrationCode($data->lCode, $regNbr+1),moment()->format('Y-m-d H:i:s'), '0', $data->installment, $data->id, $data->dead_line, null, null, $data->lesson, $data->slice, 0, $data->amount)))
        {

            return registrationCode($data->lCode, $regNbr+1);
        } else return false;
    }
    public function saveFrontEndRegistration($data)
    { $this->db->select_max('id');
        $regNbr = $this->db->get('registration')->result()[0]->id;

        if ($this->db->query('insert into registration SET code = ?, registration_date = ?, state = ?, installment = ?, user = ?, dead_line = DATE_ADD(NOW(), INTERVAL 2 DAY), promotion = ?, validate_date = ?, lesson = ?, slice_number = ?, card = ?, amount = ?',
            array(registrationCode($data->lCode, $regNbr+1),moment()->format('Y-m-d H:i:s'), '0', $data->installment, $data->id, null, null, $data->lesson, $data->slice, 0, $data->amount)))
        {

            return $regNbr=$this->db->query('select * from registration where code=?', registrationCode($data->lCode, $regNbr+1))->result();
        } else return false;
    }

    public function validate($code, $promotion)
    {
        
        return $this->db->query('update registration set state=?, promotion=?, validate_date=?,dead_line=? where code=?', array('1', $promotion, date('Y-m-d'),null, $code));




    }
    public function endRegistration($code)
    {
        return $this->db->query('update registration set state=? where code=?', array('2', $code));

    }


    public function getRegistration($code)
    {
        $registration=$this->db->query('select state from registration where code=?', array($code));
        if ($registration->num_rows()==0)
        {
            return "Ce code d'inscription n'exite pas.";
        }
        if (in_array($registration->result()[0]->state, array('1', '2')))
        {
            return "Cette inscription a déjà été validée";
        }
        $getInfo=$this->db->query('select user.firstname as firstname, user.lastname as lastname, registration.code as reg_code, registration.registration_date as reg_date, registration.user as idU, registration.state as reg_state, registration.id as regId, lesson.label as label
                                 from user, registration, lesson where registration.code=? and user.id=registration.user and registration.lesson=lesson.id', array($code));

        $infos=$getInfo->result()[0];
        return $infos;
    }

    public function printQuitus($regId){
        return $this->db->query('
            SELECT lesson.label, lesson.code as lcode, registration.amount as fees,
              user.firstname, user.lastname, user.photo, user.number_id, user.birth_place,
              user.birth_date, user.nationality, user.address, user.phone, user.mail,
              user.school, user.school_area, user.school_level,
              promotion.code AS vCode, registration.code as regCode, registration.registration_date as regDate,registration.*
            FROM registration
              LEFT JOIN user ON registration.user = user.id
              LEFT JOIN promotion ON registration.promotion = promotion.id
              LEFT JOIN lesson ON registration.lesson = lesson.id
            WHERE registration.state <> \'0\' AND registration.id = '.$regId.'
        ')->result();
    }

    public  function shelveRegistration($data, $id){
        return $this->db->update($this->registration, $data, "id = ".$id);
    }

    /**
     * @param bool|false $idR id resgistration
     * @param bool|false $idU id user
     * @param bool|false $installemnt montant recu
     * @param bool|false $fees montant de l'enseignement
     * @param bool|false $mode
     * @return array|bool|int|mixed
     */

    public function payInstallement($idR=false, $idU=false, $installemnt=false, $fees=false, $mode=false){
        $this->db->query("update registration set card=card+1 WHERE  id = $idR");
        if($idR and $idU and $installemnt and $fees){
            $lastInstallment = $this->db->select(array('installment', 'slice_number'))->from($this->registration)->where(array('id'=>$idR))->get()->result();

            if(empty($lastInstallment)){
                return 2;
            }else{
                $lastFees = intval($lastInstallment[0]->installment);//deja payé
                $newFees = intval($lastInstallment[0]->installment) + intval($installemnt); //nouveau déjà payé
                if(intval($fees) >= (intval($lastInstallment[0]->installment) + intval($installemnt))){
                    $s_n = intval($lastInstallment[0]->slice_number)+1; //nombre de paiement de cette inscription
                    $lastInstallment = $newFees;
                    $data = array(
                        'installment'=>$lastInstallment,
                        'slice_number'=>$s_n,
                        'last_instalment'=>$installemnt);
                    $id = array('id'=>$idR, 'user'=>$idU);
                    //var_dump($data,$id);die();
                    if($this->db->update($this->registration, $data, $id)){

                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return 1;
                }
            }

        }elseif($idR and $mode == 'delete'){
            return $this->db->delete($this->registration, 'id = '.$idR);
        }


    }

    public function getRegNumber($lesson)
    {
        return $this->db->query('select * from registration where lesson=?', $lesson)->num_rows();
    }

    public function getPerDate($year, $month)
    {
        return $this->db->query('select * from registration where year(registration_date)=? and month(registration_date)=?', array($year, $month))->num_rows();
    }

    public function get($student, $promotion=null)
    {
        if ($promotion==null)
        {
            $query=$this->db->query("select * from registration where user=?", $student);
            return !empty($query->result())?$query->result():null;
        }
        else
        {
            $query=$this->db->query("select * from registration where user=? and promotion=?", array($student, $promotion));
            return !empty($query->result())?$query->result()[0]:null;
        }
    }

    public function isRegistered($student, $lesson)
    {
        $query=$this->db->query('select * from registration where user=? and lesson=? and state not in (?, ?)', array($student, $lesson, '-1', '2'))->num_rows();
        return $query>0?true:false;
    }

    public function isValidated($code)
    {
        $query=$this->db->query('select * from registration where code=? and state in (?, ?)', array($code, '1', '2'))->num_rows();
        return $query>0?true:false;
    }
     public function getCode($student,$promotion){
        return $this->db->query("
        SELECT r.code,r.registration_date AS debut, p.end_date AS fin,l.duration
        FROM registration r
        INNER JOIN promotion p ON p.id = r.promotion
        INNER JOIN lesson l ON l.id = p.lesson
        WHERE r.user=? and r.promotion = ? AND r.state='2'
        ",array($student,$promotion))->result();
    }
    
       public function getLesson(){
         return  $this->db->query('
            SELECT lesson.*, promotion.id as promId, promotion.code as promCode, promotion.state as promState
            FROM promotion
            LEFT JOIN lesson ON promotion.lesson = lesson.id
            ORDER BY promotion.code DESC')->result();
    }
}