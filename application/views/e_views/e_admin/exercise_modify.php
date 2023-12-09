
    <script type="text/javascript" charset="utf-8" async defer>
      function voir(id){
        if (document.getElementById(id).className == 'panel-body hidden') {
          document.getElementById(id).className = 'panel-body';
          document.getElementById('button'+id).className = "glyphicon glyphicon-chevron-up";
        }else{
          document.getElementById(id).className = 'panel-body hidden';
          document.getElementById('button'+id).className = "glyphicon glyphicon-chevron-down";
        }
      }

      function refer(){
        //alert(document.getElementById('reference').value);
        if (document.getElementById('reference').value == '0') {
          document.getElementById('group').className = 'hidden';
          document.getElementById('id_chap').value = 'N/A';
        }else{
          document.getElementById('group').className = '';
        }
      }
    </script>

<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        if (isset($_SESSION['update_exercise_info'])) {
          echo '<div class="form-group">'.$_SESSION['update_exercise_info'].'</div>';
        }
        if (isset($_SESSION['delete_question_info'])) {
          echo '<div class="form-group">'.$_SESSION['delete_question_info'].'</div>';
        }

        echo '<div><a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/" class="btn btn-danger form-group"><span class="glyphicon glyphicon-arrow-left"></span> Back to the exercise\'list</a></div>';
        echo br();

          echo '<div class="alert">';
          echo '<div class="form-group row">';
          echo '<div class="btn btn-default col-lg-6">';
          echo heading('EXERCISE\'LABEL : '.$exercise->ex_label, 5);
          echo '</div>';
          echo '<div class="btn btn-default col-lg-3">';
          echo heading('TYPE : '.$exercise->ex_type, 5);
          echo '</div>';
          echo '<div class="btn btn-default col-lg-3" >';
          echo heading('CHAPTER : '.$exercise->id_chap, 5);
          echo '</div>';
          echo '</div>';

          echo '<div class="row">';
          echo '<div class="btn btn-default col-lg-6">';
          echo heading('TOTAL QUESTIONS : '.$exercise->number_question, 5);
          echo '</div>';
          echo '<div class="btn btn-default col-lg-6">';
          echo heading('TOTAL POINTS : '.$exercise->ex_point, 5);
          echo '</div>';
          echo '</div>';
          echo '</div>';

          echo heading('Modify Exercise', 2);


          echo '<div id="group" class="alert" >';
          echo form_open('index.php/e_controllers/e_admin/exercise_manager/modify_exercise');

          echo form_input(array('name' => 'id_exercise' , 'type' => 'text' , 'value' => $exercise->id_exercise , 'class' => 'form-group form-control' ));

          echo 'Select Chapters : '.form_dropdown('id_chap', $chapter , $exercise->id_chap , 'id="id_chap" class="form-control"' );
          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/modify_lesson/" class="form-group form-control alert-warning" onclick="return confirm( \' Voulez vous vraiment quitter cette page??! \' ) ; " >Click To Create A Chapter &raquo;</a>';
          echo form_input(array('name' => 'ex_label' , 'type' => 'text' , 'value' => $exercise->ex_label , 'class' => 'form-group form-control' ));
          if ($exercise->ex_type == 'QRU') {
            echo '<div id="point" class="" >Point if felt : '.form_dropdown('point_if_felt', array(  '1' => '-1', '0.5' =>'-0,5', '0.25' =>'-0,25' ,'0'=>'0' ) , $exercise->point_if_felt , 'id="point2" class="form-group form-control"' ).'</div>';
          }
          echo form_button( array('name' => 'update_exercise' , 'content' => 'Update exercise <span class="glyphicon glyphicon-retweet" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );

          echo form_close();
          echo '</div>';


          echo heading('QUESTIONS ASSOCIATED (Click To Modify)', 4);

          echo '<div><a href="#hide" class="btn btn-primary form-group"  ><span class="glyphicon glyphicon-plus"></span> Add question to this exercise</a></div>';

          ?>
          
          <div class="alert">

          <?php

          if (isset($question_list)) {
          
          for ( $info = 0 ; $info < $exercise->number_question ;  $info++ )
          {            
        ?>
            <div class="panel panel-default">
              <div class="panel-heading" onclick = "voir(<?=$info ?>)">
                <div class="row">
                <?php
                if (isset($_SESSION['update_question_info'.$question_list[$info]->id_question])) {
                  echo '<div>'.$_SESSION['update_question_info'.$question_list[$info]->id_question].'</div>';
                }
                
                echo '<div class="col-lg-9" style="text-align:left" >';
                if( $exercise->number_question == 1){
                  echo '<a class="alert-default" onclick="alert(\'Cannot delete the last question... But you can delete the exercise\');"><span class="glyphicon glyphicon-remove" title="Cannot delete the last question... But you can delete the exercise"></span></a>';
                }else{
                  echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/delete_question/'.$exercise->id_exercise.'/'.$question_list[$info]->id_question.'" class="alert-danger" ><span class="glyphicon glyphicon-remove" title="delete this question..."></span></a>';
                }
                echo 'Question :<em>"'.$question_list[$info]->question.'"</em></div>';
                echo '<div class="col-lg-3" style="text-align:right">Point : <em class="">'.$question_list[$info]->point.' </em><span id="button'.$info.'" class="glyphicon glyphicon-chevron-down" ></span></div>';
                ?> 
                </div>              
              </div>
              <div class="panel-body hidden" id=<?=$info; ?> >
                <blockquote style="font-size: 13px">
                  <?php
                  // echo validation_errors('<div class= "alert-warning">', '</div>');
                    echo form_open('index.php/e_controllers/e_admin/exercise_manager/modify_question');

                    echo form_input(array('name' => 'id_question' , 'id'=>'question' , 'type' => 'text' , 'value' =>$question_list[$info]->id_question , 'class' => 'form-group form-control' ));
                    echo form_input(array('name' => 'type_question' , 'id'=>'type_question' , 'type' => 'text' , 'value' =>$question_list[$info]->type_question , 'class' => 'form-group form-control' ));
                    echo form_input(array('name' => 'id_exercise' , 'id'=>'id_exercise' , 'type' => 'text' , 'value' =>$question_list[$info]->id_exercise , 'class' => 'form-group form-control' ));

                    echo form_label('Question','question');
                    echo form_input(array('name' => 'question'.$question_list[$info]->id_question , 'id'=>'question' , 'type' => 'text' , 'value' =>$question_list[$info]->question , 'class' => 'form-control' ));
                    echo form_error('question'.$question_list[$info]->id_question,'<div class="form-control alert-warning">', '</div>');

                    echo form_label('Answer','answer');
                    echo form_input(array('name' => 'answer'.$question_list[$info]->id_question , 'id'=>'answer' , 'type' => 'text' , 'value' =>$question_list[$info]->answer , 'class' => 'form-control' , 'size'=>'1' ));
                    echo form_error('answer'.$question_list[$info]->id_question,'<div class="form-control alert-warning">', '</div>');
                    

                    if ($question_list[$info]->type_question =='QRU') {

                      echo form_label('Prop 1.','prop1');
                      echo form_input(array('name' => 'prop1'.$question_list[$info]->id_question , 'id'=>'prop1' , 'type' => 'text' , 'value' =>$question_list[$info]->prop1 , 'class' => 'form-control' ));
                      echo form_error('prop1'.$question_list[$info]->id_question,'<div class="form-control alert-warning">', '</div>');

                      echo form_label('Prop 2','prop2');
                      echo form_input(array('name' => 'prop2'.$question_list[$info]->id_question , 'id'=>'prop2' , 'type' => 'text' , 'value' =>$question_list[$info]->prop2 , 'class' => 'form-control' ));
                      echo form_error('prop2'.$question_list[$info]->id_question,'<div class="form-control alert-warning">', '</div>');

                      echo form_label('Prop 3','prop3');
                      echo form_input(array('name' => 'prop3'.$question_list[$info]->id_question , 'id'=>'prop3' , 'type' => 'text' , 'value' =>$question_list[$info]->prop3 , 'class' => 'form-control' ));
                      echo form_error('prop3'.$question_list[$info]->id_question,'<div class="form-control alert-warning">', '</div>');
                      
                    }

                    echo form_label('Points + :','prop3');
                    echo 'Points + : '.form_dropdown('point'.$question_list[$info]->id_question , array( 1=>'+1', 2=>'+2', 3=>'+3', 4=>'+4', 5=>'+5' ) , $question_list[$info]->point , 'id="type" class="form-group form-control"' );

                    echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/delete_question/'.$exercise->id_exercise.'/'.$question_list[$info]->id_question.'" class="btn btn-danger" ><span class="glyphicon glyphicon-remove" title="delete this question..."></span> Delete this question </a>';
                    echo form_button( array('name' => 'update_question' , 'content' => 'Update this question <span class="glyphicon glyphicon-retweet" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );



                    echo form_close();
                  ?>

                </blockquote>
              </div>
            </div>
        <?php
          }

          }else{
            echo "No question already added...";
          }

          ?>
          </div>

          <hr>

          <?php
          
          echo form_button( array('name' => '' , 'content' => '<span class="glyphicon glyphicon-plus" ></span> Click to add question' , 'type' => 'button' , 'class' => 'btn form-group btn-default' , 'id'=>'hide') );

          echo '<div class="alert" id="add">';
          echo heading('Adding New Question', 4);
          
          echo form_open('index.php/e_controllers/e_admin/exercise_manager/add');

          echo '<blockquote style="font-size:13px;">';
          if ($exercise->ex_type == "QRO") {
            include 'QRO.php';
          }elseif ($exercise->ex_type == "QRU") {
            include 'QRU.php';
          }
          echo '</blockquote>';
          
          echo form_input(array('name' => 'id_exercise' , 'type' => 'hidden' , 'value' => $exercise->id_exercise , 'class' => ' form-control' ) );
          echo form_input(array('name' => 'type_question' , 'type' => 'hidden' , 'value' => $exercise->ex_type , 'class' => ' form-control' ) );
          
          echo form_button( array( 'content' => '<span class="glyphicon glyphicon-refresh" ></span> Reset' , 'type' => 'reset' , 'class' => 'btn form-group btn-success' ) );
          echo form_button( array('name' => 'add_question' , 'content' => 'Add New Question <span class="glyphicon glyphicon-plus" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );

          echo form_close();
          echo '</div>';

          echo '<div><a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/delete_exercise/'.$exercise->id_exercise.'" class="btn btn-danger form-group" onclick="return confirm(\'Are you really want to delete -'.$exercise->ex_label.'- Exercise?\') && confirm(\'This will delete all exercises associated...!!?\'); " ><span class="glyphicon glyphicon-remove"></span> Delete this exercise</a></div>';

        ?>

    </div>

      
</div>