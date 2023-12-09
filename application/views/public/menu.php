<nav role="navigation">
    <a href="javascript:void(0);" class="ic menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </a>
    <a href="javascript:void(0);" class="ic close"></a>
    <ul class="main-nav">
        <li class="top-level-link">
            <a class="mega-menu" href="<?php echo base_url() ?>"><span>Accueil</span></a>
            <div class="sub-menu-block">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h3 class="sub-menu-head">à Propos</h3>
                        <ul class="sub-menu-lists">
                            <li><a href="<?php echo base_url(MOT_DE_BIENVENUE) ?>">Mot de bienvenue</a></li>
                            <li><a href="<?php echo base_url(HISTORIQUE) ?>">Historique</a></li>
                            <li><a href="<?php echo base_url(CHIFFRES_CLES) ?>">Chiffres clés</a></li>
                        </ul>

                        <h3 class="sub-menu-head">Le personnel</h3>
                        <ul class="sub-menu-lists">
                            <li><a href="<?php echo base_url(PERSONNEL_PEDAGOGIQUE) ?>">Personnel pédagogique</a></li>
                            <li><a href="<?php echo base_url(PERSONNEL_APPUI) ?>">Personnel d'appui</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-8">
                        <h3 class="sub-menu-head">Apperçu de MULTISOFT ACADEMY</h3>
                        <img class="img-fluid" src="<?php echo img_url("msoft-profil.png") ?>">
                    </div>
                </div>

            </div>
        </li>

        <li class="top-level-link">
            <a href="<?php echo base_url(PRESENTATION) ?>"><span>Présentation</span></a>
        </li>
        <li class="top-level-link">
            <a href="<?php echo base_url('enseignements') ?>" class="mega-menu"><span>Formations en présentielle</span></a>
            <div class="sub-menu-block">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h3 class="sub-menu-head">Formations Longues</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center"><i class="fa fa-graduation-cap fa-5x w3-center blue-color" aria-hidden="true"></i></li>
                            <li>

                                Préparation au <b>Diplôme de Qualification Professionnelle</b> dans les filières homologuées du <b>Ministère de l'emloi
                                    et de la Formation Professionnelle</b>.
                            </li>
                            <li><a href="<?php echo base_url('enseignements/filiere') ?>" class="link">Voir toutes les filières</a></li>
                        </ul>

                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h3 class="sub-menu-head">Formations Accélérées</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center">
                                <i class="fa fa-forward fa-5x w3-center green-color" aria-hidden="true"></i>
                            </li>
                            <li>
                                <b>Un besoin pressant de connaissances ?</b><br> Ne cherchez plus!
                                Formez-vous rapidement en suivant nos cours.
                            </li>
                            <li>
                                <a href="<?php echo base_url('enseignements/cours') ?>" class="link">Voir tous les cours rapides</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h3 class="sub-menu-head">Formations Promotionnelles</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center">
                                <i class="fa fa-gift fa-5x w3-center orange-color" aria-hidden="true"></i>
                            </li>
                            <li>
                                <b>Formation à des prix réduits ?</b><br>
                                Découvrez nos offres promotionnelles et nos réductions.
                            </li>
                            <li>
                                <a href="<?php echo base_url('enseignements/promotion') ?>" class="link">Voir toutes les offres de promotion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        <li class="top-level-link">
            <a href="<?php echo base_url().'e_controllers/c_home_page'; ?>" class="mega-menu" ><span>FORMATIONS EN LIGNE</span></a>
            <div class="sub-menu-block">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <h3 class="sub-menu-head">Formations Longues en ligne</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center"><i class="fa fa-graduation-cap fa-5x w3-center blue-color" aria-hidden="true"></i></li>
                            <li>
                                Préparation au <b>Diplôme de Qualification Professionnelle</b> dans les filières homologuées du <b>Ministère de l'emloi
                                    et de la Formation Professionnelle</b>.
                            </li>
                            <li><a href="<?php echo base_url().'e_controllers/c_home_page/list_lesson';?>" class="link">Voir toutes les filières longues en ligne</a></li>
                        </ul>

                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <h3 class="sub-menu-head">Formations Accélérées en ligne</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center">
                                <i class="fa fa-forward fa-5x w3-center green-color" aria-hidden="true"></i>
                            </li>
                            <li>
                                <b>Un besoin pressant de connaissances ? </b><b>Pas le temps ou les moyens d'aller directement en cours cotidiennement ? </b><br> Ne cherchez plus!
                                Formez-vous à distance et rapidement en suivant nos cours.
                            </li>
                            <li>
                                <a href="<?php echo base_url().'e_controllers/c_home_page/list_lesson2'?>" class="link">Voir tous les cours rapides en ligne</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        <li class="top-level-link">
            <a href="<?php echo base_url(SERVICES) ?>" class="mega-menu"><span>Services</span></a>
            <div class="sub-menu-block">
                <div class="row">
                    <div class=" col-sm-3">
                        <h3 class="sub-menu-head">Secrétariat</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center"><i class="fa fa-print fa-5x w3-center blue-color" aria-hidden="true"></i></li>
                            <li>
                                Impressions, photocopies, scans et bien d'autres services liés au secrétariat.</li>

                        </ul>
                    </div>
                    <div class=" col-sm-3">
                        <h3 class="sub-menu-head">Pôle Développement</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center">
                                <i class="fa fa-code fa-5x w3-center green-color" aria-hidden="true"></i>
                            </li>
                            <li>
                                Développement des applications web, desktop et mobile.
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="sub-menu-head">Conseils techniques</h3>
                        <ul class="sub-menu-lists">
                            <li class="w3-center">
                                <i class="fa fa-wrench fa-5x w3-center orange-color" aria-hidden="true"></i>
                            </li>
                            <li>
                                Consultattion, conseils et suivi informatique.
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="sub-menu-head">Et bien d'autres</h3>
                        <ul class="sub-menu-lists">
                            <li>
                                <a href="<?php echo base_url(SERVICES) ?>" class="link">Voir tous nos services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        <li class="top-level-link">
            <a href="<?php echo base_url('forum') ?>"><span>Forum</span></a>
        </li>
        <li class="top-level-link">
            <a href="<?php echo base_url(CONTACTS) ?>"><span>Contacts</span></a>
        </li>
    </ul>
</nav>
