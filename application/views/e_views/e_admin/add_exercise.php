    <script type="text/javascript" charset="utf-8" async defer>
      function voir(){
        //alert(document.getElementById('type').value);
        if (document.getElementById('type').value == 'QRO') {
          document.getElementById('point').className = 'hidden';
          document.getElementById('point2').value = '0';
        }else{
          document.getElementById('point').className = '';
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
      // function chapter(){
        // alert(document.getElementById('lesson').value);
        // var index = document.getElementById('lesson').value;

        // return index;
      // }
    </script>

<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/" class="alert btn-danger form-group"><span class="glyphicon glyphicon-arrow-left"></span> Back to the exercise\'list</a>';

          echo heading('Creating Exercise', 2);

          echo form_open('index.php/e_controllers/e_admin/exercise_manager/add');
          
          echo form_input(array('name' => 'id_user' , 'type' => 'hidden' , 'value' => session_data('id') , 'class' => 'form-group form-control' ));
          if (isset($_SESSION['exercise'])) {
            $default_name = $_SESSION['exercise']['ex_label'];
            $default_type = $_SESSION['exercise']['ex_type'];
            $default_point = $_SESSION['exercise']['point_if_felt'];
            $default_chapter = $_SESSION['exercise']['id_chap'];
          }else{
            $default_name = 'exercise name';
            $default_type = '';
            $default_point = '0';
            $default_chapter = null;
          }
          
          echo 'Reference* : '.form_dropdown('reference', array('0'=>'Anonymous', '1'=>'choose lesson...' ) , '0' , 'id="reference" onchange="refer();"  class="form-group form-control" ' );

          echo '<div id="group" class="hidden" >';
          // echo 'Lesson* : '.form_dropdown('lesson', $lesson , $default_type , 'id="lesson" class="form-group form-control"  onchange="chapter();" ' );
          echo 'Select Chapters : '.form_dropdown('id_chap', $_SESSION['chapter'] , $default_chapter , 'id="id_chap" class="form-control"' );
          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/modify_lesson/" class="form-group form-control alert-warning" onclick="return confirm( \' Voulez vous vraiment quitter cette page??! \' ) ; " >Click To Create A Chapter &raquo;</a>';
          echo '</div>';

          echo form_input(array('name' => 'ex_label' , 'type' => 'text' , 'value' => $default_name , 'class' => 'form-group form-control' ));
          echo 'Exercise\'type* : '.form_dropdown('ex_type', array('QRO'=>'QRO', 'QRU'=>'QRU' ) , $default_type , 'id="type" onchange= "voir();" class="form-group form-control"' );
          /*echo 'Exercise\'type : 
          <select class="form-group form-control" onclick="voir()" id="type">
            <option value="QRO">QRO</option>
            <option value="QRU">QRU</option>
          </select>
          ';*/
          echo '<div id="point" class="hidden" >Point if felt : '.form_dropdown('point_if_felt', array(  '1' => '-1', '0.5' =>'-0,5', '0.25' =>'-0,25' ,'0'=>'0' ) , $default_point , 'id="point2" class="form-group form-control"' ).'</div>';


          echo '<a href="'.base_url().'/index.php/e_controllers/e_admin/exercise_manager/" class="btn btn-warning form-group" ><span class="glyphicon glyphicon-remove">Cancel</a>';
          echo form_button( array('name' => 'previous' , 'content' => '<span class="glyphicon glyphicon-triangle-left" ></span> Previous' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' , 'disabled'=>true ) );
          echo form_button( array('name' => 'add_ex' , 'content' => 'Add questions <span class="glyphicon glyphicon-plus" ></span>' , 'type' => 'submit' , 'class' => 'btn form-group btn-success' ) );
          echo form_close();

        ?>
      </div>

    </div>