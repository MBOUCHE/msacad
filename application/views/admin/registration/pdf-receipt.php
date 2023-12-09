<style>
    <!--
    table {
        margin: auto;
    }
    table.carte td{
        border-collapse: collapse;
    }
    .carte{
        background: white;
    }
    *{
        font-size: 14px;
        font-family: arial, sans-serif;
    }
    .header{
        background:#004455;
        color: white;
    }.footer{
         background:#004455;
         color: white;
     }
    .code{
        color: rgb(170, 0, 0);
    }
    .thead{
        width:80%;
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
    small,.small{
        font-size: 12px;
    }
    .endHeader{
        border-bottom: 1px grey dotted;
    }
    .rub{
        font-weight: bold;
        border: 1px solid black;
        padding-bottom: 10px;
    }
    .nom{
        font-size: 20px;
        font-weight: bold;
    }
    hr{
        color: grey;
    }
    .photo{
        border: 1px solid black;
    }
    .alert{
        color: red;
    }
    .info{
        width: 15%;
    }
    -->
</style>
<page format="A4" orientation="P" backtop="4mm" backleft="8mm" backright="8mm" backbottom="4mm">

    <div style="position: absolute; width: 45mm; height: 5mm; right:    5mm; top:     80mm; border: solid 2px grey; background: whitesmoke; color: black; padding: 5mm; text-align: center">Coupon Apprenant</div>
    <div style="position: absolute; width: 45mm; height: 5mm; right:    5mm; top:     220mm; border: solid 2px grey; background: whitesmoke; color: black; padding: 5mm; text-align: center">Coupon Centre</div>


    <table cellspacing="2mm" style="width:100%">
        <tr>
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo-black.png" ?>" height="80">
            </td>
            <td align="center" class="thead">
                <b>CENTRE DE FORMATION PROFESSIONNELLE</b><br>
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <i><small>Agrément ministériel N° 0124/MINEFOP/SE/DFOP/SDGSF/SACD du 11 AOÛT 2010</small></i>
            </td>
        </tr>
        <tr><td colspan="2" class="endHeader"></td></tr>
        <tr>
            <td align="center" >
                <qrcode value="<?php echo $registration->regCode; ?>" style="border: none; width: 20mm;"></qrcode>
            </td>
            <td align="center">
                <b class="">RECU DE PAIEMENT DES FRAIS DE FORMATION</b><br>
                <em class="small">RECEIPT OF PAYMENT OF TRAINING EXPENSES</em><br>
                N° <b class="small" ><?php echo $registration->regCode; ?> / #<?php echo $registration->slice_number ?></b><br><br>
            </td>
        </tr>

        <tr>
            <td class="info">Reçu de </td>
            <td class="thead"><b><?php echo $registration->lastname ." ".$registration->firstname  ?></b></td>
        </tr>
        <tr>
            <td class="info">Matricule </td>
            <td class="thead"><b><?php echo $registration->number_id; ?></b></td>
        </tr>
        <tr>
            <td class="info">Pour l'inscription en</td>
            <td class="thead"><b><?php echo mb_strtoupper($registration->label) ?> (<?php echo $registration->lcode ?>)</b></td>
        </tr>
        <tr>
            <td>Le</td>
            <td><b><?php echo $regDate ?></b></td>
        </tr>
        <tr>
            <td >Montant perçu :</td>
            <td> <b><?php echo $registration->last_instalment ?> FCFA</b></td>
        </tr>
        <tr>
            <td class="info">Montant déjà payé </td>
            <td><b><?php echo intval($registration->installment)   ?> FCFA</b> / <?php echo intval($registration->fees)   ?> FCFA</td>
        </tr>
        <tr>
            <td>Reste :</td>
            <td> <b><?php echo intval($registration->fees)-intval($registration->installment) ?> FCFA</b></td>
        </tr>

        <tr>
            <td class="info">
                <br><br>Le  <b><?php echo date('d').'/'.date('m').'/'.date('Y') ?></b>
            </td>
            <td align="center" class="">
                <br><br><b>Noms et signature du Responsable</b>
            </td>
        </tr>



    </table>

    <br><br><br><br><br>

    <hr style="border: 1px dashed grey">


    <table cellspacing="2mm" style="width:100%">
        <tr>
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo-black.png" ?>" height="80">
            </td>
            <td align="center" class="thead">
                <b>CENTRE DE FORMATION PROFESSIONNELLE</b><br>
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <i><small>Agrément ministériel N° 0124/MINEFOP/SE/DFOP/SDGSF/SACD du 11 AOUT 2010</small></i>
            </td>
        </tr>
        <tr><td colspan="2" class="endHeader"></td></tr>
        <tr>
            <td align="center" >
                <qrcode value="<?php echo $registration->regCode; ?>" style="border: none; width: 20mm;"></qrcode>
            </td>
            <td align="center">
                <b class="">RECU DE PAIEMENT DES FRAIS DE FORMATION</b><br>
                <em class="small">RECEIPT OF PAYMENT OF TRAINING EXPENSES</em><br>
                N° <b class="small" ><?php echo $registration->regCode; ?> / #<?php echo $registration->slice_number ?></b><br><br>
            </td>
        </tr>

        <tr>
            <td class="info">Reçu de </td>
           <td class="thead"><b><?php echo $registration->lastname ." ". $registration->firstname  ?></b></td>
        </tr>
        <tr>
            <td class="info">Matricule </td>
            <td class="thead"><b><?php echo $registration->number_id; ?></b></td>
        </tr>
        <tr>
            <td class="info">Pour l'inscription en</td>
            <td class="thead"><b><?php echo mb_strtoupper($registration->label) ?> (<?php echo $registration->lcode ?>)</b></td>
        </tr>
        <tr>
            <td>Le</td>
            <td><b><?php echo $regDate ?></b></td>
        </tr>

        <tr>
            <td >Montant perçu :</td>
            <td> <b><?php echo $registration->last_instalment ?> FCFA</b></td>
        </tr>
        <tr>
            <td class="info">Montant déjà payé </td>
            <td><b><?php echo intval($registration->installment)   ?> FCFA</b> / <?php echo intval($registration->fees)   ?> FCFA</td>
        </tr>
        <tr>
            <td>Reste :</td>
            <td> <b><?php echo intval($registration->fees)-intval($registration->installment) ?> FCFA</b></td>
        </tr>

        <tr>
            <td class="info">
                <br><br>Le  <b><?php echo date('d').'/'.date('m').'/'.date('Y') ?></b>
            </td>
            <td align="center" class="thead">
                <br><br><b>Noms et signature du Responsable</b>
            </td>
        </tr>
    </table>

</page>