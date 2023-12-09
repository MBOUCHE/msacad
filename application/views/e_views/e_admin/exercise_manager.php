
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >

<div class="content-wrapper py-3">

  <div class="container-fluid" style="text-align: ; position:"> 

        <?php
          echo heading('Exercice Manager', 2);

          echo '<hr style="width:50%; position:center;">';

          echo heading('Create an Exercise',4);
          echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/add/" class="form-group form-control btn btn-warning" ><i class="fa fa-plus fa-1x"></i> Add exercise</a>';

          echo "<hr>";


          if(isset($_SESSION['delete_exercise_info'])){
            echo '<div> '.$_SESSION['delete_exercise_info'].'</div>';
          }

          if(isset($_SESSION['info'])){
            echo '<div class="alert" > '.$_SESSION['info'].'</div>';
          }

          if($list_lesson != false)
          {

          $option = array('all'=>'All**('.count( $this->exercise->get_all_exercise() ).')exercise(s)',
                        null=>'Anonymous**('.count( $this->exercise->get_exercise_lesson(null) ).')exercise(s)'
                      );
          foreach ($list_lesson as $lesson) {
            $number_exercise = count($this->exercise->get_exercise_lesson($lesson['id']) );
            $option[$lesson['id']] = character_limiter(character_limiter($lesson['label'] , 10).'**('.$number_exercise.')exercise(s)', 20);
          }

          echo form_open('index.php/e_controllers/e_admin/exercise_manager' , 'class="form-inline form-group"');
          echo '<div class="form-group">';

          echo 'Select lesson ';
          echo form_dropdown('id_lesson' , $option , set_value('id_lesson','all') , 'class="form-control"' );

          echo form_submit('search_exercise','search exercises!!' , 'class="btn btn-default" ');

          echo '</div>';
          echo form_close();

          }else{
            echo '<div><a href="'.base_url().'index.php/e_controllers/e_admin/test_manager/" class="btn btn-danger form-group"><i class="fa fa-arrow-left fa-1x"></i> Back to the test\'list</a></div>';
          }


          echo heading('List of exercise', 4);

          if(count($exercise) != 0)
          {


          foreach ($exercise as $info)
          {
            $details = $this->exercise->get_exercise_details($info->id_exercise);

        ?>

            <div class="panel panel-primary form-group">
              <div class="panel-heading">
                <div class="row">
                <?php
                  echo '<div class="col-lg-4" >Exercise Name :<em>"'.$info->ex_label.'"</em></div>';
                  echo '<div class="col-lg-4" >  Added by id_user:<em>"'.$details['added_by'].'"</em></div>';
                  echo '<div class="col-lg-4" >  Last modification :<em>"'.$info->date_modify.'"</em></div>';
                ?> 
                </div>              
              </div>
              <div class="panel-body">
                  <div class="form-group row">
                    <label class="btn btn-default">
                      Type : <?php echo $info->ex_type ?>
                    </label>
                    <label class="btn btn-default">
                      Reference Lesson: <?php echo $details['lesson_label'] ?>
                    </label>               
                    <label class="btn btn-default">
                      Reference Chapter: <?php echo $details['title_chap'] ?>
                    </label>
                  </div>
                  <div class="row">
                    <label class="btn btn-default">
                      Number of Question : <?php echo $info->number_question ?>
                    </label>
                    <label class="btn btn-default">
                      Exercise points : <?php echo $info->ex_point ?>
                    </label>
                    <label class="btn btn-default"><i class="fa w3-text-red">
                      Points if Failt : -<?php echo $info->point_if_felt ?></i>
                    </label>
                  </div>
              </div>
              <div class="panel-footer">
                <?php
                include 'exercise_action.php' ;
                ?>
              </div>
            </div>
        <?php
          }

          }else{
            echo '<div class="alert alert-warning form-group">Empty list !!</div>';
          }

          echo heading('Create an Exercise',4);
          echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/add/" class="form-group form-control btn btn-warning" ><i class="fa fa-plus fa-1x"></i> Add exercise</a>';

        ?>
    </div>

</div>

<?php 
echo '<pre>';
// set_flash_data('Some error are occured...!!');
// $this->session->set_flashdata('test' , 'Some error are occured...!!');
// $_SESSION['test'] = 'ceci est un test';
echo print_r($_SESSION);
echo '</pre>';
 ?>
