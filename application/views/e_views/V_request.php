<div class="panel panel-default">
  	<div class="panel-body">
		<div class="row">
		    <div class="h4 text-center  col-sm-12">
		        Envoyer votre requete
		        <a style="float: right; border-radius:0px;" href="<?php echo base_url().'e_controllers/c_take_courses/listRequest'; ?>"  class="btn btn-info" title="Voir la liste de vos requêtes"> (Liste de vos requêtes) </a>
		        <hr width="60%" style="margin: auto; margin-top: 10px">
		    </div>
		</div>
		<div class="container">

		  	<form action = "sendRequest" method = "post">
		  		<div class="row">
		  			<div class="col-md-2"></div>
				    <div class="col-md-8">
						<div class="input-group">
						  <span class="input-group-addon" id="sizing-addon2">Objet * :</span>
						  <input type="text" name="object" class="form-control" placeholder="Bref libelé de votre demande" aria-describedby="sizing-addon2" required>
						</div><br>
						<div class="input-group">
						  <span class="input-group-addon" id="sizing-addon2">Motifs * : 
						  </span>
						  <textarea name="justification" class="form-control" id="justification" style="height: 260px;" placeholder="Saisissez le motif de votre demande" aria-describedby="sizing-addon2" required>
						  </textarea>
						</div>
					</div>
					<div class="col-md-2">
						<ul style="background-color: green;margin-top:17px; width: 256px;">
				<?php
					foreach ($lesson_user as $key) {
						foreach ($list_training as $key1) {
							if ($key['id_lesson'] == $key1['id']) {
								echo '<br>
								<label style="width: 100px;">
									<img src="'.base_url().'assets/img/logo/logo-sm.png'.'" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 44px; height: 35px; margin-left: -35px;">
									<li style="text-align: center; background-color: lightblue; width: 206px; margin-left: -17px;">
										<h4><input required type="radio" name="id_training" value="'.$key1['id'].'">'.$key1['label'].'</h4>
									</li>
								</label>';
							}
						}
					}
				?>
						</ul >
						<input type="submit" value="Envoyer" name="code_training" class="btn" style="color: red; background-color: lightblue; float: right; border-radius: 0;" title="Choisir la formation avant de soumettre">	
					</div>
				</div>
			</form>
		</div>
  	</div>
</div>
