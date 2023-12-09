<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note  extends Ci_Controller
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
        $lists['list'] =$this->Courses->wave();
        $this->load->view('trainner/note', $lists);
        $this->load->view('trainner/footerAdmin');
    }
      public function vague()
    {
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $lists['list'] =$this->Courses->wave();
        $lists['liste'] =$this->Courses->type_exam();
        $this->load->view('trainner/wave', $lists);
        $this->load->view('trainner/footerAdmin');
    }
         public function type()
    {
                                          
        $name=$_GET['name'];
        $type_test=$_GET['type_test'];
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $lists['list'] =$this->Courses->wave();
        $lists['lisa'] =$this->Courses->nomwave($name);
        $lists['liste'] =$this->Courses->type_exam();
        $lists['lista'] =$this->Courses->type($type_test);
        $lists['lister']=$this->Courses->stud($name);
        $this->load->view('trainner/next', $lists);
        $this->load->view('trainner/footerAdmin');
    }

}