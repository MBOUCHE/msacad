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

    </table>

        <table style='width: 100%; align-items: center; margin: auto'>
            <tr>
                <td><h1 align='center'>Transaction du materiel MSA</h1></td>
            </tr>
        </table><hr width="80" align="left">


        <table border='1' style='margin: auto; font-size: 11pt; border-collapse: collapse;'>
            <thead>
            <tr>
                <th align="center" class="text - center">N&#176;</th>
                <th align="center">Nom</th>
                <th align="center">Conditionnemnt</th>
                <th align="center">Quantité</th>
                <th align="center">Type de transaction</th>
                <th align="center">Date de transaction</th>
                <th align="center">Transacteur</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $k = 0;
            for($i = 1; $i <= count($inventory['inventory']); $i++)
            {
                //var_dump($inventory[$i]->id);
                echo '<tr><td class="text-center">' . ++$k . '</td>';
                echo '<td align="center">' . $inventory['inventory'][$i-1]->name . '</td>';
                echo '<td align="center">' . $inventory['inventory'][$i-1]->packaging . '</td>';
                echo '<td align="center">' . $inventory['inventory'][$i-1]->qty . '</td>';
                echo '<td align="center">' . $inventory['inventory'][$i-1]->transType . '</td>';
                echo '<td align="center">'. $inventory['inventory'][$i-1]->transDate .'</td>';
                echo '<td align="center">'. $inventory['userName'][$i-1] .'</td></tr>';
            }
            ?>
            </tbody>
        </table>
</page>