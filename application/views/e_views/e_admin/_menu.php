        
<ul class="nav sidebar-nav navbar-nav" id="left-menu">

    <!--SECTION AJOUTER-->
    <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseGerant"><i class="fa fa-fw fa-users"></i> Espace E-learning</a>
        <ul class="sidebar-second-level collapse" id="collapseGerant">
            
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/inscription">Gerer Inscriptions</a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>">Gerer les vagues</a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>">Gerer les test</a>
                </li>
            <?php } ?>
        </ul>
    </li>
    <!--SECTION AJOUTER-->


    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin') ?>"><i class="fa fa-fw fa-dashboard"></i> Tableau de bord</a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-parent="#left-menu" data-toggle="collapse" href="#collapseStudent" aria-controls="#collapseStudent"><i class="fa fa-fw fa-graduation-cap"></i> Apprenants</a>
        <ul class="sidebar-second-level collapse" id="collapseStudent">
            <li>
                <a href="<?php echo base_url('admin/student/all') ?>">Tous les apprenants</a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-parent="#left-menu" data-toggle="collapse" href="#collapseDoc" aria-controls="#collapseDoc"><i class="fa fa-fw fa-files-o"></i> Documents</a>
        <ul class="sidebar-second-level collapse" id="collapseDoc">
            <li>
                <a href="<?php echo base_url('admin/document/all') ?>">Liste des documents</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/document/formUpload') ?>">Nouveau document</a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSess"><i class="fa fa-fw fa-table"></i> Emploi du temps</a>
        <ul class="sidebar-second-level collapse" id="collapseSess">
            <li>
                <a href="<?php echo base_url('admin/session/timetableList') ?>">Tous les emplois du temps</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/session/generateTimetable') ?>"> Générer un emploi du temps</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseEns"><i class="fa fa-fw fa-book"></i> Enseignements</a>
        <ul class="sidebar-second-level collapse" id="collapseEns">
            <li>
                <a href="<?php echo base_url('admin/lesson/all') ?>">Tous les enseignements</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/lesson/formAdd') ?>">Nouvel enseignement</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExa"><i class="fa fa-fw fa-certificate"></i> Examens</a>
        <ul class="sidebar-second-level collapse" id="collapseExa">
            <li>
                <a href="<?php echo base_url('admin/examination/planning/all') ?>">Plannings des examens</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/examination/planning/generate') ?>"> Générer un planning d'examen</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/examination/results') ?>"> Résultats</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <?php if(session_data('role')==ADMIN){ ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/export/promotion') ?>"><i class="fa fa-fw fa-table"></i> Exportations
        </a>
    </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseForm"><i class="fa fa-fw fa-user-secret"></i> Formateurs</a>
        <ul class="sidebar-second-level collapse" id="collapseForm">
            <li>
                <a href="<?php echo base_url('admin/trainer/all') ?>">Liste des formateurs</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/trainer/allLessonSlip') ?>">Fiches de suivie</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/trainer/addTrainer') ?>">Nouveau formateur</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/trainer/allocation') ?>">Cours dispensés</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseGerant"><i class="fa fa-fw fa-users"></i> Gérants</a>
        <ul class="sidebar-second-level collapse" id="collapseGerant">
            <li>
                <a href="<?php echo base_url('admin/manager/') ?>">Liste des gérants</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/manager/addManager') ?>">Nouveau gérant</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseReg"><i class="fa fa-fw fa-newspaper-o"></i> Inscriptions</a>
        <ul class="sidebar-second-level collapse" id="collapseReg">
            <li>
                <a href="<?php echo base_url('admin/registration') ?>">Toutes les inscriptions</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/registration/addRegistration') ?>">Nouvelle inscription</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/registration/validateRegistrations') ?>">Valider</a>
            </li>
        </ul>
    </li>

    <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseJournaux"><i class="fa fa-fw fa-list"></i> Journaux</a>
            <ul class="sidebar-second-level collapse" id="collapseJournaux">
                <li>
                    <a href="<?php echo base_url('admin/log/all') ?>">Liste des logs</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseLetter"><i class="fa fa-fw fa-file"></i> Lettres</a>
            <ul class="sidebar-second-level collapse" id="collapseLetter">
                <li>
                    <a href="<?php echo base_url('admin/letter/recommandationLetter') ?>">Lettre de recommandation</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <!--li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMat"><i class="fa fa-fw fa-sitemap"></i> Matériels</a>
        <ul class="sidebar-second-level collapse" id="collapseMat">
            <li>
                <a href="<?php echo base_url('material/lyst') ?>">Inventaire</a>
            </li>
            <li>
                <a href="<?php echo base_url('material/inventory') ?>">Transaction</a>
            </li>
            <li>
                <a href="<?php echo base_url('material/save') ?>">Ajouter</a>
            </li>
        </ul>
    </li-->

    <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseNotif"><i class="fa fa-fw fa-bell"></i> Models de Notification</a>
            <ul class="sidebar-second-level collapse" id="collapseNotif">
                <li>
                    <a href="<?php echo base_url('admin/notification/allModel') ?>">Toutes les models</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/notification/formAdd') ?>">Ajouter un model</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMod"><i class="fa fa-fw fa-users"></i> Modérateurs</a>
        <ul class="sidebar-second-level collapse" id="collapseMod">
            <li>
                <a href="<?php echo base_url('admin/moderator/') ?>">Liste des modérateurs</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/moderator/addModerator') ?>">Nouveau modérateur</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/settings/edit') ?>"><i class="fa fa-fw fa-gears"></i> Paramètres</a>
    </li>

    <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/promotion') ?>"><i class="fa fa-fw fa-table"></i> Promotions</a>
        </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePeriode"><i class="fa fa-fw fa-th-list"></i> Périodes</a>
        <ul class="sidebar-second-level collapse" id="collapsePeriode">
            <li>
                <a href="<?php echo base_url('admin/period/all') ?>">Toutes les périodes</a>
            </li>
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url('admin/period/formAdd') ?>">Ajouter</a>
                </li>
            <?php } ?>
        </ul>
    </li>
    
     <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseRequete"><i class="fa fa-question-circle fa-list"></i> Requêtes</a>
            <ul class="sidebar-second-level collapse" id="collapseRequete">
                <li>
                    <a href="<?php echo base_url('admin/request/') ?>">Liste des requêtes</a>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if(session_data('role')==ADMIN){ ?>
        <li class="nav-item">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers"><i class="fa fa-fw fa-users"></i> Utilisateurs</a>
            <ul class="sidebar-second-level collapse" id="collapseUsers">
                <li>
                    <a href="<?php echo base_url('admin/user/') ?>">Toutes les utilisateurs</a>
                </li>
            </ul>
        </li>
    <?php } ?>
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

        <?php if (session_data('role')==ADMIN) {
        ?>
        <a  href="<?php echo base_url(); ?>index.php/inscription_wait/inscription_wait" title="">Valider les inscriptions</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/modify_lesson">Modify a lesson</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/test_manager">Management tests</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/exercise_manager">Manage exercice</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/wave_manager">Manage Wave</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/inscription">List of inscription</a>
        <?php
        }  ?>
        <br>
        <a href="<?php echo base_url(); ?>index.php/user/logout">Logout</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/user/cours">Liste des cours</a>
        <br>
        <a href="<?php echo base_url(); ?>index.php/user/profile">Profile</a>
        <br>
        <a href="../sending_email">Send me an Email</a>


