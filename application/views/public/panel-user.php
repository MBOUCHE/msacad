<?php
if(session_data_isset('connect') and session_data('connect')) {
    if (!session_data_isset('sudo') and !session_data('sudo')){
        ?>

        <div class="portail panel-user w3-text-white ">
            <a href="<?php echo base_url(lcfirst(role_tostring(MEMBER, 'en').'Gate')) ?>"><img height="40" class=" avatar" src="<?php echo base_url(session_data('avatar')) ?>"></a>

            <div class="dropdown d-inline-block">
                <span class=" dropdown-toggle w3-text-black" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b class="pl-1"><?php echo excerpt(session_data('lastname'),15) ?></b>
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <span class="dropdown-header">Vos comptes</span>
                    <?php
                    if(session_data_isset('roles') and session_data('roles')){
                        foreach (session_data('roles') as $item) {
                            ?>
                            <a class='dropdown-item' href='<?php echo base_url(lcfirst(role_tostring($item, 'en').'Gate')); ?>'><?php echo 'Compte '.role_tostring($item) ?></a>
                            <?php
                        }
                    }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('account/logout/') ?>">Déconnexion</a>
                </div>
            </div>
            <div id="topAlertsDropdown" class="dropdown d-inline-block pl-2" >
                <span class="badge  badge-success dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="notifs-info"><?php if(isset($notif)) echo (string)count($notif); else echo 0 ?></span> <i class="fa fa-bell"></i>
                </span>
                <div class="dropdown-menu dropdown-menu dropdown-alerts w3-responsive w3-small" aria-labelledby="dropdownMenuLink" style="max-height: 250px; min-width: 325px;">
                    <ul style="padding: 3px;">

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
                                            <small class="text-muted">
                                                <?php
                                                $time = moment($item->send_date);
                                                echo ($time) ? $time->fromNow()->getRelative() : '';
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                </li>
                                <hr class="" style="margin: 0; margin-bottom: 3px;">
                                <?php
                            }
                        }
                        else { ?>
                        <li class="w3-padding-small">
                            <a class="w3-text-red">Pas de nouvelles notifications!</a>
                        <li>
                            <hr class="" style="margin: 0; margin-bottom: 3px;">
                            <?php } ?>
                    </ul>
                </div>
            </div>


        </div>

        <?php
    }else{
        ?>
        <a class="portail btn green-bg-color w3-text-white top-link" href="<?php echo base_url('account/login') ?>"><b>Portail</b>, Connectez-vous</a>

        <a class=" btn orange-bg-color w3-text-white top-link" href="<?php echo base_url('account/signup') ?>"><b>Pas de compte ? </b>, Inscrivez-vous</a><br>

        <?php
    }
}
else{
    ?>
    <a class="portail btn green-bg-color w3-text-white top-link" href="<?php echo base_url('account/login') ?>"><b>Portail</b>, Connectez-vous</a>

    <a class=" btn orange-bg-color w3-text-white top-link" href="<?php echo base_url('account/signup') ?>"><b>Pas de compte ? </b>, Inscrivez-vous</a><br>

    <?php
}

?>



<script>
    $(document).ready(function(){
        $('#topAlertsDropdown').on('shown.bs.dropdown', function(){
            var $notifs = $(this).find('.notifs'), nb = $notifs.length, data = {mode: 'js', id: []}, $nbNotif = $(this).find('.notifs-info');
            if(nb > 0){
                for(var i=0; i<nb; i++){
                    data.id[i] = $notifs.eq(i).attr('id');
                }
                $.post('<?php echo base_url('notifications/notifView')?>', data, function(rep){
                    if(rep.trim().split('*0*').length>1){
                        $nbNotif.text(0);
                    }
                });
            }
        });
    })
</script>