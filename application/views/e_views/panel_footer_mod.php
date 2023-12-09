<?php
	echo '
	<div class="panel-footer">
	      <a href="'.base_url().'e_controllers/c_space_works/referenceCourses/'.$key['id_mod'].'/'.$key['label_mod'].'/'.$training.'/'.$id_training.'">
	      	<button type="button" class="btn btn-info" style="border-radius:0px;">
	        	<span><i class="glyphicon glyphicon-tags"></i><br> COMPLEMENTS</span>
	      	</button>';/*
	    echo'
	      </a>
	      <a href="'.base_url().'e_controllers/c_space_works/referenceCourses/'.$key['id_mod'].'/'.$key['label_mod'].'/'.$training.'/'.$id_training.'">
	      	<button type="button" class="btn btn-warning" style="border-radius:0px; margin-left: 89px">
	        	<span><i class="glyphicon glyphicon-facetime-video"></i><br> VIDEOS</span>
	      	</button>
	      </a>';*/
	    echo '
	      <a href="'.base_url().'e_controllers/c_space_works/readingCourses/'.$key['id_mod'].'/'.$key['label_mod'].'/'.$training.'/'.$id_training.'" style="float: right;">
	      	<button type="button" class="btn btn-success" style="border-radius:0px;">
	        	<span><i class="glyphicon glyphicon-leaf"></i><br> CHAPITRES</span>
	      	</button>
	      </a>'.
    '</div>';
?>