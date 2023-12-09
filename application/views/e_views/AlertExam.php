
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
  <script LANGUAGE="JavaScript" type="text/javascript" charset="utf-8" async defer> <!-- 
    function getTime() {

    programming_date = document.getElementById('programming_date').value;
    programming_date = document.getElementById('TimeNow').value;
    duration = document.getElementById('duration').value;

    variable = "Tue Aug 28 2018 16:30:00";

    now = new Date();
    y2k = new Date(programming_date);
    duree = new Date(duration);
    // duree = duree.getTime();
    // alert(duree);

    fin = new Date(programming_date);
    fin.setHours( fin.getHours() + duree.getHours() );
    fin.setMinutes( fin.getMinutes() + duree.getMinutes() );
    fin.setSeconds( fin.getSeconds() + duree.getSeconds() );
    
    // alert( fin.getMonth()+'_'+fin.getDate()+'_'+fin.getHours()+' heures_'+fin.getMinutes()+' minutes' );
    
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

        document.timeForm.input1.value = "Fin de l'examen dans " + daysRound + dy + hoursRound + hr + minutesRound + min + secondsRound + sec + "/" + "--- avant le " + fin;
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

<div class="content-wrapper py-3">

  <div class="container-fluid">

    <?php
    foreach ($test as $t) {
    
    $programming_date = $this->db->get_where('e_composition' , array('id_test'=>$t['id_test']) )->row()->programming_date;
    $programming_date = date_format(date_create($programming_date) , 'D M d Y H:i:s');
    $duration = date_format(date_create($t['duration']) , 'D M d Y H:i:s');
    }
    echo form_input('programming_date', $programming_date , 'id="programming_date" type="datetime" class="form-control" required' );
    echo form_input('TimeNow', moment()->format('Y-m-d H:i:s'), 'id="TimeNow" type="datetime" class="form-control" required' );
    echo form_input('duration', $duration , 'id="duration" type="datetime" class="form-control" required' );

    echo '<iframe class="hidden" onLoad="getTime();" src="" style="" ></iframe>';
    ?>

    <?php 
    
    ?>
    
    <form name="timeForm" style="te">
      <input type="text" name="input1" size=210  class="form-control input-lg alert alert-danger btn btn-danger">
    </form>

    <div id="progress_zone">
    <div class="progress">
      <div class="progress-bar" role="progressbar" id="progress" aria-valuenow="0" aria-valuemin="0"  >
        <span class="sr-only">60% Complete</span>
      </div>
    </div>
    </div>

    </div>

</div>



    <div class="row">
    	<div class="col-md-3"></div>
    	<div class="col-md-9" style="float: right;">
  	<?php
    	foreach ($test as $soul) {
    		echo '
    		<label class="btn" style="border-radius: 0px; background-color: orange">
    			<span class="btn btn-success" style="background-color: blue; color: white; border-radius: 0px; font-size: 17px">'.strtoupper($this->db->where('id_type_test', $soul['id_type_test'])->get('e_type_test')->row()->label_type).' DE '.strtoupper($this->db->where('id_user', $soul['id_user'])->get('lesson')->row()->label).' EN COURS <hr>
    			</span><br><br>
    			<span class="h4">
            		Proposé par M. '.($this->db->where('id', $soul['id_user'])->get('user')->row()->lastname).'
            	</span><hr>
    			<span class="h4">
                	<span class="h3">'.$soul['label_test'].'</span>
              	</span><hr>
              	<span class="h4">
            		Temps aloué : '.$soul['duration'].'
            	</span><hr>
            	<span class="h4">
            		Reste : '.$soul['duration'].'
            	</span><hr>
                <a href="'.base_url().'e_controllers/c_space_works/preparetionExamen/'.$soul['id_test'].'/'.$soul['label_test'].'/'.$soul['id_type_test'].'" class="btn btn-success" style="border-radius:0px;"">	
                	COMPOSER
        		</a>
    		</label>';
    	}
  	?>
	</div>
</div>
