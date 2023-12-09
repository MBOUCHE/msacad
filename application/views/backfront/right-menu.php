<!-- RIGHT STRIP  SECTION -->
<div id="right">
    <?php

    if(isset($userProfil))
    {
        $dc =  ($userProfil->last_connexion == null)? "Jamais connecté" : $userProfil->last_connexion;
        ?>

        <div class="w3-border  w3-responsive w3-border-gray">
            <div class="well well-small w3-blue w3-center w3-border-blue " style="border-radius: 0">
                <span>Profil utilisateur</span>
            </div>
            <div class="">
                <p class="w3-center"><small><b>Login </b></small> : <small><br> <?php echo $userProfil->mail ?><br> <?php echo  $userProfil->number_id ?></small>
                </p>
                <p class="w3-center"><small><b>Date d'inscription </b></small> :  <br><small><?php echo moment($userProfil->register_date)->fromNow()->getRelative()?></small>
                </p>
                <p class="w3-center"><small><b><?php echo ucfirst("Dernière connexion")?> </b></small> :  <br> <small><?php echo moment($dc)->fromNow()->getRelative()?></small>  </p>
            </div>
        </div>

        <?php
    }
    
    if(!empty($lastPost))
    {
        ?>
        <hr class="w3-border">
        <div class="w3-border  w3-responsive w3-border-gray">
            <div class="well well-small w3-blue w3-center w3-border-blue " style="border-radius: 0">
                <span>Infos du Forum</span>
            </div>
            <div class="">
                <p class="w3-margin-left">
                    <small>
                        <b><?php echo $nbrPost ?></b> sujet(s) / <b><?php echo $nbrComment ?></b> réponse(s)
                    </small>
                </p>
                <p class="w3-margin-left">
                    <small>
                        <b>Dernier sujet </b> :
                        <br>&blacktriangleright;
                        <b><i><a target="_blank" href="<?php echo base_url('forum/sujet/'.permalink($lastPost->title).'--'.$lastPost->id) ?>"> <?php echo $lastPost->title ?></a></i></b>
                    </small>
                </p>
                <p class="w3-margin-left">
                    <small>
                        Posté  <b><?php echo moment($lastPost->post_date)->fromNow()->getRelative()?></b><br>
                        Résolu ? <b><?php echo ($lastPost->solved=='1')?"OUI":"NON" ?></b><br>
                        réponses <b><?php echo $lastPost->comment_nbr ?></b><br>
                    </small>
                </p>
                <?php if(!empty($lastComment)){
                    ?>
                    <p class="w3-margin-left">
                        <small>
                            Dernière réponse : <br><b><?php echo moment($lastComment->post_date)->fromNow()->getRelative()?> </b><br>
                            Par <b> <?php echo mb_strtoupper($lastComment->lastname) ?></b>
                        </small>
                    </p>
                    <?php
                } ?>

            </div>
        </div>

        <?php
    }
    ?>

    <?php if(in_array(STUDENT, session_data('roles'))){ // student

        if(isset($acadProfil)) {
            if (empty($acadProfil )) {
                $es = 0;
                $ec = 0;
                $enc = 0;
            } else {
                $ec = 0;
                foreach ($acadProfil as $item) {
                    if($item->state==1)
                        $ec++;
                }
                $es = count($acadProfil);
            }
            ?>

            <hr class="w3-border">
            <div class="w3-border  w3-responsive w3-border-gray">
                <div class="well well-small w3-blue w3-center w3-border-blue" style="border-radius: 0">
                    <span>Profil académique</span>
                </div>
                <div class="">
                    <p class="w3-center"> <small><b> <?php echo ucfirst("Enseignement(s) suivi(s) en présentiel")?> </b></small> : <small><?php echo $es?><br> (<?php echo $ec?> en cours)</small>   </p>
                </div>
                <div class="">
                    <p class="w3-center"> <small><b> <?php echo ucfirst("Enseignement(s) suivi(s) en ligne")?> </b></small> : <small><?php echo $es?><br> (<?php echo $ec?> en cours)</small>   </p>
                </div>
            </div>

            <?php
        }
    }
    if(in_array(TRAINER, session_data('roles'))){ // trainer
        if(isset($trainerProfil)){
            $ed = count($trainerProfil);
             ?>

    <hr class="w3-border">
    <div class="w3-border  w3-responsive w3-border-gray">
        <div class="well well-small w3-blue  w3-center w3-border-blue" style="border-radius: 0">
            <span>Profil professionnel</span>
        </div>
        <div class="">
            <p class="w3-center">
                <small><b><?php echo ucfirst("Enseignement(s) dispensé(s)") ?></b></small> :
                <small><?php echo $ed ?></small>   </p>
            <p class="w3-center">
                <small><b> <?php echo ucfirst("nombre d'heure(s) dispensé(s)")?> </b></small> :
                <small><?php echo (empty($hourDispense) ? 0 : $hourDispense)?> H</small>
            </p>
            
        </div>
    </div>
            <?php
        }
    }
    if(in_array(MODERATOR, session_data('roles'))){ // moderator
        if(isset($moderatorProfil)){
            $attente = 0; $membre = 0; $bloque = 0;
            foreach ($moderatorProfil as $item) {
                if((int)$item->state == 0)
                    $attente++;
                elseif((int)$item->state == -1)
                     $bloque++;
            }
            $membre = count($moderatorProfil);
            ?>

            <hr class="w3-border">
            <div class="w3-border  w3-responsive w3-border-gray">
                <div class="well well-small w3-blue  w3-center w3-border-blue" style="border-radius: 0">
                    <span>Comptes utilisateur </span>
                </div>
                <div class="">
                    <p class="w3-center"> <small><b><?php echo $membre?> </b></small> <?php echo ucfirst("membre(s)")?> </p>
                    <p class="w3-center"><small><b> <?php echo $attente?> </b></small>  <?php echo  ucfirst("compte(s) en attente")?> </p>
                    <p class="w3-center"><small><b> <?php echo $bloque?> </b></small>  <?php echo ucfirst("compte(s) bloqué(s)")?>  </p>
                </div>
            </div>

            <?php
        }
    }

    ?>


</div>
<!-- END RIGHT STRIP  SECTION -->