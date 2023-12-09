<head>
<style>
a.A { border: 2px ; padding: 4px; text-decoration: none; background-color: white; color: blue; font-weight: bold; font-family: serif; font-size: 12pt }
a.A:hover { border: 4px groove aqua; padding: 4px 4px 5px 4px; background-color: aqua; color: aqua; text-transform: capitalize; font-family: Times New Roman; font-size: 12pt }
a.B { border: 2px groove white; padding: 4px; text-decoration: none; background-color: white; color: blue; font-weight: bold; font-family: serif; font-size: 12pt }
a.B:hover { border: 4px groove black; padding: 4px 4px 5px 4px; text-transform: capitalize; font-family: Times New Roman; font-size: 12pt }
a.Z {font-family: Times New Roman; font-size: 10pt }
a.Z:hover {background-color: lightblue; font-family: Times New Roman; font-size: 12pt;}
</style>
</head>

<body id="page-top">

<!-- <nav id="mainNav" class="navbar static-top navbar-toggleable-sm navbar-inverse bg-inverse"> -->
<nav id="mainNav" class="navbar static-top navbar-toggleable-sm navbar-inverse" style="background-color: white">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a title="Allez à l'accueil du site" class="navbar-brand" href="<?php echo base_url();?>">
        <img src="<?php echo base_url().'assets/img/logo/logo-sm.png' ?>" alt="MULTISOFT ACADEMY" class="rounded float-left" style="width: 26px; height: 26px; margin-right: 5px;">
        MULTISOFT ACADEMY
    </a>

    <div class="col-md-2">
        <div class="dropdown d-inline-block">
            <span class="btn btn-default dropdown-header" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseInfoFlash" style=" color: black; font-family: Algerian;" title="Cliquez pour voir toutes les infos vous consernant.">
                    <i class="fa fa-bullhorn fa-2x float-left"> </i>&nbsp; Infos Flashs
                </a>
            </span>
            <div class="dropdown-menu">
                <ul class="sidebar-second-level collapse" id="collapseInfoFlash" style="color: gray; font-size: 14px">
                    <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="margin-right: 22px; width: 310px; height: 202px;font-family: Times New Roman">
