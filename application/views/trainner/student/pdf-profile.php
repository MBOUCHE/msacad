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
<page format="A4" orientation="P" backtop="8mm" backleft="8mm" backright="10mm" backbottom="8mm">
    <table style="width: 100%;" cellspacing="2mm">
        <tr>
            <td align="center" class="header thead">
                <<b>
                    REPUBLIQUE DU CAMEROUN<br><small>PAIX-TRAVAIL-PATRIE</small><br>
			   --------<br>
               MINISTERE DE L'EMPLOI ET DE LA<br> FORMATION PROFESSIONNELLE<br>
			   -------<br>
               CENTRE DE FORMATION PROFESSIONNELLE</b>
            </td>
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo-black.png" ?>" height="80">
            </td>
            <td align="center"  class="header thead">
                <b>
                    REPUBLIC OF CAMEROON <br><small>PEACE-WORK-FATHERLAND</small><br>
                    --------<br>
                    MINISTRY OF EMPLOYEMENT  <br> AND VOCATIONAL TRAINING <br>
                    --------<br>
                    VOCATIONAL TRAINING CENTER</b>
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
                <span class="titre">PROFIL ACADEMIQUE</span><br><br>
                <span class="nom"><?php echo strtoupper($student->firstname)." ".strtoupper($student->lastname) ?></span>
            </td>
        </tr>
        <tr>
            <td class="rub" colspan="3">
                Informations personnelles
                <hr style="width: 80%;" align="left">
            </td>
        </tr>
        <tr>
            <td align="center">
                <img src="<?php echo base_url().$student->photo ?>" height="120">
            </td>
            <td colspan="2">
                Matricule : <b><?php echo $student->number_id ?></b><br>
                Nom complet : <b><?php echo mb_strtoupper($student->lastname)." ".mb_strtoupper($student->firstname) ?></b><br>
                Date et lieu de Naissance : <b><?php echo $dateBirth ?></b> <b><?php echo $student->birth_place ?></b><br>
                Pays d'arigine : <b><?php echo $student->nationality ?></b><br>
                Téléphone(s) : <b>(+237) <?php echo $student->phone ?></b> <br>
                Email : <b><?php echo $student->mail ?></b><br>
                Adresse : <b><?php echo $student->address ?></b>
            </td>
        </tr>
        <tr>
            <td class="rub"  colspan="3">
                Informations du compte utilisateur
                <hr style="width: 80%;" align="left">
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                Login : <b><?php echo $student->mail." | ".$student->number_id ?></b><br>
                Mot de passe : <b>**********</b><br>
                Compte créé le : <b><?php echo $student->number_id ?></b><br>
                Dernière connexion le : <b><?php echo ($dateCon = "null") ? "Jamais connecté" : $dateCon =''.date_format($dateCon, 'd'). '-'.date_format($dateCon, 'm').'-'.date_format($dateCon, 'Y') ?></b>
            </td>
        </tr>
        <tr>
            <td class="rub"  colspan="3">
                Enseignements suivis
                <hr style="width: 80%;" align="left">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <ul>
                    <?php
                    if(isset($lesson) and is_array($lesson)){
                        //var_dump($lesson); die(0);
                        for($i = 0; $i < count($lesson); $i++){
                            $registration_date = date_create($lesson[$i]->registration_date);
                            $registration_date = ''.date_format($registration_date, 'd'). '/'.date_format($registration_date, 'm').'/'.date_format($registration_date, 'Y');
                            echo "
                                                <li>
                                                    <b>".mb_strtoupper($lesson[$i]->label)."(".$lesson[$i]->code.")</b>
                                                    <ul>
                                                        <li>Vague : <b>".$lesson[$i]->promCode."</b></li>
                                                        <li>Inscrit le : <b>".$registration_date."</b></li>
                                                    </ul>
                                                </li>
                                            ";
                        }
                        /*for($i = 0; $i < count($lesson); $i++){
                            echo "
                                                <li>
                                                <b>".mb_strtoupper($lesson[$i]->label)."(".$lesson[$i]->code.")</b>
                                                <ul>
                                                    <li>Vague : <b>".$lesson[$i]->promCode."</b></li>
                                                    <li>Inscrit le : <b>".$lesson[$i]->registration_date."</b></li>
                                                </ul>
                                                </li>
                                            ";
                        }*/
                    }
                    ?>

                </ul>
            </td>
        </tr>

    </table>

</page>