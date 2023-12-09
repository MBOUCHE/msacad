    <script type="text/javascript" charset="utf-8" async defer>
      function voir(){
        if (document.getElementById('add').className == 'hidden') {
          document.getElementById('add').className = '';
          document.getElementById('button').className = "glyphicon glyphicon-chevron-up";
        }else{
          document.getElementById('add').className = 'hidden';
          document.getElementById('button').className = "glyphicon glyphicon-chevron-down";
        }
      }

      function modify(id){
        if (document.getElementById('modify'+id).className == 'hidden') {
          document.getElementById('modify'+id).className = '';
          document.getElementById('button_modify'+id).className = "glyphicon glyphicon-chevron-up";
        }else{
          document.getElementById('modify'+id).className = 'hidden';
          document.getElementById('button_modify'+id).className = "glyphicon glyphicon-chevron-down";
        }
      }

      function view_all(id){
        if (document.getElementById('small'+id).className == "hidden") {
          document.getElementById('small'+id).className = "";
          document.getElementById('all'+id).className = "hidden";
        }else{
          document.getElementById('small'+id).className = "hidden";
          document.getElementById('all'+id).className = "";
        }
      }
    </script>

    <script src="<?php echo js_url('ckeditor-full/ckeditor')?>"></script>
 
<div class="content-wrapper py-3">

  <div class="container-fluid">

        <?php
        echo form_fieldset('Informations about chapter and else...');

        echo br();
        if (isset($this->session->info)) {
          echo '<div class="alert alert-info" >'.$this->session->info.'</div>';
        }

        echo form_fieldset('Lesson Details');
        echo '<div class="row" >';
        echo '<div class="col-lg-1" >'.form_label('Label: ').'</div><div class="col-lg-11" >'.$lesson->label.'</div>';
        echo '</div>';
        echo '<div class="row" >';
        echo '<div class="col-lg-1" >'.form_label('Code: ').'</div><div class="col-lg-11" >'.$lesson->code.'</div>';
        echo '</div>';
        echo '<div class="row" >';
        echo '<div class="col-lg-1" >'.form_label('Syllabus: ').'</div><div class="col-lg-11" >'.$lesson->syllabus.'</div>';
        echo '</div>';
        echo form_fieldset_close();

        echo form_fieldset('List of Last chapters ');
        if ( ! empty($chapter->result()) ) {
          foreach ($chapter->result() as $info) {

            echo '<div class="panel panel-primary">';

            echo '<div class="panel-heading" >';
            echo "Chapter No ".$info->num_chap." : ".$info->title_chap;
            echo br()."Added the : ".$info->date.br()."Last modification : ".$info->last_modify;

            echo '</div>';

            echo '<div class="panel-body" >';
            echo '<div id="small'.$info->id_chap.'" class="" >';
            echo character_limiter( $info->content , 50 ).'...<div onclick="view_all('.$info->id_chap.')" class="btn"><i class="fa fa-eye fa-1x w3-text-green"> view all</i></div>';
            echo '</div>';
            echo '<div id="all'.$info->id_chap.'" class="hidden" >';
            echo '<div onclick="view_all('.$info->id_chap.')" class="btn"><i class="fa fa-eye-slash fa-1x w3-text-orange"> Not view all</i></div>';
            echo $info->content;
            echo '</div>';
            echo '</div>';

            echo '<div class="panel-footer" >';
            echo '<a href="'.base_url().'index.php/e_controllers/e_admin/modify_lesson/delete/'.$info->id_lesson.'/'.$info->id_chap.'" class="form-group btn btn-warning" ><i class="fa fa-remove fa-1x w3-text-red"></i> Delete this Chapter</a> ';

            echo form_button('','<span id="button_modify'.$info->id_chap.'" class="glyphicon glyphicon-chevron-down" ></span><i class="fa fa-edit fa-1x"></i> Proceed to the Modification of the Chapter', array('class' => 'form-group btn btn-success' , 'onclick' => 'modify('.$info->id_chap.')'));
            if ($info->status == 0 ) {
              echo '<a href="'.base_url().'index.php/e_controllers/e_admin/modify_lesson/activate/'.$lesson->id.'/'.$info->id_chap.'/1" class="btn form-group" ><i class="fa fa-eye fa-1x"></i> Click to activate </a>';
            }else{
              echo '<a href="'.base_url().'index.php/e_controllers/e_admin/modify_lesson/activate/'.$lesson->id.'/'.$info->id_chap.'/0" class="btn form-group" ><i class="fa fa-eye-slash fa-1x"></i> Click to desactivate </a>';
            }

            echo '<div id="modify'.$info->id_chap.'" class="hidden" onclick="modify()">';

              echo form_open('e_controllers/e_admin/modify_lesson/modify');
              echo form_input(array('name' => 'id_chap', 'class' => 'form-control form-group' , 'type' => 'text' , 'value' => $info->id_chap));
              echo form_input(array('name' => 'id_lesson', 'class' => 'form-control form-group' , 'type' => 'number' , 'value' => $info->id_lesson));

              echo form_label('Chapter\'number (it\'s auto increment)','number');
              echo form_input(array('name' => 'num_chap', 'id' => 'number', 'class' => 'form-control' , 'type' => 'number' , 'required' => true , 'value' => $info->num_chap));
                    echo form_error('num_chap','<div class="alert-warning">', '</div>');

              echo form_label('Enter the name of the chapter','name');
              echo form_input(array('name' => 'title_chap', 'id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Chapter\'name...' , 'required' => true , 'value' => $info->title_chap));
                    echo form_error('title_chap','<div class="alert-warning">', '</div>');

              echo form_label('Enter the content of the chapter','content');
              echo form_textarea(array('name' => 'content', 'id' => 'content', 'class' => 'form-control', 'placeholder' => 'Enter Chapter\'content...' , 'required' => true , 'value' => $info->content));
                    echo form_error('content','<div class="alert-warning">', '</div>');

              echo form_button( array('name' => 'modify' , 'content' => '<span class="glyphicon glyphicon-pencil" ></span> Modify or Update Chapter' , 'type' => 'submit'  , 'class' => 'form-control form-group btn-primary' ) );

              //echo form_submit('modify','<span class="glyphicon glyphicon-plus" ></span> Modify/Update Chapter', array('class' => 'form-control form-group btn-primary'));
              echo form_close();
            echo '</div>';

            echo '</div>';


            echo '</div>';
          }
          
        }else{
          echo '<div class="alert alert-warning form-group">No chapter of this lessons exists</div>';
        }
        echo form_fieldset_close();


        echo form_button('','<span id="button" class="glyphicon glyphicon-chevron-down" ></span><i class="fa fa-plus fa-1x"></i> Add a chapter', array('class' => 'form-control form-group btn-primary' , 'onclick' => 'voir()'));

        echo '<div id="add" class="hidden" >';

          echo form_open('e_controllers/e_admin/modify_lesson/add_chapter');

          // echo validation_errors('<div class="alert-danger">', '</div>');

          echo form_input(array('name' => 'id_lesson', 'class' => 'form-control form-group' , 'type' => 'number' , 'value' => $lesson->id));

          if (isset($_POST['num_chap']) && isset($_POST['title_chap']) && isset($_POST['content']) ) {
            $default = array(
                      'num_chap'=>$_POST['num_chap'],
                      'title_chap'=>$_POST['title_chap'],
                      'content'=>$_POST['content']
                    );
          }else{
            $default = array(
                      'num_chap'=>'',
                      'title_chap'=>'',
                      'content'=>'',
                    );
          }
          echo form_label('Chapter\'number (it\'s auto increment)','number');
          echo form_input(array('name' => 'num_chap', 'id' => 'number', 'class' => 'form-control' , 'type' => 'number' , 'required' => true , 'value' => set_value('num_chap') /* $default['num_chap'] */ ));
          echo form_error('num_chap','<div class="form-control form-group alert-warning">', '</div>');

          echo form_label('Enter the name of the chapter','name');
          echo form_input(array('name' => 'title_chap', 'id' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter Chapter\'name...' , 'required' => true , 'value' => set_value('title_chap') /* $default['title_chap'] */ ));
          echo form_error('title_chap','<div class="form-control form-group alert-warning">', '</div>');


          echo form_label('Enter the content of the chapter','content');
          echo form_textarea(array('name' => 'content', 'id' => 'content', 'class' => 'form-control', 'placeholder' => 'Enter Chapter\'content...' , 'required' => true , 'value' => set_value('content') /*$default['content']*/ ));
          echo form_error('content','<div class="form-control form-group alert-warning">', '</div>');

          echo form_button( array('name' => 'save' , 'content' => '<span class="glyphicon glyphicon-save" ></span> Save Chapter' , 'type' => 'submit'  , 'class' => 'form-control form-group btn-primary' ) );

          echo br(2);

          //echo form_submit('save','<span class="glyphicon glyphicon-plus" ></span> Save Chapter', array('class' => 'form-control form-group btn-primary glyphicon glyphicon-plus'));

          echo form_close();

        echo '</div>';

        echo form_fieldset_close();

        ?>

  </div>

  <script>
        $(document).ready(function(){
            alm('collapseEns',4);
            CKEDITOR.replace('content');
        });
    </script>

     
</div>