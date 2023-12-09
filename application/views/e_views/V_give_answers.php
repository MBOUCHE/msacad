<div class="content-wrapper py-3">
<?php
  if ($id_training >=1) {
    $training = mb_strtoupper($this->db->where('id', $id_training)->get('lesson')->row()->label);
  }
  $name_mod = mb_strtoupper($this->db->where('id_mod', $id_mod)->get('e_module_teach')->row()->label_mod);
  $title_chap = mb_strtoupper($this->db->where('id_chap', $id_chap)->get('e_chapter')->row()->title_chap);
?>
    <div class="container-fluid">
      <div class="row">
        <div class="h4 text-center  col-sm-10">
            <?php echo 'FORMATION : '; if (isset($training)) { echo $training;
            } echo '<hr>' ; ?>
            <?php echo 'MODULE : '.$name_mod.'<hr>CHAPITRE : '.$title_chap ; ?>
            <hr width="60%" style="margin: auto; margin-top: 10px">
        </div>
          <img src="<?php echo base_url().'assets/img/logo/logo-sm.png' ?>" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 112px; height: 112px;float: right;">
      </div>
        <div class="row">
          <div class="h4 text-center  col-sm-10">
            <?php echo ' Pour chaque réponse fausse : - '.$point_if_felt.'[point(s)]'; ?>
              <hr width="60%" style="margin: auto; margin-top: 10px">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo base_url().'e_controllers/c_space_works/sendWork/'.$id_exo.'/'.$point_if_felt.'/'.sizeof($list_questions).'/'.$id_training.'/'.$id_mod.'/'.$id_chap ;?>" method="post">
            <div class="row">
<?php
  $i_q = 0;
  $k = -1;
  $nb_mod = 0;
  foreach ($list_questions as $key) {

    echo '<div class="col-md-6">';
          echo ' <div class="dropdown">
                  <button class="btn btn-default " type="button" style="width: 503px; margin: 13px; background-color: lightblue;">
                    '.$key['num_qst'].') <label>'.$key['question'].'</label>
                    <label style="float : right; margin-top: -31px; color: blue;">
                            '.$key['point'].'point(s)
                    <label>
                  </button>
                  <ol aria-labelledby="dropdownMenu1" style="width: 503px; margin-left: 13px">'; 
                  $ar =  $this->CaseLearners->listIsAswrs($key['id_question']);
                    foreach ($ar as $key1) {
                      echo '
                        <li>
                          <label style="margin-left: 13px;">
                            <input type="radio" name="answer'.$i_q.'" value='.$key1['proposition'].' style="margin-right: 26px">'.$key1['proposition'].'
                          <label>
                        </li><br>';
                    }
                    $i_q++;
              echo '</ol>';
            echo '</div>';
        echo '</div>';
    }

?>

        </div>
        <div class="row">
          <button class="btn btn-success" style="width: 305px; margin-left: 404px; border-radius: 0px" type="submit">
            Soumettre vos réponses
          </button>

        </div>
      </form>
    </div>
  </div>
</body>
</html>