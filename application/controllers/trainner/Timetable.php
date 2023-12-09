<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable  extends Ci_Controller
{
    protected $data, $menu;

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model', 'authM');

        if(!session_data('connect'))
            $this->authM->auth(false,get_cookie('multisoft'));
        protected_session(array('','trainner/auth'),array(TRAINER));

        $this->load->library('calendar');
        $this->load->library('form_validation');
        $this->load->model('trainner/admin_model', 'admin');
        $this->load->model('trainner/lesson_model', 'lesson');
        $this->load->helper('general_helper');
        $this->load->model('trainner/notification_model', 'notif');
        $this->load->model('trainner/registration_model', 'registration');
        $this->load->model('Courses');

    }

    public function index()
    {
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $lists['list'] =$this->Courses->wave();
        $this->load->view('trainner/timetable', $lists);
        $this->load->view('trainner/footerAdmin');
    }
    public function generate()
    {
                $this->load->library('calendar');
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $lists['lists'] =$this->Courses->nbre_cours($_GET['name']);
        $lists['listee'] =$this->Courses->nbre_mod($_GET['name']);
        $this->load->view('trainner/menu',$listes);
        $lists['list'] =$this->Courses->wave();
        $this->load->view('trainner/all_timetable', $lists);
        $this->load->view('trainner/footerAdmin');
    }
}
