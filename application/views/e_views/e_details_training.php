
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">

   	<?php 
   	foreach ($choice as $key) {
			if ($key['id'] == $id) { ?>
				<div class="col-md-8 panel panel-default" style="margin-right: -125px; width: 125%">					
		      <div class="col-sm-12">
		          <h3 class="page-title mb-3" style="text-align: center;">DETAILS DE LA FORMATION EN LIGNE EN <hr><?php echo mb_strtoupper($key['label']) ;?></h3>
		          <hr>
		      </div>
		<?php
			$path_choice = base_url().'e_controllers/c_home_page/choiceTraining/'.$key['id'] ;?>

					<div class="row">
						<div class="input-group col-md-6">
							
				    	</div>

				    </div>
<?php 
	$IsSlices = array();
	$IsSlices = $this->db->select('*')->from('e_slices')->where('id_lesson', $key['id'])->get()->result_array();
?>
					<div class="panel-body">
						<div class="input-group col-md-4">
							<li class="list-group-item">
						  		<a href="<?php echo base_url().'e_controllers/c_list_training/listModuleTraining/'.$key['id'] ;?>" style="text-decoration: none; border-radius: 0px" >
									<button type="button" class="btn btn-warning"><span>Liste des modules</span>
									</button>
								</a>
								
							</li>
							<li class="list-group-item">
						  		<a href="<?php echo base_url().'e_controllers/c_home_page/testTraining/'.$key['id'];?>" style="text-decoration: none; border-radius: 0px">
									<button type="button" class="btn btn-info"><span>Passez un test de prérequis dédié</span>
									</button>
								</a>
								
							</li>
							<li class="list-group-item">
								<a href="<?php echo $path_choice ;?>" style="text-decoration: none; border-radius: 0px">
									<button type="button" class="btn btn-success"><span>Procéder à l'inscription</span>
									</button>
								</a>
							</li>
					    </div>
				    	<div class="col-md-4" style="text-align: center;">
				    		<li class="list-group-item">
                                <i class="fa fa-hashtag green-color"></i>&nbsp;
                                Code : &nbsp;<b><?php echo $key['code'];?></b>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-clock-o green-color"></i>&nbsp;
                                Nombre d'heures :&nbsp; <b><?php echo $key['duration'];?> H</b>
                            </li>
							<li class="list-group-item">
								<i class="fa fa-money green-color"></i>&nbsp;
								Frais de la formation :&nbsp; <b> 
								<?php
									foreach ($IsSlices as $key2) {
										echo $key2['mtn1'].'fcfa en ligne et : '.$key['fees'].' fcfa en présentielle';
									}
								?></b>		
							</li>
							<li class="list-group-item">
								<i class="fa fa-money green-color"></i>&nbsp;
								Tranches en ligne :&nbsp; <b> 
								<?php
									foreach ($IsSlices as $key2) {
										echo '<br>Deux tranches : '.$key2['mtn21'].' fcfa et '.$key2['mtn22'].' fcfa <br>
											<br>Trois tranches : '.$key2['mtn31'].' fcfa, '.$key2['mtn32'].' fcfa et '.$key2['mtn33'].' fcfa';
									}
								?></b>
									
							</li>
							<li class="list-group-item text-uppercase text-primary">
                                <i class="fa fa-trophy green-color"></i> &nbsp;
                                <b class="text-primary" style="font-size: 90%">Produit : <?php
							if ($key['type'] == 'cours') {
							 	echo 'ATTESTATION';
							 }else{ echo "CERTIFICATION";}
							 ?></b>
							</li>
						</ul>
				    </div>
						    <div class="col-md-4">
								<li class="list-group-item">Résumé :<?php echo $key['syllabus'];}}
								?></li>
							</div>
				</div>
			</div>	    
		</div>
	</div>
</div>
