
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
	<script type="text/javascript" href="<?php echo base_url().'assets/js/bootstrap/js/bootstrap.min.js';?>">
		
	</script>
</head>
<body>
	<form method="POST" action="<?php echo base_url().'e_controllers/c_confirm_valid_registration/registration'; ?>" enctype="multipart/form-data">
		<div class="container" style="width: 94%;float: right;">
			<div class="panel" style="margin: 0px;text-align: center;color: orange;">
				<h3>VALIDATION ET CONFIRMATION DE VOTRE DEMANDE</h3>
			</div>
			<div class="panel-body">
<div class="panel panel-info" style="width: 100%;float: right;margin-right: 7%">
   <div class="panel-heading" style="height: 44px;">
		<h4>Modalité de paiement</h4>
	</div>
	<div class="panel-body">
		<div class="row" style="text-align: center;">
			<div align="left" style="margin-left: 17px;">
				<label style="color: white;">Choisissez l'opérateur utilisé puis indiqué le montant versé ainsi que votre reférence de payement :
				</label>
			</div><br>
		<div class="row container">
			<div class="col-md-6">
				<div class="input-group">
				    <span class="input-group-addon">
				        Montant versé* :
				    </span>
					<select class="form-control" name="num_slice" style="height: 35px;">
				  		<option value="0">Selectionnez</option>
					<?php
					$u1 = 1;
					$u2 = 2;
					$u3 = 4;
					foreach ($list_slices as $key) {
						echo '
							<option value="'.$u1.'">'.$key['mtn1'].' Total</option>';
						if ($key['mtn21'] != null) {
							echo '
							<option value="'.$u2.'">'.$key['mtn21'].' Première tranche sur 2
							</option>
							';
						}
						if ($key['mtn31'] != null) {
							echo '
							<option value="'.$u3.'">'.$key['mtn31'].' Première tranche sur 3
							</option>
							';
						}
						if ($key['mtn21'] != null or $key['mtn31'] != null) {
							echo '
							<input type="hidden" name="mtn21" value="'.$key['mtn21'].'">
							<input type="hidden" name="mtn22" value="'.$key['mtn22'].'">
							<input type="hidden" name="mtn31" value="'.$key['mtn31'].'">
							<input type="hidden" name="mtn32" value="'.$key['mtn32'].'">
							<input type="hidden" name="mtn33" value="'.$key['mtn33'].'">';
						}

						echo '
							<input type="hidden" name="total_amount" value="'.$key['mtn1'].'">
							<input type="hidden" name="mtn1" value="'.$key['mtn1'].'">';
						}
					?>
				  	</select>
				</div><br>
				<div class="input-group">
				    <span class="input-group-addon">
				        Reférence de payement * :
				    </span>
					<input type="text" class="form-control" name="reference" placeholder="Entrer la reférence de payement" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
			      <span class="input-group-addon">
			        Occupation actuelle* :
			      </span>
			      <select class="form-control" name="kind" style="height: 35px;">
			      	<option value="0"></option>
			      	<option value="Elève">
			      		Elève
			      	</option>
			      	<option value="Etudiant">
			      		Etudiant
			      	</option>
			      	<option value="Enseignant">
			      		Enseignant
			      	</option>
			      	<option value="Chercheur">
			      		Chercheur
			      	</option>
			      	<option value="Employer">
			      		Employer
			      	</option>
			      	<option value="Autre">
			      		Autre
			      	</option>
			      </select>
		  		</div><br>
		      	<div class="input-group">
			      <span class="input-group-addon">
			        Lieu de l'occupation* :
			      </span><input type="text" name="place_kind" class="form-control" placeholder="Ecole, Entreprise, Edifice, ..." required>
		  		</div>
	  		</div>
	  	</div>
	</div>
	<br>
	<br>
    	Veuillez selectionner le numéro sur lequel vous avez effectué le virement :
    <div class="row">
    <?php 
    $k = -1;
    foreach ($list_operator as $key) {
      echo '<div style="margin-top: 8px; width: 170px; height: 170px; margin-left: 13px; ">';
      if ($k < 2) {
        if ($key['type_op']=='Banquaire') {
          echo '<div class="panel" style="margin: 8px; height: 161px; background-color: #ff9000; color: white;">
                  <div class="panel-heading" style="height: 35px;">
                  	<label style="float: right">'.$key['numbers_used'].'</label>
                  	<input type="radio" name="operator" value="'.$key['id_op'].'" required>
                  </div>
                  <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 121px; height: 103px;" class="img-responsive img-cercle"></li>
                </div>';

          $k++;
        }
        else{
          echo '<div class="panel" style="margin: 8px; height: 161px; background-color: #ff9000; color: white;">
                  <div class="panel-heading" style="height: 35px;">
                  	<label style="float: right" >'.$key['numbers_used'].'</label>
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

			</div>
		</div>
	</div>
	<div class="panel panel-success"  style="float: left;">
	   <div class="panel-heading" style="height: 44px;">
			<h4>DEMANDE D'UNE FORMATION EN :
<?php foreach ($choice as $key) { if ($key['id'] == $id) { echo mb_strtoupper($key['label']) ; ?>
			</h4>
	   </div>
<?php
$IsSlices = array();
$IsSlices = $this->db->select('*')->from('e_slices')->where('id_lesson', $key['id'])->get()->result_array();
?>
<div class="panel-body">
    <div class="input-group col-md-6">

			<li class="list-group-item h4"><i class="glyphicon glyphicon-education"></i><b> Type de la formation : <?php echo " <label> ".$key['type'].'</label>';?></b></li>
			<li class="list-group-item h4">
			   <i class="fa fa-clock-time green-color"> code : <?php echo " <label> ".$key['code'].'</label>';?></i>

			<input type="hidden" name="id_training" value="<?php echo $key['id'] ;?>">
			</li>
			<li class="list-group-item h4">Nombre d'heures : <?php echo ' <label> '.$key['duration'].'</label>';?></li>
			<li class="list-group-item h4">Frais :
				<?php
					foreach ($IsSlices as $key2) {
						echo ' <label> '.$key2['mtn1'].' fcfa en ligne et : '.$key['fees'].' fcfa en présentielle'.'</label>';
					}
				?>

			</li>
			<li class="list-group-item h4">Tranches en ligne :
				<?php
					foreach ($IsSlices as $key2) {
						if ($key2['mtn21'] != null ) {
							echo '<br><br>Deux tranches : <label>'.$key2['mtn21'].' fcfa et '.$key2['mtn22'].' fcfa</label><br>';
						}
						if ($key2['mtn31'] != null) {
							echo '
							<br>Trois tranches : <label>'.$key2['mtn31'].' fcfa, '.$key2['mtn32'].' fcfa et '.$key2['mtn33'].' fcfa</label>';
						}
					}
				?>

			</li>
			<input type="hidden" name="fees_training" value="<?php echo $key['fees'];?>">
			<li class="list-group-item h4">Produit délévré:
				<?php
					if ($key['type'] = 'cours') {
				 	echo '<label>CERTIFICATION</label>';
				 	echo '<input type="hidden" name="formation_type" value="'.$key['type'].'"';
				 }
				 else{ echo "<label>ATTESTATION</label>";
					echo '<input type="hidden" name="formation_type" value="'.$key['type'].'"';
				 }
			 	?>
			</li>
		</ul>
    </div>
    <div class="input-group col-md-6 h4">
    	<ul class="list-group">
		  <li class="list-group-item">Résumé de la formation :<?php echo $key['syllabus'];
		?></li> <?php
			}
		}
		?>
		  <li class="list-group-item">Modules :<ol>
		<?php
		foreach ($list_Id_module as $key) {
			foreach ($list_module as $key1) {
				if ($key1['id_mod'] == $key['id_mod']) {
				echo '<li>'.$key1['label_mod'].' ('.$key1['code_mod'].') :'.$key1['duration_mod'].' heures de cours</li>';
				}
			}
		}
		?></ol>
		  </li>
		</ul>
    </div>
</div>
</div>

		<div style="margin-bottom: 8px;margin-left: 35%;">
			<button type="submit" class="btn btn-success" style="width: 300px;height: 44px;">Soumettre</button>
		</div>
	</form>
</body>
