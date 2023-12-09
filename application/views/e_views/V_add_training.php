<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">

	<script type="text/javascript" href="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
	<title>Actions E_learning</title>
</head>
<body>
	<style>
	body{
		font-size: 12px;
		font-family: Arial;
	}
	#content > div {
	      background-color: #A9BCF5;
	      box-shadow: inset 2px -2px 2px #DF3A01, inset -2px 2px 2px #DF3A01;
	      height: 2024px;
	}
	</style>
</head>
<body>
	<div class="container">
		<div>
			<nav class="navbar navbar-inverse">
			   <div class="container"> 
			        <div class="navbar-header"> 
			            <a href="#">E-learning</a> 
			        </div>
			        <ul class="nav nav-tabs nav-justified"> 
			             <li><a href="">--------</a></li> 
			             <li><a href="">---------</a></li> 
			             <li><a href="">--------</a></li> 
			             <li><a href="">-----------</a></li> 
			        </ul>
			    </div>
			</nav> 
		</div>
		<div>
			<a href="<?php echo base_url().'e_controllers/c_add_training/addTraining';?>" style="color: white;">
				<button type="button" class="btn btn-primary">Ajouter une formation</button></a>
		</div><br>

		<div class="row">
			<?php 
			$i = count($rslt_list);

			foreach ($rslt_list as $key) {
				if ($key['state'] = 1) {
					echo '<center>
					<div class="col-md-4" style="height: 224px;">
						<div class="panel panel-success">
							<div class="panel-heading">'.$key['label'].'
								<a href="'.base_url().'e_controllers/c_actions_training/statueTraining/'.$key['id'].'" style="color: white;">
						 			<button type="button" class="btn btn-default">Désactiver</button>
						 		</a>
							</div>
							  <ul class="list-group">
							    <li class="list-group-item">Image</li>
							    <li class="list-group-item">'.$key['type'].'</li>
							  </ul>
							<div class="panel-footer">

					 		<a href="'.base_url().'e_controllers/c_actions_training/updateTraining/'.$key['id'].'" style="color: white;">
					 			<button type="button" class="btn btn-success">Modifier</button>
					 		</a>
							

							<a href="'.base_url().'e_controllers/c_actions_training/deleteTraining/'.$key['id'].'" style="color: white;">
					 			<button type="button" class="btn btn-danger">Supprimer</button>
					 		</a>
							</div>
						</div>
					</div></center>';
					}
				else{
					echo '<center>
					<div class="col-md-4" style="height: 224px;">
						<div class="panel panel-default">
							<div class="panel-heading">'.$key['label'].'
								<a href="'.base_url().'e_controllers/c_actions_training/statueTraining/'.$key['id'].'" style="color: white;">
						 			<button type="button" class="btn btn-default">Désactiver</button>
						 		</a>
							</div>
							  <ul class="list-group">
							    <li class="list-group-item">Image</li>
							    <li class="list-group-item">'.$key['type'].'</li>
							  </ul>
							<div class="panel-footer">

					 		<a href="'.base_url().'e_controllers/c_actions_training/updateTraining/'.$key['id'].'" style="color: white;">
					 			<button type="button" class="btn btn-success">Modifier</button>
					 		</a>
							<a href="'.base_url().'e_controllers/c_actions_training/statueTraining/'.$key['id'].'" style="color: white;">
					 			<button type="button" class="btn btn-default">Désactiver</button>
					 		</a>

							<a href="'.base_url().'e_controllers/c_actions_training/deleteTraining/'.$key['id'].'" style="color: white;">
					 			<button type="button" class="btn btn-danger">Supprimer</button>
					 		</a>
							</div>
						</div>
					</div></center>';					
				}		
			} ?>
		</div>
	</div>
</body>
</html>