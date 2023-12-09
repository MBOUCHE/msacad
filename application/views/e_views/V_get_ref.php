<div class="panel panel-default" style="width: 79%; float: right; margin-right: 22px;">
  	<div class="panel-body">
    	<a href="<?php echo base_url().'e_controllers/c_take_courses/reviewCourse/'.$id_training.'/'.$training ;?>">
	      	<button type="button" class="btn btn-primary glyphicon glyphicon-circle-arrow-left" style="border-radius:0px;">
	        	<span>Retour</span>
	      	</button>
    	</a>
<?php

   	$l = $this->db->where('id', $id_training)->get('lesson')->result_array(); 
    foreach ($l as $key) {
      $tr = mb_strtoupper($key['label']);
    }
   	$mt = $this->db->where('id_mod', $id_mod)->get('e_module_teach')->result_array(); 
    foreach ($mt as $key) {
      $mod = mb_strtoupper($key['label_mod']);
    }
	foreach ($HisRef as $key) {

		if (sizeof($key['refernece_mod']) == 0) {
			echo '<img src="'.base_url().'assets/img/logo/logo-sm.png'.'" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 112px; height: 112px;float: right;">
	          	<h4 class="btn btn-warning" style="margin-left: 404; height: 98px;">DESOLE : AUCUNE REFERENCE DISPONIBLE A VOUS FOURNIR POUR LE MOMENT
	          	</h4>
				</div>
			</div>';
		}
		else{
			$trainer_mod = $this->db->where('id_mod', $key['id_mod'])->get('e_provided')->result_array();
			foreach ($trainer_mod as $shino) {
				$teacher = $this->db->where('id', $shino['id_user'])->get('user')->result_array();
				foreach ($teacher as $zetsou) {
					$name = $this->db->where('id', $zetsou['id'])->get('user')->result_array();
					foreach ($name as $mugi) {
						$nameT=$mugi['lastname'];
					}
				}
			}

			$id_trainer_lesson = $this->db->where('id', $id_training)->get('lesson')->result_array();
			foreach ($id_trainer_lesson as $key301) {
			   $trainer_lesson = $this->db->where('id', $key301['id_user'])->get('user')->result_array();
			}
			foreach ($trainer_lesson as $key10) {
				foreach ($trainer_mod as $key103) {
					echo '
					<div class="panel panel-warning" style="text-align: center;"><br>
						<div class="h4 text-center  col-sm-12">
          				<img src="'.base_url().'assets/img/logo/logo-sm.png'.'" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 112px; height: 112px;float: right; font-size: 17px">
							FORMATION : '.$tr.'
								<label class="btn btn-info" style="float: right; margin-right: 53px; border-radius: 0px;"> Formateur principale : M. '.$key10['lastname'].'
								</label>
				            <hr width="60%" style="margin: auto; margin-top: 10px"><br>
				        </div>
				        <div class="h4 text-center  col-sm-12">
							MODULE : '.$mod.'
								<label class="btn btn-info" style="float: right; margin-right: 53px; border-radius: 0px;">Formateur du module : M. '.$nameT.'
								</label>
				            <hr width="60%" style="margin: auto; margin-top: 10px"><br>
				        </div>
						<div class="panel-body">

						<div class="panel panel-primary" style="text-align: center; border-radius: 0px;">
					  	<div class="panel-heading"><h5> REFERENCES DU COURS (Chapitres et Exercices)</h5>
					  	</div>
					  	<div class="panel-body" style="font-size: 22px">'.$key['refernece_mod'].'
						</div>
					</div>';
				}
			}
		}
	} 
?>
  </div>
</div>