<div class="panel panel-default">
  	<div class="panel-body">
		<div class="container-fluid">
		    <div class="row">
		        <div class="h4 text-center  col-sm-12" style="color: orange">
		            RÈGLEMENTS
		            <hr width="60%" style="margin: auto; margin-top: 10px">
		        </div>
		    </div>
			<div class="panel panel-default" style="width: 81%; float: right;">

				<form action="" method="post">
        <div class="row">
        <?php 
        $k = -1;
        foreach ($list_operator as $key) {
          echo '<div style="margin-top: 8px; width: 170px; height: 170px; margin-left: 13px; ">';
          if ($k < 2) {
            if ($key['type_op']=='Banquaire') {
              echo '<div class="panel" style="margin: 8px; height: 161px; background-color: #ff9000; color: white;">
                      	<div class="panel-heading" style="height: 35px;">
                      		<label>'.$key['numbers_used'].'</label>
                      		<input type="radio" name="operator" value="'.$key['id_op'].'" required>
                      </div>
                      <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 121px; height: 103px;" class="img-responsive img-cercle"></li>
                    </div>';
              $k++;
            }
            else{
              echo '<div class="panel" style="margin: 8px; height: 161px; background-color: #ff9000; color: white;">
                      <div class="panel-heading" style="height: 35px;">
                      	<label>'.$key['numbers_used'].'</label>
                      	<input type="radio" name="operator" value="'.$key['id_op'].'" required>
                      </div>
                      <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 121px; height: 103px;" class="img-responsive img-cercle"></li>
                    </div>';
              $k = 0;
            }
            echo '</div>';
          }
        }  
        ?>
				</div>

				<div class="col-md-12">
						<table class="table">
						    <th style="width: 148px;height: 58px;">Formation</th>
						    <th style="width: 200px;height: 58px;">Total restant</th>
						    <th style="width: 200px;height: 58px;">Tranche(s) payée(s)</th>
						    <th style="width: 100px;height: 58px;">Détails</th>
						    <th style="width: 200px;height: 58px;">Date limite</th>
					<?php 
						$i = 1;
						$m = 1;
						$id_user = session_data('id');
						
						$allIdIsWave = $this->db->distinct('*')->from('e_content')->where('id_user = '.$id_user)->get()->result_array();

						$j = 0;
						foreach ($IsRegulation as $key) {
						$rest_slice = ($key['total_slice'] - $key['num_slice']);


						foreach ($allIdIsWave as $key4) {
						$all_delay[$j++] = $this->db->select('*')->from('e_delay')->where('id_wave', $key4['id_wv'])->get()->result_array();
						}
						if ($key['remaining_amount'] > 0 and $key['validation_state'] == 1) {
				    		$name_lesson = array();
				    		$name_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
				    		$total_amount = $this->db->select('mtn1')->from('e_slices')->where('id_lesson', $key['id_lesson'])->get()->result_array();

							foreach ($name_lesson as $key1) {

								if ($key['formation_type'] == 'lng') {
									$formation_type = 'Longue';
								}
								elseif ($key['formation_type'] == 'crt') {
									$formation_type = 'Courte';
								}
								else{
									$formation_type = 'Promotionnelle';
								}
								$new_remaining = ($key['remaining_amount']-$key['next_amount']);
								if ($new_remaining <= 0) {
									$new_remaining = 0;
								}
								$j = $i;
								echo'<tr style="height: 50px;height: 50px; margin-top: 13px;">
										<td>'.$key1['code'].'('.$formation_type.')
										<input type="hidden" name="formation_type'.$j.'" value="'.$key['formation_type'].'">
										<input type="hidden" name="id_lesson'.$j.'" value="'.$key['id_lesson'].'">
										</td>
										<td>'.$key['remaining_amount'].' FCFA</td>
										<input type="hidden" name="next_amount'.$j.'" value="'.($key['next_amount']).'">
										<input type="hidden" name="new_remaining'.$j.'" value="'.$new_remaining.'">';

										$rest_slice = ($key['total_slice'] - $key['num_slice']);

								echo '	<td>'.$key['num_slice'].'/'.$key['total_slice'].'
										<input type="hidden" name="num_slice'.$j.'" value="'.($key['num_slice']+1).'">
										<input type="hidden" name="total_slice'.$j.'" value="'.$key['total_slice'].'">
										</td>';

								echo '  <td><a href="'.base_url().'e_controllers/c_confirm_valid_registration/details/'.$key['id_lesson'].'" style="text-decoration: none;" class="glyphicon glyphicon-eye-open"></a>
										</td>';
									$numDelay = 'delay_'.$key['total_slice'].'_'.$key['num_slice'];
									$ThisDelay = $this->db->where('id_wave', $key4['id_wv'])->get('e_delay')->result_array();
									foreach ($ThisDelay as $genkidama) {
									if ($numDelay!='delay_2_1' and 'delay_3_1') {
									echo '	<td>'.$genkidama[$numDelay].'
											</td>
										</tr>';
									}
								}
								$i++;
							}
						}
						elseif ($key['validation_state'] == -1){
							$name_lesson = array();
				    		$name_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
				    		$total_amount = $this->db->select('mtn1')->from('e_slices')->where('id_lesson', $key['id_lesson'])->get()->result_array();

							foreach ($name_lesson as $key1) {

								if ($key['formation_type'] == 'lng') {
									$formation_type = 'Longue';
								}
								elseif ($key['formation_type'] == 'crt') {
									$formation_type = 'Courte';
								}
								else{
									$formation_type = 'Promotionnelle';
								}
								$new_remaining = ($key['remaining_amount']-$key['next_amount']);
								if ($new_remaining <= 0) {
									$new_remaining = 0;
								}
								$j = $i;
								echo 
								'<form action="e_controllers/c_confirm_valid_registration/finalizeRegulation" method="post">
									<tr style="height: 50px;height: 50px; margin-top: 13px;">
										<td>'.$key1['code'].'('.$formation_type.')
										<input type="hidden" name="formation_type'.$j.'" value="'.$key['formation_type'].'">
										<input type="hidden" name="id_lesson'.$j.'" value="'.$key['id_lesson'].'">
										</td>
										<td><label style="color: indigo;">Erreur : dernière transaction</label></td>
										<input type="hidden" name="next_amount'.$j.'" value="'.($key['next_amount']).'">
										<input type="hidden" name="new_remaining'.$j.'" value="'.$new_remaining.'">';

										$rest_slice = ($key['total_slice'] - $key['num_slice']);

								echo'	<td><label style="color: red;"> (Dernière opération refusée : Veuillez Contacter l\'administration)</label>
								
										<input type="hidden" name="num_slice'.$j.'" value="'.($key['num_slice']+1).'">
										<input type="hidden" name="total_slice'.$j.'" value="'.$key['total_slice'].'">
										</td>';

								echo '  <td><a href="'.base_url().'e_controllers/c_confirm_valid_registration/details/'.$key['id_lesson'].'" style="text-decoration: none;" class="glyphicon glyphicon-eye-open"></a>
										</td>';
								$numDelay = 'delay_'.$key['total_slice'].'_'.$key['num_slice'];
								$ThisDelay = $this->db->where('id_wave', $key4['id_wv'])->get('e_delay')->result_array();
								foreach ($ThisDelay as $genkidama) {
								
								echo '	<td>'.$genkidama[$numDelay].'
										</td>
									</tr>';
								}
								$i++;
							}
						}
						elseif ($key['validation_state'] == 0){
				    		$name_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
							foreach ($name_lesson as $key1) {
								$l = $m;
								echo '
								<tr>
									<td>'.$key1['code'].'</td>
									<td>En attente</td>
									<td>En attente</td>
									<td>En attente</td>';
								$numDelay = 'delay_'.$key['total_slice'].'_'.$key['num_slice'];

								$ThisDelay = $this->db->where('id_wave', $key4['id_wv'])->get('e_delay')->result_array();
								foreach ($ThisDelay as $genkidama) {
								if ($numDelay!='delay_2_1' and 'delay_3_1') {
								echo '	<td>'.$genkidama[$numDelay].'
										</td>
									</tr>';
								}
							}
							$m++;
						}
					}
				}
				echo '</div>';
				
			?>
				</table><br><br>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
						  	<span class="input-group-addon" id="basic-addon1">Ref :</span>
						  	<input type="text" class="form-control" name="reference" placeholder="Reférence de payement" aria-describedby="basic-addon1" required>
						</div>
					</div>
					<div class="col-md-6">	
						<div class="dropup">
						  	<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 202px; float: right;">
						    	Formation consernée ?
						  	</button>
						  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 503px;">
						  	<?php 
							foreach ($IsRegulation as $key) {
								if (($key['remaining_amount'] > 0 ) and ($key['validation_state'] == 1)) {
										$name_lesson = array();
										$name_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
									foreach ($name_lesson as $key1) {
						  				echo 
					  					'<li>
					  						<label style="margin-left: 44px">
					  							<input type="radio" name="id_training" value="'.$key1['id'].'" style=" margin-right: 22px" required>'.$key1['label'].' ('.$key1['code'].')
					  							<input type="hidden" name="formation_type" value="'.$key['formation_type'].'">
												<input type="hidden" name="id_lesson" value="'.$key['id_lesson'].'">
												<input type="hidden" name="num_slice" value="'.($key['num_slice']+1).'">
												<input type="hidden" name="total_slice" value="'.$key['total_slice'].'">
												<input type="hidden" name="next_amount" value="'.($key['next_amount']).'">
												<input type="hidden" name="new_remaining" value="'.$new_remaining.'">
					  						</label>
					  					</li>
					  					<li role="separator" class="divider"></li>';
						  			}
						  		}
						  		elseif ($key['remaining_amount'] > 0 and $key['validation_state'] == -1) {
										$name_lesson = array();
										$name_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
									foreach ($name_lesson as $key1) {
						  				echo 
						  					'<li>
						  						<label style="margin-left: 44px">
						  							<input type="radio" name="id_training" value="'.$key1['id'].'" style=" margin-right: 22px" required>'.$key1['label'].' ('.$key1['code'].')
						  							<input type="hidden" name="formation_type" value="'.$key['formation_type'].'">
													<input type="hidden" name="id_lesson" value="'.$key['id_lesson'].'">
													<input type="hidden" name="num_slice" value="'.($key['num_slice']+1).'">
													<input type="hidden" name="total_slice" value="'.$key['total_slice'].'">
													<input type="hidden" name="next_amount" value="'.($key['next_amount']).'">
													<input type="hidden" name="new_remaining" value="'.$new_remaining.'">
						  						</label>
						  					</li>
						  					<li role="separator" class="divider"></li>';
						  			}
						  		}
						  	}
						  	?>
						  	</ul>
						</div>
					</div> 
			<input style="margin-left: 404px; margin-bottom: 44px; margin-top: 17px" type="submit" class="btn btn-success" name="Soumettre" value="Soumettre">
			</div>
		</form>
		</div>
  	</div>
</div>