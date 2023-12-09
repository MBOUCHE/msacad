
<div class="row e-menu-left" style="margin-left: 4px; width: 112%">
    <div class="list-group col-md-2">
        <a href="<?php echo base_url().'e_controllers/c_home_page/list_lesson';?>" class="list-group-item" style="background-color: #11c55b; color: white; font-size: 14px;">
            <i class="fa fa-graduation-cap white-color" aria-hidden="true"></i>&nbsp;
            FORMATIONS LONGUES
        </a>
        <a href="<?php echo base_url().'e_controllers/c_home_page/list_lesson2';?>" class="list-group-item" style="background-color: #11c55b; color: white; margin-top: 17px; font-size: 14px;">
            <i class="fa fa-forward fa-1x white-color" aria-hidden="true"></i>&nbsp;
            FORMATIONS RAPIDES
        </a>
        <a href="<?php echo base_url().'e_controllers/C_take_courses';?>" class="list-group-item" style="background-color: #11c55b; margin-top: 17px; color: white; font-size: 17px;">
            <i class="fa fa-users fa-1x"></i>&nbsp;Espace Apprenant</a>
        <a href="<?php echo base_url(); ?>assets/uploads/static/livret-apprenant.pdf" class="list-group-item" style="background-color: #11c55b; color: white; margin-top: 17px; font-size: 17px;"><i class="fa fa-book fa-1x"></i>&nbsp; Livret E-learning</a>
        <p><br></p>
        <div class="card-header" style="color: white; background-color: #ff9000"><i class="fa fa-bullhorn fa-2x float-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;
            INFOS FLASH
        </div>
        <div class="" style="background: gray; color: green; min-height: 150px;">
            <div class="card-text m-2">
                <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="height: 350px">
<?php
    $waves_user = $this->db->select('*')->from('e_content')->get()->result_array();
    foreach ($waves_user as $key404) {
        $session_user = $this->db->where('id_wv', $key404['id_wv'])->get('e_course_session')->result_array();
        $waves = $this->db->where('id_wave', $key404['id_wv'])->get('e_wave')->result_array();
        foreach ($waves as $key040) {
            foreach ($session_user as $key22) {
                $ke="Info Flash";
                $all_info_flash = $this->db->where('type_com', $ke)->get('e_communication')->result_array();
                foreach ($all_info_flash as $info) {
                    if ($info['type_com'] == 'Info Flash' and $info['id_wav'] == $key040['id_wave']) {
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
                                <strong style="margin-left: 4px; color: #20ecf6;"> M. '.$key26['lastname'].'</strong>
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
            <div class="panel-footer" style="color: white; background-color: #ff9000">
            	Pour les formations en ligne
            </div>
        </div>
    </div>   
    