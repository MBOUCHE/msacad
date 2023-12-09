<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">


                    <div class="card float-left mr-3 mb-3 panel-lesson">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-uppercase">
                                <?php
                                if($lesson->type=="cours")
                                    echo "Formation Accélérée";
                                elseif($lesson->type=='filière')
                                    echo "Formation Longue";
                                else
                                    echo "Formation Promotionnelle";

                                ?>
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa fa-hashtag green-color"></i>&nbsp;
                                Code : &nbsp;<b><?php echo $lesson->code; ?></b></li>
                            <li class="list-group-item">
                                <i class="fa fa-clock-o green-color"></i>&nbsp;
                                Nombre d'heures :&nbsp; <b><?php echo $lesson->duration; ?> H</b></li>
                            <li class="list-group-item text-uppercase text-primary">
                                <i class="fa fa-trophy green-color"></i> &nbsp;
                                
                                <b class="text-primary" style="font-size: 90%">
                                <?php
                                if($lesson->type=='filière')
                                    echo "Attesttation de Fin de Formation";
                                else
                                    echo "Certificat de Fin de Formation";

                                ?>
                                    
                                </b>
                            </li>
                            <li class="list-group-item text-uppercase text-primary">
                                <i class="fa fa-2x fa-user-plus green-color"></i> &nbsp;
                                <a href="<?php echo base_url('enseignements/register').'/'.permalink($lesson->label).'--'.permalink($lesson->code) ?>" class="btn top-link w3-text-white orange-bg-color" >M'inscrire</a>
                            </li>
                        </ul>
                    </div>
                <div class="text-justify panel-lesson-content" style="">
                    <?php  echo $lesson->syllabus ?>
                    <hr>
                    <h4>Les évaluations de l'enseignement:</h4>
                    <ul>
                        <?php

                        foreach($evaluations as $eval){
                            ?>
                            <li>
                                <b><?php echo $eval->label ?></b>
                                <ul>
                                    <li>Code : <b><?php echo $eval->code ?></b></li>
                                    <li>Pourcentage : <b><?php echo $eval->ev_percent ?>%</b></li>
                                </ul>
                            </li>
                            <?php
                        }

                        ?>
                    </ul>
                    <div class="fb-like" data-layout="standard" data-action="recommend" data-size="large" data-show-faces="true" data-share="true"></div>
                </div>
            </div>



        </div>
    </div>

</div>