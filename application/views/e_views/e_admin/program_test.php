<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo heading('Programmation of a test...' , 3);
        
        if (isset($this->session->info)) { echo '<div class="alert alert-success">'.$this->session->info.'</div>'; }


        $option_wave[''] = '';
        foreach ($list_wave as $wave) {
          $option_wave[$wave->id_wave] = character_limiter($wave->code_wave.'**('.$wave->number_learners.')' , 10);
        }
        
            $state = $test['status'];
            if ($state == 1) {
              $alert = 'alert alert-success';
            }elseif ($state == 0) {
              $alert = 'alert alert-info';
            }else{
              $alert = 'alert alert-warning';
            }
            echo '<div class="'.$alert.'">';

            echo '<div class="row">';
            echo '<div class="col-lg-3">Label: <b>'.$test['label_test'].'</b></div>';
            echo '<div class="col-lg-2">Type:<b>'.$details['label_type_test'].'</b></div>';
            echo '<div class="col-lg-3">Added by: <b>'.$details['autor'].'</b></div>';
            echo '<div class="col-lg-4">Added the: <b>'.date($test['date']).'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">(<b>'.$details['number_exercise'].'</b>)exercises</div>';
            echo '<div class="col-lg-4">(<b>'.$test['nb_point'].'</b>)points</div>';
            echo '<div class="col-lg-4">Duration: <b>'.$test['duration'].'(Hours)</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Default wave: <b>'.$details['code_wave'].'</b></div>';
            echo '<div class="col-lg-4">formator of wave: <b>'.$details['wave_formator'].'</b></div>';
            echo '<div class="col-lg-4">(<b>'.$details['number_learners'].'</b>)learners</div>';
            echo '</div>';


            echo '<hr>';

            echo '<div class="row">';
              echo 'put some link here';
            echo '</div>';

            echo '</div>';


        echo '<hr>';

        echo form_open('e_controllers/e_admin/test_manager/program/'.$test['id_test'] , 'onBlur="choose()" ' , array('id_user'=>session_data('id') , 'id_test'=>$test['id_test'] ) );

        if($details['wave_status'] == '1' ){
          echo '<div class="alert alert-info">This test is Assigned to the default wave indicated...</div>';
          echo form_label('Left me choose wave again' , 'choose');
          echo form_checkbox(array('name'=>'choose', 'id'=>'choose' , 'onClick'=>"choose()" ) );
        }elseif ($details['wave_status'] == '-1') {
          echo '<div class="alert alert-warning" >The default wave indicated are desactived... Choose another wave</div>';
        }
        echo '<div class="form-inline form-group" id="wave">';
        echo 'Select wave (Depend of the lesson of the test...): ';
        echo form_dropdown('id_wave' , $option_wave , set_value('id_wave' , '') , 'class="form-control" Required' );
        echo '</div>';

        echo '<div class="form-inline form-group">';
        echo 'Date and time: ';
        echo '<input name="programming_date" type="datetime" class="form-control" value="'.date('Y-m-d h:i:s').'" min="'.date('Y-m-d h:i:s').'" Required />';
        echo '</div>';



        echo form_submit('program' , 'Progam this test', 'class="form-control btn btn-primary" ');

        echo form_close();

        echo '<hr>';

        echo '<div class=""  >
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/build_test" class="btn btn-info form-control">Go to build a test!!</a><b></b></div>';
        
        echo '<hr>';

        ?>

    </div>

      
</div>