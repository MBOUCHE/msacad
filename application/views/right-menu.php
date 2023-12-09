 <!-- RIGHT STRIP  SECTION -->
        <div id="right">
            <?php //var_dump($vague); die(0);
                if(isset($userProfil))
                {
                    $dc =  ($userProfil->last_connexion == null)? "Jamais connecté" : $userProfil->last_connexion;
                    echo '
                        <div class="w3-border w3-round w3-responsive w3-border-gray">
                        <div class="well well-small w3-blue w3-card-4 w3-center w3-border-blue">
                            <span>Profil utilisateur</span>
                        </div>
                        <div class="">
                            <p class="w3-center"><small><b>Login </b></small> : <small><br> '.$userProfil->mail.' <br> /'.$userProfil->number_id.'</small>  </p>
                            <p class="w3-center"><small><b>Date de souscription </b></small> :  <br><small>'.$userProfil->register_date.'</small>  </p>
                            <p class="w3-center"><small><b> '.ucfirst("Dernière connexion").' </b></small> :  <br> <small>'.$dc.'</small>  </p>
                        </div>
                    </div>
                    ';
                }
            ?>

            <?php if(in_array(STUDENT, session_data('roles'))){ // student
                if(isset($acadProfil)) {
                    if ($acadProfil == null) {
                        $es = 0;
                        $ec = 0;
                        $enc = 0;
                    } else {
                        $ec = 0;
                        foreach ($acadProfil as $item) {
                            $ec++;
                        }
                        $es = count($acadProfil);
                    }
                    echo '
                    <hr class="w3-border">
                    <div class="w3-border w3-round w3-responsive w3-border-gray">
                        <div class="well well-small w3-blue w3-card-4 w3-center w3-border-blue">
                            <span>Profil académique</span>
                        </div>
                        <div class="">
                            <p class="w3-center"> <small><b> '.ucfirst("Enseignement(s) suivi(s)").' </b></small> : <small>' . $es . ' <br> ('.$ec.' en cours)</small>   </p>
                        </div>
                    </div>
                    ';
                }
            }
            if(in_array(TRAINER, session_data('roles'))){ // trainer
                if(isset($trainerProfil)){
                    $ed = count($trainerProfil);
                    echo '
                    <hr class="w3-border">
                    <div class="w3-border w3-round w3-responsive w3-border-gray">
                        <div class="well well-small w3-blue w3-card-4 w3-center w3-border-blue">
                            <span>Profil professionnel</span>
                        </div>
                        <div class="">
                            <p class="w3-center"><small><b> '.ucfirst("Enseignement(s) dispensé(s)").' </b></small> : <small>'.$ed.'</small>   </p>
                            <p class="w3-center"><small><b> '.ucfirst("nombre d'heure(s) dispensé(s)").' </b></small> : <small>'.(empty($hourDispense) ? 0 : $hourDispense).'h</small>   </p>
                            <p class="w3-center"><small><b> '.ucfirst("Vague tenue ").' </b></small> :';
                    foreach ($vague as $item) {
                        echo ' <small>'.$item->code.'</small> ;';

                    }
                        echo '</p></div>
                    </div>

                    ';
                }
            }
            if(in_array(MODERATOR, session_data('roles'))){ // moderator
                if(isset($moderatorProfil)){ $attente = 0; $membre = 0; $bloque = 0;
                    foreach ($moderatorProfil as $item) {
                        if((int)$item->state == 0)
                            $attente++;
                        elseif((int)$item->state == 1)
                            $membre++;
                        else $bloque++;
                    }
                    $ed = count($trainerProfil);
                    echo '
                    <hr class="w3-border">
                    <div class="w3-border w3-round w3-responsive w3-border-gray">
                        <div class="well well-small w3-blue w3-card-4 w3-center w3-border-blue">
                            <span>Profil du moderateur</span>
                        </div>
                        <div class="">
                            <p class="w3-center"> <small><b> '.$membre.' </b></small> '.ucfirst("membre(s)").' :  </p>
                            <p class="w3-center"><small><b> '.$attente.' </b></small>  '.ucfirst("compte en attente(s)").' :  </p>
                            <p class="w3-center"><small><b> '.$bloque.' </b></small>  '.ucfirst("compte bloqué(s)").' :  </p>
                        </div>
                    </div>

                    ';
                }
            }

            ?>


        </div>
         <!-- END RIGHT STRIP  SECTION -->