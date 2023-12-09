<ul class="navbar-nav ml-auto">
    <?php if(session_data('connect')){ ?>
        <style>
            #topAlertsDropdown .list-group-item{
                border-radius: 0 !important;
            }
        </style>
        <li id="topAlertsDropdown" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i> <span class="hidden-lg-up">Alerts <?php $nbNotif = count($notif); if($nbNotif>0){ ?><span class="badge badge-pill badge-warning"><?php echo $nbNotif; ?> New</span><?php } ?></span>
                <span class="new-indicator text-warning hidden-md-down"><?php if($nbNotif>0){ ?><i class="fa fa-fw fa-circle"></i><span class="number"><?php echo $nbNotif; ?></span><?php } ?></span>
            </a>
            <div id="notif" class="dropdown-menu w3-small w3-responsive" aria-labelledby="messagesDropdown" style="width:350px; max-height: 10cm">
                <h6 class="dropdown-header" style="margin: 0;">Nouvelle(s) Notification(s):</h6>
                <?php
                if($nbNotif>0)
                    foreach ($notif as $item) {
                ?>
                        <a id="<?php echo $item->id ?>" class="list-group-item list-group-item-action flex-column align-items-start notifs" href="<?php echo $item->url?>" target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"> <?php echo mb_strtoupper($item->firstname).' '.ucfirst(mb_strtolower($item->lastname))?></h5>
                            </div>
                            <p class="mb-1"><?php echo ucfirst($item->content) ?></p>
							<?php
								if($item->send_date = moment($item->send_date))
									echo '<small class="text-muted send_date">' . $item->send_date->fromNow()->getRelative() . '</small>';
							?>
                        </a>
                <?php
                    }
                else echo
                    '<a class="list-group-item list-group-item-action flex-column align-items-start w3-text-red">Pas de nouvelles notifications!</a>'
                ?>
                <a class="list-group-item list-group-item-action flex-column align-items-start small" href="<?php echo base_url('admin/notification') ?>" style="border-bottom: none;">
                    Voir toutes les notifications
                </a>
            </div>
        </li>
        <li class="nav-item">
            <form action="<?php echo base_url('admin/search') ?>" method="get" class="form-inline my-2 my-lg-0 mr-lg-2">
                <div class="input-group">
                    <input type="text" class="form-control w3-input" placeholder="Recherche ..." name="query">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" style="margin-right: 0px !important; max-width: 200px !important; text-overflow: ellipsis;" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-secret"></i> <?php echo ucfirst(mb_strtolower(session_data('lastname'))) ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" aria-labelledby="alertsDropdown">
                <li>
                    <a class="dropdown-item" href="<?php echo base_url('admin/home/profile') ?>"><i class="fa fa-fw fa-user"></i> Profil</a>
                </li>
                <li class="w3-border-bottom"></li>
                <li>
                    <a class="dropdown-item" href="<?php echo base_url('admin/auth/loggout') ?>"><i class="fa fa-fw fa-power-off"></i> D&eacute;connecter</a>
                </li>
            </ul>
        </li>
    <?php }else{ ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/auth') ?>"><i class="fa fa-fw fa-sign-in"></i> Connecter</a>
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
                $.post('<?php echo base_url('admin/notification/notifView')?>', data, function(rep){
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
    })
</script>