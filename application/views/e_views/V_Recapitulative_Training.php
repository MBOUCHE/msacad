
<div class="panel panel-default" style="width: 81.5%; float: right;margin-top: -22px;">

	<div class="panel-heading h4 text-center" style="color: orange; height: 49px;">
          	<?php
          		$sizeAlllesson = sizeof($this->db->get('lesson')->result_array());
          	?>
          	VOTRE PROGRESSION
          	<hr width="60%" style="margin: auto; margin-top: 10px">
	</div>
  	<div class="panel-body">

<?php 
	foreach ($list_is_wave as $key) {
		if ($key != NULL) {
			foreach ($key as $key1) {
				if ($key1['code_wave'] != 'TEST') {
				$HisLesson = $this->db->select('*')->from('e_wave')->where('id_lesson', $key1['id_lesson'])->get()->result_array();
				foreach ($HisLesson as $nin) {
					$id_trainer = $this->db->select('id_user')->from('lesson')->where('id', $nin['id_lesson'])->get()->result_array();
					foreach ($id_trainer as $ja) {
						$lastname = $this->db->select('*')->from('user')->where('id', $ja['id_user'])->get()->result_array();
						foreach ($lastname as $key2002) {
							$name = $key2002['lastname'];
						}
					}
				}
					foreach ($list_training as $key4) {
						if ($key4['id'] == $key1['id_lesson']) {
					echo 
					'<br><div class="h5 panel panel-info" style="margin-top: -13px">
						<div class="panel-heading"><label> Code de la vague : '.$key1['code_wave'].'</label><label style="float: right">FORMATION '.$key1['type_wave'].'</label>
							<label style="margin-left: 53px;"> Formateur principale : '.$name.'</label><br>
							<label>Date de début des cours: '.moment($key1['date_bgn'])->format('d/m/Y').'</label>
						    <label style="float: right">Date prévue pour la fin des cours : '.moment($key1['date_end'])->format('d/m/Y').'</label>
						</div>';
						$n=0;
						$all_sess = $this->db->where('id_wv', $key1['id_wave'])->get('e_course_session')->result_array();
						$presence=array();
						foreach ($all_sess as $shino) {
							$presence[$n++] = $this->db->where('id_user', session_data('id'))->where('id_sess', $shino['id_sess'])->get('e_presence')->result_array();
						}
						$all_presence=0;
						foreach ($presence as $key) {
							foreach ($key as $ino) {
								$all_presence += $ino['minutes'];
							}
						}
						$duration = $this->db->where('id', $key1['id_lesson'])->get('lesson')->row()->duration;
						echo '
						<div class="panel-body">
						    <p><br></p>
						    

						    <h4><label>Présence : '.round(($all_presence/60), 2).' Heures / '.$duration.' Heures</label>';
						    $all_com = sizeof($this->db->where('id_wav', $key1['id_wave'])->get('e_communication')->result_array());
						    if ($all_com==0) {
						    	$all_com =1;
						    }
						    $Participation = sizeof($this->db->where('id_wav', $key1['id_wave'])->where('id_user', session_data('id'))->get('e_communication')->result_array());
						    echo ' </h4>
						    <div class="progress">
							  	<div class="progress-bar" role="progressbar" aria-valuenow="'.($all_presence/30).'" aria-valuemin="1" aria-valuemax="'.$duration.'"
							  	style="width: '.($all_presence/30).'%; background-color: yellow; color: black;padding-top:4px;">
							    '.round((($all_presence*100)/(60*$duration)), 2).'%
								</div>
							</div><hr>';

							echo '
							<h4><br>
								<label style="float: right;">
									Participation au cours : '.round((100*$Participation/$all_com), 2).' % 
								</label>
						     </h4>';
					  		$ex_make = $this->db->select('*')->from('e_work_exo')->join('e_exercise', 'e_exercise.id_exercise=e_work_exo.id_ex')->join('lesson', 'e_exercise.id_lesson='.$key1['id_lesson'])->where('e_work_exo.id_user', session_data('id'))->get()->result_array();
					  		
						  	$All_points = 0;
						  	$Total = 0;
						  	$real = (sizeof($ex_make)/$sizeAlllesson);
							foreach ($ex_make as $key22) {
						  		$ThisEx = $this->db->where('id_exercise', $key22['id_ex'])->get('e_exercise')->result_array();
						  		$Total += $this->db->where('id_exercise', $key22['id_ex'])->get('e_exercise')->row()->ex_point;
						  		foreach ($ThisEx as $key23) {
						  			if ($key23['id_lesson'] == $key1['id_lesson'] ) {
						  				$All_points += $key22['note_wk'];
						  			}
						  			if ($All_points < 0) {
						  				$All_points = 0;
						  			}
						  		}
						  	}
						  	$ex_all = $this->db->where('id_lesson', $key1['id_lesson'])->get('e_exercise')->result_array();
						  	echo '</label></h4>
						  	<h4><br><br>
						  	<label style="float: right">Total de point(s) obtenus: '.$All_points/$sizeAlllesson.' point(s)</label>
						  	<label>Exercices traités : ';
						  	echo $real.' / '.sizeof($ex_all);
						  	$t = sizeof($ex_all);
						  	if ($t==0) {
						  		$t=1;
						  	}
						  	$pourcent = (($real)/$t)*100;
						  	$pourcent = round($pourcent, 2);
						  	echo '</label></h4>
						    <div class="progress">
							  	<div class="progress-bar" role="progressbar" aria-valuenow="'.$pourcent.'" aria-valuemin="1" aria-valuemax="100" style="width: '.$pourcent.'%; background-color: #ffcd43; color: blue;padding-top:4px;">
							    '.$pourcent.'%
							  	</div>
							</div><hr>
							<h4 style="color: green">Examens : </h4>';

							$allComposition = $RecapNoteExam['allComposition'];
							foreach ($allComposition as $kurap) {
								if ($kurap['id_wave']==$key1['id_wave']) {

									$note = $this->db->where('id_compo', $kurap['id_compo'])->get('e_statement')->row()->note;
									$nb_point = $this->db->where('id_test', $kurap['id_test'])->get('e_test')->row()->nb_point;
									$id_type_test = $this->db->where('id_test', $kurap['id_test'])->get('e_test')->row()->id_type_test;
									/*var_dump($note);
									var_dump($id_type_test);*/
									//var_dump($RecapNoteExam['allComposition']);

									$allTypeTest = $this->db->get('e_type_test')->result_array();
									foreach ($allTypeTest as $item) {
										if ($item['code_type']!='RAT' and $item['id_type_test'] == $id_type_test) {
										echo '
										<button class="btn btn-default" style="float: left; width: 166px; margin-left: 4px">
										'.$item['code_type'].' : '.$note.' / '.$nb_point.'
										vaut ('.$item['percentage'].'%) </button>';
										}
										elseif($item['code_type']!='RAT') {
											echo '
										<button class="btn btn-default" style="float: left; width: 166px; margin-left: 4px">
										'.$item['code_type'].' : -- / 20
										vaut ('.$item['percentage'].'%) </button>';
										}
									}
								}
								else{
									$allTypeTest = $this->db->get('e_type_test')->result_array();
									foreach ($allTypeTest as $item) {
										if ($item['code_type']!='RAT'){ 
											echo '
										<button class="btn btn-default" style="float: left; width: 166px; margin-left: 4px">
										'.$item['code_type'].' : -- / 20
										vaut ('.$item['percentage'].'%) </button>';
										}
									}
								}
							}
							$moyenne = 0;
							$allstatement = $RecapNoteExam['allstatement'];
							foreach ($allComposition as $kurap) {
								if ($kurap['id_wave']==$key1['id_wave']) {
									foreach ($allstatement as $gon) {
										$somme = $this->db->where('id_user', session_data('id'))->get('e_statement')->result_array();
										$id_type_test = $this->db->where('id_test', $kurap['id_test'])->get('e_test')->result_array();
										$TotalNote = 0;
										foreach ($somme as $magnum) {
											$percent = 0;
											$id_test = $this->db->where('id_compo', $magnum['id_compo'])->get('e_composition')->row()->id_test;
											$id_type_test = $this->db->where('id_test', $id_test)->get('e_test')->row()->id_type_test;
											$percent = $this->db->where('id_type_test', $id_type_test)->get('e_type_test')->row()->percentage;
											$moyenne += ($magnum['note']*$percent)/100;
										}
									}
									echo '
								</div>
								<div class="panel-footer">
									<h4 style="float: left; margin-left: 8px;">Moyenne actuelle : '. $moyenne.'/ 20
									</h4>';

	if ($moyenne < 20*20/100) {
      $mention = 'Nulle';
    }
    elseif ($moyenne >= 20*20/100 and $moyenne < 20*30/100) {
      $mention = 'Médiocre';
    }
    elseif ($moyenne >= 20*30/100 and $moyenne < 20*40/100) {
      $mention = 'Insuffisant';
    }
    elseif ($moyenne >= 20*40/100 and $moyenne < 20*50/100) {
      $mention = 'Passable';
    }
    elseif ($moyenne >= 20*50/100 and $moyenne < 20*60/100) {
      $mention = 'Assez Bien';
    }
    elseif ($moyenne >= 20*60/100 and $moyenne < 20*70/100) {
      $mention = 'Bien';
    }
    elseif ($moyenne >= 20*70/100 and $moyenne < 20*80/100) {
      $mention = 'Très Bien';
    }
    elseif ($moyenne >= 20*80/100 and $moyenne < 20*90/100) {
      $mention = 'Très Bien (Avec Félicitation)';
    }
    elseif ( $moyenne >= 20*90/100 and $moyenne < 20*95/100) {
      $mention = 'Excellente';
    }
    else {
      $mention = 'Parfaite';
    }
								echo '
								<h4 style="float: left; margin-left: 35px;">
					    			Appréssiation : '.$mention.' pour le moment
							    </h4>';
									}
									else{
									echo '
								</div>
								<div class="panel-footer">
									<h4 style="float: left; margin-left: 8px;">Moyenne actuelle : -- / 20
									</h4>';
								echo '
								<h4 style="float: left; margin-left: 35px;">
					    			Appréssiation : nulle pour le moment
							    </h4>';

									}
								}
$allLearnersW = $this->db->where('id_wv', $key1['id_wave'])->get('e_content')->result_array();
$number_learners= sizeof($allLearnersW);
							if ($key1['type_wave']=='Longue') {
								if ($moyenne >= 12 /*and (round(($all_presence/60), 2)/$duration)>=0.67*/) {
									$compo=$this->db->where('id_wave', $key1['id_wave'])->get('e_composition')->result_array();
									if (sizeof($compo)>=6) {
										foreach ($compo as $oui) {
											if (sizeof($this->db->where('id_user', session_data('id'))->where('id_compo', $oui['id_compo'])->get('e_statement')->result_array())>=6) {
												echo '
												<div style="float: right;"><br>
													<a class="btn btn-primary h4" href="'.base_url().'assets/uploads/e_documents/Certificats/'.session_data('matricule').$key1['id_wave'].'" style="float: right; border-radius: 0px;">ATTESTATION</a>
												</div>';
											}
											else{
												echo '
												<div style="float: right;"><br>
													<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">ATTESTATION indisponible</a>
												</div>';
											}
										}
									}
									else{
										echo '
										<div style="float: right;"><br>
											<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">ATTESTATION indisponible</a>
										</div>';
									}
								}
								else{
									echo '
									<div style="float: right;"><br>
										<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">ATTESTATION indisponible</a>
									</div>';
								}
							}
							else{
								if ($moyenne >= 12 /*and (round(($all_presence/60), 2)/$duration)>=0.67*/) {
									$compo=$this->db->where('id_wave', $key1['id_wave'])->get('e_composition')->result_array();
									if (sizeof($compo)>=6) {
										foreach ($compo as $oui) {
											if (sizeof($this->db->where('id_user', session_data('id'))->where('id_compo', $oui['id_compo'])->get('e_statement')->result_array())>=6) {
												echo '
												<div style="float: right;"><br>
													<a class="btn btn-primary h4" href="'.base_url().'assets/uploads/e_documents/Certificats/'.session_data('matricule').$key1['id_wave'].'" style="float: right; border-radius: 0px;">CERTIFICAT</a>
												</div>';
											}
											else{
												echo '
												<div style="float: right;"><br>
													<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">CERTIFICAT indisponible</a>
												</div>';
											}
										}
									}
									else{
										echo '
										<div style="float: right;"><br>
											<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">CERTIFICAT indisponible</a>
										</div>';
									}
								}
								else{
								echo '
								<div style="float: right;"><br>
									<a class="btn btn-primary h4" style="float: right;color: white; border-radius: 0px;">ATTESTATION indisponible</a>
								</div>';
								}
							}
				    		echo '
							<h4 style="float: left; margin-left: 98px;">Rang actuelle : ';
							if ($number_learners == 1) {
								echo '1<sup>er</sup>/'.$number_learners.' apprenant';
							}
							else{
								echo $key1['number_learners'].'<sup>ième</sup>/'.$number_learners.' apprenants
							</h4>';
							}
							echo'
						</div>
					</div>';		
						}
					}
				}
			}
		}
	}
?>
		</div>
  	</div>
</div>
