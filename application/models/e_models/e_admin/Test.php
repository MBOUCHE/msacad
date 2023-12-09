<?php

/**
 * 
 */

class Test extends CI_Model {

        public $id_test;
        public $label_test;
        public $nb_point;
        public $status;
        public $duration;
        public $date;
        public $last_modify;
        public $id_type_test;
        public $id_wave;
        public $id_user;

        public function __construct()
        {
            parent:: __construct();
            $this->load->model('e_models/e_admin/wave');
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('test', 10);
                return $query->result();
        }

        public function insert_entry()
        {

                $this->id_type_test = $_POST['id_type_test']; // please read the below note
                $this->id_wave = $_POST['id_wave'];
                $this->id_user = session_data('id');

                $this->db->insert('test', $this);
        }

        public function build_test()
        {
            foreach ($_POST as $key => $value) {
                if ($this->db->field_exists($key , 'e_test')) {
                    $this->$key = $value;
                }
            }

            $nb_point = 0;
            foreach ($_POST['exercise'] as $id_exercise){
                $nb_point += $this->db->get_where('e_exercise' , array('id_exercise'=>$id_exercise))->row()->ex_point;
            }
            $this->nb_point = $nb_point;
            $this->status = '0';
            $this->date = date('Y-m-d h:i:s');
            $this->last_modify = date('Y-m-d h:i:s');
            $this->id_user = session_data('id');

            $this->db->insert('e_test', $this);

            $this->id_test = $this->db->insert_id();
            foreach ($_POST['exercise'] as $id_exercise){
                $this->db->insert('e_build' , array('id_test'=>$this->id_test , 'id_ex'=>$id_exercise) );
            }
        }

        public function program(){
            $composition = array();
            foreach ($_POST as $key => $value) {
                if ($this->db->field_exists($key , 'e_composition')) {
                    $composition[$key] = $value;
                }
            }

            if ( $this->db->insert('e_composition' , $composition) ) {
                $this->db->update('e_test' , array('status'=>'1') , 'id_test='.$_POST['id_test'] );
            }
            //Notifier tous les apprenants de la vague
            
        }

        public function confirm_program($id_test) {
            $this->db->update( 'e_composition' , array('status'=>'1' , 'date'=>date('Y-m-d h:i:s') ) , 'id_test='.$id_test );
            $this->db->update( 'e_test' , array('status'=>'-1') , 'id_test='.$id_test );
            $this->exercise->modification_status($id_test , '-1' );

            // Notifier la vague et le formateur...
            $details = $this->get_details($id_test);
            $composition = $this->db->get_where( 'e_composition' , array('id_test'=>$id_test) )->row();

                $message = 'Bienvenue a tous,<br>
                            Vague/promotion:<b>'.$code_wave.'</b>
                            *****IMPORTANT*****<br>
                            Programmation d\'un test de <b>'.$details['label_type_test'].'</b><br>
                            Epreuve composee par <b>'.$details['autor'].'</b><br>
                            Prevue le <b>'.$composition->programming_date.'</b>
                            Merci de respecter ces delais...<br>
                            L\'ADMINISTRATEUR <br>';
                $flash = array('message'=>$message
                    );
                $this->wave->notify_wave($id_wave , $flash);
        }

        public function update_entry()
        {
                $this->id_type_test    = $_POST['id_type_test'];
                $this->id_wave  = $_POST['id_wave'];
                $this->id_user     = session_data('id');

                $this->db->update('test', $this, array('id_test' => $_POST['id_test']));
        }

        public function get_test($id_test)
        {
            return $this->db->get_where( 'e_test' , array('id_test'=>$id_test) )->row_array();
        }

        public function get_test_all() 
        {			
			return $this->db->order_by('date' , 'DESC')->get('e_test')->result_array();			
		}

        public function get_test_type($id_type_test) 
        {           
            return $this->db->get_where('e_test' , array('id_type_test' => $id_type_test ) )->result_array();            
        }

        public function get_test_wave($id_wave) 
        {           
            return $this->db->get_where('e_test' , array('id_wave' => $id_wave ) )->result_array();            
        }

        public function get_test_wave_type($id_wave , $id_type_test) 
        {           
            return $this->db->get_where('e_test' , array('id_wave' => $id_wave , 'id_type_test' => $id_type_test ) )->result_array();            
        }

        public function get_details ($id_test){
            $details = array();
            $test = $this->db->get_where('e_test' , 'id_test='.$id_test )->row_array();
            if ( count($test ) != 0 ) {

                $details['autor'] = $this->db->get_where('user' , array('id' => $test['id_user'] ) )->row()->firstname;
                $details['label_type_test'] = $this->db->get_where('e_type_test' , array('id_type_test' => $test['id_type_test'] ) )->row()->label_type;
                $wave = $this->db->get_where( 'e_wave' , array('id_wave' => $test['id_wave']) )->row();
                $details['code_wave'] = $wave->code_wave;
                $details['number_learners'] = $wave->number_learners;
                $details['wave_formator'] = $this->db->get_where('user' , array('id' => $wave->id_user ) )->row()->firstname;
                $details['number_exercise'] = count( $this->db->get_where('e_build' , array('id_test' => $id_test ) )->result() );
                $details['wave_status'] = $wave->status;
                $details['wave_id_lesson'] = $wave->id_lesson;
            }
            return $details;
        }

        public function re_use($id_test){

            $test = $this->test->get_test($id_test);

            $list_exercise = $this->exercise->get_exercise_test($id_test);

            unset($test['id_test']);
            $test['status'] = '0';
            $test['id_user'] = $this->session->username->id;
            $test['date'] = date('Y-m-d h:i:s');
            $test['last_modify'] = date('Y-m-d h:i:s');

            $this->db->insert( 'e_test' , $test );
            $id_new_test = $this->db->insert_id();

            foreach ( $list_exercise as $exercise ) {
                $id_new_exercise = $this->exercise->copy_exercise( $exercise->id_exercise );
                $this->db->insert( 'e_build' , array( 'id_test'=>$id_new_test , 'id_ex'=>$id_new_exercise ) );
            }

        }

        public function delete_test($id_test){
            $this->db->delete('e_test' , 'id_test='.$id_test);
            $this->db->delete('e_build' , 'id_test='.$id_test);
        }

        public function update_test_all()
        {
            $list_test = $this->get_test_all();
            foreach ( $list_test as $test ) {
                $nb_point = 0;
                $list_exercise = $this->exercise->get_exercise_test($test['id_test']);
                foreach ($list_exercise as $exercise){
                    $nb_point += $this->db->get_where('e_exercise' , array('id_exercise'=>$exercise->id_exercise))->row()->ex_point;
                }

                $this->db->update( 'e_test' , array( 'nb_point'=>$nb_point ) , 'id_test='.$test['id_test'] );
            }
        }

        public function change_test_date(){
            return $this->db->update( 'e_composition' , array( 'programming_date'=>$_POST['programming_date'] ) , 'id_test='.$_POST['id_test'] );
        }

        public function cancel_test($id_test) {
            $this->db->delete( 'e_composition' , 'id_test='.$id_test);
            // NOTIFIER TOUS LES APPRENNANTS DE LA VAGUE
            return $this->db->update('e_test' , array( 'status'=>'0' ) , 'id_test='.$id_test );
        }

}