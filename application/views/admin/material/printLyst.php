<style>
    <!--
    table.carte {
        border-collapse: collapse;
    }
    table.carte td{
        border-collapse: collapse;
    }
    .carte{
        background: white;
    }
    *{
        font-size: 15px;
        font-family: arial, sans-serif;
    }
    .header{
        width: 40%;
    }.footer{
         background:#004455;
         color: white;
     }
    .footer td{
        padding: 10px;
    }
    .content td{
        padding: 5px;
    }
    .ecole{
        font-size: 18px;
        font-weight: bold;
    }
    .titre{
        font-size: 16px;
        font-weight: bold;
    }
    small{
        font-size: 12px;
    }
    .endHeader{
        border-bottom: 1px grey dotted;
    }
    .rub{
        font-weight: bold;
    }
    .nom{
        font-size: 20px;
        font-weight: bold;
    }
    hr{
        color: grey;
    }
    .thead{
        width: 40%;
    }
    -->
</style>
<page format="A4" orientation="P">

    <table style="margin: auto;" cellspacing="2mm">
        <tr>
            <td align="center" class="header thead">
                <b>
                    REPUBLIQUE DU CAMEROUN<br><small>PAIX-TRAVAIL-PATRIE</small><br>
                    --------<br>
                    MINISTERE DE L'EMPLOI <br>ET DE LA FORMATION PROFESSIONNELLE<br>
                    -------<br>
                    CENTRE DE FORMATION PROFESSIONNELLE</b>
            </td>
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo.png" ?>" height="80">
            </td>
            <td align="center"  class="header thead">
                <b>
                    REPUBLIC OF CAMEROON<br><small>PEACE-WORK-FATHERLAND</small><br>
                    --------<br>
                    MINISTRY OF EMPLOYEMENT<br>AND VOCATIONAL TRAINING<br>
                    --------<br>
                    VOCATIONAL TRAINING CENTER</b>
            </td>
        </tr>

    </table><br><br><br><br>
    <div>
        <h1 style="text-align: center;">Inventaire du matériel MSA</h1>
        <hr width="80" align="left">
    </div><br><br>
    <table border='1'>
        <thead>
        <tr>
            <th align='center' class="text-center">N&#176;</th>
            <th align='center'>Nom</th>
            <th align='center'>Type de materiel</th>
            <th align='center'>Conditionnement</th>
            <th align='center'>Quantité</th>
            <th align='center'>Plus</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $k = 0;
        //var_dump($material);
        for($i = 1; $i <= count($material); $i++)
        {
            //var_dump($material[$i]->id);
            echo '<tr><td align=\'center\' class="text-center">' . ++$k . '</td>';
            echo '<td align=\'center\'>' . $material[$i-1]->name . '</td>';
            echo '<td align=\'center\'>' . $material[$i-1]->type . '</td>';
            echo '<td align=\'center\'>' . $material[$i-1]->packaging . '</td>';
            echo '<td align=\'center\'>'. $material[$i-1]->qty .'</td>';
            echo '<td>
                                    <a href="modify/'.$material[$i-1]->id.'" data-toggle="tooltip" data-placement="top" title="modifier!" class="btn btn-primary"><i  class="fa fa-edit"></i></a>
                                    <a href="delete" data-toggle="tooltip" data-placement="top" title="modifier!" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                    <a href="'.base_url("admin/material/materialAction").'/'.$material[$i-1]->id.'/add" title="Ajouter du materiel!" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                    <a href="'.base_url("admin/material/materialAction").'/'.$material[$i-1]->id.'/remove" title="retirer du materiel!" class="btn btn-primary"><i class="fa fa-minus-square"></i></a>

                                  </td></tr>';
        }
        ?>
        </tbody>
    </table>

</page>