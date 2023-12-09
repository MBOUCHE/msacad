<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-1">
            <a href="<?php echo base_url().'e_controllers/c_take_courses/reviewCourse/'.$id_training.'/'.$training ;?>">
              <button type="button" class="btn btn-primary glyphicon glyphicon-circle-arrow-left" style="border-radius:0px;">
                <span>Retour</span>
              </button>
            </a>
          </div>
          <div class="h4 text-center  col-sm-9">
            <?php

              $l = $this->db->where('id', $id_training)->get('lesson')->result_array(); 
              foreach ($l as $key) {
                $tr = $key['label'];
              }
              $mt = $this->db->where('id_mod', $id_mod)->get('e_module_teach')->result_array(); 
              foreach ($mt as $key) {
                $mod = $key['label_mod'];
              }
              echo 'FORMATION : '.mb_strtoupper($tr).'<hr>' ;
              echo 'MODULE : '.mb_strtoupper($mod).'<hr>' ;
            ?>
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
    <?php

      $k = -1;
      foreach ($list_chapter as $key) {
        if ($key['status'] == 1) {
          echo '<div class="col-md-6">';
            if ($k < 2) {
              echo '<div class="panel panel-success" style="border-radius:0px;">
                      <div class="panel-heading">CHAPITRE : '.$key['num_chap'].' / '.mb_strtoupper($key['title_chap']).'<label></label></div>
                      <ul class="list-group">
                      </ul>';
                  include "panel_footer_chap.php";
              echo '</div>';
              $k++;
            }
            else{
              echo '<div class="panel panel-success">
                      <div class="panel-heading">CHAPITRE : '.$key['num_chap'].'/'.mb_strtoupper($key['title_chap']).'<label></label></div>
                      <ul class="list-group">
                      </ul>';
                    include "panel_footer_chap.php";
              echo '</div>';
              $k=0;
            }
            echo '</div>';
        }
      }

    ?>
    </div>
  </div>
</div>
</body>
</html>