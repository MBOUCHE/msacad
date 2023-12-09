
	<title>
		Correction du test de prérequis pour le formation <?php $i= 1; $j= 1; $point = 0; $M = 0;?>
	</title>
</head>
<body>
	<div class="col-md-10" style=" margin-left: -13px;">
	    <div class="panel panel-default">
	        <div class="panel-body">
	            <ul class="list-group" style="text-align: center;width:1064px;">
	              	<li class="list-group-item">
		              	<h3>CORRECTION DE <br> <?php echo mb_strtoupper('l\'épreuve de test pour la formation'); ?> : 
		              	<?php 
		              		$all_lesson = $this->db->select('*')->from('lesson')->where('id', $id)->get()->result_array();
		              		foreach ($all_lesson as $key) {
		              			if ($key['id'] =$id) {
		              				echo mb_strtoupper($key['label']).' ( '.$key['code'].' )';
		              			}
		              		}
		              	?></h3>
	              	</li>
	            </ul>
<?php 
	$query = $this->db->select('*')
						->from('e_exercise', 'e_test', 'e_question', 'e_answer')
						->join('e_build','e_build.id_ex = e_exercise.id_exercise')
						->join('e_test','e_test.id_test = e_build.id_test')
						->where('e_exercise.id_lesson='.$id)
						->order_by('e_exercise.id_lesson', 'RANDOM')
						->get()->result_array();
	foreach ($query as $key2) {
		 $name = $this->db->select('lastname')->from('user')->where('id', $key2['id_user'])->get()->result_array();
		$all_qsts = $this->db->select('*')->from('e_question')->where('id_exercise', $key2['id_exercise'])->order_by('answer', 'RANDOM')->get()->result_array();
	}
?>
	            <form action='<?php echo base_url().'e_controllers/c_home_page/correctionTest/'.$id ;?>' method="post">
	              	<div class="row">
	              	<?php
		 				foreach ($query as $key2) {
		 					$name = $this->db->select('lastname')->from('user')->where('id', $key2['id_user'])->get()->result_array();
		 					foreach ($name as $key808) {
		 						$name_trainer = $key808['lastname'];
		 					}
		 					$all_qsts = $this->db->select('*')->from('e_question')->where('id_exercise', $key2['id_exercise'])->order_by('answer', 'RANDOM')->get()->result_array();
			 					echo '<div class="panel panel-info" style="margin-left:17px;width:1064px;">
  										<div class="panel-heading"> Exercice : '.($j++).'-'.$key2['ex_label'].'<label style="margin-left: 89px;">proposé par Mr : '.$name_trainer.'</label><label style="float: right;color: red;">- '.$key2['point_if_felt'].'pour chaque réponse fausse.</label></div>
										  <div class="panel-body">';
							$all_aswrs = array();
							foreach ($all_qsts as $key301) {
								$all_aswrs[$M++] = $this->db->select('*')->from('e_answer')->where('id_qst', $key301['id_question'])->order_by('answer', 'RANDOM')->get()->result_array();
							}
			 				foreach ($all_qsts as $key5) {
								$ar =  $this->CaseLearners->listIsAswrs($key5['id_question']);
			                	$k = 0;
			                    echo '<div class="col-md-4">';
			                    if ($k < 3) {
			                        echo '<div class="panel panel-success" style="border-radius:0px;margin-left: -13px; width: 323px;">
			                                <div class="panel-heading"> Question n° '.($i++).'/<label style="float: right;"> ['.$key5['point'].'] point(s)</label><br>'.$key5['question'].'</div>
			                                <ul class="list-group">';
			                                foreach ($ar as $ulrich) {
			                                	if ($ulrich['proposition'] == $key5['answer']) {
			                                		echo'
				                                  	<li class="list-group-item" style="background-color: lightblue;">
				                                  		<label >'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
			                                	}
			                                	else{
			                                		echo'
				                                  	<li class="list-group-item">
				                                  		<label>'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
			                                	}
				                            }
			                        echo    '</ul>
			                            </div>';
			                        $k++;       
			                    }
			                    else{
			                        echo '<div class="panel panel-success" style="border-radius:0px;margin-left: -13px; width: 323px;">
			                                <div class="panel-heading"> Question n° '.($i++).'/<label style="float: right;"> ['.$key5['point'].'] point(s)</label><br>'.$key5['question'].'</div>
			                                <ul class="list-group">';
			                                foreach ($ar as $ulrich) {
			                                	if ($ulrich['proposition'] == $key5['answer']) {
			                                		echo'
				                                  	<li class="list-group-item">
				                                  		<label style="background-color: #4a8af4;">'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
			                                	}
			                                	else{
			                                		echo'
				                                  	<li class="list-group-item">
				                                  		<label>'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
			                                	}
				                            }
			                        echo    '</ul>
			                            </div>';
			                      $k=0;
			                    }
			                    echo '</div>';
			                    $point += $key5['point'];
			 				}
			 				echo '</div>
							</div>';
	                	}
	              	?>
	              	</div>  
	            </form>
	        </div>
	    </div>
	</div>
</body>
</html>