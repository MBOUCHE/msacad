<?php

	class M_verify extends CI_Model {
		function __construct(){
			parent::__construct();
		}
	  	public function verify(){  
	    	if(!session_data('connect'))
	      		$this->authM->auth(false,get_cookie('multisoft'));
	    	protected_session(array('', 'account/login'), array(STUDENT, MEMBER, ADMIN));
	  	}
	  	public function verify_e(){  
	    	if(!session_data('connect'))
	      		$this->authM->auth(false,get_cookie('multisoft'));
	    	protected_session(array('', 'account/login'), array(STUDENT, TRAINER));
	  	}
	  	public function HisInfoWave($id_learner=null, $id_training=null){
	  		if ($id_learner == null) {
	  			return $this->db->select('*')->from('e_wave')->where('id_lesson', $id_training)->where('status', 1)->get()->result_array();
	  		}
	  		else {
			  return $this->db->select('*')->from('e_content')->where('id_user', $id_learner)->get()->result_array();
	  		}
	  	}
	  	public function selectIsWave($idWave){
	  		return $this->db->select('*')->from('e_wave')->where('id_wave', $idWave)->get()->result_array();
	  	}
	  	public function registerTest($mention, $note, $point, $date_compo, $id_compo, $id){
	  		if (sizeof($this->db->where('id_compo', $id_compo)->where('id_user', $id)->get('e_statement')->result_array()) >= 2) {
  				$id_state = $this->db->where('id_compo', $id_compo)->where('id_user', $id)->limit(1)->get('e_statement')->row()->id_state;
  				$this->db->where('id_state', $id_state);
				$this->db->delete('e_statement');
	  		}
	  		if (sizeof($this->db->where('id_compo', $id_compo)->where('id_user', $id)->get('e_statement')->result_array()) == 0) {
	  			$data = array('appression' => $mention, 'content' =>$note, 'note' =>$point, 'registration_date' =>$date_compo, 'id_compo' =>$id_compo, 'id_user' => $id);
	  			$this->db->insert('e_statement', $data);
	  		}
	  		elseif (sizeof($this->db->where('id_compo', $id_compo)->where('id_user', $id)->get('e_statement')->result_array()) == 1) {
	  			$data = array('appression' => $mention, 'content' =>$note, 'note' =>$point, 'registration_date' =>$date_compo, 'id_compo' =>$id_compo, 'id_user' => $id);
	  			$this->db->update('e_statement', $data);
	  		}
	  		else{
	  			return 0;
	  		}
	  	}
	  	
		public function AlertExam(){
	  		$HisWave = $this->db->select('id_wv')->from('e_content')->where('id_user', session_data('id'))->get()->result_array();
	  		$timeConnection = moment();
	  		$i =0;
	  		
	  		foreach ($HisWave as $key) {
	  			$ExamDay[$i++] = $this->db->select('programming_date, id_test')->where('id_wave', $key['id_wv'])->where('status=1')->get('e_composition')->result_array();
	  		}
			foreach ($ExamDay as $item) {
				foreach ($item as $ken) {
					if (sizeof($ken)!=0) {

						$delay = moment($ken['programming_date']);

						$delay->addMinutes(53);

						/*var_dump(strtotime($ken['programming_date']));
						var_dump(strtotime($timeConnection->format(NO_TZ_MYSQL)));
						var_dump(strtotime($delay->format(NO_TZ_MYSQL)));*/

						if ( strtotime($ken['programming_date']) < strtotime($timeConnection->format(NO_TZ_MYSQL)) and strtotime($timeConnection->format(NO_TZ_MYSQL)) < strtotime($delay->format(NO_TZ_MYSQL))) {
	  						return $this->db->where('id_test', $ken['id_test'])->get('e_test')->result_array();
	  					}
	  					else return null;
	  				}
	  				else return null;	
  				}
  			}
	  	}
	}
?>