<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    protected $data, $menu;

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model', 'authM');

        if(!session_data('connect'))
            $this->authM->auth(false,get_cookie('multisoft'));
        protected_session(array('','trainner/auth'),array(TRAINER));
        $this->load->model('trainner/notification_model', 'notif');
                $this->load->model('Courses');


    }

            public function index()
    {
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $this->load->view('trainner/notification/received-list', $listes);
        $this->load->view('trainner/footerAdmin');
    }
        public function All()
    {
        $this->load->view('trainner/headerAdmin');
        $this->load->view('trainner/menu');
        $this->load->view('trainner/footerAdmin');

    }
}
