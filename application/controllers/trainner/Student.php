<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
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
        $this->load->helper('general_helper');
        $this->load->model('trainner/student_model', 'student');
        $this->load->model('trainner/notification_model', 'notif');
        $this->load->model('trainner/log_model', 'mLog');

        $this->menu['notif'] = $this->notif->newNotif();
        $this->load->model('Courses');

    }

    private function render($view, $titre = NULL)
    {
        $this->load->model('trainner/notification_model', 'notif');
        $this->menu['notif'] = $this->notif->newNotif();
        $this->load->view('trainner/headerAdmin', array('titre'=>$titre));
        $this->load->view('trainner/menu', $this->menu);
        $this->load->view($view, $this->data);
        $this->load->view('trainner/footerAdmin');
    }

    public function index()
    {
        $this->all();
    }
    public function all(){
        $this->load->view('trainner/headerAdmin');
        $listes['list'] =$this->Courses->notif();
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $lists['list']=$this->Courses->stud($_GET['name']);
        $this->load->view('trainner/student/list', $lists);
        $this->load->view('trainner/footerAdmin');
    }

    /**
     * @param bool|false $id - id de l'apprenant
     * @param bool|false $print - condition d'impression
     * Affichage du profil d'un apprenant avec la possibilité d'imprimer
     */
    public function profile(){
        $id=$_GET['name'];
        if(isset($id) and $print != 'print'){
            $student = $this->student->getStudent($id)->result();
            if(empty($student)){
                redirect('trainner/student');
            }else{
               if($_FILES AND !empty($_FILES)){
                   $this->load->config('uploads', TRUE);
                   $this->load->library('upload', $this->config->item('images', 'uploads'));
                   foreach($_FILES as $name => $file){
                       if(empty($name)){
                           $this->data['message'] = 'Vous n\'avez sélectionné aucune image';
                           $this->profile($id);
                       }
                       elseif(!$this->upload->do_upload($name))
                       {
                           $this->data['message'] = $this->upload->display_errors();
                           $this->profile($id);
                       }
                       else
                       {
                           if($this->student->savePhoto('assets/uploads' . explode('assets/uploads', $this->upload->data()['full_path'])[1], $id)){
                               $this->data['imgName'] = $this->upload->data()['file_name'];
                               $this->data['message'] = 'La Photo a été modifié';
                               //$this->profile($id);
                           }
                       }
                   }
               }
                $student = $student[0];
                $promotion = $this->student->getPromotion($id)->result();
                $dateCon = ($student->last_connexion == "0000-00-00") ? "null" : date_create($student->last_connexion);
                $dateReg = date_create($student->register_date);
                $dateBirth = date_create($student->birth_date);
                $this->data['student'] = $student;
                $this->data['dateCon'] = $dateCon;
                $this->data['dateReg'] = $dateReg;
                $this->data['dateBirth'] = $dateBirth;
                $lesson = $this->student->getLesson($id);
                if(empty($lesson)){
                    $this->render("trainner/student/profile", "Profil");
                }else{
                    if(empty($promotion)){
                        $this->data['lesson'] = $lesson;
                        $this->render("trainner/student/profile", "Profil");
                    }else{
                        $this->data['promotion'] = $promotion;
                        $this->data['lesson'] = $lesson;
                        $this->render("trainner/student/profile", "Profil");
                    }
                }
            }
        }elseif(isset($id) and isset($print) and $print == 'print'){
            $this->load->helper("html2pdf_helper");
            $student = $this->student->getStudent($id)->result();
            if(empty($student)){
                redirect('trainner/student');
            }else {
                $student = $student[0];
                $this->data['student'] = $student;
                $dateCon = ($student->last_connexion = "0000-00-00") ? "null" : date_create($student->last_connexion);
                $dateReg = date_create($student->register_date);
                $dateBirth = date_format($dateReg, 'd').'/'.date_format($dateReg, 'm').'/'.date_format($dateReg, 'Y');
                $dateReg = 'Année :'.date_format($dateReg, 'Y').'   Mois :'.date_format($dateReg, 'm').'   Jour :'.date_format($dateReg, 'd');
                $dateCon = 'Année :'.date_format($dateCon, 'Y').'   Mois :'.date_format($dateCon, 'm').'   Jour :'.date_format($dateCon, 'd');
                $this->data['dateCon'] = $dateCon;
                $this->data['dateReg'] = $dateReg;
                $this->data['dateBirth'] = $dateBirth;
                $lesson = $this->student->getLesson($id);
                $profil = '';
                if(!empty($lesson))
                    $this->data['lesson'] = $lesson;

                $content =  $this->load->view('trainner/student/pdf-profile', $this->data, TRUE);

                try{
                    $pdf = new HTML2PDF('P', 'A4', 'fr');
                    $pdf->pdf->setDisplayMode('fullpage');
                    $pdf->writeHTML($content);
                    ob_end_clean();
                    $pdf->Output('Profile'.$student->number_id.'.pdf');
                }catch (HTML2PDF_exception $e){
                    die($e);
                }
            }
        }
    }

    /**
     * Génération du pdf de la liste des cartes des apprenants
     */
    public function printCards(){
        $this->load->helper("html2pdf_helper");
        if(isset($_POST['send']) and isset($_POST['lesson'])) {
            $lesson = ($_POST['lesson'] == '-1') ? false : intval($_POST['lesson']);
            $student = $this->student->lystStudentCard($lesson, 'cours')->result();
            if(empty($student)){
                set_flash_data(array('alert', 'Désolé il n\' existe aucun apprenant pour cet enseignement ou cet enseignement n\'est pas de type filière.'));
                redirect("trainner/student/all");
            }else{
                $this->data['student'] = $student;

                $content =   $this->load->view('trainner/student/pdf-list-card', $this->data, TRUE);

                try{
                    $pdf = new HTML2PDF('P', 'A4', 'fr',true,'UTF-8',array(1,1,1,1));
                    $pdf->pdf->setDisplayMode('fullpage');
                    $pdf->writeHTML($content);
                    ob_end_clean();
                    $pdf->Output('Cardlist.pdf');
                }catch (HTML2PDF_exception $e){
                    die($e);
                }
            }

        }elseif(isset($_POST['lesson']) and $_POST['lesson'] != -1){
            $this->load->model('trainner/lesson_model', 'lesson');

            $this->data['query'] = $this->student->lystStudentCard(intval($_POST['lesson']))->result();

            echo $this->load->view('trainner/student/dynamic-list', $this->data, true);

        }else{
            $this->data['query'] = $this->student->lyst()->result();
            echo $this->load->view('trainner/student/dynamic-list', $this->data, true);
        }


    }

    /**
     * @param bool|false $id
     * Affichage de la liste des logs d'un apprenant
     */
    public function log($id=false){
        $log = $this->student->log($id);
        $this->data['log'] = $log;
        $this->render('trainner/student/log', 'Liste des logs');
    }

}
