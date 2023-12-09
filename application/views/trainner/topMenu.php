<ul class="navbar-nav ml-auto" >
    <?php if(session_data('connect')){ ?>
        <style>
            #topAlertsDropdown .list-group-item{
                border-radius: 0 !important;

            }
        </style>
        <li id="topAlertsDropdown" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-fw fa-bell"></i> <span class="badge badge-info" id="nb_notif"><?php echo count($list);?></span>
            </a>
            <div id="notif" class="dropdown-menu w3-small w3-responsive" aria-labelledby="messagesDropdown" style="width:350px; max-height: 10cm">
                <a class="list-group-item list-group-item-action flex-column align-items-start small" href="<?php echo base_url('trainner/gerer') ?>" style="border-bottom: none;">
                   <p style="color:indigo;font-size: 25px;font-family: Cookie"> Vous avez <?php echo count($list);?> nouvelle notification(s)</p>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <form action="<?php echo base_url('trainner/search') ?>" method="get" class="form-inline my-2 my-lg-0 mr-lg-2">
                <div class="input-group">
                    <input type="text" class="form-control w3-input" placeholder="Recherche ..." name="query">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" style="margin-right: 0px !important; max-width: 200px !important; text-overflow: ellipsis;" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-x"></i> <?php echo ucfirst(mb_strtolower(session_data('lastname'))) ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" aria-labelledby="alertsDropdown">
                <li>
                    <a class="dropdown-item" href="<?php echo base_url('trainner/home/profile') ?>"><i class="fa fa-fw fa-user"></i> Profil</a>
                </li>
                <li class="w3-border-bottom"></li>
                <li>
                    <a class="dropdown-item" href="https://mail.google.com/mail/u/0/#inbox"><i class="fa fa-fw fa-envelope";"></i> Message</a>
                </li>
                <li class="w3-border-bottom"></li>
                <li>
                    <a class="dropdown-item" href="<?php echo base_url() ?>"><i class="fa fa-fw fa-power-off"></i> D&eacute;connecter</a>
                </li>
            </ul>
        </li>

    <?php } ?>
</ul>


<script>
    $(document).ready(function(){
        $('#topAlertsDropdown').on('shown.bs.dropdown', function(){
            var $notifs = $(this).find('a.notifs'), nb = $notifs.length, data = {mode: 'js', id: []}, $nbNotif = $('#topAlertsDropdown > a > span > span');
            if(nb > 0){
                for(var i=0; i<nb; i++){
                    data.id[i] = $notifs.eq(i).attr('id');
                }
                $.post('<?php echo base_url('trainner/notification/notifView')?>', data, function(rep){
                    if(rep.trim().split('*0*').length>1){
                        for(var i=0; i< 2; i++) {
                            $nbNotif.eq(i).text($nbNotif.eq(i).text().replace(nb, 0));
                        }
                        if($('#admin-notif').length == 1){
                            $('#admin-notif div').eq(0).text(0);
                        }
                    }
                });
            }
        });
    $('#nb_notif').on('click',function(){
      $('#nb_notif').html('<span class="badge badge-info" id="2">0</span>')
    })
    })
</script>
