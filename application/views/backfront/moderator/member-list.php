<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="w3-row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('LISTE DES membres') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>
    
            <div class="w3-row">
                <p style="margin-left: 25px;">L&eacute;gende : </p>
                <ul style="padding-bottom: 30px">
                    <li class="legend"><span class="w3-green">#</span> En attente</li>
                    <li class="legend"><span class="w3-white">#</span> Actif</li>
                    <li class="legend"><span class="w3-red">#</span> Bloqué</li>
                </ul>

                <div class="col-sm-12 table-responsive">
                        <?php
                        if(isset($users) And is_array($users) and !empty($users))
                        {
                            $k = 0;
                            ?>
                            <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th>Avatar</th>
                                    <th>Matricule</th>
                                    <th>Noms et Prénoms</th>
                                    <th>Contacts</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                            <?php
                            foreach ($users as $user)
                            {
                                $unlock = false;
                                if($user->state=='0'){
                                    $bgcolor = 'w3-green';
                                }elseif($user->state=='1'){
                                    $bgcolor = 'w3-white';
                                }else{
                                    $unlock = true;
                                    $bgcolor = 'w3-red';
                                }
                                $sexe = ($user->sexe==0)?'Mme':'Mr';
				$lastC = ($user->last_connexion == null)? "Jamais connecté" : moment($user->last_connexion)->fromNow()->getRelative();
                                $user->avatar = ($user->avatar)?$user->avatar:'/logo/logo.png';

                                echo '<tr id="'.$user->id.'"><td><span class="text-center '.$bgcolor.' text-white" style="padding: 7px">' . ++$k . '</span></td>';
                                echo '<td class="text-center"><img src="' . base_url($user->avatar) . '" class="responsive-img" height="50"></td>';
                                echo '<td>' . $user->number_id . '</td>';
                                echo '<td>' .$sexe.' '. strtoupper($user->lastname) . ' ' . ucfirst($user->firstname) . '</td>';
                                echo '<td>' . $user->phone .'<br>'. $user->mail . '<br>Connexion : <b>'.$lastC.'</b></td>';
                                echo '<td>';
                                echo '  <a href="'.base_url('moderatorGate/user/profile/'.mb_strtolower($user->number_id).'/'.permalink($user->firstname.' '.$user->lastname)).'" class="w3-btn w3-white w3-margin-small" title="Profil"><i class="fa fa-2x fa-user w3-text-blue" aria-hidden="true"></i></a>';
                                if($unlock)
                                    echo '<button class="w3-btn w3-white w3-margin-small" title="Débloquer" onclick="unlock(this)"><i class="fa fa-2x fa-unlock w3-text-green" aria-hidden="true"></i></button>';
                                echo'<button class="w3-btn w3-white w3-margin-small reset-pass" title="Réinitialiser le mot de passe" onclick="resetPass(this)"><i class="fa fa-refresh w3-tiny close w3-text-green" style=""></i><i class="fa fa-2x fa-lock"></i></button>';
                                echo '</td></tr>';
                            }
                            ?>
                                </tbody>
                            </table>
                            <?php
                        }else {
                            echo '<div class="h3 text-center text-warning">Aucun membre pour le moment ...</div>';
                        }
                        ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <style>
            .legend
            {
                text-decoration: none;
                display: inline-block;
                float: left;
                margin-left: 15px;
            }

            .legend span
            {
                padding: 7px;
                border: dashed;
                border-color: #0a0a0a;
            }
        </style>
    
        <script type="text/javascript">
$(document).ready(function(){
                    <?php if($val = get_flash_data()){
                        echo 'setTimeout(function(){
                            alertify.'.$val[0].'("'.$val[1].'");
                        }, 750);';
                    } ?>
                })
            function unlock($this){
                var $this_tr = $($this).parent().parent(),
                    $this_tds = $this_tr.find('td'),
                    data = {};
                alertify.confirm("<div class='w3-center'>Voulez vous débloquer le compte de: <br><b>"+$this_tds.eq(3).text()+"</b><br>De matricule: <b>"+$this_tds.eq(2).text()+"</b></div>", function(){
                    $.loader({className: 'blue-with-image-2', content: ''});
                    data = {mode:'js', type:'user', id:$this_tr.prop('id')};
                    $.post('<?php echo base_url('moderatorGate/user/unlock') ?>', data, function(rep){
                        $.loader('close');
                        if(rep.trim().split('*0*').length>1){
                            $(location).prop('href', '');
                        }else{
                            alertify.error('Une erreur c\'est produite.');
                        }
                    }).fail(function() {
                        $.loader('close');
                    });
                }).setHeader('Déblocage de compte');
            }

            function resetPass($this){
                var $this_tr = $($this).parent().parent(),
                    $this_tds = $this_tr.find('td'),
                    data = {};
                alertify.confirm("<div class='w3-center'>Voulez vous réinitialiser le mot de passe de: <br><b>"+$this_tds.eq(3).text()+"</b><br>De matricule: <b>"+$this_tds.eq(2).text()+"</b></div>", function(){
                    $.loader({className: 'blue-with-image-2', content: ''});
                    data = {mode: 'js', type:'user', id:$this_tr.prop('id')};
                    $.post('<?php echo base_url('moderatorGate/user/resetPassword') ?>', data, function(rep){
                        $.loader('close');
                        if(rep.trim().split('*0*').length>1);
                            //$(location).prop('href', '');
                        }).fail(function() {
                            $.loader('close');
                        });
                }).setHeader('Réinitialisation de mot de passe');
            }

            $(document).ready(function(){
                <?php
                    if (isset($status) and !empty($status))
                    {
                        if ($status)
                        {
                ?>
                alertify.defaults.theme.ok = "w3-btn w3-green";
                alertify.alert("<i class='fa fa-fw fa-check-circle w3-text-green'></i> Succès", "<?php echo $message ?>", function(){});
                <?php
                        } else {
                ?>
                alertify.defaults.theme.ok = "btn w3-btn btn-primary w3-red";
                alertify.alert("<i class='fa fa-fw fa-ban w3-text-red'></i> Echec", "<?php echo $message ?>", function(){});
                <?php
                        }
                    }
                ?>
                alertify.defaults.theme.ok = "w3-btn w3-blue";
                alertify.defaults.theme.cancel = "w3-btn w3-red";
                leftM(0, '#panel-membre');
            })
        </script>
    </div>

</div>
<!--END PAGE CONTENT -->