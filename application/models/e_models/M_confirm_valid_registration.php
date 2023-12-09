<?php
	class M_confirm_valid_registration extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
			$id_user = session_data('id');
		}
		public function isRegister($id_training, $id){
			return $this->db->select('*')->from('e_paid')->where('id_user', $id)->where('id_lesson', $id_training)->get()->result_array();
		}
		public function choice_training($id){
			return $this ->db->select('*')->from('lesson')->where('id', $id)->get()->result_array();	
		}
		public function addElearner($payment){
			$payment['date_paid'] = moment()->format(NO_TZ_MYSQL);
			$payment['e_register_date'] = $payment['date_paid'];

			$action_paid = "INSERT INTO e_paid (id_op, remaining_amount, next_amount, reference, id_lesson, num_slice, total_slice, id_user, date_paid) 
							VALUES (".$this->db->escape($payment['id_op']).", 
									".$this->db->escape($payment['remaining_amount']).",
									".$this->db->escape($payment['next_amount']).", 
									".$this->db->escape($payment['reference']).", 
									".$this->db->escape($payment['id_training']).", 
									".$this->db->escape($payment['num_slice']).",
									".$this->db->escape($payment['total_slice']).",
									".$this->db->escape($payment['id_user']).", 
									".$this->db->escape($payment['date_paid'])."
								)";
			
			$this->db->trans_begin();
							$this->db->query($action_paid);
							$this->db->set('occupation', $payment['kind']);
							$this->db->set('place_occupation', $payment['place_kind']);
							$this->db->set('e_register_date', $payment['e_register_date']);
							$this->db->where('id', $payment['id_user']);
							$this->db->update('user');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			}
			else
			{
			    $this->db->trans_commit();
			    return true;
			}
		}

		public function IsRegulation($id_learner){
			return $this->db->select('*')->from('e_paid')->where('id_user', $id_learner)->get()->result_array();
		}
		public function updatePayment($operator, $reference, $formation_type, $total_slice, $num_slice, $next_amount, $new_remaining, $id_lesson) {
			$id_user = session_data('id');
			$new_payment = array(
			        'id_op' => $operator,
			        'remaining_amount' => $new_remaining,
			        'next_amount' => $next_amount,
			        'reference' => $reference,
			        'id_lesson' => $id_lesson,
			        'id_user' => $id_user,
			        'date_paid' => moment()->format(NO_TZ_MYSQL),
			        'validation_state' => 0,
			        'total_slice' => $total_slice,
			        'num_slice' => $num_slice,
			        'formation_type' => $formation_type);
			$last_validation_state = $this->db->where('id_lesson', $id_lesson)->where('id_user', $id_user)->get('e_paid')->result_array();
			foreach ($last_validation_state as $key404) {
				if ($key404['validation_state'] == 1) {
					$this->db->where('id_lesson', $id_lesson)->where('id_user', $id_user)->update('e_paid', $new_payment);
				}
				else
					return 0;
			}
		}
		public function getPreviewChoise($id_training){
			$id_user = session_data('id');
			return $this->db->select('*')->from('e_paid')->where('id_user', $id_user)->where('id_lesson', $id_training)->get()->result_array();
		}
		public function updateElearner($payment){
			$payment['date_paid'] = moment()->format(NO_TZ_MYSQL);
			$payment['e_register_date'] = $payment['date_paid'];
$data = array(
        'id_op' => $payment['id_op'],
        'remaining_amount' => $payment['remaining_amount'],
        'next_amount' => $payment['next_amount'],
        'reference' => $payment['reference'],
        'num_slice' => $payment['num_slice'],
        'date_paid' => $payment['date_paid'] );
			
			$this->db->trans_begin();
				$this->db->where('id_user', $payment['id_user']);
				$this->db->where('id_lesson', $payment['id_training']);
				$this->db->update('e_paid', $data);


				$this->db->set('occupation', $payment['kind']);
				$this->db->set('place_occupation', $payment['place_kind']);
				$this->db->set('e_register_date', $payment['e_register_date']);
				$this->db->where('id', $payment['id_user']);
				$this->db->update('user');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			}
			else
			{
			    $this->db->trans_commit();
			    return true;
			}
		}
	}
?>