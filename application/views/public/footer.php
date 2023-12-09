<footer class="jumbotron" style="border-radius: 0 !important;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <img alt="Multisoft-Academy" src="<?php echo img_url('logo/logo-text-white.png') ?>" class="img-fluid">
                <h6 class="text-center">Centre de Formation Professionnelle</h6>
                <h5 class="orange-color text-center"><b>MULTISOFT ACADEMY</b></h5>
                <h6 class="slogan text-center" style="font-size: 80%">Pour une formation multidimensionnelle!</h6>
                <br>
                Situé à Dang, Ngaoundéré, Derrière l'hôtel PACKEM PALACE.
                <br>
                <u>Contacts</u> :
                <ul>
                    <li>Téléphone : (+237) 655 811 916 - (+237) 690 983 673 - (+237) 697 969 696</li>
                    <li>
                        <u>Email</u> :
                        <a href="mailto:multisoftacademy@gmail.com" class="link">
                            multisoftacademy@gmail.com
                        </a>
                        | <a href="mailto:infos@msacad.com" class="link">infos@msacad.com</a>
                    </li>
                    <li>
                        <u>Horaires</u> :
                        <ul>
                            <li>Ouverture : 8H00</li>
                            <li>Fermeture : 18H30</li>
                        </ul>
                    </li>
                </ul>
                <a href="<?php echo base_url('newsletter') ?>" class=""><img src="<?php echo img_url('news-mini.png') ?>" class="mb-2 img-fluid"></a>
            </div>
            <div class="col-sm-12 col-lg-4">
                <h5 class="text-center orange-color"><b>PROGRAMMES D'ENSEIGNEMENT</b></h5>
                <b class="p-1">Formations Longues</b>
                <ul>
                    <?php
                    foreach ($fLesson as $key=>$filiere) {
                        if($key<7){
                            ?>
                            <li><a href="<?php echo base_url('enseignements').'/'.permalink($filiere->label).'--'.permalink($filiere->code) ?>" class="text-uppercase"> <?php echo $filiere->label;?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <b class="p-1">Formations Accélérées</b>
                <ul>
                    <?php
                    //var_dump($fLesson);
                    foreach ($cLesson as $key=>$cours) {
                        if($key<7){
                            ?>
                            <li><a href="<?php echo base_url('enseignements').'/'.permalink($cours->label).'--'.permalink($cours->code) ?>" class="text-uppercase"> <?php echo $cours->label;?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <b class="p-1">Formations Promotionnelles</b>
                <ul>
                    <?php
                    //var_dump($fLesson);
                    foreach ($pLesson as $key=>$promo) {
                        if($key<7){
                            ?>
                            <li><a href="<?php echo base_url('enseignements').'/'.permalink($promo->label).'--'.permalink($promo->code) ?>" class="text-uppercase"> <?php echo $promo->label;?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-sm-12 col-lg-4">
                <h5 class="text-center orange-color"><b>MULTISOFT ACADEMY - RESEAUX SOCIAUX</b></h5>
                <div class="">
                    <div class="fb-page" data-href="https://www.facebook.com/msoftacademy/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/msoftacademy/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/msoftacademy/">Multisoft Academy</a></blockquote></div>
                </div>
                <div class="mt-2">
	                <a class="twitter-timeline"  href="https://twitter.com/MsoftAcad"  data-chrome="nofooter noborders " data-tweet-limit="1">Tweets par @MsoftAcad</a>
                </div>
                <br>
                <a class="twitter-follow-button"  href="https://twitter.com/MsoftAcad"  data-size="small">Follow @MsoftAcad</a>
                <br>
            </div>
        </div>
        <div class="row pt-1" style="border-top: 1px solid rgba(255,255,255,.125);">
            <div class="text-center col-sm-12" >
                &copy; MULTISOFT ACADEMY
                <?php
                echo (intval(date('Y'))>2017)?'2017 - '.date('Y'):date('Y');

                ?>
                <br>
                Conception et développement par <a target="_blank" href="http://www.lefindex.com" class="orange-color">Le Findex</a>
            </div>
        </div>
    </div>
</footer>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
    </body>
</html>