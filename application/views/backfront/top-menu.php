<!-- HEADER SECTION -->
<?php
$backArrayAllRole = array(MODERATOR, STUDENT, TRAINER, MEMBER);

$backArrayNotMemberRole      = array(MODERATOR, STUDENT, TRAINER);
$backArrayNotTrainerRole     = array(MODERATOR, STUDENT, MEMBER);
$backArrayNotStudentRole     = array(MODERATOR, TRAINER, MEMBER);
$backArrayNotModeratorRole   = array(STUDENT, TRAINER, MEMBER);

$backArrayStudAndMenRole     = array(STUDENT, MEMBER);
$backArrayStudAndModRole     = array(STUDENT, MODERATOR);
$backArrayStudAndTrainRole    = array(STUDENT, TRAINER);
$backArrayModAndTrainRole    = array(MODERATOR, TRAINER);
$backArrayModAndMenRole      = array(MODERATOR, MEMBER);
$backArrayMemAndTrainRole    = array(MEMBER, TRAINER);

$backArrayMemberRole      = array(MEMBER);
$backArrayTrainerRole     = array(TRAINER);
$backArrayStudentRole     = array(STUDENT);
$backArrayModeratorRole   = array(MODERATOR);

function role_in_array(array $data = array()){
    return (is_connect())? in_array(session_data('role'), $data): false;
}

function is_connect() {
    return (bool) session_data('connect');
}
?>

<div id="top">

    <nav class="navbar navbar-inverse navbar-fixed-top w3-white" style="padding-top: 10px;">
        <a class="accordion-toggle w3-btn w3-blue w3-round btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
        <!-- LOGO SECTION -->
        <header class="navbar-header w3-padding-small">
            <a href="<?php echo base_url() ?>" class="navbar-brand w3-text-black w3-hover-text-black">
                <img src="<?php echo img_url('logo/logo.png')?>" class="img-fluid" alt="Multisoft" style="height: 30px;  margin-bottom: 5px;">
                Mutisoft Academy
            </a>
        </header>
        <!-- END LOGO SECTION -->
        <ul class="nav navbar-top-links navbar-right w3-text-dark-grey">
            <!--ALERTS SECTION -->
            <li id="topAlertsDropdown" class="chat-panel dropdown">
                <a class="dropdown-toggle w3-white w3-hover-white" data-toggle="dropdown" href="#">
                    <span class="label label-info notifs-info"><?php if(isset($notif) And count($notif)>0) echo (string)count($notif) ?></span> <i class="fa fa-comment" aria-hidden="true"></i>&nbsp; <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-alerts w3-responsive w3-small" style="max-height: 250px; min-width: 325px;">
                    <ul style="padding: 0;">
                        <li class="w3-hover-text-blue" onclick="$(location).prop('href', $(this).children().prop('href'))" style="cursor: pointer;">
                            <a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/notifications'); ?>" class="w3-hover-text-blue text-center">
                                <strong>Voir toutes les notifications</strong>
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <hr class="w3-dark-grey" style="margin: 0; margin-top: 3px; margin-bottom: 3px;">
                        <?php
                        if(isset($notif) And count($notif)>0) {
                            foreach ($notif as $item) {
                                ?>
                                <li id="<?php echo $item->id ?>" class="w3-padding-small notifs">
                                    <a href="<?php echo $item->url ?>" class="w3-hover-text-blue" style="margin: 0; padding: 0;">
                                        <div>
                                            <b class="w3-small">
                                                <?php
                                                echo mb_strtoupper($item->firstname) . ' ' . ucwords(mb_strtolower($item->lastname)) . ':'
                                                ?>
                                            </b>
                                        </div>
                                        <div style="margin-left: 4px;">
                                            <p><?php echo ucfirst($item->content) ?></p>
                                        </div>
                                        <div>
                                            <small class="text-muted float-right">
                                                <?php
                                                $time = moment($item->send_date);
                                                echo ($time) ? $time->fromNow()->getRelative() : '';
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                </li>
                                <hr class="w3-dark-grey" style="margin: 0; margin-bottom: 3px;">
                                <?php
                            }
                        }
                        else { ?>
                        <li class="w3-padding-small">
                            <a class="w3-text-red">Pas de nouvelles notifications!</a>
                        <li>
                            <hr class="w3-dark-grey" style="margin: 0; margin-bottom: 3px;">
                            <?php } ?>
                    </ul>
                </div>
            </li>
            <!-- END ALERTS SECTION -->

            <!--ADMIN SETTINGS SECTIONS -->

            <li class="dropdown">
                <a class="dropdown-toggle w3-white w3-hover-white" data-toggle="dropdown" href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp; <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>

                <ul class="dropdown-menu dropdown-user">
                    <?php
                    if(role_in_array($backArrayAllRole)){
                        echo '
                                <li><a href="'.base_url(strtolower(role_tostring(session_data('role'), 'en'))."Gate/home/profil").'"><i class="fa fa-user" aria-hidden="true"></i> Mon profil</a></li>
                            ';
                    }
                    ?>

                    <li class="divider" style="margin: 0;"></li>

                    <?php if ($roles = session_data('roles')) {
                        foreach ($roles as $role) {
                            if( $role!=session_data('role')){ ?>
                                <li><a href="<?php echo base_url(lcfirst(role_tostring($role, 'en').'Gate')); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo 'Compte '.role_tostring($role) ?></a></li>
                            <?php  }
                        }
                    } ?>
                    <li class="divider" style="margin: 0;"></li>
                    <li><a href="<?php echo base_url('account/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a>
                    </li>
                </ul>

            </li>
            <!--END ADMIN SETTINGS -->
        </ul>

    </nav>

    <script>
        $(document).ready(function(){
            $('#topAlertsDropdown').on('shown.bs.dropdown', function(){
                var $notifs = $(this).find('.notifs'), nb = $notifs.length, data = {mode: 'js', id: []}, $nbNotif = $(this).find('.notifs-info');
                if(nb > 0){
                    for(var i=0; i<nb; i++){
                        data.id[i] = $notifs.eq(i).attr('id');
                    }
                    $.post('<?php echo base_url(lcfirst(role_tostring($role, 'en').'Gate').'/notifications/notifView')?>', data, function(rep){
                        if(rep.trim().split('*0*').length>1){
                            $nbNotif.text(0);
                        }
                    });
                }
            });
        })
    </script>
</div>
<!-- END HEADER SECTION -->