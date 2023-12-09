<div class="panel panel-default">
  	<div class="panel-body">

		<?php if (sizeof($allIsRequests)!=0) {
		?>

		<div class="row" style="color: #ff9000">
		    <div class="text-center  col-sm-12">
		    	<h2 class="page-title mb-3">
		    		LISTE DE VOS REQUETES	
		    	</h2>
		        <a style="float: right; border-radius:0px;" href="<?php echo base_url().'e_controllers/c_take_courses/deleteAllRequest'; ?>"  class="btn btn-info" title="Vider la liste de vos requêtes"> Vider </a>
		        <hr width="40%" style="margin: auto; margin-top: 10px">
		    </div>
		</div>
		<div class="row" style="margin-left: 18%">
			<div class="panel panel-default">
				<table class="table">
			    	<?php 
			    	   echo '<th>#</th><th>Date d\'envoie</th><th>Formation</th><th>Objet</th><th>Décision</th><th>Réponse</th><th>Signature</th><th>Date de réponse</th><th colspan="2">Action</th>';
			    	   foreach ($allIsRequests as $key) {
							foreach ($list_training as $key1) {
								if ($key['role_resp'] == 3) {
			    	   				$Signature = "Le responsable de la formation";
			    	   			}
			    	   			else{
			    	   				$Signature = "L'administrateur";
			    	   			}
								if ($key['id_lesson'] == $key1['id']) {
						    	   	if ( $key['date_answer']== '0000-00-00 00:00:00' and $key['answer_rqst'] == NULL)
						    	   		{
							    		echo '<tr>
							    				<td>'.$key['num_rqst'].'</td>
							    				<td style="width: 157px">'.$key['date_rqst'].'</td>
							    				<td>'.$key1['code'].'</td>
							    				<td style="width: 175px">'.$key['reason'].'</td>
							    				<td style="width: 157px">'.$key['decision'].'</td>
							    				<td style="width: 157px">'.'----'.'</td>
							    				<td style="width: 157px">'.'----'.'</td>
							    				<td style="width: 157px">'.'----'.'</td>
							    				<td style="width: 107px">
							    					<a class="glyphicon glyphicon-remove btn btn-warning" href="'.base_url().'e_controllers/c_take_courses/removeRqst/'.$key['id_rqst'].'">
							    					</a>
							    					<a class="glyphicon glyphicon-refresh btn btn-info" href="'.base_url().'e_controllers/c_take_courses/sendRequest/'.$key['id_rqst'].'/'.$key['id_lesson'].'">
							    					</a>
							    				</td>						    				
							    			  </tr>';		    	   		
						    	   	}
						    	   	else{
										echo '<tr>
						    				<td>'.$key['num_rqst'].'</td>
						    				<td>'.$key['date_rqst'].'</td>
						    				<td>'.$key1['code'].'</td>
						    				<td>'.$key['reason'].'</td>
						    				<td>'.$key['decision'].'</td>
						    				<td>
						    					<div class="dropup">
				  									<button class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Voir
				  									</button>
				  									<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="text-align: center;">
				  										<li>'.$key['answer_rqst'].'</li>
				  									</ul>
				  								</div>
				  							</td>
						    				<td style="width: 121px;">'.$Signature.'</td>
						    				<td style="width: 121px;">'.$key['date_answer'].'</td>
						    				<td style="width: 121px;">
						    					<a class="glyphicon glyphicon-remove btn btn-warning" href="'.base_url().'e_controllers/c_take_courses/removeRqst/'.$key['id_rqst'].'">
							    				</a>
						    				</td>
						    			  </tr>';		    	   		
						    	   	}
						    	}
						    }	
				    	} ?>
				  	</table>
				</div>
			</div>
	<?php 	}
			else {
				echo '			
					<div class="row">
			    	<div class="h4 text-center  col-sm-12">
			       		Vous n\'avez pas de nouvelles requêtes <label style="color: blue;"> soumises </label>,<label style="color: gray;"> en attentes </label> ou <label style="color: green;"> validées </label> !  <a href="'.base_url().'e_controllers/c_take_courses/makeRequest'.'"  class="btn btn-info" title="Soumettre une requête"> (Soumettre) </a>
			        	<hr width="60%" style="margin: auto; margin-top: 10px">
			    	</div>
				</div>';
			} ?>
  	</div>
</div>
