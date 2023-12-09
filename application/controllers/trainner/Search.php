<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{

    protected $data, $menu;

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model', 'authM');

        if(!session_data('connect'))
            $this->authM->auth(false,get_cookie('multisoft'));
        protected_session(array('','trainner/auth'),array(TRAINER));
        $this->load->model('trainner/search_model', 'm_search');
                $this->load->model('Courses');

    }

    public function index()
    {
        if(isset($_GET['query'])){
            $this->data['query'] = $_GET['query'];

            $this->data['result']['document'] = $this->m_search->document($_GET['query']);
            $this->data['result']['lesson'] = $this->m_search->lesson($_GET['query']);
            $this->data['result']['promotion'] = $this->m_search->promotion($_GET['query']);
            $this->data['result']['registration'] = $this->m_search->registration($_GET['query']);
            $this->data['result']['user'] = $this->m_search->user($_GET['query']);

            $this->render('trainner/search/result', 'Résultat de la recherche');
        }
    }

    private function render($view, $titre = NULL)
    {
        $this->load->model('trainner/notification_model', 'notif');

        $this->menu['notif'] = $this->notif->newNotif();
        $this->load->view('trainner/headerAdmin', array('titre'=>$titre));
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $this->load->view($view, $this->data);
        $this->load->view('trainner/footerAdmin');
    }
}
