<style media="screen">
  body{
    background-color:white;
  }
</style>
<ul class="nav sidebar-nav navbar-nav" id="left-menu">
    <li class="nav-item" style="color:red;">
        <a class="nav-link" href="<?php echo base_url('trainner') ?>"><i class="fa fa-fw fa-dashboard"></i> Tableau de bord</a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed"   href="<?php echo base_url('trainner/vague') ?>" aria-controls="#collapseDoc"><i class="fa fa-users"></i> Vagues</a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed"  href="<?php echo base_url('trainner/session/rapport') ?>"><i class="fa fa-fw fa-table"></i>Consulter les rappports</a>
        <ul class="sidebar-second-level collapse" id="collapseSess">
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExa"><i class="fa fa-fw fa-calendar"></i> Emploie de temps</a>
        <ul class="sidebar-second-level collapse" id="collapseExa">
            <li>
                <a href="<?php echo base_url('trainner/timetable') ?>">generer un emploie de temps</a>
            </li>
            <li>
                <a href="<?php echo base_url('trainner/Planning_exam') ?>">programmer un planning d'examen</a>
            </li>
        </ul>
    </li>
        <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed"  href="<?php echo base_url('trainner/note') ?>"><i class="fa fa-fw fa-cloud-download"></i>Modifier une note</a>
    </li>


    <li class="nav-item">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseForm"><i class="fa fa-fw fa-user-secret"></i> classe virtuelle</a>
        <ul class="sidebar-second-level collapse" id="collapseForm" style="color: white">
        <?php
            foreach ($liste as $key) {
        ?>
                 <li>
                    <a href="<?php echo base_url('trainner/virtual') .'?name='.$key['id_wave']?>"><?php echo $key['label'].'('.strtoupper($key['code_wave']).')';?></a>
                </li>
        <?php
            }
        ?>
        </ul>
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
