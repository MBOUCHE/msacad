
	<title>Test de prérequis pour le formation <?php $i= 1; $j= 1; $point = 0; $M = 0;?></title>
</head>
	<body>
<div class="panel panel-default" style="background-color: #fbffbd">
  <div class="panel-body">
<div class="col-md-10" style="background-color: #fbffbd; margin-left: -26px;">
	        <div class="panel panel-default">
	          <div class="panel-body">
	            <ul class="list-group" style="text-align: center;width:1030px;">
	              <li class="list-group-item">
	              	<h3> 
	              		<?php
	              			$label_type = $this->db->where('id_type_test', $id_type_test)->get('e_type_test')->row()->label_type;
	              			echo $label_type; 
	              		?> : 
	              	<?php 
	              		$all_lesson = $this->db->select('*')->from('lesson')->where('id', $id)->get()->result_array();
	              		foreach ($all_lesson as $key) {
	              			if ($key['id'] =$id) {
	              				echo $key['label'].' ( '.$key['code'].' )';
	              			}
	              		}
	              	?></h3>


<div class="container-fluid" style="">

    <?php
    foreach ($query as $nass) {
    $programming_date = $this->db->get_where('e_composition' , array('id_test'=>$nass['id_test']) )->row()->programming_date;
    $programming_date = date_format(date_create($programming_date) , 'D M d Y H:i:s');
    $duration = date_format(date_create($nass['duration']) , 'D M d Y H:i:s');
    }
    echo form_input('programming_date', $programming_date , 'id="programming_date" type="datetime" class="form-control hidden" required');
    echo form_input('duration', $duration , 'id="duration" type="datetime" class="form-control hidden"  required' );
    ?>
    
    <form name="timeForm">
      <input type="text" name="input1" size=210  class="form-control input-lg alert alert-danger btn btn-danger">
    </form>

    <div id="progress_zone">
    <div class="progress">
      <iframe class="hidden" onLoad="getTime();" src="" style="height: 0px;width: 0px" ></iframe>
      <div class="progress-bar" role="progressbar" id="progress" aria-valuenow="0" aria-valuemin="0"  >
      </div>
    </div>
    </div>
