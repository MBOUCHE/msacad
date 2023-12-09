  <?php

    $l = $this->db->where('id', $id_training)->get('lesson')->result_array(); 
    foreach ($l as $key) {
      $tr = mb_strtoupper($key['label']);
    }
    $mt = $this->db->where('id_mod', $id_mod)->get('e_module_teach')->result_array(); 
    foreach ($mt as $key) {
      $mod = mb_strtoupper($key['label_mod']);
    }
    $cp = $this->db->where('id_chap', $id_chap)->get('e_chapter')->result_array(); 
    foreach ($cp as $ke) {
      $chap = mb_strtoupper($ke['title_chap']);
      $num = $ke['num_chap'];
    }
  ?>

<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
          <div class="h4 text-center  col-sm-10">
              <a href="<?php echo base_url().'e_controllers/c_space_works/readingCourses/'.$id_mod.'/'.$name_mod.'/'.$training.'/'.$id_training; ?>" style="float: left;">
                <button type="button" class="btn btn-info glyphicon glyphicon-circle-arrow-left" style="border-radius:0px;">
                  <span>Retour</span>
                </button>
              </a>
              <?php echo 'FORMATION : '.$tr ; ?>
              <hr width="60%" style="margin: auto; margin-top: 10px">
          </div>
          <div class="col-sm-2">
            <a href="<?php echo base_url().'e_controllers/c_take_courses/beginClass/'.$training.'/'.$id_training ; ?>">
              <button type="button" class="btn btn-warning" style="border-radius:0px;float: right;">
                <span><i class="fa fa-2x fa-users" style="color: blue"></i> <label style="color: blue">Classe </label></span>
              </button>
            </a> 
          </div>
        </div>
        <div class="row">
          <div class="h4 text-center  col-sm-12">
              <?php echo 'MODULE : <label>'.$mod.'</label>' ; ?>
              <hr width="85%" style="margin: auto; margin-top: 10px">
          </div>
        </div>
        <div class="row">
          <div class="h4 text-center  col-sm-12">
              <?php echo 'CHAPITRE '.$num.' : <label>'.$chap.'</label>' ; ?>
              <hr width="85%" style="margin: auto; margin-top: 10px">
          </div>
        </div>
    <div class="row">
    <?php
      $j=1;
      $k = -1;
      foreach ($list_exos as $key) {
        if ($key['ex_type']!='THEME') {
          if ($key['status'] == 1) {
            echo '<div class="col-md-6">';
            $merde =  $this->CaseLearners->listIsQsts($key['id_exercise']);
            $pointsOfEx = 0;
            foreach ($merde as $key1) {
              $pointsOfEx += $key1['point'];
            }
            if ($k < 2) {
              if ($key['status'] == 1) {
              echo '<div class="panel panel-success" style="border-radius:0px;">
                      <div class="panel-heading">Exercice n° '.$j++.'/'.$key['ex_type'].'<label style="float: right;">'.$key['ex_label'].'</label></div>
                      <ul class="list-group">
                        <li class="list-group-item">Nombre de questions :'.sizeof($merde).'</li>
                        <li class="list-group-item">Nombre de points :'.$pointsOfEx.' (Points) </li>
                        <li class="list-group-item">Pour chaque réponse incorrecte : -'.$key['point_if_felt'].' (Point)</li>
                      </ul>';
                  include "panel_footer_exo.php";
              echo '</div>';
              $k++;
            }
            else{
              echo '<div class="panel panel-success" style="border-radius:0px;">
                      <div class="panel-heading">Exercice n° '.$j++.'/'.$key['ex_type'].'<label style="float: right;">'.$key['ex_label'].'</label></div>
                      <ul class="list-group">

                        <li class="list-group-item">Nombre de questions :'.sizeof($merde).'</li>
                        <li class="list-group-item">Nombre de point :'.$pointsOfEx.' (Points) </li>
                        <li class="list-group-item">Pour chaque question rattée : -'.$key['point_if_felt'].' (Point)</li>
                      </ul>';
                    include "panel_footer_exo.php";
              echo '</div>';
              $k=0;
              }
            }
            echo '</div>';
          }
        }
      }

    ?>
    </div>
  </div>
</div>
</body>
</html>