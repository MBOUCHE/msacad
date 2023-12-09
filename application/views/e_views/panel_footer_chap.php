<?php
	echo 
	'<div class="panel-footer col-md-12">
		<div class="col-md-3">
        <a href="'.base_url().'e_controllers/c_space_works/doExercises/'.$key['id_chap'].'/'.$name_mod.'/'.$training.'/'.$key['title_chap'].'/'.$id_training.'/'.$id_mod.'">
	      	<button type="button" class="btn btn-info" style="border-radius:0px;">
	        	<span><i class="glyphicon glyphicon-edit"></i><br>Exercices</span>
	      	</button>
        </a></div>';
         echo '<div class="col-md-6"><br><label style="color: orange;">'.$key['duration_chap'].' Heures de cours</div>';

         echo '<div class="col-md-3">
	    <a href="'.base_url().'e_controllers/c_space_works/readChapter/'.$key['id_chap'].'/'.$name_mod.'/'.$training.'/'.$key['title_chap'].'/'.$id_training.'/'.$id_mod.'" style="float: right;">
	      	<button type="button" class="btn btn-success" style="border-radius:0px;">
	        	<span><i class="glyphicon glyphicon-sort-by-alphabet"></i><br> Lecture</span>
	      	</button>
	    </a></div>
    </div>';
?>