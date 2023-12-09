<div class="panel panel-default">
  	<div class="panel-body">
		<div class="row">
		    <div class="h4 text-center  col-sm-11" style="color: orange; float: right;">
		        ENVOYER VOTRE DOCUMENT
		        <hr width="60%" style="margin: auto; margin-top: 10px">
		    </div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					
				</div>

				<div class="col-md-6">
			      	<form action = "do_upload" method = "post" enctype="multipart/form-data">
						<div class="input-group">
						  	<span class="input-group-addon" id="sizing-addon2" style="width: 86px;">Titre * : </span>
						    <input type="text" name="new_name" class="form-control"  placeholder="Saisissez le titre ou le thème de votre document " required >
						</div><hr>
						<input type="file" class="btn btn-default" name="report_file">

						<ul  style="background-color: green;">
						<?php
						foreach ($lesson_user as $key) {
							foreach ($list_training as $key1) {
								if ($key['id_lesson'] == $key1['id']) {

									echo '<br>
									<li style=" background-color: lightblue; width: 494px;">
										<input type="submit" name="code_training" value="'.$key1['code'].'" class="btn" ><label style="color: blue;"> '.$key1['label'].'</label>
									</li>';
								}
							}
						}
						?>
						</ul>
			      	</form>
				</div>	
			</div>
		</div>
  	</div>
</div>

