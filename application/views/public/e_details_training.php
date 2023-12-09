<div class="row">
	<div class="panel panel-default">
      <div class="col-sm-12">
          <h1 class="page-title mb-3">DEMANDE D'UNE FORMATION EN LIGNE EN</h1>
          <hr width="">
      </div>
	   	<?php 
	   	foreach ($choice as $key) {
   			if ($key['id'] == $id) {
	   			echo $key['label'] ;
	   	 ?>
	   	
	   </h4>
		<div class="panel-body">
		    <div class="col-md-6">
		    	<div class="input-group col-md-6">
					<li class="list-group-item">Type : <?php echo $key['type'];?></li>
					<li class="list-group-item">Code : <?php echo $key['code'];?></li>
					<li class="list-group-item">Heures : <?php echo $key['duration'];?></li>
					<li class="list-group-item">Frais : <?php echo $key['fees'];?></li>
					<li class="list-group-item">Produit : <?php
					if ($key['type'] = 'cours') {
					 	echo 'Attestation';
					 }else{ echo "Certification";}
					 ?></li>
				</ul>
		    	</div>
		    	<ul class="list-group">
		    </div>
		    <div class="input-group col-md-6">
		    	<ul class="list-group">
				  <li class="list-group-item">Résumé de la formation :<?php echo $key['syllabus'];
				?></li>
				  <li class="list-group-item">Prérequis :<?php echo $key['prerequisite'];
					} 
				}
				?></li>
				  <li class="list-group-item">Vestibulum at eros</li>
				</ul>
		    </div>
		</div>
	</div>
</div>