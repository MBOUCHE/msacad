<?php
class Timetable_model extends CI_Model
{

    protected $period = 'period';
    protected $availability = 'availability';
    protected $sessions = 'sessions';
    protected $promotion = 'promotion';
    protected $lesson = 'lesson';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('backfront/log_model', 'logs');
    }

    public function getPeriod(){
        return $this->db->select('*')->from($this->period)->get()->result();
    }

    public function saveAvailability($field = array()){
        if(is_array($field)){
            return $this->db->set($field)->insert($this->availability);
        }else{
            return -1;
        }
    }

    public function checkAvailability($user=false, $date=false){
        if($user and $date){
            return $this->db->select('*')->from($this->availability)->where(array('user'=>$user))->where(array('start_date'=>$date))->get()->result();
        }else return -1;
    }

    public function getAvailability($user = false,$date = false){
        if($user and $date){
            return $this->db->select('*')->from($this->availability)->where(array('user'=>$user,'start_date'=>$date))->get()->result();
        }else{
            return -1;
        }
    }

    public  function updateAvailability($data, $id){
        return $this->db->update($this->availability, $data, "id = ".$id);
    }

    public function all()
    {
        return $this->db->query('select distinct(start_date) from sessions ORDER BY start_date DESC ')->result();
    }

    public function getTimetable($timetableStartDate)
    {
        //var_dump($timetableStartDate);
        return $this->db->query('select * from sessions where start_date=?', $timetableStartDate)->result();
    }

    public function lessonProgression($promotion=false){
         return $this->db->query("
            SELECT SUM(duration) AS sumDuration
            FROM sessions
            WHERE promotion LIKE '%#$promotion#%'
        ")->result()[0];
    }

    public function selectSessions($code=false, $date=false){
        //var_dump($code); var_dump($date); die(0);
        $sessionsId = $this->db->select('id')->from($this->sessions)->where(array('code'=>$code))->get()->result();
        //var_dump($sessionsId); die(0);
        if(!empty($sessionsId)){
            //var_dump($sessionsId); die(0);
            $locked = $this->db->select('locked')->from('lesson_slip')->where(array('session'=>$sessionsId[0]->id))->get()->result();
            //var_dump($locked); die(0);
            if($locked[0]->locked == '1'){
                //var_dump($locked); die(0);
                return null;
            }else{
                //var_dump($locked); die(0);
                $date = explode('/', $date); $date = $date[2].'-'.$date[1].'-'.$date[0];
                //var_dump($date); die(0);
                return $this->db->select('*')->from($this->sessions)->where(array('code'=>$code))->where(array('start_date'=>$date))->get()->result();
            }
        }else
            return null;
    }

    public function getLessonByPromotion($promotionId=false){
    	$proms = explode('#',$promotionId);
        array_pop($proms);
        array_shift($proms);
        $i=0;
        $promos = array();
        $lessons = array();
        foreach ($proms as $prom){
            $promos[$i] = $this->db->select('*')->from($this->promotion)->where(array('id'=>$prom))->get()->result()[0];
            //var_dump($promos);
            if(empty($promos[$i])){
            	return null;
	    }else{
	        $lessons[$i] = $this->db->select('*')->from($this->lesson)->where(array('id'=>$promos[$i]->lesson))->get()->result()[0];
	        
	    }
	    $i++;
        }
        return array('lesson'=>$lessons, 'promotion'=>$promos);

    }

    public function updateSession($code=false, $content=false){
        //var_dump($code); var_dump($content); die(0);
        if($code){
            $sessions = $this->db->select('id')->from($this->sessions)->where(array('code'=>$code))->get()->result();

            $this->db->trans_begin();

            $this->db->update('sessions', array('user'=>session_data("id")), array('code'=>$code));

            $this->db->update('lesson_slip', array('content'=>$content, 'locked'=>1), array('session'=>$sessions[0]->id));
            //if($resu){
            $field = array('motivation'=>'Remplissage de la fiche de suivie',
                'author'=>session_data('id'),
                'date'=>moment()->format('Y-m-d H:i:s'),
                'action'=>'Code de session :'.$code.'. Nom du formateur :'.session_data('firstname').' '.session_data('lastname'));
            $this->logs->save($field);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return null;
            } else {
                $this->db->trans_commit();
                return true;
            }

        }

    }



}