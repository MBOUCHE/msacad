
    <div class="container-fluid" style="width: 81%; float: right;">
        <div class="row">
          	<div class="h4 text-center  col-sm-10" style="color: #f98d0b">

          	<?php 
				$themeDisp = array();
				$i = 0;
				foreach ($lesson_user as $key) {
					$themeDisp[$i++] = $this->M_list_training->AvailibityTheme($key['id_lesson']);
				}

	            if (sizeof($lesson_user)==1) {
	              	$title = '<class="page-title mb-3">THEME DISPONIBLE</h1>';
	            }
	            else{
	            	$title = '<class="page-title mb-3">THEMES DISPONIBLES</h1>';	
	            }
	               echo $title ; ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
<span style="background-color: red;"><?php echo $msg;?></span>

  	<div class="row">
	<?php

		$i = 1;
		$trainer = array();
		$id_user = session_data('id');
		echo '<table class="table table-bordered table-striped tablecondensed h5" style=" float: left;">';
		echo '  <th>#</th>
				<th>Titre</th>
				<th>Formation</th>
				<th>Proposé par</th>
				<th>Date de validation</th>
				<th>Action</th>
				<th>Désision</th>
			  ';
	  	foreach ($themeDisp as $key1) {
	  		foreach ($key1 as $key) {
		      	if ($key['status'] == 1) {
		      		$trainer = $this->db->select('*')->from('user')->where('id', $key['id_user'])->get()->result_array();
		      		foreach ($trainer as $key2) {
		      			$label_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
		      			foreach ($label_lesson as $key4) {
		      				$label = $key4['code'];
		      			}
			      		echo '
			      		<tr>
		      				<td>'.($i++).'</td>
		      				<td>'.$key['ex_label'].'</td>
		      				<td>'.$label.'</td>
		      				<td> Mr '.$key2['lastname'].'</td>
		      				<td>'.$key['date_modify'].'</td>
		      				<td><a href="'.base_url().'e_controllers/c_space_works/seeDetails/'.$key['id_exercise'].'/'.$key2['lastname'].'/'.$key['ex_label'].'/'.$key['id_lesson'].'" style="text-decoration: none; width:50px" class="glyphicon glyphicon-info-sign">Détails</a><br>
		      					<a href="'.base_url().'e_controllers/c_space_works/selectTheme/'.$key['id_exercise'].'/'.$key['id_lesson'].'/'.$id_user.'" style="text-decoration: none; width:50px; color: blue" class="glyphicon glyphicon-import">Demander</a>
		      				</td>
		      			</tr>';
		      		}
		      	}
		      	if ($key['status'] == -1) {
		      		$trainer = $this->db->select('*')->from('user')->where('id', $key['id_user'])->get()->result_array();
		      		foreach ($trainer as $key2) {
		      			$label_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
		      			foreach ($label_lesson as $key4) {
		      				$label = $key4['code'];
		      			}
	  			//foreach ($key2 as $key3) {
		      		echo '
		      			<tr>
		      				<td>'.($i++).'</td>
		      				<td>'.$key['ex_label'].'</td>
		      				<td>'.$label.'</td>
		      				<td> Mr '.$key2['lastname'].'</td>
		      				<td>'.$key['date_modify'].'</td>
		      				
		      				<td><a href="'.base_url().'e_controllers/c_space_works/lepTheme/'.$key['id_exercise'].'" style="text-decoration: none; width:89px" class="glyphicon glyphicon-remove-sign">Annuller </a></td>
		      				<td><label style="color: gray;">(En attente)</label></td>
		      			</tr>';
	      			//}
		      		}
		      	}
		      	if ($key['status'] == 0) {
		      		$trainer = $this->db->select('*')->from('user')->where('id', $key['id_user'])->get()->result_array();
		      		foreach ($trainer as $key2) {
		      			$label_lesson = $this->db->select('*')->from('lesson')->where('id', $key['id_lesson'])->get()->result_array();
		      			foreach ($label_lesson as $key4) {
		      				$label = $key4['code'];
		      			}
			      		echo '
		      			<tr  class="success">
		      				<td>'.($i++).'</td>
		      				<td>'.$key['ex_label'].'</td>
		      				<td>'.$label.'</td>
		      				<td> Mr '.$key2['lastname'].'</td>
		      				<td>'.$key['date_modify'].'</td>
		      				<td><a href="'.base_url().'e_controllers/c_space_works/seeDetails/'.$key['id_exercise'].'/'.$key2['lastname'].'/'.$key['ex_label'].'/'.$key['id_lesson'].'" style="text-decoration: none; width:50px" class="glyphicon glyphicon-question-sign">Consigne</a>
		      				</td>
		      				<td><label style="color: green;" class="glyphicon glyphicon-ok-sign">Approuvée</label></td>
		      			</tr>';
				      	$details = array();
				      	$details = $this->CaseLearners->detailTheme($key['id_exercise']);
		      			}
		      		}
	  			}
	    	}
	    	echo '</table>';
		?> 
	  	</div>
	</div>

	<div class="panel panel-primary" style="text-align: center; margin-top: 100px; width: 81%; float: right;">
	  	<div class="panel-body">
			<label class="h5" style="color: green;"><strong>NB : </strong> Un thème approuvé par l'administration et attribué par un formateur ne peut plus être annullé par l'apprenant qui en a fait la demande.<br> <span style="color: brown;">Faite un bon choix</span> </label>
	  	</div>
	</div>

</div>
</body>
</html>