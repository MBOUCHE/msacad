<?php
	echo '<div class="panel-footer" style="border-radius:0px;">
		      <a href="'.base_url().'e_controllers/c_space_works/seeSolution/'.$key['id_exercise'].'/'.$id_mod.'/'.$id_training.'/'.$id_chap.'/'.$key['point_if_felt'].'" style="border-radius:0px;">
		      	<button type="button" class="btn btn-info" style="border-radius:0px;">
		        	<span>Voir la correction</span>
		      	</button>
		      </a>
		      <a href="'.base_url().'e_controllers/c_space_works/work/'.$key['id_exercise'].'/'.$id_mod.'/'.$id_chap.'/'.$key['point_if_felt'].'/'.$id_training.'" style="float: right;">
		      	<button type="button" class="btn btn-success" style="border-radius:0px;">
		        	<span>Traiter</span>
		      	</button>
		      </a>'.
	    '</div>';
?>