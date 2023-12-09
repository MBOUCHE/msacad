<?php

/**
 * 
 */

class Wave extends CI_Model {

        public $id_wave;
        public $code_wave;
        public $number_learners;
        public $id_lesson;
        public $date_bgn;
        public $id_user;
        public $date_end;
        public $type_wave;
        public $status;
        public $date;
        public $last_modify;

        public function __construct()
        {
            parent:: __construct();
            $this->load->model('e_models/e_admin/paid');
        }

        public function hydrate(array $donnees)
        {
            $tab = array();
            foreach ($donnees as $key => $value)
            {
                //$method = ucfirst($key);
                $this->$key = $value;
                $tab[$key] = $value;
            }
            return $this;
        }

        public function get($id_wave){
            return $this->db->get_where('e_wave' , 'id_wave='.$id_wave)->row_array();
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('e_wave', 10);
                return $query->result();
        }

        public function create_wave($code)
        {
                $this->code_wave = $code;
                $this->number_learners = 0;
                $this->id_lesson = $_POST['id_lesson']; 
                $this->date_bgn = $_POST['date_bgn'];
                $this->date_end = $_POST['date_end'];
                $this->id_user = $_POST['id_formator'];
                $this->type_wave = $_POST['formation_type'];
                $this->status = '1';
                $this->date = date('Y-m-d h:i:s');
                $this->last_modify =  date('Y-m-d h:i:s');

                $this->db->insert('e_wave', $this);
                $id_wave = $this->db->insert_id();
                (intval($id_wave)%10 == intval($id_wave) )? $code_wave = '0'.$id_wave.''.$code : $code_wave = $id_wave.''.$code ;
                $this->db->update('e_wave' , array('code_wave'=>$code_wave ) , 'id_wave='.$id_wave );

                //Notifications de la vague
                $details = $this->get_details($id_wave);

                $message = 'Bienvenue a tous,<br>
                            Nouvelle vague/promotion, code:<b>'.$code_wave.'</b><br>
                            Cours de : <b>'.$details['lesson']->label.'</b><br>
                            Votre formateur principal : <b>'.$details['formator']->firstname.' '.$details['formator']->lastname.'</b><br>
                            Debut des cours le: <b>'.$this->date_bgn.'</b><br>
                            Fin de la promotion prevu le: <b>'.$this->date_end.'</b><br>
                            Merci de respecter ces delais...<br>
                            L\'ADMINISTRATEUR <br>';
                $flash = array('message'=>$message
                    );
                $this->notify_wave($id_wave , $flash);

                return $id_wave;
        }

        public function insert_delay($id_wave){
            $data = array('delay_2_2'=>$_POST['delay_2_2'],
                        'delay_3_2'=>$_POST['delay_3_2'],
                        'delay_3_3'=>$_POST['delay_3_3'],
                        'id_wave'=>$id_wave
                    );
            $this->db->insert('e_delay' , $data);
        }

        public function modify_delay(){
            $data1 = $_POST;
            $data = array();

            foreach ($data1 as $key => $value) {
                if ($this->db->field_exists($key , 'e_delay') ) {
                    $data[$key] = $value;
                }
            }

            if ($data) {
                $this->db->update('e_delay' , $data , 'id_wave='.$_POST['id_wave'] );
            }

            //Notifications de la vague
            $data = $this->db->get_where('e_delay' , array('id_wave'=>$_POST['id_wave']) )->row_array();
            $message = 'Bonjour a tous,<br>Modifications des delays de payement...<br>
                        2/2 : '.$data['delay_2_2'].'<br>
                        2/3 : '.$data['delay_3_2'].'<br>
                        3/3 : '.$data['delay_3_3'].'<br>
                        Merci de respecter ces delais...<br>
                        L\'ADMINISTRATEUR <br>';
            $flash = array('message'=>$message);
            $this->notify_wave($_POST['id_wave'] , $flash);
        }

        public function notify_wave($id_wave , array $data ){
            $data = array(
                    'time_send'=>date('Y-m-d h:i:s'),
                    'type_com'=>'Info Flash',
                    'id_user'=>session_data('id'),
                    'id_sess'=>'0',
                    'id_wav'=>$id_wave
                );

            $this->db->insert('e_communication' , $data);
        }

        public function get_wave_delay($id_wave){
            return $this->db->get_where('e_delay' , array('id_wave'=>$id_wave) )->row();
        }

        public function get_limit_date($id_paid , $id_wave){
            $wave = $this->get($id_wave);
            $paid = $this->paid->get($id_paid);
            $delay = $this->db->get_where('e_delay', array('id_wave' => $id_wave) )->row();

            switch ($paid['total_slice']) {
                case 1:
                    $limit_date = $wave['date_end'];
                    break;

                case 2:
                    switch ($paid['num_slice']) {
                        case 1:
                           $limit_date = $delay->delay_2_2;
                            break;

                        case 2:
                            $limit_date = $wave['date_end'];
                            break;
                        
                        default:
                            exit();
                            break;
                    }
                    break;

                case 3:
                    switch ($paid['num_slice']) {
                        case 1:
                            $limit_date = $delay->delay_3_2;
                            break;

                        case 2:
                            $limit_date = $delay->delay_3_3;
                            break;

                        case 3:
                            $limit_date = $wave['date_end'];
                            break;
                        
                        default:
                            exit();
                            break;
                    }
                    break;
                
                default:
                    exit();
                    break;
            }

            return $limit_date;
        }

