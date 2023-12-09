<!--MENU SECTION -->
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
?>

<div id="left" >
    <?php
        if(is_connect()) {
            ?>
            <div class="media user-media well-small">
                <div class="media-heading w3-green w3-padding-small text-center"><b><?php echo role_tostring(session_data('role')); ?></b></div>

                <a class="user-link" href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate'); ?>">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url(session_data('avatar')) ?>" style="height: 100px; width: 100px;">
                </a>
                <br/>

                <div class="media-body">
                    <h5 class="media-heading"> <?php echo session_data('lastname') .' '.session_data('firstname') ?></h5>
                </div>
                <br/>
            </div>
            <?php
        }
    ?>

    <ul id="menu" class="collapse">
        <li class="panel">
            <a href="<?php
            if (role_in_array($backArrayAllRole))
                echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate');
            else
                echo '#';
            ?>" >
                <i class="fa fa-dashboard" aria-hidden="true"></i> Panneau de contrôle
            </a>
        </li>

        <?php if (role_in_array($backArrayStudAndTrainRole)) { ?>
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-timetable">
                <i class="fa fa-calendar" aria-hidden="true"></i> Emploi du temps
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
            </a>
            <ul class="collapse" id="panel-timetable">
                <li><a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/timetable/all') ?>""><i class="fa fa-table" aria-hidden="true"></i>  Planning des cours</a></li>
                <?php if (role_in_array($backArrayStudentRole)) { ?><li><a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/timetable/availability') ?>"><i class="fa fa-send" aria-hidden="true"></i>  Soumettre sa disponibilité</a></li><?php } ?>
            </ul>
        </li>
            
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-evaluation">
                <i class="fa fa-certificate" aria-hidden="true"></i> &Eacute;valuations
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
            </a>
            <ul class="collapse" id="panel-evaluation">
                <li><a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/examination/planning') ?>"><i class="fa fa-calendar" aria-hidden="true"></i>  Planning des évaluations</a></li>
                <?php if (session_data('role')==TRAINER) { ?><li><a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/examination/promotions') ?>"><i class="fa fa-cloud-upload" aria-hidden="true"></i>  Enregistrer les notes</a></li><?php } ?>
                <li><a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/examination/results') ?>"><i class="fa fa-table" aria-hidden="true"></i>  Consulter les résultats</a></li>
            </ul>
        </li>
        <?php } ?>

        <?php if (role_in_array($backArrayModeratorRole)) { ?>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-agenda">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agenda
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-agenda">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/event') ?>"><i class="fa fa-calendar" aria-hidden="true"></i>  Tous les évènements</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/event/formAdd') ?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>  Ajouter un évènement</a></li>
                </ul>
            </li>

            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-flash">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Info flash
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-flash">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/infoFlash') ?>"><i class="fa fa-table" aria-hidden="true"></i>  Tous les infos flash</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/infoFlash/formAdd') ?>"><i class="fa fa-plus-square" aria-hidden="true"></i>  Ajouter un info flash</a></li>
                </ul>
            </li>

            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-news">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Nouvelles
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-news">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/news') ?>"><i class="fa fa-th-list" aria-hidden="true"></i>  Tous les nouvelles</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/news/formAdd') ?>"><i class="fa fa-plus-square" aria-hidden="true"></i>  Ajouter une nouvelle</a></li>
                </ul>
            </li>
        <?php } ?>

        <?php if (role_in_array($backArrayTrainerRole)) { ?>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-suivie">
                    <i class="fa fa-file" aria-hidden="true"></i> Fiches de suivie<span class="pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                </a>
                <ul class="collapse" id="panel-suivie">
                <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/home/lessons') ?>"><i class="fa fa-file" aria-hidden="true"></i>  Mes enseignements</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/home/giveLessonDispense') ?>"><i class="fa fa-file" aria-hidden="true"></i>  Remplir une fiche de suivie</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/home/lessonSlip') ?>"><i class="fa fa-file" aria-hidden="true"></i> Consulter une fiche de suvie</a></li>
                </ul>
            </li>
        <?php } ?>


<!-- <label>Leonel BGN </label>-->
                    <li class="panel">
                        <a href="<?php echo base_url().'trainner/home'?>"><i class="fa fa-leaf" aria-hidden="true"></i>Espace e_learning<span class="pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                        </a>
                    </li>

<!-- <label>Leonel END </label>-->

        <?php if (role_in_array($backArrayModAndTrainRole)) { ?>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-notification"><i class="fa fa-envelope" aria-hidden="true"></i> Notification<span class="pull-right"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                </a>
                <ul class="collapse" id="panel-notification">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/notifications') ?>"><i class="fa fa-th-list" aria-hidden="true"></i>  Toutes les notifications</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/notifications/formNotifAdd') ?>"><i class="fa fa-send-o" aria-hidden="true"></i>  Publier une notification</a></li>
                </ul>
            </li>
        <?php } ?>

        <?php if (role_in_array($backArrayModeratorRole)) { ?>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-membre">
                    <i class="fa fa-users" aria-hidden="true"></i> Membres
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-membre">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/user') ?>"><i class="fa fa-th-list" aria-hidden="true"></i>  Tous les membres</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-forum">
                    <i class="fa fa-forumbee" aria-hidden="true"></i> Forum
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-forum">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/forums'); ?>"><i class="fa fa-th-list" aria-hidden="true"></i>  Touts les forums</a></li>
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/forums/forumFormAdd'); ?>"><i class="fa fa-plus-square" aria-hidden="true"></i>  Ajouter</a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#panel-msg">
                    <i class="fa fa-envelope-open" aria-hidden="true"></i> Messages utilisateur
                <span class="pull-right">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                </a>
                <ul class="collapse" id="panel-msg">
                    <li><a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/message'); ?>"><i class="fa fa-th-list" aria-hidden="true"></i>  Touts les messages</a></li>
                    <li><a href="<?php echo base_url((strtolower(role_tostring(session_data('role'), 'en')))
.'Gate/message/add'); ?>"><i class="fa fa-plus-square" aria-hidden="true"></i>  Ajouter un message</a></li>
                </ul>
            </li>
        <?php } ?>

        <?php if(!is_connect()){ ?>
        <li><a href="<?php echo base_url('account/login'); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Authentification</a></li>
        <?php }else{ ?>
        <li><a href="<?php echo base_url('account/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></li>
        <?php } ?>
    </ul>
    <script>
        function leftM(position, data_target=false)
        {
            var $menu = $('#left #menu');
            if(data_target!=false)
            {
                $(data_target).collapse('show');
                $menu = $menu.find('li > [data-target="'+ data_target +'"]').parent();
                $menu.addClass('active');
                $menu.find(data_target +' > li').eq(position).addClass('active');
            }
            else{
                $menu = $menu.find(' > li').eq(position).addClass('active');
                $menu = $menu.find('.collapse');
                if($menu.length == 1) {
                    $menu.collapse('show');
                }
            }
        }
    </script>
</div>
<!--END MENU SECTION -->