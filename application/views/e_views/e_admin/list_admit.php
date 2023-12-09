<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo form_fieldset('List of learners');
        
        if (isset($this->session->info)) { echo '<div class="alert alert-success">'.$this->session->info.'</div>'; }

        

        if ( count($list_admit) != 0 ) {

          ?>

          <table class="table table-bordered" width="100%" id="" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">N&#176;</th>
                        <th><i class="fa fa-user fa-1x"></i> Learner</th>                                
                        <th><i class="fa fa-circle-o fa-1x"></i>Wave</th>
                        <th><i class="fa fa-clock-o fa-1x"></i> Admit</th>
                        <th><i class="fa fa-clock-o fa-1x"></i> Already generated</th>
                        <th><i class="fa fa-wrench fa-1x"></i> Options</th>
                </tr>

            </thead>
            <tbody>
              <?php
              $number = 1;
              
                foreach ($list_admit as $admit ) {
              ?>
                  <tr>

                    <td><?php echo $number++; ?></td>
                    <td><?php echo character_limiter($admit['user']->firstname.' '.$admit['user']->lastname , 15); ?></td>
                    <td><?php echo $admit['wave']->code_wave ?></td>
                    <td> 
                      <?php
                      if ($admit['product']->admit == '1' ) {
                        echo 'yes';
                      }else{
                        echo 'no';
                      }
                        
                      ?>
                    </td>
                    <td> 
                      <?php
                        if ($admit['product']->status == '1' ) {
                          echo 'yes';
                        }else{
                          echo 'no';
                        }                        
                      ?>
                    </td>
                    
                    <td>
                      <?php
                        if ($admit['product']->status == '1') {
                          echo 'Yes';
                        }elseif ($admit['product']->status == '0') {
                          echo '
                          
                          <a href="'.base_url().'e_controllers/e_admin/generate/attestation/'.$admit['user']->id.'/'.$admit['wave']->id_wave.'" title="Remove"><i class="fa fa-download fa-1x w3-text-green"> </i></a> ';

                           echo form_open_multipart('e_controllers/e_admin/generate/do_upload/'.$admit['product']->id_prd );?>

<input type="file" name="userfile" size="20" />

<br>

<input type="submit" value="upload" />

</form>
<?php
                        }
                        
                      ?>
                        
                    </td>
                
                  </tr>

              <?php
                }
              
              ?>
              

            </tbody>
        </table>


        <?php

        }else{
          echo '<div class="alert alert-warning form-group">Empty list !!</div>';
        }
        

        
        echo form_fieldset_close();

        ?>

  </div>
</div>