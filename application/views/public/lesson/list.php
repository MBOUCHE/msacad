<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <a class="btn btn-primary" href="<?php echo upload_url('static/liste-enseignements.pdf') ?>"><i class="fa fa-file-pdf-o"></i> Télécharger la liste de tous les enseignements </a>

                <div class="row">
                    <div class="col-sm-12 my-3">
                        <h4 class="text-uppercase card-header">Formations Longues</h4>
                    </div>

                    <?php

                    foreach($fLesson as $key=>$lesson){
                        if($key<6){
                            ?>
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-1">
                                <div class="card" style="">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-uppercase"><?php echo $lesson->label ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Code : &nbsp;<b><?php echo $lesson->code; ?></b></li>
                                        <li class="list-group-item">
                                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                                            Nombre d'heures :&nbsp; <b><?php echo $lesson->duration; ?> H</b>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-money green-color"></i>&nbsp;
                                            Frais de formation :&nbsp; <b><?php echo number_format($lesson->fees,0,'',' ') ; ?> CFA</b>
                                        </li>
                                        <li class="list-group-item text-uppercase text-primary">
                                            <i class="fa fa-trophy green-color"></i> &nbsp;
                                            <b class="text-primary" style="font-size: 90%">Attesttation de Fin de Formation</b>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <p class="card-text"><?php  echo excerpt($lesson->syllabus,150) ?></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?php echo base_url('enseignements').'/'.permalink($lesson->label).'--'.permalink($lesson->code) ?>" class="card-link btn btn-primary " style="border-radius: 0">Détails</a>
                                        <a href="<?php echo base_url('enseignements/register').'/'.permalink($lesson->label).'--'.permalink($lesson->code) ?>" class="card-link btn top-link w3-text-white orange-bg-color">M'inscrire</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                        <?php
                    }

                    ?>

                    <div class="col-sm-12">
                        <a href="<?php echo base_url("enseignements/filiere") ?>" class="float-right link">Toutes les formations longues &rightarrow;</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 my-3">
                        <h4 class="text-uppercase card-header">Formations Accélérées</h4>
                    </div>

                    <?php

                    foreach($cLesson as $key=>$cours){
                        if($key<6){
                            ?>
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-1">
                                <div class="card" style="">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-uppercase"><?php echo $cours->label ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Code : &nbsp;<b><?php echo $cours->code; ?></b></li>
                                        <li class="list-group-item">
                                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                                            Nombre d'heures :&nbsp; <b><?php echo $cours->duration; ?> H</b></li>
                                        <li class="list-group-item">
                                            <i class="fa fa-money green-color"></i>&nbsp;
                                            Frais de formation :&nbsp; <b><?php echo number_format($cours->fees,0,'',' ') ; ?> CFA</b>
                                        </li>
                                        <li class="list-group-item text-uppercase text-primary">
                                            <i class="fa fa-trophy green-color"></i> &nbsp;
                                            <b class="text-primary">Certificat de Fin de Formation</b>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <p class="card-text"><?php  echo excerpt($cours->syllabus) ?></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?php echo base_url('enseignements').'/'.permalink($cours->label).'--'.permalink($cours->code) ?>" class="card-link btn btn-primary " style="border-radius: 0">Détails</a>
                                        <a href="<?php echo base_url('enseignements/register').'/'.permalink($cours->label).'--'.permalink($cours->code) ?>" class="card-link btn top-link w3-text-white orange-bg-color">M'inscrire</a>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }

                    }

                    ?>

                    <div class="col-sm-12">
                        <a href="<?php echo base_url("enseignements/cours") ?>" class="float-right link">Toutes les formations accélérées &rightarrow;</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 my-3">
                        <h4 class="text-uppercase card-header">Formations Promotionnelles</h4>
                    </div>

                    <?php

                    foreach($pLesson as $key=>$promotion){
                        if($key<6){
                            ?>
                            <div class="col-sm-12 col-md-6 col-lg-4 mb-1">
                                <div class="card" style="">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-uppercase"><?php echo $promotion->label ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Code : &nbsp;<b><?php echo $promotion->code; ?></b></li>
                                        <li class="list-group-item">
                                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                                            Nombre d'heures :&nbsp; <b><?php echo $promotion->duration; ?> H</b></li>
                                        <li class="list-group-item">
                                            <i class="fa fa-money green-color"></i>&nbsp;
                                            Frais de formation :&nbsp; <b><?php echo number_format($promotion->fees,0,'',' ') ; ?> CFA</b>
                                        </li>
                                        <li class="list-group-item text-uppercase ">

                                            <i class="fa fa-trophy green-color"></i> &nbsp;
                                            <b class="text-primary">Certificat de Fin de Formation</b>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <p class="card-text"><?php  echo  excerpt($promotion->syllabus,150) ?></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?php echo base_url('enseignements').'/'.permalink($promotion->label).'--'.permalink($promotion->code) ?>" class="card-link btn btn-primary " style="border-radius: 0">Détails</a>
                                        <a href="<?php echo base_url('enseignements/register').'/'.permalink($promotion->label).'--'.permalink($promotion->code) ?>" class="card-link btn top-link w3-text-white orange-bg-color">M'inscrire</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    }

                    ?>

                    <div class="col-sm-12">
                        <a href="<?php echo base_url("enseignements/promotion") ?>" class="float-right link">Toutes les formations promotionnelles &rightarrow;</a>
                    </div>


                </div>
            </div>



        </div>
    </div>

</div>