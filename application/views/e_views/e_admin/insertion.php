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

        echo br();
        if (isset($this->session->info)) {
          echo '<div class="alert alert-info" >'.$this->session->info.'</div>';
        }

        echo form_fieldset('Details of payment');
          echo '<div class="alert alert-warning">';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Firstname: <b>'.$details['firstname'].'</b></div>';
            echo '<div class="col-lg-4">Lesson: <b>'.$details['label'].'</b></div>';
            echo '<div class="col-lg-4">Type: <b>'.$inscription['formation_type'].'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Reference: <b>'.$inscription['reference'].'</b></div>';
            echo '<div class="col-lg-4">Total slice: Payment in <b>'.$inscription['total_slice'].'</b> slice(s)</div>';
            echo '<div class="col-lg-4">Number slice: <b>'.$inscription['num_slice'].'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Remaining: <b>'.$inscription['remaining_amount'].'</b> Fcfa</div>';
            echo '<div class="col-lg-4">Payment method: <b>'.$details['name_op'].'</b></div>';
            echo '<div class="col-lg-4">Date of paid: <b>'.$inscription['date_paid'].'</b></div>';
            echo '</div>';            

          echo '</div>';
        echo form_fieldset_close();


        foreach ($list_lesson as $lesson) {
          $option[$lesson['id']] = character_limiter($lesson['label'] , 10);
        }

        echo form_fieldset('List of Waves ');

        echo form_open('e_controllers/e_admin/wave_manager/insert/'.$inscription['id_paid'], 'class="form-inline"');
        echo '<div class="form-group">';

        echo form_dropdown('lesson' , $option , set_value('lesson') , 'class="form-control"' );
        echo form_dropdown('formation_type' , array('lng'=>'Longue','crt'=>'Courte','prm'=>'Promo') , set_value('formation_type') , 'class="form-control"' );
        echo form_submit('search','Search wave!!' , 'class="btn btn-default"');
        echo form_submit('best','Best inscription result!!' , 'class="btn btn-default"');

        echo '</div>';
        echo form_close();

        echo '<hr>';

        if ( ! empty( $list_wave ) ){
          foreach ($list_wave as $info) {

            $details = $this->wave->get_details($info->id_wave);

            echo '<div class="panel panel-primary">';

            echo '<div class="panel-heading" >';

            echo '<div class="row">';
            echo '<div class="col-lg-4">code_wave: <b>'.$info->code_wave.'</b></div>';
            echo '<div class="col-lg-4">Added the : <b>'.$info->date.'</b></div>';
            echo '<div class="col-lg-4">Last modification : <b>'.$info->last_modify.'</b></div>';
            echo '</div>';

            echo '</div>';

            echo '<div class="panel-body" >';

            echo '<div class="row">';
            echo '<div class="col-lg-4">type_wave: <b>'.$info->type_wave.'</b></div>';
            echo '<div class="col-lg-4">number_learners: <b>'.$info->number_learners.'</b></div>';
            echo '<div class="col-lg-4"><i class="fa fa-user fa-1x"></i> Formator......<b>'.character_limiter($details['formator']->firstname, 15).'  '.character_limiter($details['formator']->lastname , 10).'</b></div>'; 
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">date_bgn: <b>'.$info->date_bgn.'</b></div>';
            echo '<div class="col-lg-4">date_end <b>'.$info->date_end.'</b></div>';
            echo '</div>';

            echo '</div>';

            echo '<div class="panel-footer" >';
            echo '<a href="'.base_url().'index.php/e_controllers/e_admin/wave_manager/add_student/'.$inscription['id_paid'].'/'.$info->id_wave.'" class="btn btn-default" ><span class="glyphicon glyphicon-share-alt" ></span> Insert user here!!</a> ';
            echo '</div>';

            echo '</div>';

            echo br();
          }
          
        }else{
          echo '<div class="alert alert-warning form-group">No waves exists...!</div>';
        }
        echo form_fieldset_close();

        echo '<hr>';

        echo heading('Create a corresponding wave',4);
        echo '<div class="alert">';
        echo form_open('e_controllers/e_admin/wave_manager/create_wave/'.$inscription['id_paid']);

        echo '<div class="form-inline form-group">';

        echo form_dropdown('id_lesson' , $option , $inscription['id_lesson'] , 'class="form-control" ' );
        echo form_dropdown('formation_type' , array('lng'=>'Longue','crt'=>'Courte','prm'=>'Promo') , $inscription['formation_type'] , 'class="form-control" ' );
        echo 'formator: '.form_dropdown('id_formator' , $list_formator , '' , 'class="form-control" ' );

        echo '</div>';

        echo '<div class="form-inline form-group">';

        echo form_label('Begin : ','date_bng');
        echo form_input('date_bgn', date('Y-m-d h:i:s') ,'class="form-control" type="datetime" id="date_bng" required');
        echo form_label('End : ','date_end');
        echo form_input('date_end', date('Y-m-d h:i:s') ,'class="form-control" type="datetime" id="date_end" required');

        echo '</div>';

        echo heading('Define payement delay' , 4);

        echo '<div class="alert ">';

        echo form_label("Case of 2 slices");
        echo '<ul>';
        echo '<li class="form-inline">';
        echo "Delay of second(2)/last payment: " ;
        echo form_input('delay_2_2', date('Y-m-d h:i:s') ,'class="form-control" type="datetime" id="delay_2_2" required');
        echo '</li>';
        echo '</ul>';

        echo form_label("Case of 3 slices");
        echo '<ul>';
        echo '<li class="form-inline">';
        echo "Delay of second(2) payment: ";
        echo form_input('delay_3_2', date('Y-m-d h:i:s') ,'class="form-control" type="datetime" id="delay_3_2" required');
        echo '</li>';
        echo '<li class="form-inline">';
        echo "Delay of third(3)/last payment: ";
        echo form_input('delay_3_3', date('Y-m-d h:i:s') ,'class="form-control" type="datetime" id="delay_3_3" required');
        echo '</li>';
        echo '</ul>';

        echo '</div>';

        echo form_submit('create_wave' , 'create_wave','class="btn btn-default"');

        echo form_close();
        echo '</div>';

        ?>

      </div>

      
</div>