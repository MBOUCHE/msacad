<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_upload extends CI_Model
{
	function __construct(){
		parent::__construct();
	}
	public function sendReportPath($path_complete_report, $id_training, $theme) {
		$id_user = session_data('id');
		$data = array( 
				'theme_rpt' => $theme,
		        'path_report' => $path_complete_report,
		        'date_deposit' => moment()->format(NO_TZ_MYSQL),
		        'id_lesson' => $id_training,
		        'id_user' => $id_user );
		$this->db->insert('e_report', $data);
	}
	public function sendApp($id_lesson, $appreciation, $id_learner){
		$data = array('appreciation' => $appreciation);
		$this->db->where('id_user', $id_learner)->where('id_lesson', $id_lesson)->update('e_training',$data);
	}
}
?>