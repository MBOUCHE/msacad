<br>
<div class="row" style="background-color: #fedb95; margin-top: -22px;">   
    <div style="width: 337px; margin: 8px;margin-left: 11px;">
        <div class="card-header" style="margin-left: 13px; width: 323px; background-color: #fbffbd"><i class="fa fa-bullhorn fa-2x float-left"></i> 
            MSOFT FLASH E-LEARNING
        </div>
        <div class="" style="background: #fbffbd; color: green; min-height: 150px;margin-left: 13px;">
            <div class="card-text m-2">
                <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="height: 364px">
<?php
    $waves_user = $this->db->select('*')->from('e_content')->where('id_user', session_data('id'))->get()->result_array();
    foreach ($waves_user as $key404) {
        $session_user = $this->db->where('id_wv', $key404['id_wv'])->get('e_course_session')->result_array();
        $waves = $this->db->where('id_wave', $key404['id_wv'])->get('e_wave')->result_array();
        foreach ($waves as $key040) {
            foreach ($session_user as $key22) {
                $ke="Info Flash";
                $all_info_flash = $this->db->where('type_com', $ke)->get('e_communication')->result_array();
                foreach ($all_info_flash as $info) {
                    if ($info['type_com'] == 'Info Flash') {
                        $role = $this->db->where('user', $info['id_user'])->get('user_role')->result_array();
                        $user = $this->db->where('id', $info['id_user'])->get('user')->result_array();
                        foreach ($user as $key26) {
                            foreach ($role as $key35) {
                                $Signature ='';
                                if ($key35['role'] == 6) {
                                    $Signature = 'La Direction.';
                                }else{
                                    $Signature = 'Le formateur';
                                }
                            }
                            echo '
                            <span class="info-flash" style="color: #FF8E0F">
                                <p style="float: right;color: #f6b120;"> '.$key040['code_wave'].'</p><br>
                                <p style="color:#bff620;">'.$info['message'].'</p>
                                <strong style="float: right;">('.$info['time_send'].')</strong><br/>
                                <p style="float: right; color: #dff626"><i style="font-family: Times New Roman">'.$Signature.'</i></p><br>
                                <strong style="margin-left: 4px; color: #20ecf6;"> Mr '.$key26['lastname'].'</strong>
                            </span>
                            <hr style="border: 1px dashed #FF8E0F">';   
                        }
                    }
                }
            }
        }
    }
?>
                </marquee>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="margin-top: 8px; margin-left: -13px;">
        <section  class="mb-4">
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
                <div class="carousel-caption d-none d-md-block" style="width: 701px;height: 404px;">
                    <h6 style="margin-top: ;">'.$key2['lastname'].' '.$key2['firstname'].'( Matricule :'.$key2['number_id'].')</h6>
                    <h6 style="margin-top: ;">Vague(s) : '.$print_wv.'</h6>
                    <h6 style="margin-top: ;">Pour le compte de la formation : '.$code_lesson.'</h6>
                    <h6 style="margin-top: ;">Affirme :</h6>
                    <h5 style="margin-top: ;"> "'.$key1['appreciation'].'"</h5>
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
            </div>
        </section>
    </div>    
</div>