<?php
$waves_user = $this->db->select('*')->from('e_content')->where('id_user', session_data('id'))->get()->result_array();
foreach ($waves_user as $key404) {
    $session_user = $this->db->where('id_wv', $key404['id_wv'])->get('e_course_session')->result_array();
    $waves = $this->db->where('id_wave', $key404['id_wv'])->get('e_wave')->result_array();
    foreach ($waves as $key040) {
        $all_info_flash = $this->db->where('id_wav', $key404['id_wv'])->where('type_com', 'Info Flash')->get('e_communication')->result_array();
        foreach ($session_user as $key22) {
            foreach ($all_info_flash as $info) {
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
                        <span class="info-flash">
                            <p style="float: right;"> '.$key040['code_wave'].'</p><br>
                            <label style="width: 112%, margin-right: 10%; color: green">'.$info['message'].'</label>
                            <strong> Depuis le '.moment($info['time_send'])->format('d/m/Y').' .</strong><br/>
                            <p style="float: right;">'.$Signature.'</p><br>
                            <strong style="color: blue"> M. '.$key26['lastname'].'</strong>
                        </span>
                        <hr style="border: 1px dashed #FF8E0F">';
                }
                if ($all_info_flash==null) {
                        echo '
                        <span class="info-flash">
                            <p style="float: right;"> Aucune vague consernée</p><br>
                            <p class="btn btn-primary" style="width: 100%">Rien pour le moment</p>
                            <p style="float: right;">MULTISOFT ACADEMY</p><br>
                        </span>
                        <hr style="border: 1px dashed #FF8E0F">'; 
                }
            }
        }
    }
}
?>
                    </marquee>
                </ul>
            </div>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarExample" style="margin-top: 13px;">
        <ul class="navbar-nav ml-auto" style="float: right;">
            <style>
            #topAlertsDropdown .list-group-item{
                border-radius: 0 !important;
            }
            </style>
            <li class="nav-item">
                <form action="<?php echo base_url('search') ?>" method="get" class="form-inline my-2 mr-lg-2">
                    <div class="input-group" style="width: 301px; margin-right: 26px;">
                        <input required class="form-control w3-input"  style="border-radius: 0" placeholder="Recherche ..." name="key" type="text">
                        <span class="input-group-btn ">
                            <button  style="border-radius: 1" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </li>
            <li class="nav-item">
            <?php
                include 'panel-user.php'
            ?>
            </li>
        </ul>
        <ul class="nav sidebar-nav navbar-nav" id="left-menu" style="background-color: white; font-size: 17px;margin-top: 5.48%;">

    <a title="Allez à l'accueil des formations en ligne" class="navbar-brand" href="<?php echo base_url() ;?>e_controllers/c_home_page" style="font-family: Times New Roman;color: #f98d0b" >
        <i class="glyphicon glyphicon-home"></i> ACCUEIL E-LEARNING
    </a>
            <li class="nav-item">
                <a class="nav-link A" href="<?php echo base_url().'e_controllers/C_Recapitulative_Training' ;?>" style=" color: black;"><i class="fa fa-fw fa-dashboard"></i> Récapitulatifs</a>
            </li>

            <li class="nav-item">
                <a href="#collapseEns" class="nav-link nav-link-collapse collapsed A" data-toggle="collapse" style=" color: black;"><i class="fa fa-fw fa-book"></i> Formations
                </a>
                <ul class="sidebar-second-level collapse" id="collapseEns" style=" background-color: white;">
                <?php
                  foreach ($lesson_user as $key1) {
                    foreach ($list_training as $key) {
                        if ($key1['id_lesson'] == $key['id']) {
                            echo '<li>
                                    <a class="Z" href="'.base_url().'e_controllers/c_take_courses/reviewCourse/'.$key['id'].'/'.$key['label'].'"><i class="glyphicon glyphicon-book"></i> '.' '.mb_strtoupper($key['label']).'
                                    </a>
                                 </li>';
                            }
                        }
                    }
                ?>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed A" data-toggle="collapse" href="#collapseSess" style=" color: black;"><i class="fa fa-fw fa-table"></i> Emploi du temps</a>
                <ul class="sidebar-second-level collapse" id="collapseSess" style=" background-color: white;">
                    <li>
                        <a class="Z" href="<?php echo base_url().'e_controllers/c_take_courses/generalPlaning'?>"><i class="glyphicon glyphicon-calendar"></i> Planings généraux</a>
                    </li>
                    <li>
                        <a class="Z" href="<?php echo base_url().'e_controllers/c_take_courses/submitAvailability'?>"><i class="glyphicon glyphicon-ok"></i> Disponinbilité</a>
                    </li>
                </ul>
            </li>

             <li class="nav-item">
                <a href="#collapseExo" class="nav-link nav-link-collapse collapsed A" data-toggle="collapse" style="color: black;"><i class="fa fa-fw fa-certificate"></i> Examens</a>
                <ul class="sidebar-second-level collapse" id="collapseExo" style=" background-color: white;">
                    <li>
                        <a class="Z" href="<?php echo base_url().'e_controllers/C_space_works/lastTest'; ?>">  <i class="glyphicon glyphicon-star-empty"></i> Anciens sujets</a>
                    </li><!-- 
                    <li>
                        <a class="Z" href="<?php echo base_url().'e_controllers/C_space_works/ResultExam'; ?>">
                <i class="fa fa-bar-chart"></i> Résultats</a>
                    </li> -->
                </ul>
            </li> 

            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed A" data-parent="#left-menu" data-toggle="collapse" href="#collapseDoc" aria-controls="#collapseDoc" style=" color: black;"><i class="fa fa-fw fa-files-o"></i> Documents</a>
                <ul class="sidebar-second-level collapse" id="collapseDoc" style=" background-color: white;">
                    <li>
                        <a href="<?php echo base_url().'assets/uploads/static/Canevas de rapport de fin de formation.pdf' ; ?>" class="Z"><i class="glyphicon glyphicon-file"></i> Model de rapport</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'e_controllers/c_take_courses/seeTheme/'.session_data('id');?>" class="Z"><i class="glyphicon glyphicon-list"></i> Thèmes disponibles</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'e_controllers/c_take_courses/sendReport'?>" class="Z"><i class="glyphicon glyphicon-send"></i> Envoyer un document</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed A" data-toggle="collapse" href="#collapseExa" style=" color: black;"><i class="glyphicon glyphicon-briefcase"></i>   Formalités</a>
                <ul class="sidebar-second-level collapse" id="collapseExa" style=" background-color: white;">
                    <li>
                        <?php $id_learner = session_data('id'); ?>
                        <a class="Z" href="<?php echo base_url().'e_controllers/c_confirm_valid_registration/finalizeRegulation/'.$id_learner ;?>"><i class="glyphicon glyphicon-usd"></i> Règlements</a>
                    </li>
                    <li>
                        <a class="Z" href="<?php echo base_url().'e_controllers/c_take_courses/learnerCoupons'?>"><i class="glyphicon glyphicon-thumbs-up"></i> Coupons </a>
                        <a class="Z" href="<?php echo base_url().'e_controllers/c_take_courses/appreciation'?>"><i class="glyphicon glyphicon-heart-empty"></i> Appréciations</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed A" data-toggle="collapse" href="#collapseRequete" style=" color: black;"><i class="glyphicon glyphicon-envelope"></i> Requêtes</a>
                <ul class="sidebar-second-level collapse" id="collapseRequete" style=" background-color: white;">
                    <li>
                        <a href="<?php echo base_url().'e_controllers/c_take_courses/makeRequest'?>" class="Z"><i class="glyphicon glyphicon-pencil"></i> Faire une requête</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'e_controllers/c_take_courses/listRequest'?>" class="Z"><i class="glyphicon glyphicon-list-alt"></i> Liste</a>
                    </li>
                </ul>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed B" data-toggle="collapse" href="#collapseInfoFlash" style=" color: black;">
                    <i class="fa fa-bullhorn fa-2x float-left"> </i>&nbsp; Infos Flashs
                </a>
               <ul class="sidebar-second-level collapse" id="collapseInfoFlash" style="color: white; font-size: 11px">
                    <div class="card-text m-2">
                        <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="height: 242px;font-family: Times New Roman";>
