<!--PAGE CONTENT -->
<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="row ">
                    <div class="col-sm-12">
                        <?php if ($evals!==null) { ?>
                            <div class="row mb-1">
                                <div class="col-sm-12 w3-text-dark-gray">
                                    <?php if ($all) { ?>
                                        <h4 class="text-center"><b><?php echo mb_strtoupper("Résultats d'examen de fin de formation") ?></b></h4>
                                        <h4 class="text-center"><b>SESSION DE <?php echo mb_strtoupper(moment($session[0]->date)->format('F Y'));  ?></b></h4>
                                    <?php }?>
                                    <h4><b>Vague : </b><?php echo $promotion->promotion->code ?> </h4>
                                    <h4><b>Enseignement : </b><?php echo mb_strtoupper($promotion->lesson->label) ?> </h4>
                                    <?php if (!$all) { ?>
                                        <h4><b>Evaluation : </b><?php echo mb_strtoupper($evals[0]->label) ?> </h4><br>
                                    <?php }
                                    $evaLink=$all?'all':permalink($evals[0]->code);
                                    ?>
                                    
<div class="fb-share-button" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Partager</a></div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 col-lg-12 table-responsive">
                                    <!--a href="<?php echo base_url('resultats/'.$promotion->promotion->code.'/'.$evaLink.'/print')?>" id="print" type="button" class="w3-btn btn w3-blue w3-margin-bottom"><i class="fa fa-fw fa-print"></i>  Imprimer</a--><br>
                                    <table class=" table table-bordered  table-hover <?php echo ($all)?'small':'' ?> w-100" id="dataTable">
                                        <thead class="">
                                        <tr>
                                            <th><b>N°<b></th>
                                            <th><b>Matricule<b></th>
                                            <th><b>Nom(s) et prénom(s)<b></th>
                                            <?php
                                            if ($all)
                                                foreach ($evals as $ev)
                                                {
                                                    echo "<th><b>".$ev->code."</b></th>";
                                                }
                                            else echo "<th><b>Note</b></th>";
                                            if ($all)
                                                echo "<th><b>Moyenne</b></th>";
                                            ?>



                                            <th><b>Appréciation</b></th>
                                            <?php
                                            if ($all)
                                                echo "<th><b>Décision</b></th>";
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($marks as $res)
                                        {
                                            echo "<tr>";
                                            echo "<td>".$res->number."</td>";
                                            echo "<td>".$res->number_id."</td>";
                                            echo "<td>".$res->names."</td>";
                                            if ($all)
                                            {
                                                foreach ($res->notes as $note)
                                                {
                                                    echo "<td align='center'>".$note->value."</td>";
                                                }
                                                $color = "";
                                                if($res->final<10)
                                                    $color = 'w3-text-red';
                                                elseif($res->final<12)
                                                    $color = 'w3-text-orange';

                                                echo "<td align='center' class='$color'>".$res->final."</td>";
                                                echo "<td align='center'><i>".$res->app."</i></td>";
                                                echo "<td align='center'>".$res->dec."</td>";
                                            } else
                                            {
                                                echo "<td align='center'>".$res->note->value."</td>";
                                                echo "<td align='center'>".$res->app."</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <div>
                                        <p style="margin-left: 25px;">L&eacute;gende : </p>
                                        <ul style="padding-bottom: 30px">

                                            <?php
                                            if ($all)
                                            {
                                                ?>
                                                <li ><b>A</b> : Admis</li>
                                                <li><b>R</b> : Rattrapage</li>
                                                <?php
                                                foreach ($evals as $ev)
                                                { ?>
                                                    <li><b><?php echo $ev->code ?></b> : <?php echo $ev->label." ($ev->ev_percent%)" ?></li>
                                                <?php }
                                            }
                                            else echo "--"
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-info text-center">
                                <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <?php echo "Les résultats de cette vague ne sont pas encore disponibles." ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.content-wrapper -->
