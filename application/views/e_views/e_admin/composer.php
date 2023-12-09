
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
  <script LANGUAGE="JavaScript" type="text/javascript" charset="utf-8" async defer> <!-- 
    function getTime() {

    programming_date = document.getElementById('programming_date').value;
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

    $programming_date = $this->db->get_where('e_composition' , array('id_test'=>$test['id_test']) )->row()->programming_date;
    $programming_date = date_format(date_create($programming_date) , 'D M d Y H:i:s');
    $duration = date_format(date_create($test['duration']) , 'D M d Y H:i:s');
    echo form_input('programming_date', $programming_date , 'id="programming_date" type="datetime" class="form-control" required' );
    echo form_input('duration', $duration , 'id="duration" type="datetime" class="form-control" required' );

    echo '<iframe class="hidden" onLoad="getTime();" src="" style="" ></iframe>';
    ?>

    <?php 
    
    ?>
    
    <form name="timeForm" style="te">
      <input type="text" name="input1" size=210  class="form-control input-lg alert alert-danger btn btn-danger" >
    </form>

    <div id="progress_zone">
    <div class="progress">
      <div class="progress-bar" role="progressbar" id="progress" aria-valuenow="0" aria-valuemin="0"  >
        <span class="sr-only">60% Complete</span>
      </div>
    </div>
    </div>

        <?php

          echo heading( $test['label_test'], 2);
          echo '<div class="row" >';
                  echo '<div class="col-lg-4" >Exercise Name :<em>"'.$test['nb_point'].'"</em></div>';
                  echo '<div class="col-lg-4" > Exercise points :<em> </em></div>';
                  echo '<div class="col-lg-4" > Points if Failt :<em> </em></div>';
          echo '</div>';

          echo heading('Exercice Manager', 2);

          if(isset($_SESSION['delete_exercise_info'])){
            echo '<div> '.$_SESSION['delete_exercise_info'].'</div>';
          }

          if(isset($_SESSION['info'])){
            echo '<div class="alert" > '.$_SESSION['info'].'</div>';
          }


          echo heading('List of exercise', 4);

          if(count($list_exercise) != 0)
          {


          foreach ($list_exercise as $exercise)
          {
            $details = $this->exercise->get_exercise_details($exercise->id_exercise);

        ?>

        <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                <?php
                  echo '<div class="col-lg-4" >Exercise Name :<em>"'.$exercise->ex_label.'"</em></div>';
                  echo '<div class="col-lg-4" > Exercise points :<em> '.$exercise->ex_point.'"</em></div>';
                  echo '<div class="col-lg-4" > Points if Failt :<em> -'.$exercise->point_if_felt.'"</em></div>';
                ?> 
                </div>              
              </div>
              <div class="panel-body">
                <?php

                $list_question = $this->question->get_exercise_question($exercise->id_exercise);
                $numero = 0;

                if ($exercise->ex_type == 'QRU') {
                echo "string";
                  
                  foreach ( $list_question as $question ) {
                    $numero++;
                ?>
                  <div class="form-group row">
                    <label class="btn btn-default">
                      <?php echo '-'.$numero.'- '.$question->question ?>
                    </label>
                  </div>

                  

                  <div class="row">

                    <div class="col-lg-3">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio" name="<?=$question->id_question?>" id="<?=$question->id_question?>"  aria-label="...">
                        </span>
                        <span class="input-group-btn">                          
                          <label class="btn" for=<?=$question->id_question?> > <?php echo $question->answer; ?> </label>
                        </span>
                      </div>
                    </div>

                    <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="radio" name=<?=$question->id_question?> id=<?=$question->id_question?> aria-label="...">
                      </span>
                      <label class="input-group-btn btn" for=<?=$question->id_question?>> <?php echo $question->prop1; ?> </label>
                    </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="radio" name=<?=$question->id_question?> id=<?=$question->id_question?> aria-label="...">
                      </span>
                      <label for=<?=$question->id_question?>> <?php echo $question->prop2; ?> </label>
                    </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="radio" name=<?=$question->id_question?> id=<?=$question->id_question?> aria-label="...">
                      </span>
                      <label for=<?=$question->id_question?>> <?php echo $question->prop3; ?> </label>
                    </div>
                    </div>
                  </div>

                <?php
                  }
                }elseif ($exercise->ex_type == 'QRO') {

                  foreach ( $list_question as $question ) {
                    $numero++;

                ?>
                  <div class="form-group row">
                    <label class="btn btn-default">
                      <?php echo '-'.$numero.'- '.$question->question ?>
                    </label>
                  </div>

                  <div class="">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon3">
                        Votre reponse
                      </span>
                      <input  type="text" name=<?=$question->id_question?> id=<?=$question->id_question?> placeholder="..." class="form-control" aria-describedby="basic-addon3">
                    </div>
                  </div>
                <?php
                  }
                }

                ?>
                  
              </div>
              <div class="panel-footer">
                <?php
                
                ?>
              </div>
            </div>
            
        <?php
          }

          }else{
            echo '<div class="alert alert-warning form-group">Empty list !!</div>';
          }

          echo heading('Create an Exercise',4);
          echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/add/" class="form-group form-control btn btn-warning" ><span class="glyphicon glyphicon-plus"></span> Add exercise</a>';

        ?>
    </div>

</div>

<?php 
echo '<pre>';
// set_flash_data('Some error are occured...!!');
// $this->session->set_flashdata('test' , 'Some error are occured...!!');
// $_SESSION['test'] = 'ceci est un test';
echo print_r($_SESSION);
echo '</pre>';
 ?>