<?php
$waves_user = $this->db->select('*')->from('e_content')->where('id_user', session_data('id'))->get()->result_array();
foreach ($waves_user as $key404) {
    $session_user = $this->db->where('id_wv', $key404['id_wv'])->get('e_course_session')->result_array();
    $waves = $this->db->where('id_wave', $key404['id_wv'])->get('e_wave')->result_array();
    foreach ($waves as $key040) {
        foreach ($session_user as $key22) {
            $all_info_flash = $this->db->where('id_sess', $key22['id_sess'])->get('e_communication')->result_array();
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
                        <span class="info-flash">
                            <p style="float: right;"> '.$key040['code_wave'].'</p><br>
                            <p class="btn btn-primary" style="width: 100%">'.$info['message'].'</p>
                            <strong> Depuis le '.moment($info['time_send'])->format('d/m/Y').' .</strong><br/>
                            <p style="float: right;">'.$Signature.'</p><br>
                            <strong> Mr '.$key26['lastname'].'</strong>
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
                </ul>
            </li> -->
        </ul>
        <script type="text/javascript">
            function alm(collapse_id, sous_menu_position=false){
                $('[href="#'+collapse_id+'"]').trigger('click');
                if(typeof(sous_menu_position) === 'number'){
                    $('#'+collapse_id+' > li').eq(sous_menu_position).addClass('active')
                }
            }

            function menu($this) {
                var $menus = $('#left-menu > li > a[data-toggle="collapse"]');
                for (var i = 0; i < $menus.length; i++) {
                    if ($menus.eq(i).hasClass('active')) {
                        $menus.eq(i).trigger('click');
                    }
                }
                $($this).trigger('click');
            }
            
            $(document).ready(function () {
                $('#left-menu > li > a[data-toggle="collapse"]').click(function(){
                    var href = $(this).attr('href'),
                        $menus = $('#left-menu > li > a[data-toggle="collapse"]');
                    for (var i = 0; i < $menus.length; i++) {
                        var $thisM = $menus.eq(i),
                            $thisP = $thisM.parent().children('ul');

                        if ($thisP.hasClass('show') && ($menus.eq(i).attr('href') != href)) {
                            $thisM.trigger('click');
                        }
                    }
                });
            })
        </script>    
    </div>

</nav>
