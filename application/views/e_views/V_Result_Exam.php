
<div class="panel panel-warning" style="width: 81.5%; float: right;margin-top: -17.5px;">
	<div class="panel-heading" style="height: 44px;">
		<div class="h4  col-sm-9" >
          	<?php echo '<label> Matricule : '.session_data('matricule').'</label>';?><label style="margin-left: 125px;"> Vos résultats d'examen par vague</label>
          	<hr width="60%" style="margin: auto; margin-top: 10px">
      	</div>
      	<div class="col-sm-3">
			<nav aria-label="Page navigation" style="float: right; margin-top: -26px;">
			  	<ul class="pagination">
			  		<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
			    	<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
			    	<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
			  	</ul>
			</nav>
		</div>
	</div>
  	<div class="panel-body">
  		<label style="color: #13a63c;">Les évaluations et leur pourcentage dans l'ordre chrologique :</label>
  			<ol style="margin-left: 296px">
<?php 
	$allTypeTest = $this->db->get('e_type_test')->result_array();
	foreach ($allTypeTest as $item) {
		if ($item['code_type'] != 'RAT' and $item['code_type'] != 'EXT') {
			echo '<li><label style="margin-left: 35px">'.$item['label_type'].' ( '.$item['code_type'].' : '.$item['percentage'].'% ) </label>,</li>';
		}
	}
?>
			</ol>
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
						'<div class="panel panel-success" style="margin-top: 22px;background: #a65313">

								<div class="panel-heading"><label> Code de la vague : '.$key1['code_wave'].'</label><label style="float: right">Type de la formation : '.$key1['type_wave'].'</label>
									<label style="margin-left: 53px;"> Formateur principale : '.$name.'</label>
									<label style="margin-left: 53px;">Nombre d\'apprenant(s) : '.$key1['number_learners'].'</label>
								</div>';
	
								echo '
								<div class="panel panel-default">
								  	<div class="panel-body">
										<label style="float: left; margin-left: 8px;">Examens : </label>';
								$allTypeTest = $this->db->get('e_type_test')->result_array();
									foreach ($allTypeTest as $item) {
										if ($item['code_type']!='RAT' and $item['percentage']!=0) {
										echo '
										<label style="float: left; margin-left: 35px;">
										'.$item['code_type'].' : '.$key4['duration'].'/ 20
										vaut (' .$item['percentage'].'% ) </label>
										';
										}
									}
									echo'
								  	</div>
								</div> 
							<div class="panel panel-primary" style="margin-top: 13px;width: 44%; margin-left: 26%">
							  	<div class="panel-body">
									<label style="float: left; margin-left: 8px;">Moyenne actuelle : </label>
									<label style="float: left; margin-left: 44px;">'.$key4['duration'].'/ 20</label>
									<label style="float: left; margin-left: 98px;">Rang actuelle : '.$key1['number_learners'].' ième</label>
							  	</div>
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