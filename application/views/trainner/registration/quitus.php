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
    small{
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
        margin-top: 20px;
		border: 1px solid black;
	}
	.alert{
		color: red;
	}
    -->
</style>

<page format="A4" orientation="P">
    <table cellspacing="2mm">
        <tr>
           <td align="center" class="thead">
               <b>
               REPUBLIQUE DU CAMEROUN<br><small>PAIX-TRAVAIL-PATRIE</small><br>
			   --------<br>
               MINISTERE DE L'EMPLOI <br>ET DE LA FORMATION PROFESSIONNELLE<br>
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
                <span class="titre"><br>QUITUS D'INSCRIPTION ACADEMIQUE</span><br>
				<span class="">ACADEMIC REGISTRATION FORM</span><br><br>
                <span class="nom"><?php echo $registration->lastname ." ". $registration->firstname ?></span><br>
				<b><?php echo $registration->label ?></b><br><br>
            </td>
        </tr>
		<tr>
			<td align="center" colspan="1">
				<qrcode value="<?php echo $registration->regCode; ?>" style="border: none; width: 40mm;"></qrcode><br>
				<span class="nom code" ><?php echo $registration->regCode; ?></span>
			</td>
			<td></td>
			<td align="center" class="photo">
				Photo ici
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
                        date_format($dateBirth, 'Y') ?></b> à <b><?php echo $registration->birth_place ?></b><br>
                <br>Pays d'origine : <b><?php echo $registration->nationality ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adresse : <b><?php echo $registration->address ?></b><br>
                <br>Téléphone(s) : <b>(+237) <?php echo $registration->phone ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email : <b>fmotchebonhe@yahoo.com</b><br>
				<br>Etablissement : <b><?php echo $registration->school ?></b><br>
				<br>Filière : <b><?php echo $registration->school_area ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Niveau d'étude : <b><?php echo $registration->school_level ?></b><br>

            </td>
        </tr>
        <tr>
            <td class="rub" colspan="3" align="center"><br>
                INFORMATIONS SUR L'ENSEIGNEMENT
            </td>
        </tr>
       <tr>
            <td colspan="3" >
               <br> Titre : <b><?php echo $registration->label ?></b><br>
               <br> Code : <b><?php echo $registration->lcode ?></b><br>
                <br> Vague : <b><?php echo $registration->code ?></b><br>
               <br>Frais d'inscription : <b><?php echo $registration->fees ?> FCFA</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
            </td>
        </tr>
		<tr>
            <td colspan="3">
                <br>Quitus délivré le <b><?php echo date('d/m/Y'); ?></b> à <b><?php echo date('H:i:s') ?></b>
            </td>
        </tr>
		<tr>
			<td colspan="3">
				<br>Nom et Signatrure du responsable<br><br><br><br><br>
			</td>
		</tr>
		<tr>
            <td colspan="3" class="footer">
                <br><b>NB:</b><i>Ce document permet de prouver l'inscription effective de apprenant.</i>
            </td>
        </tr>
		


    </table>

</page>