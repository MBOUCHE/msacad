<?php include_once "e_top_menu.php";?>

<?php include_once "e_left_menu.php";?>

    <div class="col-md-5" style="margin-left: -25px;">
                
                <div class="panel panel-primary" style="border-radius: 0px;width: 112%; font-size: 17px">
                    <div class="panel-heading" style="height: 48px">
                        <h3 class="panel-title text-center" id="presentation"><?php echo mb_strtoupper('PROCéDURE D\'INSCRIPTION à une formation en ligne'); ?></h3>
                    </div>
                    <ol class="list-group">
                        <li class="list-group-item">1. Premièrement, il faut avoir : 
                            <a href="<?php echo base_url().'account/signup';?>" style='text-decoration: none;'>&nbsp; créé un compte membre </a>;
                        </li>
                        <li class="list-group-item">2. Ensuite, il faut avoir relevé les informations concernant les frais de formation demandés par de la formation choisie et, le numéro de virement sur lequel vous effectuerez un versement égal au montant d'une des tranches ; 
                        </li>
                        <li class="list-group-item">3. Après avoir versé l'un des montants demandé, relevez votre reférence de payement dans le message qui vous parvient de l'opérateur utilisé ;
                        </li>
                        <li class="list-group-item">4. Pour la suite, cliquez sur : "S'inscrire" au niveau de la formation désirée et remplissez correctement le formulaire à votre disposition ;
                        </li> 
                        <li class="list-group-item">5. Enfin, après avoir soumis se formulaire vous patienterez un instant pour la vérification de vos information en vue de la génération de votre quitus apprenant que vous téléchargerez.

                        </li>
                    </ol>
            </div>
        </div>

<div class="col-md-4">
        <section  class="mb-4" style="width: 427px; float: right;">
            <div id="carouselExampleIndicatorsUlrich" class="carousel  slide" data-ride="carousel">
                <ol class="carousel-indicators">
    <?php
        $appreciation = $this->db->select('*')->from('e_training')->get()->result_array();
        $i = 0;
        foreach ($appreciation as $key) { 
               ?>
                <li data-target="#carouselExampleIndicatorsUlrich" class="active" data-slide-to="<?php echo $i++; ?>"></li>
    <?php
        }
    ?>
                </ol>
        <a href="" class="list-group-item" style="background-color: #11c55b; color: white; font-size: 17px;">AVIS DES APPRENANTS FORMES EN LIGNE</a>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active" style="background-image: url(<?php echo base_url();?>assets/uploads/images/news/img-nouvelle-012.jpg">
                    <div class="carousel-caption d-none d-md-block ">
                        <h4>Remise des Certificats de Formation aux apprenants des formatione en présentielles</h4>
                    </div>
                </div>
    <?php 
        $print_wv = '';
        foreach ($appreciation as $key1) {
            $all_user = $this->db->select('*')->from('user')->where('id', $key1['id_user'])->get()->result_array();
        }
        foreach ($all_user as $key2) {
            $avatar = $key2['avatar'];
            $all_is_wave = $this->db->select('*')->from('e_content')->where('id_user', $key1['id_user'])->get()->result_array();   
        }         
        foreach ($all_is_wave as $key3) {
            $wave = $this->db->select('*')->from('e_wave')->where('id_wave', $key3['id_wv'])->get()->result_array();
            foreach ($wave as $key4) {
                $print_wv .= $key4['code_wave'].', ';
            }   
        }
        foreach ($appreciation as $key1) {
            if ($key1['appreciation']) {
            $all_user = $this->db->select('*')->from('user')->where('id', $key1['id_user'])->get()->result_array();
            foreach ($all_user as $key2) {
                $avatar = $key2['avatar'];
                $all_is_wave = $this->db->select('*')->from('e_content')->where('id_user', $key1['id_user'])->get()->result_array();         
                foreach ($all_is_wave as $key3) {
                    $wave = $this->db->select('*')->from('e_wave')->where('id_wave', $key3['id_wv'])->get()->result_array();   
                }   
            }
            $code = $this->db->select('*')->from('lesson')->where('id', $key1['id_lesson'])->get()->result_array();
            foreach ($code as $key5) {
                $code_lesson = $key5['code'];
            }
            echo 
            '<div class="carousel-item" style="background-image: url('.base_url().'/'.$avatar.'">
                <div class="carousel-caption d-none d-md-block" style="width: 450px;height: 400px;">
                    <h6 style="margin-top: ;">'.$key2['lastname'].' '.$key2['firstname'].'('.$key2['number_id'].')</h6>
                    <h6 style="margin-top: ;">Formation : '.$code_lesson.'</h6>
                    <h6 style="margin-top: ;">Affirme :</h6>
                    <h5 style="margin-top: ;"> "'.htmlentities($key1['appreciation']).'"</h5>
                </div>
            </div>';
            }
        }
    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicatorsUlrich" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicatorsUlrich" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><br>
        <div class="panel row" style="width: 99%; float: right;margin-right: 1%">
            <a href="" class="list-group-item" style="background-color: #11c55b; color: white; font-size: 17px;width: 100%">NOS NUMEROS DE TRANSACTION</a>
        <?php 
        $k = -1;
        foreach ($rslt_list as $key) {
          echo '<div class="panel-warning" style="margin-top: 8px; width: 43%; height: 46%;">';
          if ($k < 2) {
            if ($key['type_op']=='Banquaire') {
              echo '<div class="panel" style="margin: 4px;margin-left: 17px; height: 161px; background-color: #ff9000; color: white;">
                      <div class="panel-heading" style="height: 35px;"><label>'.$key['numbers_used'].'</label></div>
                      <li class="list-group-item"><img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 121px; height: 103px;" class="img-responsive img-cercle"></li>
                    </div>';
              $k++;
            }
            else{
                echo '<div class="panel" style="margin: 4px;margin-left: 17px; height: 161px; background-color: #ff9000; color: white;">
                        <div class="panel-heading" style="height: 35px;">
                            <label>'.$key['numbers_used'].'</label>
                        </div>
                        <li class="list-group-item">
                            <img src="'.base_url().'assets/img/e_img/operator/'.$key['image_op'].'.png" alt="'.$key['image_op'].'" style="width: 121px; height: 103px;" class="img-responsive img-cercle">
                        </li>
                    </div>';
              $k = 0;
            }
            echo '</div>';
          }
        }  
        ?>
        </div>
        </section>
    </div> 
    </div>
</body>