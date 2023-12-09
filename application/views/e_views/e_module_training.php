<div class="col-md-9" style=" margin-left: -22px;">
  <div class="panel panel-default">
    <div class="panel-heading" style="height: 53px;">
    <?php  $test_training = base_url().'e_controllers/c_home_page/testTraining/'.$training ; ?>
      <a href="<?php echo $test_training ; ?>">
        <button type="button" class="btn btn-info"><span>Passer un test de prérequis</span>
        </button>
      </a>
      <?php  $registration_training = base_url().'e_controllers/c_home_page/choiceTraining/'.$training ; ?>
      <a href="<?php echo $registration_training ; ?>" style="float: right;">
        <button type="button" class="btn btn-success"><span>Procéder à l'inscription</span>
        </button>
      </a>
    </div>
    <div class="col-sm-12">
        <h3 class="page-title mb-3" style="text-align: center;">LISTE DES MODULES DE LA FORMATION EN <hr><?php echo $this->db->where('id', $training)->get('lesson')->row()->label ;?></h3>
        <hr>
    </div>
      <div class="panel-body">
  <div class="col-md-12">
  <?php
    $k = -1;
    foreach ($his_module as $key1) {
      $all_ex = null;
      foreach ($all_module as $key) {
        if ($key['id_mod'] == $key1['id_mod']) {
          echo '<div class="col-md-6">';
            if ($key['statue_mod'] == 1) {
              if ($k < 3) {
                echo '<div class="panel panel-primary">
                        <div class="panel-heading">'.strtoupper($key['label_mod']).'<label style="float: right;">'.strtoupper($key['code_mod']).'</label></div>
                        <ul class="list-group">
                          <li class="list-group-item">
                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                            Nombre d\'heures :&nbsp; <b>'.$key['duration_mod'].' H</b>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span style="float: right; color: blue">
                              <i class="glyphicon glyphicon-edit"></i>&nbsp;
                              Nombre d\'exercices :&nbsp; <b>';
                            $all_chap = $this->db->where('id_mod', $key['id_mod'])->get('e_chapter')->result_array();
                            foreach ($all_chap as $prince) {
                              if ($all_ex==null) {
                                $all_ex = $this->db->where('id_chap', $prince['id_chap'])->get('e_exercise')->result_array();
                              echo sizeof($all_ex);
                              }
                            }
                              echo ' </b>
                            </span>
                          </li>
                        </ul>';
                echo '</div>';
                $k++;
              }
              else{
                echo '<div class="panel panel-primary">
                        <div class="panel-heading">'.strtoupper($key['label_mod']).'<label style="float: right;">'.strtoupper($key['code_mod']).'</label></div>
                        <ul class="list-group">
                          <li class="list-group-item">
                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                            Nombre d\'heures :&nbsp; <b>'.$key['duration_mod'].' H</b>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span style="float: right; color: blue">
                              <i class="glyphicon glyphicon-edit"></i>&nbsp;
                              Nombre d\'exercices :&nbsp; <b>'.sizeof($all_ex).' </b>
                            </span>
                          </li>
                        </ul>';
                echo '</div>';
                $k=0;
              }
            echo '</div>';
          }
        }
      }
    }
  ?>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>