<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
          <div class="h4 text-center  col-sm-10">
            <a href="<?php echo base_url().'e_controllers/c_take_courses'; ?>" style="float: left;color: orange">
              <button type="button" class="btn btn-default" style="border-radius:0px;">
                <span>VOS FORMATIONS</span>
              </button>
            </a>
              <?php $lesson = $this->db->where('id', $id_training)->get('lesson')->result_array() ; 
                foreach ($lesson as $key) {
                  echo mb_strtoupper($key['label']);
                }
              ?>
              <hr width="60%" style="margin: auto; margin-top: 10px">
          </div>
          <div class="col-sm-2">
            <a href="<?php echo base_url().'e_controllers/c_take_courses/beginClass/'.$training.'/'.$id_training ; ?>">
              <button type="button" class="btn btn-warning" style="border-radius:0px;float: right;">
                <span><i class="fa fa-2x fa-users" style="color: blue"></i> <label style="color: blue">Classe</label></span>
              </button>
            </a> 
          </div>
        </div>

    <div class="row">
<?php
  $k = -1;
  $nb_mod = 0;
  foreach ($lesson_user2 as $key1) {
    foreach ($list_module as $key) {
      if ($key1['id_mod'] == $key['id_mod']) {
        echo '<div class="col-md-6">';
          if ($key['statue_mod']==1) {
            if ($k < 2) {
              echo '<div class="panel panel-success" style="border-radius:0px; font-size:12px">
                      <div class="panel-heading">'.mb_strtoupper($key['label_mod']).'...<label>'.$key['code_mod'].'</label><label style="float: right; color: orange"> Nombre d\'heures : '.$key['duration_mod'].' H</label></div>
                      <ul class="list-group">

                      </ul>';
                  include "panel_footer_mod.php";
              echo '</div>';
              $k++;
            }
            else{
              echo '<div class="panel panel-success" style="border-radius:0px; font-size:12px">
                      <div class="panel-heading">'.mb_strtoupper($key['label_mod']).'...<label>'.$key['code_mod'].'</label><label style="float: right; color: orange"> Nombre d\'heures : '.$key['duration_mod'].' H</label></div>
                      <ul class="list-group">

                      </ul>';
                    include "panel_footer_mod.php";
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
</body>
</html>