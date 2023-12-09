<?php

  $l = $this->db->where('id', $id_training)->get('lesson')->result_array(); 
  foreach ($l as $key) {
    $tr = mb_strtoupper($key['label']);
  }
  $mt = $this->db->where('id_mod', $id_mod)->get('e_module_teach')->result_array(); 
  foreach ($mt as $key) {
    $mod = mb_strtoupper($key['label_mod']);
  }
?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
          <div class="h4 text-center  col-sm-10">
              <a href="<?php echo base_url().'e_controllers/c_space_works/readingCourses/'.$id_mod.'/'.$name_mod.'/'.$training.'/'.$id_training; ?>" style="float: left;">
                <button type="button" class="btn btn-info glyphicon glyphicon-circle-arrow-left" style="border-radius:0px;">
                  <span>Retour</span>
                </button>
              </a>
              <?php echo 'FORMATION : '.strtoupper($tr).'<hr>' ;
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
          <div class="h4 text-center  col-sm-12">
              <?php echo 'MODULE : <label>'.mb_strtoupper($mod).'</label>' ; ?>
              <hr width="85%" style="margin: auto; margin-top: 10px">
          </div>
        </div>
<?php
	foreach ($content as $key) {

    $cp = $this->db->where('id_chap', $id_chap)->get('e_chapter')->result_array(); 
    foreach ($cp as $ke) {
      $chap = strtoupper($ke['title_chap']);
      $content = $ke['content'];
    }

		echo '
		<div class="panel panel-primary">
		  	<div class="panel-heading"><h4>CHAPITRE '.$key['num_chap'].' : <label>'.mb_strtoupper($chap).'</label></h4></div>
		  	<div class="panel-body">
		     '.$key['content'].'
		  	</div>
		  	<div class="panel-footer">
		  		<a href="'.base_url().'e_controllers/c_space_works/doExercises/'.$key['id_chap'].'/'.$name_mod.'/'.$training.'/'.$key['title_chap'].'/'.$id_training.'/'.$id_mod.'">
			      	<button type="button" class="btn btn-info" style="border-radius:0px;">
			        	<span>EXERCICES</span>
			      	</button>
        		</a>
        		<a href="'.base_url().'e_controllers/c_space_works/referenceCourses/'.$id_mod.'/'.$name_mod.'/'.$training.'/'.$id_training.'">
			      	<button type="button" class="btn btn-info" style="border-radius:0px; float: right;">
			        	<span>COMPLEMENTS DU COURS</span>
			      	</button>
			    </a>
		  	</div>
		</div>';
	}
?>
  		</div>
</body>
</html>