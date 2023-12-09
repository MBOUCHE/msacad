<div class="panel panel-default">
  	<div class="panel-body">
	    <div class="row">
	        <div class="h3 text-center  col-sm-12" style="color: orange">
	        	<?php 
	        		if (sizeof($lesson_user) > 1) {
	        			echo 'Liste des anciens sujets de vos '.sizeof($lesson_user).' formations';
	        		}
	        		else{
	        			echo "Liste des anciens sujets de votre formation";
	        		}
	        	?>
	            
	            <hr width="60%" style="margin: auto; margin-top: 10px;">
	        </div>
	    </div>
		<div class="panel panel-default" style="width: 81%; float: right;">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Proposé par</th>
					<th>Nature</th>
					<th>Formation</th>
					<th>Durée prévue</th>
					<th>Date de création</th>
					<th>Votre note</th>
				</thead>
<?php
	$positionTest = sizeof($listHisTest)/2;
	$k= 1;
	if ($positionTest!=0) {
		for ($i=0; $i < ($positionTest); $i++) {
			if ( $listHisTest[$i] != null) {
				if ($listHisTest[$i] and $listHisTest[$i+$positionTest] != null) {	
				echo '
				<tr>
					<td>'.($k).'</td>
					<td>Mr ';
					foreach ($listHisTest[$i+$positionTest] as $key) {
						$trainer_test = $this->db->where('id', $key['id_user'])->get('user')->result_array();
						foreach ($trainer_test as $keyT) {
							echo $keyT['lastname'].' /<br>'.$keyT['mail'];
						}
					}
					echo'</td>
					<td>';
					foreach ($listHisTest[$i+$positionTest] as $key) {
						$type_test = $this->db->where('id_type_test', $key['id_type_test'])->get('e_type_test')->result_array();
						foreach ($type_test as $key1) {
							echo $key1['label_type'];
							if ($key1['label_type']=='Examen de test') {
								$label_type = 'Test';
								$id_type_test = $key['id_type_test'];
							}else{
								$label_type = $key1['label_type'];
								$id_type_test = $key['id_type_test'];
							}
						}
					}

					echo'</td>
					<td>';
					foreach ($listHisTest[$i] as $key) {
						echo $key['label'];
					}
					echo'</td>
					<td>';
					foreach ($listHisTest[$i+$positionTest] as $key) {
						echo $key['duration'];
					}

					echo '</td>
					<td>';
					foreach ($listHisTest[$i+$positionTest] as $key) {
						echo $key['last_modify'];
					}
					echo'</td>
					<td>';
					foreach ($listHisTest[$i] as $key17) {
						echo'
						<a style="text-decoration: none;" href="'.base_url().'e_controllers/c_space_works/preparetionExamen/'.$key17['id'].'/'.$label_type.'/'.$id_type_test.'"> Composer
						</a>';
					}
					echo'
					</td>
				</tr>';
				}
				else{
				echo '
				<tr>
					<td>'.($k).'</td>
					<td>Mr ';
					foreach ($listHisTest[$i] as $key) {
						$trainer_test = $this->db->where('id', $key['id_user'])->get('user')->result_array();
						foreach ($trainer_test as $keyT) {
							if ($keyT['lastname']) {
								echo $keyT['lastname'].' /<br>'.$keyT['mail'];
							}else{
								echo 'MULTISOFT';
							}
						}
					}
					echo'</td>
					<td>Examen de test';
					foreach ($listHisTest[$i+$positionTest] as $key) {
						$type_test = $this->db->where('id_type_test', $key['id_type_test'])->get('e_type_test')->result_array();
						foreach ($type_test as $key1) {
							echo $key1['label_type'];
							if ($key1['label_type']=='Examen de test') {
								$label_type = 'Test';
								$id_type_test= $key['id_type_test'];
							}else{
								$label_type = $key1['label_type'];
								$id_type_test= $key['id_type_test'];
							}
						}
					}

					echo'</td>
					<td>';
					foreach ($listHisTest[$i] as $key) {
						echo $key['label'];
					}
					echo'</td>
					<td>00:30:00';

					echo '</td>
					<td>';
					foreach ($listHisTest[$i] as $key) {
						$day_begin = $this->db->where('id_user', $key['id_user'])->get('e_provided')->result_array();
						foreach ($day_begin as $keyT) {
							echo $keyT['day_begin'];
						}
					}
					echo'</td>
					<td>';
					foreach ($listHisTest[$i] as $key17) {
						if (isset($label_type)) {
						echo'
						<a style="text-decoration: none;" href="'.base_url().'e_controllers/c_space_works/preparetionExamen/'.$key17['id'].'/Test/'.$id_type_test.'"> Composer</a>';
						}else{
						echo '<a style="text-decoration: none;" href=""> Indisponible</a>';
						}
					}
					echo'
					</td>
				</tr>';
				}
				$k++;
			}
			else{
				echo '<div class="panel panel-default">
		  				<div class="panel-body h4 text-center">Aucun sujet disponible pour le moment !!!
		  				</div>
					</div>';
			}
		}
	}
?>
			</table>
		</div>
	</div>
</div>