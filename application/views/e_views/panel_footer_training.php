<?php

	$review = base_url().'e_controllers/c_take_courses/reviewCourse/'.$key['id'].'/'.$key['label'];
	$goClass = base_url().'e_controllers/c_take_courses/beginClass/'.$key['label'].'/'.$key['id'];
	echo '
		<div class="panel-footer text-center">
			<div class="row">
				<div class="col-md-2">
		      		<a href="'.$review.'" style="float: left">
				      	<button type="button" class="btn btn-info" style="border-radius:0px;">
				      		<span>
					      		<i class="fa fa-2x fa-pencil-square-o"></i><br>
					        	<label style="color: white">COURS</label>
				        	</span>
				      	</button>
		     		</a>
		      	</div>
				<div class="col-md-8">
		      		<label style="font-size: 17px">Responsable : M. '.$teacher.'<br>('.$key['duration'].' Heures de cours)</label>
		      	</div>
				<div class="col-md-2">
		      		<a href="'.$goClass.'" style="float: right;">
		      			<button type="button" class="btn btn-warning" style="border-radius:0px;float: right;">
	                	<span>
		                	<i class="fa fa-2x fa-users"></i><br> 
		                	<label style="color: white">CLASSE</label>
	                	</span>
                		</button>
		      		</a>
		     	</div>
			</div>
	    </div>';
?>