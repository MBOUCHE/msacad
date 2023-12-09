<ul class="nav sidebar-nav navbar-nav" id="left-menu">

    <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin') ?>"><i class="fa fa-fw fa-dashboard"></i> Retour</a>
    </li>

    <!--SECTION AJOUTER-->
    <li class="nav-item">        
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseGerant"><i class="fa fa-fw fa-users"></i> Manage inscriptions</a>
        <ul class="sidebar-second-level collapse" id="collapseGerant">
            
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/inscription">List of inscriptions</a>
                </li>
                
            <?php } ?>
        </ul>
    </li>

    
    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-parent="#left-menu" data-toggle="collapse" href="#collapseStudent" aria-controls="#collapseStudent"><i class="fa fa-fw fa-graduation-cap"></i> Manage waves</a>
        <ul class="sidebar-second-level collapse" id="collapseStudent">
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/wave_manager">List of waves</a>
                </li>
                
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-parent="#left-menu" data-toggle="collapse" href="#collapseDoc" aria-controls="#collapseDoc"><i class="fa fa-fw fa-files-o"></i> Manage Exercises</a>
        <ul class="sidebar-second-level collapse" id="collapseDoc">
            <li>
                <a href="<?php echo base_url('') ?>e_controllers/e_admin/exercise_manager">List of exercise</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>e_controllers/e_admin/exercise_manager/add/">Create exercise</a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSess"><i class="fa fa-fw fa-table"></i> Manage tests</a>
        <ul class="sidebar-second-level collapse" id="collapseSess">
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/test_manager">List of test</a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/test_manager/build_test"> Create a test</a>
                </li>                
            <?php } ?>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseEns"><i class="fa fa-fw fa-book"></i> Manage lesson</a>
        <ul class="sidebar-second-level collapse" id="collapseEns">
            <?php if(session_data('role')==ADMIN){ ?>
                <li>
                    <a href="<?php echo base_url() ?>e_controllers/e_admin/modify_lesson">View lessons</a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>">Nouvel enseignement</a>
                </li>
            <?php } ?>
        </ul>
    </li>

    <li>
        <a class="nav-link nav-link-collapse collapsed" href="<?php echo base_url() ?>e_controllers/e_admin/generate">Generate</a>
    </li>

    <li>
        <a class="nav-link nav-link-collapse collapsed" href="<?php echo base_url() ?>e_controllers/e_admin/composer">Composer</a>
    </li>

    <li>
        <a class="nav-link nav-link-collapse collapsed" href="<?php echo base_url() ?>e_controllers/e_admin/generate/list_learner">Generate Attestation</a>
    </li>


   
    <!--SECTION AJOUTER-->

    
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