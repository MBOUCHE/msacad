
<div class="panel panel-default">
    <div class="panel-body">
    <div class="panel panel-success h4" style="width: 81%; float: right;">
      <a class="btn btn-info glyphicon glyphicon-circle-arrow-left" href="<?php $id_user = session_data('id'); echo base_url().'e_controllers/c_take_courses/seeTheme/'.$id_user ;?>"><span class="btn btn-info" style="border-radius: 0px; text-decoration: none;"></span>Retour</a>
      <?php 
        if (sizeof($this->db->where('id_user', session_data('id'))->where('id_ex', $id_theme)->get('e_work_exo')->result_array())==0) {
          echo '
            <a class="btn btn-info" style="text-decoration: none; color: white; float: right;" href="'.base_url().'e_controllers/c_space_works/selectTheme/'.$id_theme.'/'.$id_lesson.'/'.$id_user.'">
              <span aria-hidden="true">Faire la demande de ce thème et patienter </span>
            </a>';
        }
        $name_theme=$this->db->where('id_exercise', $id_theme)->get('e_exercise')->row()->ex_label;
        $id_trainer=$this->db->where('id_exercise', $id_theme)->get('e_exercise')->row()->id_user;
        $name_trainer=$this->db->where('id', $id_trainer)->get('user')->row()->lastname;
      ?>
      <div class="panel-heading">
        <label > <?php echo 'Details portants sur : '.mb_strtoupper($name_theme);?></label>
      </div>
      <div class="panel-body">
        <p>
        <?php 
          foreach ($details as $key) {
            echo '<H4 style="color: blue;">'.$key['path_correction'].'</H4>';   
        ?>
        </p>
      </div>

      <ul class="list-group">
        <li class="list-group-item">
        </li>
        <li class="list-group-item">Proposé par : 
          <label> 
            <?php echo $name_trainer;?>
          </label>
        </li>
        <li class="list-group-item">
          <label style="color: blue;">
            Compte pour :<?php echo ' <label style="color: red"> 15 % </label>'; ?> de la note finale.
          </label>
          <label style="color: green; float: right;">
            Approuvé par la direction 
        <?php 
          echo '<br><u> (Le '.moment($key['date_modify'])->format(' d / M / Y').' ) </u>';
          } 
        ?>
        <img src="<?php echo base_url().'assets/img/logo/logo-sm.png' ?>" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 35px; height: 35px;float: right; margin-top: 8px">
          </label>
        </li>
      </ul>
    </div>
  </div>
</div>