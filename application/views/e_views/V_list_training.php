<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/css/bootstrap/css/bootstrap.min.css';?>">

	<script type="text/javascript" href="<?php echo base_url().'/assets/js/bootstrap.min.js';?>"></script>
	<title>Liste des formations E_learning</title>
</head>
<body>
	<div class="container">
		<form method="POST" action="<?php echo base_url().'e_controllers/c_confirm_valid_registration/choiceTraining';?>">
 			<div class="row">
				<div class="col-md-7">
					<div class="input-group">
						<span class="input-group-addon">Choisir votre formation</span>
						<select name="training" class="form-control">
						<?php
							foreach ($rslt_list as $key) {
								echo "<option value='".$key['label']."'>".$key['label']."</option>";
							}
						?>
						</select>
					</div>
					<?php ?>
					<input type="submit" name="choise_training" value="OK" class="form-control">
				</div> 

<?php
	//foreach ($rslt_list as $key) {
		//for ($i=0; $i < count($key) ; $i++) {
			//if ($i %= 3) { 
				//echo '<div class="row">';
/*				if ($key['type'] == 'cours') {
					echo '
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body"></div>
							<ul class="list-group">

								<li class="list-group-item">Formation :'.$key['label'].'</li>
								<li class="list-group-item">Code :'.$key['code'].'</li>
								<li class="list-group-item">Nombre d\'heure'.$key['duration'].'</li>
								<li class="list-group-item">Frais :'.$key['fees'].'</li>
								<li class="list-group-item">Produit : '.$key['type'].'</li>
								<li class="list-group-item">'.$key['syllabus'].'</li>
							</ul>
						 	<div class="panel-heading"></div>
						</div>
					</div>';
				}*/
/*				else{
					echo '
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body"></div>
							<ul class="list-group">

								<li class="list-group-item">Formation :'.$key['label'].'</li>
								<li class="list-group-item">Code :'.$key['code'].'</li>
								<li class="list-group-item">Nombre d\'heure'.$key['duration'].'</li>
								<li class="list-group-item">Frais :'.$key['fees'].'</li>
								<li class="list-group-item">Produit : '.$key['type'].'</li>
								<li class="list-group-item">'.$key['syllabus'].'</li>
							</ul>
						 	<div class="panel-heading"></div>
						</div>
					</div>';
				}
				echo '</div>';*/
			//}
			/*else{
				if ($key['type'] == 'cours') {
					echo '
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body"></div>
							<ul class="list-group">

								<li class="list-group-item">Formation :'.$key['label'].'</li>
								<li class="list-group-item">Code :'.$key['code'].'</li>
								<li class="list-group-item">Nombre d\'heure'.$key['duration'].'</li>
								<li class="list-group-item">Frais :'.$key['fees'].'</li>
								<li class="list-group-item">Produit : '.$key['type'].'</li>
								<li class="list-group-item">'.$key['syllabus'].'</li>
							</ul>
						 	<div class="panel-heading"></div>
						</div>
					</div>';
				}
				else{
					echo '
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body"></div>
							<ul class="list-group">

								<li class="list-group-item">Formation :'.$key['label'].'</li>
								<li class="list-group-item">Code :'.$key['code'].'</li>
								<li class="list-group-item">Nombre d\'heure'.$key['duration'].'</li>
								<li class="list-group-item">Frais :'.$key['fees'].'</li>
								<li class="list-group-item">Produit : '.$key['type'].'</li>
								<li class="list-group-item">'.$key['syllabus'].'</li>
							</ul>
						 	<div class="panel-heading"></div>
						</div>
					</div>';
				}*/
			//}
		//}
		
	//}
	
?>
			</div>
			
		</form>
	</div>
</body>
</html>