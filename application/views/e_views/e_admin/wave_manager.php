    <script type="text/javascript" charset="utf-8" async defer>
      function voir(){
        if (document.getElementById('add').className == 'hidden') {
          document.getElementById('add').className = '';
          document.getElementById('button').className = "glyphicon glyphicon-chevron-up";
        }else{
          document.getElementById('add').className = 'hidden';
          document.getElementById('button').className = "glyphicon glyphicon-chevron-down";
        }
      }

      function modify(id){
        if (document.getElementById('modify'+id).className == 'hidden') {
          document.getElementById('modify'+id).className = '';
          document.getElementById('button_modify'+id).className = "glyphicon glyphicon-chevron-up";
        }else{
          document.getElementById('modify'+id).className = 'hidden';
          document.getElementById('button_modify'+id).className = "glyphicon glyphicon-chevron-down";
        }
      }
    </script>

<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo form_fieldset('Informations about Wave and else...');

        echo br();
        if (isset($this->session->info)) {
          echo '<div class="alert alert-info" >'.$this->session->info.'</div>';
        }

        echo form_fieldset('List of Waves ');

        echo form_fieldset('Search for specific wave', 'class=" form-group"');
        $option = array('all'=>'Select lesson' );
          foreach ($list_lesson as $lesson) {
            $number_wave = count($this->db->get_where('e_wave',array( 'id_lesson'=>$lesson['id']) )->result() );
            $option[$lesson['id']] = character_limiter(character_limiter($lesson['label'] , 15).'**('.$number_wave.')waves', 15);
          }
        echo form_open('e_controllers/e_admin/wave_manager' , 'class="form-inline form-group"');

        echo '<div class="form-group">';

        echo form_dropdown('id_lesson' , $option , set_value('id_lesson' , 'all') , 'class="form-control" id="validation_state" ' );

        echo form_dropdown('type_wave' , array('all'=>'select Wave type','lng'=>'Longue','crt'=>'Courte','prm'=>'Promotion') , set_value('type_wave' , 'all') , 'class="form-control" id="validation_state" ' );

        echo form_dropdown('status' , array('all'=>'Select status','1'=>'Active','0'=>'Terminate') , set_value('status' , 'all') , 'class="form-control" id="validation_state" ' );

        echo '<button type="submit" name="search_wave" class="btn btn-default" ><i class="fa fa-search fa-1x"></i> Search wave!!</button>';
        // echo form_submit('search_wave','Search wave!!' , 'class="btn btn-default"');
        echo '</div>';
        
        echo form_close();

        echo form_fieldset_close();


        if ( ! empty($list ) ){
          foreach ($list as $info) {

            $details = $this->wave->get_details($info->id_wave);

            echo '<div class="form-group panel panel-primary">';

            echo '<div class="panel-heading" >';

            echo '<div class="row">';
              echo '<div class="col-lg-2">';
              echo '<i class="fa fa-console fa-1x"></i> Code '.$info->code_wave;
              echo '</div>';
              echo '<div class="col-lg-2">';
              if ($info->status == 1) {
                echo '<i class="fa fa-console fa-1x w3-text-green">State:Active</i>';
              }else{
                echo '<i class="fa fa-console fa-1x w3-text-orange">State:Terminate</i>';
              }
              echo '</div>';
              echo '<div class="col-lg-4">';
              echo '<i class="fa fa-clock-o fa-1x"></i> Added the : '.$info->date;
              echo '</div>';
              echo '<div class="col-lg-4">';
              echo '<i class="fa fa-clock-o fa-1x"></i> Last modification : '.$info->last_modify; 
              echo '</div>';
            echo '</div>';

            echo '</div>';

            echo '<div class="panel-body" >';

            echo '<div class="row">';

              echo '<div class="col-lg-6">';
              echo '<ul>';
                echo '<li class="form-group"><i class="fa fa-circle-o fa-1x"></i> Wave type...<b>'.$info->type_wave.'</b></li>';
                echo '<li class="form-group"><i class="fa fa-clock-o fa-1x"></i> Date begin..<b>'.$info->date_bgn.'</b></li>';
                echo '<li class="form-group"><i class="fa fa-user fa-1x"></i> Formator......<b>'.character_limiter($details['formator']->firstname, 15).'  '.character_limiter($details['formator']->lastname , 10).'</b></li>';
              echo '</ul>';
              echo '</div>';

              echo '<div class="col-lg-6">';
              echo '<ul>';
                echo '<li class="form-group"><i class="fa fa-circle-o fa-1x"></i> Lesson...<b>'.character_limiter($details['lesson']->label, 10).'</b></li>';
                echo '<li class="form-group"><i class="fa fa-clock-o fa-1x"></i> Date end.....<b>'.$info->date_end.'</b></li>';
                echo '<li class="form-group"><i class="fa fa-group fa-1x"></i> Effectif...<b>'.$info->number_learners.' Learners</b></li>';
              echo '</ul>';
              echo '</div>';

            echo '</div>';

            echo '</div>';

            echo '<div class="panel-footer" >';
            
            echo '<a href="'.base_url().'index.php/e_controllers/e_admin/wave_manager/overview/'.$info->id_wave.'" class="form-group btn btn-default" ><i class="fa fa-steam fa-1x"></i> Overview/Manage</a> ';

            if ($info->status == 0 ) {
              echo '<a href="'.base_url().'index.php/e_controllers/e_admin/wave_manager/activate/'.$info->id_wave.'/1" class="btn btn-default form-group" ><i class="fa fa-play fa-1x w3-text-green"></i> Click to activate this Wave</a>';
            }else{
              echo '<a href="'.base_url().'index.php/e_controllers/e_admin/wave_manager/activate/'.$info->id_wave.'/0" class="btn btn-default form-group" ><i class="fa fa-stop fa-1x w3-text-red"></i> Click to terminate this Wave</a>';
            }

            echo '</div>';

            echo '</div>';

            echo br();
          }
          
        }else{
          echo '<div class="alert alert-warning form-group">No Wave exists</div>';
        }
        echo form_fieldset_close();

        echo form_fieldset_close();

        ?>

    </div>

</div>