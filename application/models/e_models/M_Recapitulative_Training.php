<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class M_Recapitulative_Training extends CI_Model {
  	function __construct() {
  	  parent::__construct();
  	}
  	public function Recapitulative() {
	  $this->db->select('*');
	  $this->db->from('e_training', 'e_composed', 'e_chapter', 'e_exercise', 'report', 'e_work_exo', 'e_question', 'e_composition');
	  $this->db->join('lesson', 'lesson.id = e_training.id_lesson');
	  $query = $this->db->get();
	  return $query;
  	}
  	public function RecapNoteExam($All_WV= array()) {
  		$allstatement = $this->db->where('id_user', session_data('id'))->get('e_statement')->result_array();

  		foreach ($allstatement as $shinobi) {
  			$allComposition = $this->db->where('id_compo', $shinobi['id_compo'])->get('e_composition')->result_array();
  		}
  		$Examen['allstatement'] = $allstatement;
  		$Examen['allComposition'] = $allComposition;
  		return $Examen;
  	}
  }
?>