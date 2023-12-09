<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="text-justify">
                    <h4 class="text-uppercase">Résultats dans le forum</h4>
                    <table class="table w3-table-all " width="100%" id="dataTable" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="hidden">#</th>
                            <th>Sujets</th>
                            <th>Détails</th>
                        </tr>
                        </thead>
                        <tbody id="table-list">
                        <?php

                        foreach($result['posts'] as $key=>$post) {
                            ?>
                            <tr id="<?php echo $post->id ?>">
                                <td class="hidden"><?php echo $key ?></td>
                                <td>
                                    <b><?php echo $post->title ?><br></b>
                                    <p class="w3-text-grey small">
                                        Posté par : <b><?php echo $post->lastname." ".$post->firstname ?></b> <br>
                                        <b><?php  echo fromNow($post->post_date) ?></b>
                                        <?php
                                        if($post->solved=='1'){
                                            ?>
                                            <br><button disabled class="btn btn-sm btn-secondary green-color"> <i class="fa fa-trophy"></i> Sujet résolu!</button>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                </td>
                                <td class="">
                                    <b><?php echo $post->comment_nbr ?></b> messages<br>
                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('forum/sujet'.'/'.permalink                                    ($post->title).'--'.$post->id) ?>">Ouvrir</a>

                                </td>
                            </tr>
                            <?php
                        }


                        ?>
                        </tbody>
                    </table>

                    <h4>Résultats dans les enseignements</h4>
                    <div class="row my-2">
                        <?php
                        if(count($result['lessons'])>0){
                            foreach($result['lessons'] as $key=>$lesson){

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
                        }else{
                            echo "<div class='col-sm-12'>Aucun résultat</div>";
                        }

                        ?>

                        <div class="col-sm-12">
                            <a href="<?php echo base_url("enseignements/filiere") ?>" class="float-right link">Toutes les formations longues &rightarrow;</a>
                        </div>
                    </div>



                    <h4 class="text-uppercase">Résultats dans les nouvelles</h4>
                    <div class="row my-2">

                        <?php
                        if(count($result['news'])>0){
                            foreach($result['news'] as $new){
                                if($new->thumbnail!=null){
                                    ?>
                                    <div class="col-sm-12 new-block">
                                        <div class="row h-100">
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class="h4 new-title"><?php echo $new->title ?></a><br>
                                                <small class="small" style="color: grey">
                                                    Publié <b><?php echo  fromNow($new->save_date) ?></b>
                                                </small>
                                                <div class="text-justify">
                                                    <?php echo excerpt($new->content) ?> <a href="<?php echo base_url("nouvelles")."/$new->id-".permalink($new->title)?>" class=" blue-color">Lire plus</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>"><img width="" class="h-100" src="<?php echo base_url($new->thumbnail )?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>

                                    <div class="col-sm-12 new-block">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class="h4 new-title"><?php echo $new->title ?></a><br>
                                                <small class="small" style="color: grey">
                                                    Publié <b><?php echo fromNow($new->save_date) ?></b>
                                                </small>
                                                <div class="text-justify">
                                                    <?php echo excerpt($new->content) ?> <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class=" blue-color">Lire plus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                        }
                        else{
                            echo "<div class='col-sm-12'>Aucun résultat</div>";
                        }


                        ?>
                    </div>

                    <h4 class="text-uppercase">Résultats dans l'Agenda</h4>
                    <div class="row">

                        <?php
                        if(count($result['events'])>0){
                            foreach($result['events'] as $event){
                                ?>


                                <a href="<?php echo base_url("evenements")."/".permalink($event->title)."--".$event->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-uppercase"><?php echo $event->title ?></h5>
                                        <small><?php echo moment($event->start_date)->fromNow()->getRelative() ?></small>
                                    </div>
                                    <p class="mb-1">
                                        <?php echo $event->content ?>
                                    </p>
                                </a>


                                <?php
                            }
                        }
                        else{
                            echo "<div class='col-sm-12'>Aucun résultat</div>";
                        }


                        ?>
                    </div>



                </div>
            </div>

        </div>
    </div>

</div>