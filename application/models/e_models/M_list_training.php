<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class M_list_training extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function listTraining($id=null) {
			if($id And is_numeric($id)){
				return $this->db->where('id', $id)->get('lesson')->result_array();
			}else{
				$list_training = $this->db->get('lesson');
	    		return $list_training->result_array();
			}
		}
		public function IsTraining($id_learner){
			return $this->db->where('id_user', $id_learner)->get('e_training')->result_array();
		}
		public function IsModule($id_lesson){
			return $this->db->where('id_lesson', $id_lesson)->get('e_composed')->result_array();
		}
		public function All_id_Manager($id_mod){
			return $this->db->where('id_mod', $id_mod)->get('e_provided')->result_array();
		}
		public function AllManager($id_user){
			return $this->db->where('id', $id_user)->get('user')->result_array();
		}
		public function IsWave($id_learner){
			return $this->db->where('id_user', $id_learner)->get('e_content')->result_array();
		}
		public function listOperator(){
			$list_op = $this->db->get('e_operator');
    		return $list_op->result_array();	
		}		
		public function listModule($id=null){
			if($id And is_numeric($id)){
				return $this->db->where('id_mod', $id)->get('e_module_teach')->result_array();
			}else{
				$list_module = $this->db->get('e_module_teach');
	    		return $list_module->result_array();
			}	
		}
		public function listDistinctModule($id_training){
		  return $this->db->select('*')->from('e_composed')->where('id_lesson', $id_training)->get()->result_array();
		}
		public function isSlices($id_training){	
			return $this->db->where('id_lesson', $id_training)->get('e_slices')->result_array();
		}
		public function AvailibityTheme($id_training){
			return $this->db->where('id_lesson', $id_training)->where('ex_type', 'THEME')->get('e_exercise')->result_array();
		}
		public function searchId($code_training){
			return $this->db->select('id')->from('lesson')->where('code', $code_training)->get()->result_array();
		}
		public function IsChapter($id_mod){
			return $this->db->select('*')->from('e_chapter')->where('id_mod', $id_mod)->get()->result_array();
		}
		public function selectHisRef($id_mod){
			return $this->db->select('*')->from('e_module_teach')->where('id_mod', $id_mod)->get()->result_array();	
		}
	}
?>