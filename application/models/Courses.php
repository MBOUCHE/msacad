 <?php

	class Courses extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
      $id_user=session_data('id');
		}
	public function nbr_cours(){
	    $id_user=session_data('id');
		return $this->db->select('e_module_teach.label_mod,lesson.label,e_module_teach.duration_mod,e_module_teach.id_mod')
		->from('e_module_teach')
		->join('e_provided','e_provided.id_mod=e_module_teach.id_mod')
		->join('e_composed','e_composed.id_mod=e_module_teach.id_mod')
		->join('lesson','lesson.id=e_composed.id_lesson')
		->where('e_provided.id_user='.$id_user)->get()->result_array();
	}
	public function notif() {
		$id_user = session_data('id');

		return $this->db->select('e_request.id_rqst,reason,justification,decision,user.firstname,user.lastname,e_wave.code_wave')
					->from('e_request')
					->join('lesson','lesson.id=e_request.id_lesson')
					->join('e_wave','e_wave.id_lesson=e_request.id_lesson')
					->join('user','user.id=e_request.id_user')
					->join('e_content','e_content.id_user=e_request.id_user')
					->where('e_wave.id_user='.$id_user)
					->where('e_content.id_wv=e_wave.id_wave')
					->get()->result_array();
	}
	public function getResults()
    {
        return $this->db->select('e_wave.code_wave,evaluation.code,lesson.label')
        ->from('evaluation')
        ->join('lesson','lesson.id=evaluation.lesson')
        ->join('e_wave','e_wave.id_lesson=evaluation.lesson')
        ->where('e_wave.id_user='.$id_user)
        ->get()->result_array();
	}
	public function type_exam()
    {
        return $this->db->select('id_type_tst,label_type,percentage,code_type')
        ->from('e_type_test')
        ->get()->result_array();
	}
	public function type($i)
    {
        return $this->db->select('label_type')
        ->from('e_type_test')
        ->where('id_type_tst='.$i)
        ->get()->result_array();
	}
  public function sms($id)
    {
    	$id_user=session_data('id');
        return $this->db->select('e_communication.message,user.firstname,e_communication.time_send,user.id')
        ->from('e_communication')
        ->join('e_wave','e_wave.id_wave=e_communication.id_wav')
        ->join('user','user.id=e_communication.id_user')
        ->where('e_wave.id_user='.$id_user)
        ->where('e_communication.id_wav='.$id)
        ->get()->result_array();
  }
	public function stud($i)
    {
      $id_user=session_data('id');
        return $this->db->select('*')
        ->from('user')
        ->join('e_content','user.id=e_content.id_user')
		->join('e_wave','e_wave.id_wave='.$i)
        ->join('e_communication','user.id=e_communication.id_user')
		->where('e_wave.id_user=',$id_user)
        ->where('e_communication.id_wav='.$i)
		->where('e_content.id_wv='.$i)
        ->get()->result_array();
	}
	public function lesson($id)
    {
      	$id_user=session_data('id');
      	if (session_data('role')==2) {
      		$ThisWave = $this->db->select('id_wv')
						        ->from('e_content')
								->where('id_user='.$id_user)
								->where('id_wv='.$id)
						        ->get()->row()->id_wv;
			return $this->db->select('code_wave')
					        ->from('e_wave')
							->where('id_wave='.$ThisWave)
					        ->get()->row()->code_wave;
      	}
      	else {
	        return $this->db->select('code_wave')
	        ->from('e_wave')
			->where('id_user='.$id_user)
			->where('id_wave='.$id)
	        ->get()->row()->code_wave;
        }
    }
	public function wave()
	{
    $id_user=session_data('id');

		return $this->db->select('lesson.label,e_wave.code_wave,e_wave.id_wave')
					->from('e_wave')
					->join('lesson','lesson.id=e_wave.id_lesson')
					->where('e_wave.id_user='.$id_user)
					->get()->result_array();
	}
	public function nomwave($id)
	{
    $id_user=session_data('id');

		return $this->db->select('e_wave.code_wave,lesson.label')
					->from('e_wave')
					->join('lesson','lesson.id=e_wave.id_lesson')
					->where('e_wave.id_user='.$id_user)
					->where('e_wave.id_wave='.$id)
					->get()->result_array();
	}
	public function exam()
	{
		return $this->db->select('evaluation.code')
					->from('evaluation')
					->join('lesson','lesson.id=evaluation.lesson')
					->join('e_wave','e_wave.id_lesson=lesson.id')
					->where('e_wave.id_user='.$id_user)
					->get()->result_array();
	}
	public function nbre_cours($id){
		return $this->db->select('e_module_teach.label_mod,lesson.label,e_module_teach.code_mod')
		->from('e_module_teach')
		->join('e_composed','e_composed.id_lesson='.$id)
		->join('lesson','lesson.id='.$id)
		->where('e_composed.id_mod=e_module_teach.id_mod')->get()->result_array();
	}
	public function nbres_cours($i){
		return $this->db->select('label_mod')
		->from('e_module_teach')
		->where('id_mod='.$i)->get()->row()->label_mod;
	}
	public function nbre1_cours($i){
		return $this->db->select('label')
		->from('lesson')
		->where('id='.$i)->get()->row()->label;
		}
	public function nbre_mod($id){
		return $this->db->select('e_module_teach.label_mod,lesson.label,e_module_teach.id_mod,duration_mod')
		->from('e_module_teach')
		->join('e_wave','e_wave.id_wave='.$id)
		->join('lesson','lesson.id=e_wave.id_lesson')
		->join('e_composed','e_composed.id_lesson=e_wave.id_lesson')
		->where('e_composed.id_mod=e_module_teach.id_mod')->get()->result_array();
	}
	public function nbres_mod($i){
		return $this->db->select('lesson.label')
		->from('lesson')
		->join('e_wave','e_wave.id_wave='.$i)
		->where('e_wave.id_lesson=lesson.id')->get()->row()->label;
	}
	public function code($i){
		return $this->db->select('code_wave')
		->from('e_wave')
		->where('e_wave.id_wave='.$i)->get()->row()->code_wave;
	}
	public function name(){
  		$id_user=session_data('id');

		return $this->db->select('firstname')
		->from('user')
		->join('e_wave','e_wave.id_user=user.id')
		->where('e_wave.id_user='.$id_user)->get()->row()->firstname;
	}
	public function nombre(){
  		$id_user=session_data('id');

		return $this->db->select('number_learners')
		->from('user')
		->join('e_wave','e_wave.id_user=user.id')
		->where('e_wave.id_user='.$id_user)->get()->row()->number_learners;
		}
	public function rapport()
	{
  		$id_user=session_data('id');

		return $this->db->select('e_report.theme_rpt,e_report.path_report,lesson.label,e_wave.code_wave')
		->from('e_report')
		->join('lesson','lesson.id=e_report.id_lesson')
		->join('user','e_report.id_user=user.id')
		->join('e_wave','e_wave.id_lesson=lesson.id')
		->join('e_content','e_content.id_user=e_report.id_user')
		->where('e_wave.id_user='.$id_user)
		->where('e_content.id_wv=e_wave.id_wave')
		->get()->result_array();
	}
}

?>
