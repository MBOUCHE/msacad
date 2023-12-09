<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
<?php include_once "e_top_menu.php";?>

<?php include_once "e_left_menu.php";?>

      <div class="col-md-10" style="margin-left: -22px;width: 67%;">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul class="list-group" style="text-align: center;">
              <li class="list-group-item"><h2>LISTE DES FORMATIONS PROMOTIONELLES EN LIGNE</h2></li>
            </ul>
            <form action='choiceTraining' method="post">
              <div class="row">
              <?php

                  $k = -1;
                  foreach ($list_training as $key) {
                    echo '<div class="col-md-4">';
                    if ($k < 3) {
                      if ($key['type']=='promotion') {
                        echo '<div class="panel panel-success" style="border-radius:0px;">
                                <div class="panel-heading">'.$key['label'].'</div>
                                <ul class="list-group">
                                  <li class="list-group-item">'.$key['path_img'].'img</li>
                                  <li class="list-group-item">'.$key['duration'].'</li>
                                </ul>';
                                $id = $key['id'];
                                $actual_page = 'list_lesson3';
                          include "panel_footer_choice.php";
                        echo '</div>';
                        $k++;
                      }
                    }
                    else{
                      echo '<div class="panel panel-success" style="border-radius:0px;">
                              <div class="panel-heading">'.$key['label'].'</div>
                              <ul class="list-group">
                                <li class="list-group-item">'.$key['path_img'].'img</li>
                                <li class="list-group-item">'.$key['duration'].'</li>
                              </ul>';
                              $actual_page = 'list_lesson3';
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
<?php
  include_once "e_before_footer.php";
?>
</body>
</html>
