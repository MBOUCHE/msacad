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
        width:40%;
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
    -->
</style>
<page format="A4" orientation="P" backtop="8mm" backleft="8mm" backright="10mm" backbottom="12mm">
    <table cellspacing="2mm" style="width:100%">
        <tr>
            <td align="center" class="thead">
                <b>
                    REPUBLIQUE DU CAMEROUN<br><small>PAIX-TRAVAIL-PATRIE</small><br>
                    --------<br>
                    MINISTERE DE L'EMPLOI ET DE LA<br> FORMATION PROFESSIONNELLE<br>
                    -------<br>
                    CENTRE DE FORMATION PROFESSIONNELLE</b>
            </td>
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo-black.png" ?>" height="80">
            </td>
            <td align="center" class="thead">
                <b>
                    REPUBLIC OF CAMEROON <br><small>PEACE-WORK-FATHERLAND</small><br>
                    --------<br>
                    MINISTRY OF EMPLOYMENT  <br> AND PROFESSIONAL TRAINING <br>
                    --------<br>
                    PROFESSIONAL TRAINING CENTER</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center" class="endHeader">
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <i><small>Agrément ministériel N° 0124/MINEFOP/SE/DFOP/SDGSF/SACD du 11 AOUT 2010</small></i>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <span class="titre">QUITUS D'INSCRIPTION ACADEMIQUE</span><br>
                <span class="">ACADEMIC REGISTRATION FORM</span><br>
                N° <span class="small" ><?php echo $registration->regCode; ?></span><br><br>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="width: 61%;">
                <span class="nom"><?php echo $registration->lastname ." ". $registration->firstname ?></span><br>
                <b><?php echo mb_strtoupper($registration->label) ?></b><br><br>
            </td>
            <td>
                <div style="position: absolute; width: 30mm; height: 35mm; right:    5mm; top:     70mm; border: solid 2px grey; background: whitesmoke; color: black; padding: 5mm; text-align: center">Photo 4x4</div>

            </td>
        </tr>
        <tr>
            <td align="center" colspan="1">
                <qrcode value="<?php echo $registration->regCode; ?>" style="border: none; width: 25mm;"></qrcode><br>
            </td>
            <td></td>
            <td align="center" class="">

            </td>
        </tr>
        <tr>
            <td class="rub" colspan="3" align="center"><br>
                INFORMATIONS PERSONNELLES DE L'APPRENANT
            </td>
        </tr>
        <tr>
            <td align="left" colspan="3">
                <!--img src="profil.jpg" height="120"-->
                <br>Matricule : <b><?php echo $registration->number_id ?></b><br>
                <br> Nom complèt : <b><?php echo $registration->lastname ." ". $registration->firstname ?></b><br>
                <br> Né(e) le : <b><?php echo $dateBirth = date_format($dateBirth, 'd').'/'.date_format($dateBirth, 'm').'/'.
                        date_format($dateBirth, 'Y') ?></b> &aacute; <b><?php echo $registration->birth_place ?></b><br>
                <br>Pays d'origine : <b><?php echo $registration->nationality ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adresse : <b><?php echo $registration->address ?></b><br>
                <br>Téléphone(s) : <b><?php echo $registration->phone ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email : <b><?php echo $registration->mail ?></b><br>
                
            </td>
        </tr>
        <tr>
            <td class="rub" colspan="3" align="center"><br>
                INFORMATIONS SUR L'ENSEIGNEMENT
            </td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100%;">
                <br> Titre : <b><?php echo mb_strtoupper($registration->label) ?></b> <br>
                <br>Code : <b><?php echo $registration->lcode ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Vague : <b><?php echo $registration->vCode ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Frais d'inscription : <b><?php echo number_format($registration->fees,0,'',' ')  ?> FCFA</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
            </td>
        </tr>
        <tr>
            <td>
                Fait à Ngaoundéré, le <b><?php echo moment($registration->registration_date)->format('d M Y'); ?></b>
            </td>
            <td colspan="2" align="right">
                <br><br><br><br><br><br><b>Noms et Signatrure du responsable</b>
            </td>
        </tr>
    </table>
    <page_footer>
        <table class="page_footer" style="width: 100%;padding-bottom:25px;" >
            <tr>
                <td class="" align="center" style="width: 100%;">
                    <p class="small">
                        Contacts : 655 81 19 16 – 690 98 36 73 – 697 96 96 96<br>
                        Site web: www.msacad.com<br>
                        <b>NB:</b><i>Ce document permet de prouver l'inscription effective d'un apprenant.</i>
                    </p>
                </td>
            </tr>
        </table>
    </page_footer>
</page>