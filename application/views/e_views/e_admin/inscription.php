<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo form_fieldset('List of incriptions');
        
        if (isset($this->session->info)) { echo '<div class="alert alert-success">'.$this->session->info.'</div>'; }

        echo form_open('e_controllers/e_admin/inscription/index' , 'class="form-inline form-group"');
        echo '<div class="form-group">';

        echo 'Select validation state ';
        echo form_dropdown('validation_state' , array('all'=>'All','wait'=>'waiting','validate'=>'Validated','reject'=>'Rejected') , set_value('validation_state' , 'wait') , 'class="form-control" id="validation_state" ' );
        echo form_submit('search_inscription','search_inscription!!' , 'class="btn btn-default"');

        echo '</div>';
        echo form_close();

        if ( count($list) != 0 ) {

          foreach ($list as $inscription) {
            $state = $inscription['validation_state'];
            if ($state == 1) {
              $alert = 'alert alert-success';
            }elseif ($state == 0) {
              $alert = 'alert alert-info';
            }else{
              $alert = 'alert alert-warning';
            }
            echo '<div class="'.$alert.'">';

            echo '<div class="row">';
            if ($inscription['num_slice'] == 1) {
              echo '<i class="fa fa-certificate fa-2x"> New</i> ';
            }else{
              if ($inscription['id_wave'] != null) {
              echo '<i class="fa fa-group fa-2x"> '.$this->db->get_where('e_wave' , array('id_wave'=>$inscription['id_wave']) )->row()->code_wave.'</i> ';
              echo '<a href="'.base_url().'index.php/e_controllers/e_admin/wave_manager/overview/'.$inscription['id_wave'].'"><i class="fa fa-eye fa-2x"> Overview wave</i></a>';
                
              }
            }
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Firstname: <b>'.$details[$inscription['id_paid']]['firstname'].'</b></div>';
            echo '<div class="col-lg-4">Lesson: <b>'.$details[$inscription['id_paid']]['label'].'</b></div>';
            echo '<div class="col-lg-4">Type: <b>'.$inscription['formation_type'].'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Reference: <b>'.$inscription['reference'].'</b></div>';
            echo '<div class="col-lg-4">Total slice: Payment in <b>'.$inscription['total_slice'].'</b> slice(s)</div>';
            echo '<div class="col-lg-4">Number slice: <b>'.$inscription['num_slice'].'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Remaining: <b>'.$inscription['remaining_amount'].'</b> Fcfa</div>';
            echo '<div class="col-lg-4">Payment method: <b>'.$details[$inscription['id_paid']]['name_op'].'</b></div>';
            echo '<div class="col-lg-4">Date of paid: <b>'.$inscription['date_paid'].'</b></div>';
            echo '</div>';

            echo '<hr>';

            echo '<div class="row">';
            if ($state == 0) {
              echo '<div class="col-lg-4">
              <a href="'.base_url().'index.php/e_controllers/e_admin/inscription/reject/'.$inscription['id_paid'].'" class="btn btn-info form-control">Reject</a><b></b></div>';
              echo '<div class="col-lg-4">State <span class="glyphicon glyphicon-hourglass"></span><b> Waiting for validation!!</b></div>';
              if ($inscription['num_slice'] == 1 ) {
                echo '<div class="col-lg-4">
                <a href="'.base_url().'index.php/e_controllers/e_admin/inscription/insert/'.$inscription['id_paid'].'" class="btn btn-info form-control"><i class="fa fa-bolt fa-1x"></i> Proceed to validation</a><b></b></div>';
              }else{
                echo '<div class="col-lg-4">
                <a href="'.base_url().'index.php/e_controllers/e_admin/inscription/add_student/'.$inscription['id_paid'].'/'.$inscription['id_wave'].'" class="btn btn-info form-control"><i class="fa fa-refresh fa-1x"></i> All is right, validate/update learner </a><b></b></div>';
              }
              
            }elseif ($state == 1) {
              echo '<div class="col-lg-4">
              </div>';
              echo '<div class="col-lg-4">State: <i class="fa fa-check fa-1x"></i><b> Validated!!</b></div>';
              echo '<div class="col-lg-4">
              </div>';
            }else{
              echo '<div class="col-lg-4">
              <b>Some information are not valid...!!</b></div>';
              echo '<div class="col-lg-4">State: <i class="fa fa-remove fa-1x w3-text-red"></i><b> Rejected!!</b></div>';
              if ($inscription['num_slice'] == 1 ) {
                echo '<div class="col-lg-4">
                <a href="'.base_url().'index.php/e_controllers/e_admin/inscription/insert/'.$inscription['id_paid'].'" class="btn btn-warning form-control"><i class="fa fa-bolt fa-1x"></i> Proceed to validation</a><b></b></div>';
              }else{
                echo '<div class="col-lg-4">
                <a href="'.base_url().'index.php/e_controllers/e_admin/inscription/add_student/'.$inscription['id_paid'].'/'.$inscription['id_wave'].'" class="btn btn-warning form-control"><i class="fa fa-refresh fa-1x"></i> All is right, validate/update learner </a><b></b></div>';
              }

            }

            echo '</div>';

            echo '</div>';
          }

        }else{
          echo '<div class="alert alert-warning form-group">Empty list !!</div>';
        }
        

        
        echo form_fieldset_close();

        ?>

  </div>
</div>