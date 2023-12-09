
<div class="panel panel-default">
  	<div class="panel-body">
		<div class="row">
		    <div class="text-center  col-sm-12">
		        <label class="h3">Vos impressions par rapport à une formation</label> 
		        <hr width="60%" style="margin: auto; margin-top: 10px">
		    </div>
		</div>
		<div class="container">

		  	<form action = "sendApp" method = "post">
		  		<div class="row">
		  			<div class="col-md-2"></div>
				    <div class="col-md-8">
						<div class="input-group">
							<select class="h4" name="id_lesson" style="text-align: center; background-color: #56c66f; width: 76%; height: 31px;">
								<option value="<?php echo 0;?>"></option>
		<?php
			foreach ($lesson_user as $key) {
				foreach ($list_training as $key1) {
					if ($key['id_lesson'] == $key1['id']) {
						echo '

							<option class="h4" value="'.$key1['id'].'" class="form-control" ><br>
								<label style="margin-top:22px;">
									<h3>'.strtoupper($key1['label']).' ('.$key1['code'].')'.'</h3>
								</label>
							</option>';
					}
				}
			}
?>						</select>
					</div><br>
					<div class="input-group">
					  <textarea name="appreciation" class="form-control" id="justification" style="height: 260px;" aria-describedby="sizing-addon2" required>
					  </textarea>
					</div><br>
					<button type="submit" class="btn btn-success" name="send" style="float: right;width: 170px;border-radius: 0px;">Envoyer</button>
				</div>

		      	<img src="<?php echo base_url().'assets/img/logo/logo-sm.png' ?>" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 103px; height: 103px;margin-left: 4px; margin-top: 98px">
		      	<label>  MULTISOFT ACADEMY </label>
				</div>
			</form>
		</div>
  	</div>
</div>

