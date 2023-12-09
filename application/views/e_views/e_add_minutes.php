<?php
	// div id="auto"
	$id_lesson = $this->db->where('id_wave', $id_wave)->get('e_wave')->row()->id_lesson;
	$all_mod = $this->db->where('id_lesson', $id_lesson)->get('e_composed')->result_array();

	// Pour le moment avec le premier Module de chaque lesson . $all_mod[0]

	$id_sess = $this->db->where('id_wv', $id_wave)->where('id_mod', $all_mod[0]['id_mod'])->order_by('date_end', 'DESC')->get('e_course_session')->result_array();
	$last_munutes=null;
	$time_end = $id_sess[0]['date_end'];
	// Il faut controller la seconde et sa connection à la classe virtuelle.
	if (time() < $time_end){
		$last_minutes = $this->db->where('id_sess', $id_sess[0]['id_sess'])->where('id_user', session_data('id'))->order_by('id_prsc', 'DESC')->get('e_presence')->result_array();
		if ($last_munutes==0) {
			$last_munutes = $last_minutes[0]['minutes']+1;
			$this->db->insert('e_presence', ['id_sess' => $id_sess[0]['id_sess'], 'id_user' => session_data('id'), 'minutes' => $last_munutes]);
		}
		else{
			$last_munutes = $last_minutes[0]['minutes']+1;
			$this->db->update('e_presence', ['id_sess' => $id_sess[0]['id_sess'], 'id_user' => session_data('id'), 'minutes' => $last_munutes]);
		}
	}
?>
