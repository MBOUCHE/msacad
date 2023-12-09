<?php if($all){
    ?>
    <style>

        *{
            font-size: 12px;
            font-family: arial, sans-serif;
        }
    </style>
    <?php
}
else{
    ?>
    <style>

        *{
            font-size: 14px;
            font-family: arial, sans-serif;
        }
    </style>
    <?php
}?>
<style>
    <!--
    table {
        margin : auto;
    }
    .thead{
        width:60%;
        font-size: 14px;
    }
    .header{
        background:#004455;
        color: white;
    }.footer{
         background:green;
         color: white;
     }

    td{
        padding: 10px;
    }
    .content td{
        padding: 5px;
    }

    small{
        font-size: 12px;
    }
    .small{
        font-size: 12px;
    }
    .endHeader{
        border-bottom: 1px grey dotted;
    }

    hr{
        color: grey;
    }

    .edt td{
        text-align: center;
        border-collapse : collapse;
        border: 1px solid black;
        /*width : 14.28%;*/
        font-size : 14px;
    }

    table.edt{
        border-collapse: collapse;
    }

    .legend
    {

    }
    -->
</style>
<!--PAGE CONTENT -->
<page format="A4" orientation="paysage">
    <table style="width:100%;">
        <tr>
            <td align="center">
                <img src="<?php echo img_url('logo/logo.png') ?>" height="80">
            </td>
            <td align="center" class="thead">
                REPUBLIQUE DU CAMEROUN<br>
                Ministère de l'Emploi et de la Formation Professionnelle<br>
                <b>CENTRE DE FORMATION PROFESSIONNELLE</b><br>
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <i><small>Agrément ministériel N° 0124/MINEFOP/SE/DFOP/SDGSF/SACD du 11 AOUT 2010</small></i>
            </td>
        </tr>
        <tr><td colspan="2" class="endHeader"></td></tr>
        <tr>
            <td colspan="3" align="center">
                <?php if ($all) { ?>
                    <br><span class="h2 bold underline"><?php echo mb_strtoupper("Résultats d'examen de fin de formation") ?></span><br><br>
                    <span class="h4 bold">SESSION NORMALE DE <?php echo mb_strtoupper(moment()->format('F Y')); ?></span>
                    <br>
                    <br>
                <?php } else { ?>
                    <br><span class="h2 bold underline"><?php echo mb_strtoupper("Résultats d'évaluation <br><br> ".$evals[0]->label) ?></span><br><br>
                <?php } ?>

                <span class="h2 bold"><?php echo mb_strtoupper("Enseignement") ?> : <?php echo mb_strtoupper($promotion->promotion->label) ?> (<?php echo $promotion->promotion->code ?>)</span><br><br>
            </td>
        </tr>
    </table>

    <table class="edt" style="width: 100%">
        <tr>
            <td><b>N°</b></td>
            <td><b>Matricule</b></td>
            <td><b>Nom(s) et prénom(s)</b></td>
            <?php
            if ($all)
                foreach ($evals as $ev)
                {
                    echo "<td><b>".$ev->code."</b></td>";
                }
            if ($all)
            {
                ?>
                <td class="col-4"><b>Moyenne</b></td>
                <?php
            }
            else{
                ?>
                <td class="col-3"><b>Note</b></td>
                <?php
            }
            ?>
            <td><b>Appréciation</b></td>
            <?php
            if ($all) { ?>
                <td class="col-4"><b>Décision</b></td>
            <?php } ?>
        </tr>
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
    </table>

    <page_footer>
        <table class="page_footer" style="width: 100%;">
            <tr>
                <td class="" align="right" style="width: 100%;">
                    <p>

                        <?php
                        if ($all)
                        {
                            ?>
                            <b>A</b> : Admis;
                            <b>R</b> : Rattrapage;
                            <?php
                            foreach ($evals as $ev)
                            { ?>
                                <b><?php echo $ev->code ?></b> : <?php echo $ev->label." ($ev->ev_percent%);" ?>
                            <?php }
                        }
                        else echo "--";

                        ?>
                    </p>
                </td>
            </tr>
        </table>
    </page_footer>
</page>
<!--END PAGE CONTENT -->