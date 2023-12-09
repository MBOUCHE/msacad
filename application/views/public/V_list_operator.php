<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
<?php include_once "e_top_menu.php";?>

<?php include_once "e_left_menu.php";?>

      <div class="col-md-10" style="margin-left: -25px;">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul class="list-group" style="text-align: center;">
              <li class="list-group-item"><h2>LISTE DE NOS OPERATEURS MONETAIRES</h2></li>
            </ul>
              <div class="row">
<?php 
$k = -1;
foreach ($rslt_list as $key) {
  echo '<div class="col-md-2" style="width: 193px; height: 193px; margin-top: 13px;">';
  if ($k < 3) {
    if ($key['type_op']=='Banquaire') {
      echo '<div class="panel panel-primary" style="border-radius:0px;">
              <div class="panel-heading"><label>'.$key['numbers_used'].'</label></div>
              <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 134px; height: 134px;" class="img-responsive img-cercle"></li>
            </div>';
      $k++;
    }
    else{
      echo '<div class="panel panel-primary" style="border-radius:0px;">
              <div class="panel-heading"><label>'.$key['numbers_used'].'</label></div>
              <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 134px; height: 134px;" class="img-responsive img-cercle"></li>
            </div>';
      $k = 0;
    }
    echo '</div>';
  }
}  
?>
            </div>
          </div>
        </div>
      </div>
  </div><br><br>
<?php
  include_once "e_before_footer.php";
?>
</body>
</html>
