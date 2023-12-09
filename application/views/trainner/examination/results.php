<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center col-sm-12">
                RÉSULTATS DES EXAMENS
                <hr>
            </div>
            <div class="col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2 w3-text-dark-gray">
                <h4><b>Vague : </b><?php echo $promotion->promotion->code ?> </h4>
                <h4><b>Enseignement : </b><?php echo mb_strtoupper($promotion->lesson->label) ?> </h4>
                <?php if (!$all) { ?>
                    <h4><b>Evaluation : </b><?php echo mb_strtoupper($evals[0]->label) ?> </h4><br>
                <?php }
                $evaLink=$all?'all':permalink($evals[0]->code);
                ?>
            </div>
            <div class="col-sm-12 table-responsive">
                <a target="_blank" href="<?php echo base_url('trainner/examination/results/'.$promotion->promotion->code.'/'.$evaLink.'/print')?>" id="print" type="button" class="w3-btn btn w3-blue w3-margin-bottom"><i class="fa fa-fw fa-print"></i>  Imprimer</a><br>

                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
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
                        if ($all)
                        {
                            ?>
                            <th><b>Moyenne</b></th>
                            <?php
                        }
                        else{
                            ?>
                            <th><b>Note</b></th>
                            <?php
                        }
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
                            echo "<td align='center'>".$res->final."</td>";
                            echo "<td align='center'>".$res->app."</td>";
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
                        else echo "--";

                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<script type="text/javascript">
    $(document).ready(function () {
        alm('collapseExa',2);
    });
</script>

