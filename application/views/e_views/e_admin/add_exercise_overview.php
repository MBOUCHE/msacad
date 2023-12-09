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
    </script>

<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
          echo heading('Creating Exercise', 2);
          echo '<div class="form-group row">';
          echo '<div class="btn btn-default col-lg-6">';
          echo heading('EXERCISE\'LABEL : '.$_SESSION['exercise']['ex_label'], 5);
          echo '</div>';
          echo '<div class="btn btn-default col-lg-3">';
          echo heading('TYPE : '.$_SESSION['exercise']['ex_type'], 5);
          echo '</div>';
          echo '<div class="btn btn-default col-lg-3" >';
          echo heading('CHAPTER : '.$_SESSION['exercise']['id_chap'], 5);
          echo '</div>';
          echo '</div>';

          echo '<div class="row">';

          echo '<div class="btn btn-default col-lg-6">';
          echo heading('TOTAL QUESTIONS : '.$_SESSION['exercise']['number_question'], 5);
          echo '</div>';

          echo '<div class="btn btn-default col-lg-6">';
          echo heading('TOTAL POINTS : '.$_SESSION['exercise']['ex_point'], 5);
          echo '</div>';

          echo '</div>';
          echo heading('QUESTIONS ADDED (Click To Overview)', 4);
           if (isset($_SESSION['info'])) {
             echo '<div class="alert form-group alert-info">';
             echo $_SESSION['info'];
             echo '</div>';
           }

          if (isset($_SESSION['question'])) {
            
          
          for ( $info = 0 ; $info < $_SESSION['exercise']['number_question'] ;  $info++ )
          {            
        ?>
            <div class="panel panel-default">
              <div class="panel-heading" onclick = "voir(<?=$info ?>)">
                <div class="row">
                <?php
                echo '<div class="col-lg-9" style="text-align:left" >Question :<em>"'.$_SESSION['question'][$info]['question'].'"</em></div>';
                echo '<div class="col-lg-3" style="text-align:right">Point : <em class="">'.$_SESSION['question'][$info]['point'].' </em><span id="button'.$info.'" class="glyphicon glyphicon-chevron-down" ></span></div>';
                ?> 
                </div>              
              </div>
              <div class="panel-body hidden" id=<?=$info; ?> >
                <blockquote style="font-size: 13px">
                  Answer : <?php echo $_SESSION['question'][$info]['answer'] ?><br>
                  Type : <?php echo $_SESSION['question'][$info]['type_question'] ?><br>
                  <label style="font-size: 13px" class="btn btn-warning">
                    Prop1 : <?php echo '"'.$_SESSION['question'][$info]['prop1'].'"' ?>
                  </label>
                  <label style="font-size: 13px" class="btn btn-warning">
                    Prop2 : <?php echo '"'.$_SESSION['question'][$info]['prop2'].'"' ?>
                  </label>
                  <label style="font-size: 13px" class="btn btn-warning">
                    Prop3 : <?php echo '"'.$_SESSION['question'][$info]['prop3'].'"' ?>
                  </label>
                </blockquote>
              </div>
            </div>
        <?php
          }
          }else{
            echo "No question already added...";
          }

          echo form_open('index.php/e_controllers/e_admin/exercise_manager/add');
          
          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/" class="btn btn-warning form-group" ><span class="glyphicon glyphicon-remove" > Cancel</a>';
          echo form_button( array('name' => 'previous' , 'content' => '<span class="glyphicon glyphicon-triangle-left" ></span> Previous' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );
          echo form_button( array('name' => 'add_ex_3' , 'content' => 'Add New Question <span class="glyphicon glyphicon-plus" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );
          echo form_button( array('name' => 'confirm' , 'content' => 'Confirm  <span class="glyphicon glyphicon-ok" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-primary' ) );
          //echo '<a href="'.base_url().'/index.php/exercise_manager/add" class="btn btn-success form-group" name="end" > Overview and terminate <span class="glyphicon glyphicon-triangle-right" ></span></a>';
          echo form_close();

        ?>

      </div>

  </div>