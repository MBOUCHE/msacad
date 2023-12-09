<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES UTILISATEURS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <p style="margin-left: 25px;">L&eacute;gende : </p>
            <ul style="padding-bottom: 30px">
                <li class="legend"><span class="w3-green">#</span> En attente</li>
                <li class="legend"><span class="w3-white">#</span> Actif</li>
                <li class="legend"><span class="w3-red">#</span> Bloqué</li>
            </ul>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Noms et Prénoms</th>
                        <th>Contacts</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($list) And is_array($list) and !empty($list))
                    {
                        //var_dump(count($list));
                        //var_dump($list);
                        $k = 0;
                        //var_dump($list);
                        foreach ($list as $user)
                        {
                            if($user->uid!=session_data('id')){
                                $k++;
                                $lastC = ($user->last_connexion == null)? "Jamais connecté" : moment($user->last_connexion)->fromNow()->getRelative();
                                $state = $user->state;
                                $bgcolor = ($state == '-1')? 'w3-red':(($state == '0')? 'w3-green':'w3-white');
                                $toHide = ($state == '0')?'w3-hide toHide':'';
                                echo '<tr><td><span class="text-center '.$bgcolor.' text-white" style="padding: 7px">' . $k . '</span></td>';
                                echo isset($user->photo) ? '<td class="text-center"><img src="' . base_url().$user->photo . '" class="responsive-img" height="50"></td>' :
                                    '<td class="text-center"><img src="' . img_url('/logo/logo.png') . '" class="responsive-img" height="50"></td>';
                                echo '<td>' . $user->number_id . '</td>';
                                echo '<td>' . strtoupper($user->lastname) . ' ' . ucfirst($user->firstname) . '</td>';
                                echo '<td>' . $user->phone .'<br>'. $user->mail . '<br>Connexion : <b>'.$lastC.'</b></td>';
                                echo '<td>
                                    <a href="'.base_url('trainner/user/profile').'/'.$user->uid.'" class="w3-btn w3-white w3-margin-small" title="Profil"><i class="fa fa-2x fa-user w3-text-blue" aria-hidden="true"></i></a>
                                    <button class="'.$toHide.' w3-btn w3-white w3-margin-small" title="'.($user->state=='-1'?'Déverouiller':'Vérouiller').'" onclick="alertify.confirm(\'Confirmation de '.($user->state=='-1'?'réactivation':'suspension').'\', \'Voulez-vous vraiment <b>'.($user->state=='-1'?'réactiver':'suspendre').'</b> cet utilisateur ?\',
                                                                                                                                                                                                    function(){
                                                                                                                                                                                                        window.location.href=\''.base_url('trainner/user/lock/').'\'+\'/\'+'.$user->uid.';
                                                                                                                                                                                                    },
                                                                                                                                                                                                    function(){
                                                                                                                                                                                                        alertify.error(\' '.($user->state=='-1'?'Réactivation ':'Suspension').' Annulée \');
                                                                                                                                                                                                    });
                                    "><i class="fa fa-2x '.($user->state=='-1'?'fa-unlock w3-text-green':'fa-lock w3-text-red').'" aria-hidden="true"></i></button>
                                    <!--button class="w3-btn w3-white w3-margin-small" title="Logs"><i class="fa fa-2x fa-bookmark" aria-hidden="true" style="cursor: pointer;" title="Log"></i></button--></td></tr>

                                    </td></tr>';
                            }

                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="6"  class="h3 text-center"><a href="#" class="text-warning">Aucun apprenant enregistré pour le moment ...</a><td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
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
        $('.toHide').remove();
        <?php
            if (isset($status) and !empty($status))
            {
                if ($status)
                {
        ?>
        alertify.defaults.theme.ok = "btn w3-btn btn-primary w3-green";
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
        alertify.defaults.theme.ok = "btn w3-btn btn-primary w3-blue";

        alm('collapseUsers', 0);

    })
</script>