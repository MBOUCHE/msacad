<script type="text/javascript">
  function change(id){
        if (document.getElementById(id).className == 'form-inline hidden') {
          document.getElementById(id).className = 'form-inline';
        }else{
          document.getElementById(id).className = 'form-inline hidden';
        }
      }

</script>



<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo form_fieldset('List of tests');

        echo '<div class="form-inline form-group">Legend';
        echo '<button class="alert alert-warning">No progamed</button>';
        echo '<button class="alert alert-info">Progamed, no wet validate</button>';
        echo '<button class="alert alert-success">Programed, and already validate</button>';
        echo '</div>';
        
        if (isset($this->session->info)) { echo '<div class="alert alert-success">'.$this->session->info.'</div>'; }

        $option_wave = array('all'=>'All');
        $option_type_test = array('all'=>'All');

        foreach ($list_wave as $wave) {
          $option_wave[$wave->id_wave] = character_limiter($wave->code_wave , 10);
        }

        foreach ($list_type_test as $type_test) {
          $option_type_test[$type_test->id_type_test] = character_limiter($type_test->label_type , 10).' ('.$type_test->percentage.') %';
        }

        echo form_open('e_controllers/e_admin/test_manager/index' , 'class="form-inline form-group"');
        echo '<div class="form-group">';

        echo 'Select wave ';
        echo form_dropdown('id_wave' , $option_wave , set_value('id_wave' , 'all') , 'class="form-control" ' );
        echo 'Select test type ';
        echo form_dropdown('id_type_test' , $option_type_test , set_value('id_type_test' , 'all') , 'class="form-control" ' );
        echo form_submit('search_test','search for a test!!' , 'class="btn btn-default"');

        echo '</div>';
        echo form_close();

        if ( count($list_test) != 0 ) {

          foreach ($list_test as $test) {
            $state = $test['status'];
            if ($state == 1) {
              $alert = 'alert alert-info';
              $btn = 'btn btn-info';
            }elseif ($state == 0) {
              $alert = 'alert alert-warning';
              $btn = 'btn btn-warning';
            }else{
              $alert = 'alert alert-success';
              $btn = 'btn btn-success';
            }
            echo '<div class="'.$alert.'">';

            echo '<div class="row">';
            echo '<div class="col-lg-3">Label: <b>'.$test['label_test'].'</b></div>';
            echo '<div class="col-lg-2">Type:<b>'.$details[$test['id_test']]['label_type_test'].'</b></div>';
            echo '<div class="col-lg-3">Added by: <b>'.$details[$test['id_test']]['autor'].'</b></div>';
            echo '<div class="col-lg-4">Build the: <b>'.date($test['date']).'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">(<b>'.$details[$test['id_test']]['number_exercise'].'</b>)exercises</div>';
            echo '<div class="col-lg-4">(<b>'.$test['nb_point'].'</b>)points</div>';
            echo '<div class="col-lg-4">Duration: <b>'.$test['duration'].'(Hours)</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Default wave: <b>'.$details[$test['id_test']]['code_wave'].'</b></div>';
            echo '<div class="col-lg-4">formator of wave: <b>'.$details[$test['id_test']]['wave_formator'].'</b></div>';
            echo '<div class="col-lg-4">(<b>'.$details[$test['id_test']]['number_learners'].'</b>)learners</div>';
            echo '</div>';


            echo '<hr>';

            echo '<div class="row form-group">';
            if ($state == 0) {
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/program/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-clock-o fa-1x"></i> Program it</a><b></b></div>';
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/insert/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-edit fa-1x"></i> Modify this test</a><b></b></div>';
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/delete_test/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-remove fa-1x"></i> Delete test</a><b></b></div>';
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/view_content/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-eye fa-1x"></i> View content</a><b></b></div>';
            }elseif ($state == 1) {
              echo '<div class="col-lg-3">
              Composition date : <b>'.$this->db->get_where('e_composition' , array('id_test'=>$test['id_test']) )->row()->programming_date.'</b><br>';
              echo '<label class="'.$btn.' form-inline" id="change" onclick="change('.$test['id_test'].');" ><i class="fa fa-calendar fa-1x"></i> Change date</label>';
              echo '<div class="form-inline hidden" id="'.$test['id_test'].'">';

              echo form_open('e_controllers/e_admin/test_manager/change_test_date', ' class="form-inline" ' , array('id_test'=>$test['id_test']) );
              echo '<input name="programming_date" type="datetime" class="form-control" value="'.date('Y-m-d h:i:s').'" Required />';
              echo '<input name="change_date" type="submit" value="Apply" class="form-control" />';
              echo form_close();
              echo '</div>';
              echo '</div>';

              echo '<div class="col-lg-3">
              added the : <b>'.$this->db->get_where('e_composition' , array('id_test'=>$test['id_test']) )->row()->date.'</b></div>';

              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/cancel_test/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-chain-broken fa-1x"></i> Cancel this test</a><b></b></div>';
              
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/view_content/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-eye fa-1x"></i> View content</a><b></b></div>';
            }else{
              echo '<div class="col-lg-3">
              Composition date :<b>'.$this->db->get_where('e_composition' , array('id_test'=>$test['id_test']) )->row()->programming_date.'</b> </div>';
              echo '<div class="col-lg-3">
              Confirmed by <b>'.$this->db->get_where( 'user' , array('id'=> $this->db->get_where( 'e_composition' , array('id_test'=>$test['id_test'] ) )->row()->id_user) )->row()->firstname.'</b> <br>
              at <b>'.$this->db->get_where('e_composition' , array('id_test'=>$test['id_test']) )->row()->date.'</b> </div>';
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/re_use/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-clone fa-1x"></i> Re-use test</a><b></b></div>';
              echo '<div class="col-lg-3">
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/view_content/'.$test['id_test'].'" class="'.$btn.' form-control"><i class="fa fa-eye fa-1x"></i> View content</a><b></b></div>';
            }

            echo '</div>';

            if ($state == 1 And session_data('role')==ADMIN) {
              echo '<div class="row">';
              echo '<div class="col-lg-5" >
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/confirm_program/'.$test['id_test'].'" class="btn-success form-control" onclick="return confirm(\'Are you really want to confirm -'.$test['label_test'].'- Test?\') && confirm(\'This will archived all exercises associated...!!?\'); " ><b><i class="fa fa-check fa-1x"></i> Confim this test </b></a></div>';
              echo '<div class="col-lg-7" >This will notify all the wave students and formator<br>Will also return all exercise associated unwritable...</div>';
              echo '</div>';
            }

            echo '</div>';
          }

        }else{
          echo '<div class="alert alert-warning form-group">Empty list !!</div>';
        }
        
        echo form_fieldset_close();

        echo '<hr>';

        echo '<div class=""  >
              <a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/build_test" class="btn btn-info form-control">Go to build a test!!</a><b></b></div>';
        
        echo '<hr>';

        ?>

  </div>
      
</div>