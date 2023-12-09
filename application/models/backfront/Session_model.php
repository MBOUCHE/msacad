<?php


class Session_model extends  CI_Model
{
    protected $data;
    protected $userId;

    public function __construct()
    {
        parent::__construct();
        $this->userId=session_data('id');
        $this->load->helper('general_helper');
        $this->load->model('admin/availability_model', 'availability');
        $this->load->model('admin/notification_model', 'notification');
        $this->load->model('admin/log_model', 'logm');
    }

    public function saveTimetable($timetable, $start_date, $end_date, $distinctPromos)
    {
        $date = explode("/", $start_date);
        $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
        $sd=date('Y-m-d', $time);
        //var_dump($sd); die();
        $this->db->trans_begin();
        foreach ($timetable as $curClass)
        {
            //var_dump($curClass);
            $period=$this->availability->getPeriod($curClass->period);
            $nbrProg=$this->db->query('select id from sessions where promotion=?', $curClass->promotion)->num_rows();
            $curSession=array('SESS'.castNumberId($nbrProg+1).$this->availability->getCode($curClass->promotion), $curClass->promotion, $sd, $curClass->day ,$curClass->period, $period->end-$period->start);
            //var_dump($curSession);
            $this->db->query('insert into sessions(code, promotion, start_date, day, period, duration)
                                          values(?, ?, ?, ?, ?, ?)', $curSession);
            $this->db->select_max('id');
            $maxSession=$this->db->get('sessions')->result()[0]->id;
            $this->db->query('insert into lesson_slip(session) values(?) ', $maxSession);
            //$this->notification->publish(array($this->userId, "L'emploi du temp de la semaine du ".$start_date." au ".$end_date." est disponible. Le cours de ".$this->availability->getLesson($curClass->promotion)." a été programmé.", date('Y-m-d'), STUDENT, $curClass->promotion, "none"));
        }
        //die();
        foreach ($distinctPromos as $pr)
        {
            $this->notification->publish(array("sender"=>$this->userId, "content"=>"L'emploi du temp de la semaine du ".$start_date." au ".$end_date." est disponible. Le cours de ".$this->availability->getLesson($pr)." a été programmé.", "send_date"=>date('Y-m-d'), "target"=>STUDENT, "promotion"=>$pr, "url"=>"none"));
        }

        $log=array("motivation"=>"",
            "author"=>$this->userId,
            "date"=>moment()->format('Y-m-d H:i:s'),
            "action"=>" a généré l'emploi du temps de la semaine du ".$start_date." au ".$end_date."."
        );
        $this->logm->save($log);

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

    public function getTimetable($timetableStartDate)
    {
        //var_dump($timetableStartDate);
        return $this->db->query('select * from sessions where start_date=?', $timetableStartDate)->result();
    }

    public function timetableList()
    {
        return $this->db->query('select distinct(start_date) from sessions')->result();
    }

    public function timetableDelete($date)
    {
        $this->db->trans_begin();
        $this->db->query('delete from lesson_slip where session in (select id from sessions where start_date=?)', $date);
        $this->db->query('delete from sessions where start_date=?', $date);
        $log=array("motivation"=>"",
                    "author"=>$this->userId,
                    "date"=>moment()->format('Y-m-d H:i:s'),
                    "action"=>" a supprimé l'emploi du temps de la semaine du ".$date."."
        );
        $this->logm->save($log);
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

    public function findTimetable($dt)
    {
        $date = explode("/", $dt);
        $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
        $sd=date('Y-m-d', $time);
        return $this->db->query('select id from sessions where start_date=?', $sd)->num_rows();
    }
}