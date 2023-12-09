<div class="row mb-3">
    <div class="col-sm-12">
        <p class=" top-link l-bloc-title">
            Babillard
        </p>

    </div>

    <div class="col-sm-12">
        <div class="card mb-3" style="border-radius: 0">
            <div class="card-header" style=""><i class="fa fa-bullhorn fa-2x float-left"></i>MSOFT FLASH</div>
            <div class="" style="background: #7c7c7c; color: white; min-height: 150px">
                <div class="card-text m-2">
                    <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="height: 150px">
                        <?php
                        if(isset($infosFlash) and !empty($infosFlash)){
                            foreach($infosFlash as $iFlash){
                                ?>

                                    <span class="info-flash">
                                        <?php echo $iFlash->content?>
                                    </span>
                                    <hr style="border: 1px dashed #FF8E0F">

                                <?php
                            }

                        }
                        else{
                            ?>
                            <span class="info-flash">Aucune Info Flash
                        </span>
                            <br>
                            <hr style="border: 1px dashed #FF8E0F">

                            <?php
                        }
                        ?>
                    </marquee>

                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12">
        <a class="align-middle" href="<?php echo base_url('emplois-de-temps') ?>">
            <p class="l-sidebar-block top-link">
                <i class="fa fa-2x fa-table float-left m-2"></i>
                <i class="fa fa-3x fa-angle-right  float-right m-1"></i>
               Emplois de temps
            </p>
        </a>
    </div>
    <div class="col-sm-12">
        <a class="align-middle" href="<?php echo base_url('plannings') ?>">
            <p class="l-sidebar-block top-link">
                <i class="fa fa-2x fa-pencil-square-o float-left m-2"></i>
                <i class="fa fa-3x fa-angle-right  float-right m-1"></i>
                Plannings d'examen
            </p>
        </a>
    </div>
    <div class="col-sm-12">
        <a class="align-middle" href="<?php echo base_url('resultats') ?>">
            <p class="l-sidebar-block top-link">
                <i class="fa fa-2x fa-bar-chart float-left m-2"></i>
                <i class="fa fa-3x fa-angle-right  float-right m-1"></i>
               Résultats d'examen
            </p>
        </a>
    </div>
    <div class="col-sm-12">
        <a class="align-middle" href="<?php echo base_url('barbillard/apprenants') ?>">
            <p class="l-sidebar-block top-link">
                <i class="fa fa-2x fa-users float-left m-2"></i>
                <i class="fa fa-3x fa-angle-right  float-right m-1"></i>
               Liste des apprenants
            </p>
        </a>
    </div>
    
    <div class="col-sm-12">
        <a class="align-middle" href="<?php echo base_url('requetes') ?>">
            <p class="l-sidebar-block top-link">
                <i class="fa fa-2x fa-question-circle float-left m-2"></i>
                <i class="fa fa-3x fa-angle-right  float-right m-1"></i>
                Requêtes académiques
            </p>
        </a>
    </div>
    <div class="col-sm-12">

        <div class="card mb-3" style="border-radius: 0">
            <div class="card-header" style=""><i class="fa fa-calendar fa-2x float-left"></i>Agenda</div>
            <div class="" style="background: #7c7c7c; color: white; min-height: 150px">
                <div class="list-group" >
                    <?php

                    if(isset($lastEvent) and !empty($lastEvent)){
                        foreach($lastEvent as $event){
                            ?>


                            <a href="<?php echo base_url("evenements")."/".permalink($event->title)."--".$event->id?>" class="list-group-item list-group-item-action flex-column align-items-start" style="border-radius: 0;background: inherit">
                                <div class="w-100 justify-content-between">
                                    <span class="w3-text-yellow"><?php echo moment($event->start_date)->fromNow()->getRelative() ?></span>
                                    <h5 class="mb-1 text-uppercase w3-text-white"><?php echo $event->title ?></h5>
                                </div>
                            </a>


                            <?php
                        }
                        ?>


                        <a href="<?php echo base_url("evenements")?>" class="list-group-item list-group-item-action flex-column align-items-start" style="border-radius: 0;background: inherit">
                            <div class="w-100 justify-content-between">
                                <h5 class="mb-1 text-right w3-text-yellow"> &Eacute;vènements à venir &rightarrow;</h5>
                            </div>
                        </a>


                        <?php
                    }
                    else
                    echo "<a class='list-group-item list-group-item-action flex-column align-items-start' style='border-radius: 0;background: inherit'>Aucun évènement à venir</a>";

                    ?>
                </div>
            </div>
        </div>
    </div>

</div>