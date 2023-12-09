

<div class="content-wrapper py-3">
    <div class="container-fluid">
      <div class="row">

        <?php 

          $merde =  $this->CaseLearners->listIsQsts($id_exo);
          $pointsOfEx = 0;
          $IsNote = array();
          $IsNote = $this->CaseLearners->IsNote($id_exo);
          $training = $this->db->where('id', $id_training)->get('lesson')->row()->label;
          $name_mod = $this->db->where('id_mod', $id_mod)->get('e_module_teach')->row()->label_mod;
          $title_chap = $this->db->where('id_chap', $id_chap)->get('e_chapter')->row()->title_chap;
          foreach ($merde as $key1) {
            $pointsOfEx += $key1['point'];
          } ?>

      </div>
    </div>
    <div class="row" style="color: #ff9000">
      <div class="text-center  col-md-10">
        <?php 
          echo '<h4 class="page-title mb-3">FORMATION : '.mb_strtoupper($training).'</h4>' ;
          echo '<h4 class="page-title mb-3">CHAPITRE : '.mb_strtoupper($name_mod).'</h4>' ;
          echo '<h4 class="page-title mb-3">MODULE : '.mb_strtoupper($title_chap).'</h4>' ; 
        ?>
      </div>
    </div>
  <div class="row">
    <div class="col-md-12">
        <div class="row">
<?php
  $i_q = 0;
  $k = -1;
  $nb_mod = 0;
  foreach ($list_questions as $key) {

    echo '<div class="col-md-6">';
          echo ' <div class="dropdown">
                  <button class="btn btn-info" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 503px; margin: 13px; background-color:">
                    '.$key['num_qst'].') <label>'.$key['question'].'</label>
                    <label style="float : right; margin-top: -31px; color: blue;">
                            '.$key['point'].'point(s)
                    <label>
                  </button>
                  <ol  aria-labelledby="dropdownMenu1" style="width: 503px; margin-left: 13px">'; 
                  $ar =  $this->CaseLearners->listIsAswrs($key['id_question']);
                    foreach ($ar as $key1) {
                      if ($key1['proposition'] === $key['answer']) {
                        echo '
                        <li style="background-color: green;">
                          <label style="margin-left: 13px;">
                            '.$key1['proposition'].'
                          <label>
                        </li><br>' ;
                      }
                      else{
                      echo '
                        <li>
                          <label style="margin-left: 13px;">
                            '.$key1['proposition'].'
                          <label>
                        </li><br>';
                      }
                    }
                    $i_q++;
              echo '</ol>';
            echo '</div>';
        echo '</div>';
    }

?>

      </div>
    </div>
  </div>
      <div style="float: right;">
        <button class="btn btn-success" style="width: 350px; float: right;">
          <?php  foreach ($IsNote as $key) {
            if ($key['note_wk']<0) {
              $key['note_wk'] = 0;
            }
             echo 'Date du traivail : '.moment($key['date_wk'])->format(' d/M/Y à h:i:s').'<br>Note obtenue : '.$key['note_wk'].'/'.$pointsOfEx.' .';
          } ?>    
        
          <hr width="60%" style="margin: auto; margin-top: 10px">
        </button>
      </div>
</body>
</html>