        public function add_student($id_paid , $id_wave){
            $paid = $this->paid->get($id_paid);
            $wave = $this->get($id_wave);
            $delay = $this->db->get_where('e_delay','id_wave='.$id_wave)->row();

            switch ($paid['total_slice']) {
                case 1:
                    $limit_date = $wave['date_end'];
                    break;

                case 2:
                    switch ($paid['num_slice']) {
                        case 1:
                           $limit_date = $delay->delay_2_2;
                            break;

                        case 2:
                            $limit_date = $wave['date_end'];
                            break;
                        
                        default:
                            exit();
                            break;
                    }
                    break;

                case 3:
                    switch ($paid['num_slice']) {
                        case 1:
                            $limit_date = $delay->delay_3_2;
                            break;

                        case 2:
                            $limit_date = $delay->delay_3_3;
                            break;

                        case 3:
                            $limit_date = $wave['date_end'];
                            break;
                        
                        default:
                            exit();
                            break;
                    }
                    break;
                
                default:
                    exit();
            echo "string";
            echo "string";
                    break;
            }

            $content = array(
                'limit_date'=>$limit_date,
                'id_last_paid'=>$id_paid);

            if ($paid['num_slice'] == 1) {
                $content['id_wv'] = $id_wave;
                $content['id_user'] = $paid['id_user']; 
                $content['date'] = date('Y-m-d h:i:s');
                $content['last_modify'] = date('Y-m-d h:i:s');

                $this->db->insert('e_content',$content);
            }else{
                $content['last_modify'] = date('Y-m-d h:i:s');
                $this->db->update( 'e_content' , $content , 'id_wv='.$id_wave.' and id_user='.$paid['id_user'] );
            }

            $number_learners = $this->number_learners($id_wave);

            $this->update_wave( $id_wave , array('number_learners'=>$number_learners) );


        }

        public function number_learners($id_wave){
            return count($this->db->get_where('e_content' , 'id_wv='.$id_wave)->result());
        }

        public function delete($id_wave){
            $this->db->delete('e_content' , 'id_wv='.$id_wave);
            $this->db->delete('e_wave' , 'id_wave='.$id_wave);
        }

        public function get_wave_all(){
            return $this->db->get_where('e_wave', array('status'=>'1' ))->result();
        }

        public function get_wave_active(){
            return $this->db->get_where('e_wave', array('status'=>'1' ))->result();
        }

        public function get_wave_terminate(){
            return $this->db->get_where('e_wave', array('status'=>'0' ))->result();
        }

        public function get_wave_all_all(){
            return $this->db->get('e_wave')->result();
        }

        public function get_specific_wave($id_lesson,$type_wave,$status){
            $data = array();
            if ($id_lesson != 'all'){ $data['id_lesson'] = $id_lesson; }
            if ($type_wave != 'all'){ $data['type_wave'] = $type_wave; }
            if ($status != 'all'){ $data['status'] = $status; }

            return $this->db->get_where('e_wave' , $data )->result();
        }

        public function get_wave_lesson($id_lesson){
            return $this->db->get_where('e_wave' , array('status'=>'1' ,'id_lesson'=>$id_lesson) )->result();
        }

        public function listByLesson($id_lesson){
            return $this->db->get_where('e_wave' , 'id_lesson='.$id_lesson )->result_array();
        }


        public function listByType($type_wave){
            return $this->db->get_where('e_wave' , 'type_wave='.$type_wave )->result_array();
        }

        public function listByLesson_type($id_lesson , $type_wave){
            return $this->db->get_where('e_wave' , array('id_lesson'=>$id_lesson , 'type_wave'=>$type_wave) )->result();
        }

        public function update_status($id_wave,$status){
            $this->db->update('e_wave' , array('status' =>$status , 'last_modify'=>date('Y-m-d h:i:s') ) , 'id_wave='.$id_wave);            
        }

        public function update_wave($id_wave , array $data){
            $data['last_modify'] = date('Y-m-d h:i:s');
            $this->db->update('e_wave' , $data , 'id_wave='.$id_wave);
        }

        public function update_content($id_wave){

            $list_content = $this->db->get_where('e_content' , array('id_wv'=>$id_wave) )->result();
            foreach ($list_content as $content) {
                $this->add_student($content->id_last_paid , $id_wave);
            }
        }

        public function get_details($id_wave){
            $wave = $this->get($id_wave);
            $details = array();
            $details['lesson'] = $this->db->get_where('lesson' , array('id'=>$wave['id_lesson']) )->row();
            $details['formator'] = $this->db->get_where('user' , array('id'=>$wave['id_user']) )->row();

            $query = "SELECT * FROM user WHERE id IN (SELECT id_user FROM e_content WHERE id_wv=? )";
            $details['students'] = $this->db->query( $query , array($id_wave) )->result();

            return $details;
            
        }

        public function list_user_role($role){
            $query = "SELECT * FROM user WHERE id IN (SELECT user FROM user_role WHERE role=? )";
            return $this->db->query( $query , array($role) )->result();
        }
        
}