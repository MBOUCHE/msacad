<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
          echo heading('Build a Test', 2);

          if(isset($_SESSION['delete_exercise_info'])){
            echo '<div> '.$_SESSION['delete_exercise_info'].'</div>';
          }

          if(isset($_SESSION['info'])){
            echo '<div class="alert" > '.$_SESSION['info'].'</div>';
          }


          echo heading('Select an exercise in the list...', 4);

          $option = array('all'=>'All' , null=>'Anonymous');
          foreach ($list_lesson as $lesson) {
            $number_wave = count($this->db->get_where('e_wave',array('status'=>'1' , 'id_lesson'=>$lesson['id']) )->result() );
            $option[$lesson['id']] = character_limiter(character_limiter($lesson['label'] , 10).'**('.$number_wave.')waves', 15);
          }

          echo form_open('e_controllers/e_admin/test_manager/build_test' , 'class="form-inline form-group"');
          echo '<div class="form-group">';

          echo 'Select lesson ';
          echo form_dropdown('id_lesson' , $option , set_value('id_lesson','all') , 'class="form-control"' );

          echo form_submit('search_exercise','search exercises!!' , 'class="btn btn-default"');

          echo '</div>';
          echo form_close();

          echo '<hr>';

          if ( ! empty( $exercise ) ){

          foreach ($list_type_test as $type_test) {
            $option_type_test[$type_test->id_type_test] = character_limiter($type_test->label_type , 10).' ('.$type_test->percentage.') %';
          }

          $option_wave = array();
          foreach ($list_wave as $wave) {
            $option_wave[$wave->id_wave] = character_limiter('code-'.$wave->code_wave.'**('.$wave->number_learners.')learners' , 20);
          }

          echo form_open('e_controllers/e_admin/test_manager/build_test' , 'class="" ');

          echo '<b>You must select wave (depend of lesson) </b>';
          echo form_dropdown('id_wave' , $option_wave , set_value('id_wave') , 'class="form-control form-group" Required' );

          echo '<div class="form-inline">';
          echo form_input('label_test', set_value('label_test' , 'Label test') , 'class="form-control" Required');

          echo ' Test type :';
          echo form_dropdown('id_type_test' , $option_type_test , set_value('id_type_test' , 3) , 'class="form-control" Required' );
          echo ' Duration :';
          echo '<input type="time" value='.date('h:i').' class="form-control alert-success" name="duration" Required >';
          echo '</div>';

          echo '<hr>';
          
          if(isset($_SESSION['build_test_info'])){
            echo ($_SESSION['build_test_info']);
          }

          echo '<div class="alert alert-default">';
          foreach ($exercise as $info)
          {
            $details = $this->exercise->get_exercise_details($info->id_exercise);
        ?>
            <div class="panel panel-primary form-group">
              <div class="panel-heading">
                <div class="row">
                <?php
                  echo '<div class="col-lg-1" ><input type="checkbox" value='.$info->id_exercise.' name="exercise[]" class=""></div>';
                  echo '<div class="col-lg-3" >Exercise Name :<em>"'.$info->ex_label.'"</em></div>';
                  echo '<div class="col-lg-4" >Added by id_user:<em>"'.$details['added_by'].'"</em></div>';
                  echo '<div class="col-lg-4" >Last modification :<em>"'.$info->date_modify.'"</em></div>';
                ?> 
                </div>              
              </div>
              <div class="panel-body">
                  <div class="form-group row">
                    <label class="btn btn-default">
                      Type : <b><?php echo $info->ex_type ?></b>
                    </label>                
                    <label class="btn btn-default">
                      Reference Lesson: <b><?php echo $details['lesson_label'] ?></b>
                    </label>               
                    <label class="btn btn-default">
                      Reference Chapter: <b><?php echo $details['title_chap'] ?></b>
                    </label>
                  </div>
                  <div class="row">
                    <label class="btn btn-default">
                      Number of Question : <b><?php echo $info->number_question ?></b>
                    </label>
                    <label class="btn btn-default">
                      Exercise points : <b><?php echo $info->ex_point ?></b>
                    </label>
                    <label class="btn btn-warning">
                      Points if Failt : -<b><?php echo $info->point_if_felt ?></b>
                    </label>
                  </div>
              </div>
              <div class="panel-footer">
                <?php
                include 'exercise_action.php';
                ?>
              </div>
            </div>
        <?php
          }
          echo '</div>';

          echo '<input type="submit" class="form-control btn btn-success" name="build_test" value="Build a test !!">';

          echo form_close();

          }else{
            echo '<div class="alert alert-warning form-group">No exercise exists...!</div>';
          }

          echo '<hr>';

          echo heading('Create an Exercise',4);
          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/add/" class="form-group form-control btn btn-warning" ><span class="glyphicon glyphicon-plus"></span> Add exercise</a>';

        ?>
  </div>

     
</div>