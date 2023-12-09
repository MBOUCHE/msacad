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
		<form method="POST" action="<?php echo base_url().'e_controllers/c_add_training/addTraining'; ?>" enctype="multipart/form-data">
			<div class="panel panel-default">
				<div class="panel" style="margin: 13px;color: orange;">
					<h2>Ajouter une formation</h2>
				</div>
				<div class="container">
					<div class="panel-body">
						<div class="row">
							<div class="panel panel-default">
							   	<div class="panel-heading" style="height: 31px;"></div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon">Titre * :</span>
											<input type="text" name="nemu_training" class="form-control" placeholder="Nom complet de la formation" required value="">
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Code * :</span>
											<input type="text" name="code_training" class="form-control" placeholder="Concaténation" required>
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Description * :</span>
											<input type="text-area" name="namu_training" class="form-control" placeholder="Présentation des points clés de la formation" required>
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Prérequis demandés:</span>
											<input type="text-area" name="namu_training" class="form-control" placeholder="Que faut-il déjà savoir faire avant le début du cours" required>
										</div><br>											
									</div>
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon">Montant * :</span>
											<input type="number" name="namu_training" class="form-control" placeholder="Montant de la formation (multiple de 6)" required>
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Nombre de tranches * :</span>
											<input type="number" name="namu_training" class="form-control" placeholder="Entrer le nombre maximal de tranches payables" required>
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Durée de la formation * :</span>
											<input type="number" name="duration_training" class="form-control" placeholder="Durée en nombre d'heures" required>
										</div><br>
										<div class="input-group">
											<span class="input-group-addon">Type de la formation * :</span>
									      	<select class="form-control" name="_trainer">
									      		<option value="0"></option>
									      		<option value="1">
									      			Longue
									      		</option>
									      		<option value="2">
									      			Courte
									      		</option>
									      		<option value="3">
									      			Promationelle
									      		</option>
									      </select>
										</div><br>											
									</div>
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="panel panel-default">
							   	<div class="panel-heading" style="height: 31px;"></div>
								<div class="panel-body">
									<div class="col-md-6">
										<form action = "<?php echo base_url().'e_controllers/c_add_training/img_upload_training';?>" method = "post">
											<div class="panel panel-default">
											   	<div class="panel-heading">
											   		Image associée * (Choisissez un fichier puis cliquer sur ' Aperçu ' et patientez ...)
											   		<input type = "file" name = "img_training" hidden="rien"/>
											   	</div>
												<div class="panel-body"></div>
												<ul class="list-group">
												    <li class="list-group-item"><img src="" alt="Image de la formation"></li>
												</ul>
												<div class="panel-footer" align="right">
													<a href=""><button type="submit" class="btn btn-primary">Aperçu</button></a>
												</div>     
											</div>
										</form>
									</div>	
									<div class="col-md-6">
										<div class="input-group">
									        <span class="input-group-addon">
									        	Etat après création* : 
									      	</span>
									      	<select class="form-control" name="kind">
									      		<option value="1">
									      			Activé
									      		</option>
									      		<option value="0">
									      			Désactivé
									      		</option>
									      </select>
								  		</div><br>
										<div class="input-group">
											<span class="input-group-addon">Formateur principale * :</span>
									      	<select class="form-control" name="master_trainer">
									      		<option value="0">Le selectionner dans la liste...</option>
									      		<option value="1">
									      			F1
									      		</option>
									      		<option value="0">
									      			F2
									      		</option>
									      </select>
										</div><br>											
									</div>
								</div>	
							</div>
						</div>
					</div>	
				</div>
				<div style="margin-bottom: 13px;" align="center">
					<button type="submit" class="btn btn-primary" style="width: 300px;">Suivant</button>
				</div>
			</div>
		</div>

	</form>
</div>

</body>
</html>