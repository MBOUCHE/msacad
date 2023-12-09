<?php

    class MY_Controller extends CI_Controller
    {
        /**
         *
         * @var array
         */
        protected $data;

        /**
         *
         * @var Moment
         */
        protected $moment;

        /**
         *
         * @var string
         */
        protected $link;
        /**
         *
         * @var string
         */
        protected $user_name;

        //Session variable
        /**
         *
         * @var string
         */
        protected $s_id;
        /**
         *
         * @var bool
         */
        protected $s_new;
        /**
         *
         * @var string
         */
        protected $s_role;
        /**
         *
         * @var string
         */
        protected $s_roles;
        /**
         *
         * @var bool
         */
        protected $s_connect;
        /**
         *
         * @var string
         */
        protected $s_lastname;
        /**
         *
         * @var string
         */
        protected $s_matricule;
        /**
         *
         * @var string
         */
        protected $s_firstname;

        private $rightInfo;
        
        function __construct()
        {
            parent::__construct();

            $this->load->model('backfront/user_model', 'userM');
            $this->load->model('backfront/lesson_model', 'lesson');
            $this->load->model('backfront/log_model', 'logM');
            $this->load->model('backfront/registration_model', 'registration');
            $this->load->helper('general_helper');
            $this->load->helper('email_helper');

            if(!session_data('connect') And get_cookie('msa_user'))
                $this->userM->auth(false, get_cookie('msa_user'));
        }

        /**
         *
         * @param string $view La vue a charger
         * @param string $titre Le titre de la vue
         * @param bool|string|array $not_menu Les menus à ne pas charger
         */
        protected function renderGate($view, $titre='', $not_menu=false)
        {

            if(session_data_isset('id')){
                $this->rightInfo['userProfil'] =  $this->userM->getUser((int)session_data('id'))[0];
		$this->load->model('backfront/forum_model',"forumM");
		$posts = $this->forumM->getUserPost(intval(session_data('id')));
                $this->rightInfo['nbrPost'] = count($posts);
                $comments = $this->forumM->getUserComment(intval(session_data('id')));
                $this->rightInfo['nbrComment'] = count($comments);
                if(!empty($posts))
                {
                    $post = $this->rightInfo['lastPost'] = $posts[count($posts)-1];
                    if(!empty($comments)){
                        $comment = $this->rightInfo['lastComment'] = $comments[count($comments)-1];
                    }

                }

                if(session_data('role') == STUDENT)
                {
                    $this->rightInfo['acadProfil'] = $this->registration->getLesson(session_data('id'));

                    if(empty($this->rightInfo['acadProfil'])){
                        $this->rightInfo['acadProfil'] = array();
                    }
                }
                elseif(session_data('role') == TRAINER)
                {
                    $this->rightInfo['vague'] = $this->registration->getVagues();
                    $this->rightInfo['trainerProfil'] = $this->lesson->getTrainerLesson(session_data('id'));
                    if(empty($this->rightInfo['trainerProfil'])){
                        $this->rightInfo['trainerProfil'] = array();
                    }
                }
                elseif(session_data('role') == MODERATOR)
                {
                    $this->rightInfo['moderatorProfil'] = $this->userM->infoAccountForModerator();
                    if(empty($this->rightInfo['moderatorProfil'])){
                        $this->rightInfo['moderatorProfil'] = array();
                    }
                }
            }


            $notif = array();

            if($this->is_connect()){
                $notif['notif'] = $this->userM->getUserNotif();
            }

            if(is_bool($not_menu) And $not_menu){
                $not_menu = array('top', 'left', 'right');
            }elseif(is_string($not_menu)){
                $not_menu = explode('|', $not_menu);
                foreach ($not_menu as $hey=>$item) {
                    $not_menu[$hey] = mb_strtolower($item);
                }
            }elseif(is_array($not_menu)){
                foreach ($not_menu as $hey=>$item) {
                    $not_menu[$hey] = mb_strtolower($item);
                }
            }else{
                $not_menu = array();
            }

            $this->load->view('backfront/header', array('titre'=>$titre));

            if(!in_array('top', $not_menu)) {
                $this->load->view('backfront/top-menu', $notif);
            }

            if(!in_array('left', $not_menu)) {
                $this->load->view('backfront/left-menu');
            }

            $this->load->view("backfront/".$view, $this->data);

            if(!in_array('right', $not_menu)) {
                $this->load->view('backfront/right-menu',$this->rightInfo);
            }

            $this->load->view('backfront/footer');
        }

        protected function renderFront($view, $titre='')
        {
            if($this->is_connect()){
                $this->data['notif'] = $this->userM->getUserNotif();
            }
            $this->data ['breadcrumb'] = array(
                "Accueil" => base_url(),
                $titre =>"#",
            );

            $this->load->view('public/header', array('titre'=>$titre));
            if($view!=null)
            {
                $this->data['view'] = $view;
                $this->load->view("public/static-page-model", $this->data);
            }
            else
            {
                $this->load->view("public/homepage", $this->data);
            }

            $this->load->view('public/footer');
        }

        /**
         *
         * @param string $str La chaine à permalinker
         * @param array $replace Les chaine à remplqcer
         * @param string $delimiter Le delimiteur
         **/
        protected function permalink($str, array $replace=array(), $delimiter="-") {
            return permalink($str, $replace, $delimiter);
        }

        protected function gate_home($redirectUri=null)
        {
            $this->set_session();
            //var_dump($_SESSION);return;
            if ($this->s_new) {
                /**
                 * Si on se connecte pour la premiere fois, on change son mots de passe
                 * et on renseigne les champs manquants
                 */
                redirect('account/completeAccount/' . $this->link);
            }
            else{
                /**
                 * Si on est connecté en t'en qu'inscrit
                 */
                if($redirectUri!=null)
                    redirect($redirectUri);
                else
                    redirect();
            }
        }

        protected function set_session()
        {
            $this->s_connect = session_data('connect');
            if($this->s_connect)
            {
                $this->s_id     = session_data('id');
                $this->s_new    = session_data('new');
                $this->s_role   = session_data('role');
                $this->s_roles  = session_data('roles');
                $this->s_lastname   = ucfirst(mb_strtolower(session_data('lastname')));
                $this->s_matricule  = mb_strtoupper(session_data('matricule'));
                $this->s_firstname  = mb_strtoupper(session_data('firstname'));

                $this->user_name = session_data('firstname').' '.session_data('lastname');
                $this->link = mb_strtolower($this->s_matricule).'/'.$this->permalink($this->user_name);
            }
        }

        protected function logout()
        {
            unset_session_data();
            delete_cookie('msa_user');
        }

        private function is_connect()
        {
            $this->set_session();

            if($this->s_connect){
                return true;
            }
            return false;
        }

        protected function sendMail($infos=array())
        {
            sendMail($infos);
        }

        protected function vardump(...$expression)
        {
            echo "<pre>";
            foreach ($expression as $item) {
                var_dump($item);
            }
            echo "</pre>";
            die();
        }
    }