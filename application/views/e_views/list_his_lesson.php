<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center  col-sm-12" style="color: orange">
                VOS FORMATIONS
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

    <div class="row">
<?php

  $k = -1;

  foreach ($lesson_user as $key1) {
    foreach ($list_training as $key) {
        if ($key1['id_lesson'] == $key['id']) {
          $teacher = $this->db->where('id', $key['id_user'])->get('user')->row()->lastname;
            echo '<div class="col-md-6">';
                if ($k < 2) {
                  echo '<div class="panel panel-success" style="border-radius:0px;">
                          <div class="panel-heading"><label class="h4">'.mb_strtoupper($key['label']).'</label>
                          </div>
                          <ul class="list-group">
                          </ul>';
                      include "panel_footer_training.php";
                  echo '</div>';
                  $k++;
                }
                else{
                  echo '<div class="panel panel-success" style="border-radius:0px;">
                          <div class="panel-heading"><label class="h4">'.mb_strtoupper($key['label']).'</label>
                          </div>
                          <ul class="list-group">
                          </ul>';
                      include "panel_footer_training.php";
                  echo '</div>';
                  $k=0;
                }
                echo '</div>';
            }
        }
    }
?>
    </div>
</div>
</body>
</html>