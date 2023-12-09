<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
<?php include_once "e_top_menu.php";?>

<?php include_once "e_left_menu.php";?>

      <div class="col-md-10" style="margin-left: -17px;width: 67%;">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul class="list-group" style="text-align: center;">
              <div class="col-sm-12">
                  <h1 class="page-title mb-3">LISTE DES FORMATIONS LONGUES EN LIGNE</h1>
                  <hr width="">
              </div>
            </ul>
            <form action='choiceTraining' method="post">
              <div class="row">
              <?php

                  $k = 0;
                  foreach ($list_training as $key) {
                    echo '<div style="width: 360px">';
                    if ($k < 3) {
                      if ($key['type']=='filière') {
                        echo '<div class="panel panel-success" style="border-radius:0px; margin-left: 17px">
                                <div class="panel-heading">'.mb_strtoupper($key['label']).'</div>
                                <ul class="list-group">
                                  <li class="list-group-item">
                                    <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Code : &nbsp;<b>'.$key['code'].'</b></li>
                                  <li class="list-group-item">
                                    <i class="fa fa-clock-o green-color"></i>&nbsp;
                                      Nombre d\'heures :&nbsp; <b>'.$key['duration'].' H</b></li>
                                </ul>';
                                $id = $key['id'];
                          include "panel_footer_choice.php";
                        echo '</div>';
                        $k++;
                      }
                    }
                    else{
                      echo '<div class="panel panel-success" style="border-radius:0px; margin-left: 17px">
                                <div class="panel-heading">'.mb_strtoupper($key['label']).'</div>
                                <ul class="list-group">
                                  <li class="list-group-item">
                                    <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Code : &nbsp;<b>'.$key['code'].'</b></li>
                                  <li class="list-group-item">
                                    <i class="fa fa-clock-o green-color"></i>&nbsp;
                                      Nombre d\'heures :&nbsp; <b>'.$key['duration'].' H</b></li>
                                </ul>';
                                $id = $key['id'];
                          include "panel_footer_choice.php";
                        echo '</div>';
                      $k=0;
                    }
                    echo '</div>';
                }
              ?>
              </div>   
            </form>
          </div>
        </div>
      </div>
  </div><br>
</body>
</html>
