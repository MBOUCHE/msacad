<?php

class CaseLearners extends CI_Model
{	
	function __construct(){
		parent::__construct();
	}
	public function HisTraining($id_learner){
		$his_training = $this->db->where('id_user', $id_learner)->get('e_content')->result_array();
		foreach ($his_training as $Zetsou) {
			$id_lesson = $this->db->where('id_wave', $Zetsou['id_wv'])->get('e_wave')->row()->id_lesson;
			if (sizeof($this->db->where('id_user', $id_learner)->where('status=1')->where('id_wv', $Zetsou['id_wv'])->get('e_content')->result_array())==0) {
				$this->db->insert('e_training', ['arrival_date' => $Zetsou['date'], 'id_user' => $id_learner, 'id_lesson' => $id_lesson]);
			}
			elseif(sizeof($this->db->where('id_user', $id_learner)->where('status=0')->where('id_wv', $Zetsou['id_wv'])->get('e_content')->result_array())!=0) {
				$this->db->delete('e_training', array('id_user' => $id_learner, 'id_lesson' => $id_lesson));
			}
		}
		return $this->db->select('*')->from('e_training')->where('id_user', $id_learner)->get()->result_array();
	}
	public function listHisTest($id_learner){
		$HisTraining = $this->HisTraining($id_learner);
		$M = 0; $N = sizeof($HisTraining); $i=0;
		foreach ($HisTraining as $key) {
		   $trainer = $this->db->where('id', $key['id_lesson'])->get('lesson')->result_array();
		   $Test[$M++] = $trainer;
			foreach ($trainer as $key1) {
				$last_test = -1;
		   		$test = $this->db->where('id_user', $key1['id_user'])->where('status', $last_test)->get('e_test')->result_array();
		   		if ($test == null) {
		   			$i++;
		   		}
		   		$Test[$N++] = $test;
		   	}
		}
		if ($i == (sizeof($Test)/2)) {
			return 0;
		}
		else{
			return $Test;
		}
	}
	public function HisTrainingMod($id_training){
		return $this->db->select('*')->from('e_composed')->where('id_lesson', $id_training)->get()->result_array();
	}
	public function Request($id_learner, $id_training, $object, $justification, $date_rqst){
		$num_rqst = count($this->listRequest($id_learner)) +1;
		$data = array( 'id_user' => $id_learner,
				        'id_lesson' => $id_training,
				        'reason ' => $object,
				        'justification' => $justification,
				        'date_rqst'	=> $date_rqst,
				    	'num_rqst'	=> $num_rqst);

		$this->db->insert('e_request', $data);
	}
	public function listRequest($id_learner){
		return $this->db->select('*')->from('e_request')->where('id_user', $id_learner)->order_by('id_rqst', 'ASC')->get()->result_array();
	}
	public function resndRequest($id_rqst, $date_rqst, $id_training){
		$id_learner = session_data('id');
		$num_rqst = count($this->listRequest($id_learner)) +1;
		
		$data = array('num_rqst' => $num_rqst,
					'id_lesson' => $id_training,
		        	'date_rqst' => $date_rqst
		        	);
		$this->db->where('id_rqst', $id_rqst);
		$this->db->update('e_request', $data);		
	}
	public function HisWaveUser($id_learner){
		return $this->db->select('*')->from('e_content')->where('id_user', $id_learner)->get()->result_array();
	}
    public function listIsExChap($id_chap){
    	return $this->db->select('*')->from('e_exercise')->where('id_chap', $id_chap)->get()->result_array();
    }
    public function listIsCoursesMod($id_mod){
    	return $this->db->select('*')->from('e_chapter')->where('id_mod', $id_mod)->get()->result_array();
    }
    public function sendIsDispo($id_learner, $availibility){

		$data = array('id_user' => $id_learner,
	        			'availability' => $availibility);
		if (sizeof($this->db->select('*')->from('e_content')->where('id_user', $id_learner)->get()->result_array())==0) {
		$this->db->insert('e_content', $data);
		}
		else{
			$this->db->where('id_user', $id_learner)->update('e_content', $data);
		}
    }
    public function listIsQsts($id_exo){
    	return $this->db->select('*')->from('e_question')->where('id_exercise', $id_exo)->order_by('id_exercise', 'RANDOM')->get()->result_array();
    }
    public function listIsAswrs($id_qst){
    	return $this->db->select('*')->from('e_answer')->where('id_qst', $id_qst)->order_by('id_qst', 'RANDOM')->get()->result_array();    	
	}
	public function sendIsWork($id_exo, $id_learner, $note){
		$date_do_work = moment()->format(NO_TZ_MYSQL);
		$data = array( 'date_wk' => $date_do_work,
				        'note_wk' => $note,
				        'id_ex' => $id_exo,
				        'id_user' => $id_learner);
		$this->db->insert('e_work_exo', $data);
	}
	public function IsNote($id_exo){
		$id_learner = session_data('id');
		$where = 'id_ex='.$id_exo.' AND '.'id_user='.$id_learner ;
		return $this->db->select('*')->from('e_work_exo')->where($where)->get()->result_array();
	}
	public function choiseTheme($id_theme, $id_learner, $id_lesson){
		if (sizeof($this->db->where('id_user', $id_learner)->where('id_ex', $id_theme)->get('e_work_exo')->result_array()) == 0) {

			$date_select_work = moment()->format(NO_TZ_MYSQL);
			$data1 = array('id_ex' => $id_theme, 'id_user' => $id_learner, 'date_wk' => $date_select_work);

			if (sizeof($this->db->select('*')->from('e_work_exo')->where('id_ex', $id_theme)->where('id_user', $id_learner)->get()->result_array()) == 0) {	
				$state = -1;
				$data = array('status' => $state);
				$this->db->where('id_exercise', $id_theme)->update('e_exercise', $data);
				$this->db->insert('e_work_exo', $data1);
			}
			else {
				$this->db->where('id_ex', $id_theme)->where('id_user', $id_learner)->update('e_work_exo', $data1);
			}
		}
		else {
			return 0;
		}
	}
	public function abandonTheme($id_theme, $id_learner){
		$state = 1;
		$data = array('status' => $state);
		$this->db->where('id_exercise', $id_theme)->update('e_exercise', $data);
		$this->db->delete('e_work_exo', array('id_ex' => $id_theme));
	}
    public function detailTheme($id_theme){
      	return $this->db->select('*')->from('e_exercise')->where('id_exercise', $id_theme)->get()->result_array();
    }
    public function ContentChap($id_chap){
    	return $this->db->select('*')->from('e_chapter')->where('id_chap', $id_chap)->get()->result_array();
    }
    public function amountPosted($id_learner){
    	return $this->db->select('*')->from('e_paid')->where('id_user', $id_learner)->where('validation_state', 1)->get()->result_array();
    }
}
?>