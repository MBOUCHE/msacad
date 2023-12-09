<div class="row">

    <div class="col-sm-12 mb-2">
        <a class="r-sidebar-block top-link r-sidebar-block-link" href="<?php echo upload_url('static/formulaire-inscription.pdf') ?>">
            <div class="div-register-form " style="background-image: url('<?php echo img_url("register-form.jpg") ?>');
                background-size : cover">
                <span  class="r-sidebar-block-title">
                    Télécharger le formulaire d'inscription
                </span>
            </div>
        </a>
    </div>
    

    <div class="col-sm-12 mb-2">
        <div class="r-sidebar-block">
            <span class="r-sidebar-block-title">Programmes d'enseignement</span>
            <b class="p-1">Formations Longues</b>
            <ul>
                <?php
                foreach ($fLesson as $key=>$filiere) {
                    if($key<5){
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
                    if($key<5){
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
                    if($key<5){
                        ?>
                        <li><a href="<?php echo base_url('enseignements').'/'.permalink($promo->label).'--'.permalink($promo->code) ?>" class="text-uppercase"> <?php echo $promo->label;?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>

            <a href="<?php echo base_url("enseignements") ?>" class="float-right link">Voir tous les programmes &rightarrow;</a><br><br>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="r-sidebar-block">
            <span class="r-sidebar-block-title">MULTISOFT Academy en chiffres</span>
            <span class="labelInfo">

                <span class='numscroller blue-color h3' data-min='1' data-max='<?php echo ($allReg+500) ?>' data-delay='5' data-increment='10'></span>
                <br>
                 <span class="label">Apprenants formés</span>
            </span>
            <br>
            <span class="labelInfo">
                <span class='numscroller  blue-color h3' data-min='1' data-max='<?php echo ($allLes) ?>' data-delay='5' data-increment='10'></span>
                <br>
                <span class="label">Enseignements </span>

            </span>
            <br>
            <span class="labelInfo">
                  <span class='numscroller blue-color h3' data-min='1' data-max='<?php echo ($allMem) ?>' data-delay='5' data-increment='10'></span>
                <br>
                <span class="label">Membres inscrits </span>

            </span>
            <br>
            <span class="labelInfo">
                <span class='numscroller blue-color h3' data-min='1' data-max='<?php echo ($visitors) ?>' data-delay='5' data-increment='100'></span>
                <br>
                <span class="label">Visiteurs</span>

            </span>
            <br>
            <span class="labelInfo">
               <span class='numscroller blue-color h3' data-min='1' data-max='<?php echo ($visits) ?>' data-delay='5' data-increment='1000'></span>
                <br>
                <span class="label">Pages visitées </span>

            </span>

        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <a class="r-sidebar-block top-link r-sidebar-block-link" href="<?php echo base_url('newsletter') ?>">
            <div class=" " style="background-image: url('<?php echo img_url("msoft-letter.png") ?>');
                background-size : cover;height:350px">
                
            </div>
        </a>
    </div>
</div>