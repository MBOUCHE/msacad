<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
<?php include_once "e_top_menu.php";?>
<?php include_once "e_left_menu.php";?>
								<div class="row">
									<div class="panel panel-default">
									   <div class="panel-heading" style="height: 31px;"></div>
									   <h4 style=" margin: 12px;">Demande d'une formation en 
									   	<?php 
									   	foreach ($choice as $key) {
								   			if ($key['id'] == $id) {
									   			echo $key['label'] ;
									   	 ?>
									   	
									   </h4>
										<div class="panel-body">
										    <div class="col-md-6">
										    	<div class="input-group col-md-6">
													<li class="list-group-item">Type formation : <?php echo $key['type'];?></li>
													<li class="list-group-item">code : <?php echo $key['code'];?></li>
													<li class="list-group-item">Nombre d'heures : <?php echo $key['duration'];?></li>
													<li class="list-group-item">Frais de la formation : <?php echo $key['fees'];?></li>
													<li class="list-group-item">Produit délévré: <?php
													if ($key['type'] = 'cours') {
													 	echo 'Attestation';
													 }else{ echo "Certification";}
													 ?></li>
												</ul>
										    	</div>
										    	<ul class="list-group">
										    </div>
										    <div class="input-group col-md-6">
										    	<ul class="list-group">
												  <li class="list-group-item">Résumé de la formation :<?php echo $key['syllabus'];
												?></li>
												  <li class="list-group-item">Prérequis :<?php echo $key['prerequisite'];
													} 
												}
												?></li>
												  <li class="list-group-item">Vestibulum at eros</li>
												</ul>
										    </div>
										</div>
										<div>
											<a href="'.$path_details.'">
												<button type="button" class="btn btn-warning"><span>Détails</span>
												</button>
											</a>
											<a href="'.'choiceTraining/'.$key['id'].'">
												<button type="button" class="btn btn-info"><span>S\'inscrire</span>
												</button>
											</a>
										</div>
									</div>
								</div>