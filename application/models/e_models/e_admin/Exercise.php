<?php

/**
 * 
 */

class Exercise extends CI_Model {

        public $id_exercise;
        public $id_test;
        public $ex_label;
        public $number_question = 0;
        public $ex_point = 0;
        public $ex_type;
        public $id_chap;
        public $id_user;
        public $path_correction;
        public $point_if_felt;
        public $date;
        public $date_modify;

        public function __construct()
        {
            parent:: __construct();
            $this->load->model('e_models/e_admin/question');
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

        public function get()
        {
            $tab = array();
            $tab['id_exercise'] = $this->id_exercise;
            $tab['id_test'] = $this->id_test;
            $tab['ex_label'] =$this->ex_label;
            $tab['number_question'] =$this->number_question;
            $tab['ex_point'] =$this->ex_point;
            $tab['ex_type'] = $this->ex_type;
            $tab['id_chap'] =$this->id_chap;
            $tab['id_user'] = $this->id_user;
            $tab['path_correction'] =$this->path_correction;
            $tab['point_if_felt'] =$this->point_if_felt;
            $tab['date'] =$this->date;
            $tab['date_modify'] =$this->date_modify;
            return $tab;
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('test', 10);
                return $query->result();
        }

        public function insert_entry()
        {
                $this->id_test = $_POST['id_test']; // please read the below note
                $this->ex_label = $_POST['ex_label'];
                $this->number_question = $_POST['number_question'];
                $this->ex_point = $_POST['ex_point'];
                $this->ex_type = $_POST['ex_type'];
                $this->id_user = $_POST['id_user'];
                $this->id_chap = $_POST['id_chap'];
                $this->point_if_felt = $_POST['point_if_felt'];
                $this->date = $_POST['date'];
                $this->date_modify = $_POST['date_modify'];

                $this->db->insert('e_exercise', $this);
        }

        public function number_question($id_exercise){
            return count($this->question->get_exercise_question($id_exercise));
        }

        public function update_point_question($id_exercise){
            $point = 0;
            $question_list = $this->question->get_exercise_question($id_exercise);
            foreach ($question_list as $question) {
                $point += $question->point;
            }
            $point_question = array('ex_point'=>$point , 'number_question'=>count($question_list) , 'date_modify'=>date('Y-m-d h:i:s') );
            $this->db->update('e_exercise' , $point_question , 'id_exercise = '.$id_exercise);
            $this->session->set_flashdata('update_exercise_info','Successfully update this exercise...');
        }

        public function update($id_exercise , array $data){
            $data['date_modify'] = date('Y-m-d h:i:s');
            $this->db->update('e_exercise', $data , "id_exercise = ".$id_exercise );            
        }

// A REVOIR -----------************-----------------
        public function update_entry()
        {
                $this->id_test = $_POST['id_test']; // please read the below note
                $this->ex_label  = $_POST['ex_label'];
                $this->number_question = $_POST['number_question'];
                $this->ex_point = $_POST['ex_point'];
                $this->ex_type = $_POST['ex_type'];

                $this->db->update('id_exercise', $this, array('id_exercise' => $_POST['id_exercise']));
        }

        public function get_exercise($id_exercise)
        {
                $this->db->select('*');
                $this->db->from('e_exercise');
                $this->db->where('id_exercise',$id_exercise);
                $query = $this->db->get();
                
                return $this->hydrate($query->row_array());
        }

        public function get_all_exercise() 
        {			
			$list = array();
            // $this->db->from('e_exercise');
            $this->db->order_by('date_modify' , 'DESC' );
			$query = $this->db->get('e_exercise');		
			foreach ($query->result() as $donnees )
			{
				$list[] = $donnees;
			}
			return $list;
		}

        public function get_exercise_lesson($id_lesson) 
        {
            $list = array();
            if($id_lesson == null){
                $query = "SELECT * FROM e_exercise WHERE id_chap = ? ";
                return $this->db->get_where('e_exercise', array('id_chap'=>null))->result(); // WHERE `id_chap` IS NULL
            }else{
                $query = "SELECT * FROM e_exercise WHERE id_chap IN (SELECT id_chap FROM e_chapter WHERE id_lesson=? )";
                return $this->db->query($query,array($id_lesson))->result();
            }
            
        }

        public function get_lesson_chapter($id_chap){
            if( $id_chap != null and $id_chap !='0' ) {
                $query = "SELECT * FROM lesson WHERE id IN (SELECT id_lesson FROM e_chapter WHERE id_chap=? )";
                return $this->db->query($query,array($id_chap))->row_array();
            }else{
                return array();
            }
        }

		public function get_exercise_test($id_test)
        {			
			$list_build = $this->db->get_where( 'e_build' , array('id_test'=>$id_test) )->result();
            $list = array();
            foreach ($list_build as $build )
            {
                $list[] = $this->db->get_where('e_exercise' , array('id_exercise'=>$build->id_ex) )->row();
            }
			
			return $list;
		}

        public function modification_status($id_test , $modification_status){
            $list_build = $this->db->get_where('e_build' , array('id_test'=>$id_test) )->result();
            foreach ($list_build as $build) {
                $this->db->update('e_exercise' , array('modification_status'=>$modification_status , 'date_modify'=>date('Y-m-d h:i:s') ) , 'id_exercise='.$build->id_ex );
            }
        }

        public function copy_exercise($id_exercise){
            $exercise = $this->exercise->get_exercise($id_exercise);//recuperation
            $question_list = $this->question->get_exercise_question($id_exercise);//recuperation
            
            unset($exercise->id_exercise);
            unset($exercise->id_test);
            $exercise->id_user = session_data('id');
            $exercise->status = '0';
            $exercise->modification_status = '1';
            $exercise->date = date('Y-m-d h:i:s');
            $exercise->date_modify = date('Y-m-d h:i:s');

            $this->db->insert( 'e_exercise' , $exercise );
            $id_new_exercise = $this->db->insert_id();
            
            foreach ($question_list as $question ) {
                $this->question->copy_question( $id_new_exercise , $question->id_question );
            }

            return $id_new_exercise;
        }

        public function get_exercise_details($id_exercise){

            $details = array();
            $exercise = $this->get_exercise($id_exercise);
            $lesson = $this->get_lesson_chapter($exercise->id_chap);
            ( isset($exercise->id_user) )? $details['added_by'] = $this->db->get_where('user' , array('id'=>$exercise->id_user) )->row()->firstname : $details['added_by'] = 'No user' ;
            (count($lesson) != 0)? $details['title_chap'] = $this->db->get_where('e_chapter' , array('id_chap'=>$exercise->id_chap) )->row()->title_chap :  $details['title_chap'] = 'Anonymous' ;
            (count($lesson) != 0)? $details['lesson_label'] = $lesson['label'] :  $details['lesson_label'] = 'Anonymous' ;

            return $details;
        }

}