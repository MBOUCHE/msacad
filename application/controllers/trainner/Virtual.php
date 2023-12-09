<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virtual  extends Ci_Controller
{
    protected $data, $menu;

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model', 'authM');

        if(!session_data('connect'))
            $this->authM->auth(false,get_cookie('multisoft'));
        protected_session(array('','trainner/auth'),array(TRAINER));


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
        $list['lists'] =$this->Courses->name();
        $list['listes'] =$this->Courses->nombre();
        $list['list']=$this->Courses->stud($_GET['name']);
        $list['lister']=$this->Courses->lesson($_GET['name']);
        $list['message']=$this->Courses->sms($_GET['name']);
        $this->load->view('trainner/virtual',$list);
        $this->load->view('trainner/footerAdmin');


    }

}
