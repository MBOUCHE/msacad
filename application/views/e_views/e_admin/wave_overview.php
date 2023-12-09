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

      function modify(){
        if (document.getElementById('delays').className == 'hidden') {
          document.getElementById('delays').className = '';
        }else{
          document.getElementById('delays').className = 'hidden';
        }
      }

      function modify_end(){
        if (document.getElementById('formator').className == 'form-group'){
          document.getElementById('formator').className = 'form-group hidden';          
        }

        if (document.getElementById('date_end').className == 'form-group hidden') {
            document.getElementById('date_end').className = 'form-group';
        }else{
          document.getElementById('date_end').className = 'form-group hidden';
        }       
      }

      function modify_formator(){

        if (document.getElementById('date_end').className == 'form-group'){
          document.getElementById('date_end').className = 'form-group hidden';
        }

        if (document.getElementById('formator').className == 'form-group hidden') {
          document.getElementById('formator').className = 'form-group';
        }else{
          document.getElementById('formator').className = 'form-group hidden';
        }
      }
    </script>

<div class="content-wrapper py-3">

  <div class="container-fluid">


        <?php
        echo form_fieldset('Informations about Wave and else...');

        echo '<a href="'.base_url().'e_controllers/e_admin/wave_manager/" class="btn btn-danger form-group"><i class="fa fa-arrow-left fa-1x"></i> Back to list of wave!!!</a>';

        echo form_fieldset('Wave details ');

            echo '<div class="row">';
            echo '<div class="col-lg-4">Code : <b>'.$wave['code_wave'].'</b></div>';
            echo '<div class="col-lg-4">Status : <b>';
            if( $wave['status'] == '1' ){
              echo '<i class="fa fa-circle-o fa-1x w3-text-green"> In activity</i>';
            }else{
              echo '<i class="fa fa-circle-o fa-1x w3-text-red"> No activated or already finish</i>';
            }
            echo '</b></div>';
            echo '<div class="col-lg-4">Lesson : <b>'.character_limiter($details['lesson']->label , 15).'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Formator : <b>'.character_limiter( $details['formator']->firstname.' '.$details['formator']->lastname , 15).'</b></div>';
            echo '<div class="col-lg-4">Create the : <b>'.$wave['date'].'</b> slice(s)</div>';
            echo '<div class="col-lg-4">Number learners: <b>'.count($details['students']).'</b></div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-lg-4">Date begin: <b>'.$wave['date_bgn'].'</b></div>';
            echo '<div class="col-lg-4">Date end: <b>'.$wave['date_end'].'</b></div>';
            echo '<div class="col-lg-4">... <b>'.'</b></div>';
            echo '</div>';

            $total = round((strtotime($wave['date_end']) - strtotime($wave['date_bgn'])) ) ;
            $now = round((strtotime(date('Y-m-d H:i:s')) - strtotime($wave['date_bgn'])) ) ;
            echo date('Y-m-d H:i:s').'--';
            echo strtotime(date('Y-m-d h:i:s'))/60/60;
            echo '<br>'.$now.'<br>'.$total;
            if ($now < $total) {
              
            ?>

            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow=<?=($now*100/$total) ?> aria-valuemin="0" aria-valuemax=<?=$total?> style="width: <?=($now*100/$total) ?>%;">
                <span><?php echo floor($now*100/$total); ?>% Complete</span>
              </div>
            </div>

            <?php
            }else{
            ?>

              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow=<?=$total?> aria-valuemin="0" aria-valuemax=<?=$total?> style="width: 100%;">
                  <span>Wave are teminate...    <i class="fa fa-info-circle fa-1x w3-text-orange"> YOU MOST CLOSE THIS WAVE</i></span>
                </div>
              </div>

            <?php
            }
            ?>

            <hr>
            
            <div class="row" style="text-align:center;">
            <div class="col-lg-4"  onclick="modify_end();"><i class="btn btn-primary fa fa-clock-o fa-1x "> Modify date end...</i></div>
            <div class="col-lg-4" onclick="modify_formator();"><i class="btn btn-primary fa fa-user fa-1x "> Modify formator...</i></div>
            <div class="col-lg-4"><i class="btn btn-warning fa fa-stop fa-1x "> close this wave...</i></div>
            </div>
            
            <div class="form-group hidden" id="date_end">
              <?php
              echo form_open('e_controllers/e_admin/wave_manager/modify_date_end/' , 'class="form-inline" ' , array('id_wave'=>$wave['id_wave']) );
              ?>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Date End</span>
                <?php
                  echo form_input('date_end', $wave['date_end'] , 'type="datetime" class="form-control" aria-describedby="basic-addon1" required' );
                ?>
                <span class="input-group-btn">
                  <input name="end" type="submit" value="save" class="btn btn-default" aria-describedby="basic-addon1">
                </span>
              </div>
              <?php
              echo form_close();
              ?>
            </div>

            <div class="form-group hidden" id="formator">
              <?php
              echo form_open('e_controllers/e_admin/wave_manager/modify_wave_formator/' , 'class="form-inline" ' , array('id_wave'=>$wave['id_wave']) );
              ?>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Select a formator</span>
                <?php
                  echo form_dropdown( 'id_user' , $list_formator,$wave['id_user'], ' class="form-control" aria-describedby="basic-addon2" ');
                ?>
                <span class="input-group-btn">
                  <input name="formator" type="submit" value="save" class="btn btn-default" aria-describedby="basic-addon2">
                </span>
              </div>
              <?php
              echo form_close();
              ?>
            </div>

            <?php

        
        echo form_fieldset_close();

        echo '<hr>';

        echo heading('List of Learners' , 4);

        ?>
        <table class="table table-bordered" width="100%" id="" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">N&#176;</th>
                        <th><i class="fa fa-user fa-1x"></i> Learner</th>                                
                        <th><i class="fa fa-clock-o fa-1x"></i> Added (date)</th>
                        <th><i class="fa fa-clock-o fa-1x"></i> Limit date (date)</th>
                        <th><i class="fa fa-circle-o fa-1x"></i> Status</th>
                        <th><i class="fa fa-wrench fa-1x"></i> Options</th>
                </tr>

            </thead>
            <tbody>
              <?php
              $number = 1;
              if (count($details['students']) != 0 ) {
              
                foreach ($details['students'] as $student ) {
              ?>
                  <tr>

                    <td><?php echo $number++; ?></td>
                    <td><?php echo character_limiter($student->firstname.' '.$student->lastname , 15); ?></td>
                    <td> 
                      <?php
                        $content = $this->db->get_where( 'e_content' , array('id_wv'=>$wave['id_wave'] , 'id_user'=>$student->id ) )->row();
                        echo date_format(date_create($content->date) , 'd-m-Y');
                      ?>
                    </td>
                    <td> 
                      <?php
                        $content = $this->db->get_where( 'e_content' , array('id_wv'=>$wave['id_wave'] , 'id_user'=>$student->id ) )->row();
                        if ( strtotime($content->limit_date) > strtotime(date('d-m-Y h:i:s')) ) {
                          echo '<i class="fa-1x w3-text-green">'.date_format(date_create($content->limit_date) , 'd-m-Y h:i:s').' **Normal</i>';
                        }else{
                          ($content->status == '1')? $info = ' You must suspend!!</i>' : $info = '</i>' ;
                          echo '<i class="fa-1x w3-text-red">'.date_format(date_create($content->limit_date) , 'd-m-Y h:i:s').$info;
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($content->status == '1') {
                          echo '<i class="fa fa-circle-o fa-1x w3-text-green"> Active</i>';
                        }elseif ($content->status == '0') {
                          echo '<i class="fa fa-circle-o fa-1x w3-text-orange"> Supended</i>';
                        }else{
                          echo '<i class="fa fa-circle-o fa-1x w3-text-red"> Removed</i>';
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($content->status == '1') {
                          echo '
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/0" class="" title="Suspend"><i class="fa fa-pause fa-1x w3-text-orange"> </i></a>
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/-1" class="" title="Remove"><i class="fa fa-stop fa-1x w3-text-red"> </i></a> ';
                        }elseif ($content->status == '0') {
                          echo '
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/1" title="Active"> <i class="fa fa-play fa-1x w3-text-green"></i></a>
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/-1" title="Remove"><i class="fa fa-stop fa-1x w3-text-red"> </i></a> ';
                        }else{
                          echo '
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/1" title="Active"> <i class="fa fa-play fa-1x w3-text-green"></i></a>
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/wave_learner_control/'.$content->id_cnt.'/'.$content->id_user.'/0" title="Suspend"><i class="fa fa-pause fa-1x w3-text-orange"> </i></a> ';
                        }
                        echo '
                          <a href="'.base_url().'e_controllers/e_admin/wave_manager/list_paid/'.$content->id_cnt.'/'.$content->id_user.'" title="Active"> <i class="fa fa-download fa-1x w3-text-green"></i></a> ';
                        
                      ?>
                        
                       <?php  ?>
                    </td>
                
                  </tr>

              <?php
                }
              }else{
                echo '<tr><td colspan="5" style="text-align:center;">No learners or learners already desactivated...</td></tr>';
              }
              ?>
              

            </tbody>
        </table>

        <?php

        echo '<hr>';

        echo heading('Payement Delay' , 4);

        ?>

        <table class="table table-bordered" width="100%" id="" cellspacing="0">
            <thead>
                <tr>
                        <th>In 2 slices(2nd payment)</th>                                
                        <th>In 3 slices(2nd payment)</th>
                        <th>In 3 slices(3rd payment)</th>
                        <th>Options</th>
                </tr>

            </thead>
            <tbody>
              <?php             
              
                if ($delays ) {
              ?>
                  <tr>

                    <td><?php echo date_format(date_create($delays->delay_2_2) , 'd-m-Y  h:i:s') ; ?></td>
                    <td><?php echo date_format(date_create($delays->delay_3_2) , 'd-m-Y  h:i:s') ; ?></td>
                    <td><?php echo date_format(date_create($delays->delay_3_3) , 'd-m-Y  h:i:s') ; ?></td>
                    <td>
                      <a href="#delays" onclick="modify();" class=""><i class="fa fa-edit fa-1x w3-text-orange"></i> Modify</a>
                    </td>               
                  </tr>

              <?php
                }else{
                  echo '<tr><td colspan="4" style="text-align:center;">No delays exists...</td></tr>';
                }
  
              ?>
              

            </tbody>
        </table>

        <div id="delays" class="hidden">
          <div class="form-group">
            <?php
            echo form_open('e_controllers/e_admin/wave_manager/modify_delay/' , ' class="form-inline" ' , array('id_wave'=>$wave['id_wave']) );
            ?>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">In 2 slices(2nd payment)</span>
              <?php
                echo form_input('delay_2_2', $delays->delay_2_2 , 'type="datetime" class="form-control" aria-describedby="basic-addon1" required' );
              ?>
              <span class="input-group-btn">
                
                <input name="dly_2_2" type="submit" value='Save' class="btn btn-default" aria-describedby="basic-addon1">
              </span>
            </div>
            <?php
            echo form_close();
            ?>
          </div>

          <div class="form-group">
            <?php
            echo form_open('e_controllers/e_admin/wave_manager/modify_delay/' , 'class="form-inline" ' , array('id_wave'=>$wave['id_wave']) );
            ?>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">In 3 slices(2nd payment)</span>
              <?php
                echo form_input('delay_3_2', $delays->delay_3_2 , 'type="datetime" class="form-control" aria-describedby="basic-addon1" required' );
              ?>
              <span class="input-group-btn">
                <input name="dly_3_2" type="submit" value="Save" class="btn btn-default" aria-describedby="basic-addon1">
              </span>
            </div>
            <?php
            echo form_close();
            ?>
          </div>

          <div class="form-group">
            <?php
            echo form_open('e_controllers/e_admin/wave_manager/modify_delay/' , ' class="form-inline" ' , array('id_wave'=>$wave['id_wave']) );
            ?>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">In 3 slices(3rd payment)</span>
              <?php
                echo form_input('delay_3_3', $delays->delay_3_3 , 'type="datetime" class="form-control" aria-describedby="basic-addon1" required' );
              ?>
              <span class="input-group-btn">
                <input name="dly_3_3" type="submit" value="Save" class="btn btn-default" aria-describedby="basic-addon1">
              </span>
            </div>
            <?php
            echo form_close();
            ?>
          </div>

        </div>



        <?php

        echo form_fieldset_close();

        ?>

    </div>

</div>