</div>



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
	if (isset($query)) {
		foreach ($query as $key2) {
			if ($query!=null) {
			 	$name = $this->db->select('lastname')->from('user')->where('id', $key2['id_user'])->get()->result_array();
				$all_qsts = $this->db->select('*')->from('e_question')->where('id_exercise', $key2['id_exercise'])->order_by('answer', 'RANDOM')->get()->result_array();
			}
		}
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
			 					echo '<div class="panel panel-info" style="margin-left:17px;width:1030px;">
  										<div class="panel-heading"> Exercice : '.($j++).'-'.$key2['ex_label'].'<label style="margin-left: 89px;">proposé par Mr : '.$name_trainer.'</label><label style="float: right;color: red;">- '.$key2['point_if_felt'].'pour chaque réponse fausse.</label></div>
										  <div class="panel-body" style="background: #fedb95;">';
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
			                                	echo'
				                                  	<li class="list-group-item">
				                                  		<label>
				                                  			<input type="radio" name="proposition'.$key5['answer'].'" value="'.$ulrich['proposition'].'" required>'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
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
			                                	echo'
				                                  	<li class="list-group-item">
				                                  		<label>
				                                  			<input type="radio" name="proposition'.$key5['answer'].'" value="'.$ulrich['proposition'].'" required>'.$ulrich['proposition'].'
				                                  		</label>
				                                  	</li>';
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
			        <div class="row">
						<div class="input-group col-md-9">
						  <span class="input-group-addon" id="sizing-addon2" style="width: 153px;">Votre avis sur ce test : ?</span>
						  	<input type="text" class="form-control" name="note" placeholder="Bien vouloir entrer une remarque faite par rapport à ce test." aria-describedby="sizing-addon1">
						</div>
						<div class="col-md-3" style="margin-left: -400px">
				          	<button class="btn btn-success" style="width: 202px; margin-left: 404px;" type="submit">Soumettre vos réponses
				          	</button>
						</div>
			        </div>  
	            </form>
	        </div>
	    </div>
	    </div>
	      	<div class="col-md-2" style="background-color: #fbffbd;">
				<div class="panel panel-default" style="margin-left: -22px; width: 260px;">
					<div class="panel-heading"><?php  echo '['.$key2['id_type_test'].'] '.$key2['label_test']; ?> de : 
					<?php 
						$code_lesson = $this->db->select('code')->where('id', $id)->get('lesson')->result_array(); foreach ($code_lesson as $key404) {
							echo $key404['code'];;
						}
					?>		
					</div>
			  		<div class="panel-body" style="background-color: #fedb95;">
				    	<li class="list-group-item">
				    		Total de points de l'épreuve : <?php echo $point; ?> points
				    	</li><br>
				    	<li class="list-group-item">
				    		Date de constitution : <?php  echo $key2['last_modify']; ?>
				    	</li><br>
				    	<li class="list-group-item">
				    		Temps alloué : <?php echo $key2['duration']; ?> minutes
				    	</li>
			  		</div>
			  		<div class="panel-footer">Constituée par : <br>Mr
			  		<?php 
			  			$all_in_test = $this->db->where('id_test', $key2['id_test'])->get('e_test')->result_array();
			  			foreach ($all_in_test as $key202) {
			  				$name_trainer_construct = $this->db->where('id', $key202['id_user'])->get('user')->result_array();
			  				foreach ($name_trainer_construct as $key44) {
			  					$is_name = $key44['lastname'].' '.$key44['firstname'].'<br>Mail :'.$key44['mail'].'<br>Téléphone : '.$key44['phone'];
			  				}
			  			}
			  			echo $is_name ;
			  		?> 
					</div>
				</div>
			</div>
  		</div>
	</div>
</body>


  <script LANGUAGE="JavaScript" type="text/javascript" charset="utf-8" async defer> <!-- 
    function getTime() {

    programming_date = document.getElementById('programming_date').value;
    duration = document.getElementById('duration').value;

    now = new Date();
    y2k = new Date(programming_date);
    duree = new Date(duration);

    fin = new Date(programming_date);
    fin.setHours( fin.getHours() + duree.getHours() );
    fin.setMinutes( fin.getMinutes() + duree.getMinutes() );
    fin.setSeconds( fin.getSeconds() + duree.getSeconds() );

    
    //ICI LA DATE CIBLE 
    days = (y2k - now) / 1000 / 60 / 60 / 24;
    daysRound = Math.floor(days);

    hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
    hoursRound = Math.floor(hours);

    minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
    minutesRound = Math.floor(minutes);

    seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
    secondsRound = Math.round(seconds);

    sec = (secondsRound == 1) ? " seconde" : " secondes ";
    min = (minutesRound == 1) ? " minute" : " minutes, ";
    hr = (hoursRound == 1) ? " heure" : " heures, ";
    dy = (daysRound == 1) ? " jour" : " jours, ";

    document.timeForm.input1.value = "Encore " + daysRound + dy + hoursRound + hr + minutesRound + min + secondsRound + sec + ((y2k - now) ) + "--- avant le " + programming_date;

    if ( (y2k - now) < 0 ) {

      if ( (now - y2k) > 0 && (now - fin) < 0 ) {
        document.getElementById('progress').style.width =  (  (now - y2k) *100/(fin - y2k) ) + "%";
        document.getElementById('progress').setAttribute('aria-valuemax' , (fin - y2k)/1000 ) ;

        days = (fin - now) / 1000 / 60 / 60 / 24;
        daysRound = Math.floor(days);
        hours = (fin - now) / 1000 / 60 / 60 - (24 * daysRound);
        hoursRound = Math.floor(hours);
        minutes = (fin - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
        minutesRound = Math.floor(minutes);
        seconds = (fin - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
        secondsRound = Math.round(seconds);

        if (minutesRound < 5 ) {
          var intervalID = setInterval( function() {
            if (secondsRound%2 == 0) {
              document.timeForm.input1.style.backgroundColor = 'yellow';
            }else{
              document.timeForm.input1.style.backgroundColor = 'orange';
            }
          
          } , 1000) ;
        }
        if (hoursRound!=0) {
        document.timeForm.input1.value = "Fin dans "+hoursRound+hr+minutesRound+min+secondsRound+sec;
    	}else{
    		document.timeForm.input1.value = "Fin dans "+minutesRound+min+secondsRound+sec;
    	}
      }else{
        document.timeForm.input1.value = "EXAMAN TERMINER !!!" ;

        // Ulriche Mon envoi

      }
    newtime = window.setTimeout("getTime();", 1000);

      document.getElementById('formuser').submit();
    }
      // document.getElementById('test1').className = "hidden";

    newtime = window.setTimeout("getTime();", 1000);
    } // -->    
  </script>

</html>