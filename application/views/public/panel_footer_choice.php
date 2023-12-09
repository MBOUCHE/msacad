<?php
	$path_details = base_url().'e_controllers/c_confirm_valid_registration/details/'.$key['id'] ;
	echo '<div class="panel-footer">
		      <a href="'.$path_details.'" style="text-decoration: none;">
		      	<button type="button" class="btn btn-warning" style="border-radius:0px;">
		        	<span>Détails</span>
		      	</button>
		      </a>
		      <a href="'.'testTraining/'.$key['id'].'" style="text-decoration: none;">
		      	<button type="button" class="btn btn-info" style="border-radius:0px;">
		        	<span>TEST</span>
		      	</button>
		      </a>
		      <a href="'.'choiceTraining/'.$key['id'].'" style="text-decoration: none;float: right">
		      	<button type="button" class="btn btn-success" style="border-radius:0px;">
		        	<span>S\'inscrire</span>
		      	</button>
		      </a>
	    </div>';
?>