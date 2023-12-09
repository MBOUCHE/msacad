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
     .underline{
         text-decoration: underline;
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
    .contenu{
        font-size: 14pt;
        text-align: justify;
        width:100%;
    }
    .ecole{
        font-size: 18px;
        font-weight: bold;
    }
    .titre{
        font-size: 20px;
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
		border: 1px solid black;
	}
	.alert{
		color: red;
	}
    .mini{
        font-size: 9px;
    }
    .justify{
        text-align: right;
    }
    -->
</style>
<page format="A4" orientation="P" backtop="8mm" backleft="8mm" backright="10mm" backbottom="8mm">
    <table cellspacing="2mm" style="width: 100%;">
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
                   REPUBLIC OF CAMEROON<br><small>PEACE-WORK-FATHERLAND</small><br>
				   --------<br>
                   MINISTRY OF EMPLOYMENT<br>AND PROFESSIONAL TRAINING<br>
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
    </table>
    <table>
        <tr>
            <td colspan="3" align="center">
                <br><span class="titre underline">LETTRE DE RECOMMANDATION</span><br>
				<span class="">RECOMMENDATION LETTER</span><br><br>
            </td>
        </tr>
        <tr>
            <td align="left">
                <?php echo "N°<b>......</b>" ?>/<?php echo date('Y') ?>/DMSOT/CDFP
            </td>
            <td></td>
            <td align="center" class="ecole thead">
                &Agrave;<br>
                <?php echo $destination ?><br><b>BP : <?php echo $bp ?></b>
            </td>
        </tr>
		<tr>
			<td align="left" class="" colspan="1">
				<b class="ecole"><span class=" ecole underline">Objet:</span> Lettre de recommmandation</b>
			</td>
			<td></td>
			<td align="center" class="">

			</td>
		</tr>
        <tr>
            <td align="justify" colspan="3" class="contenu justify">
                <!--img src="profil.jpg" height="120"-->
                <p align="justify" style="font-size: 18px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nous, soussigné Centre de Formation Professionnelle en informatique <br><b class="ecole">MULTISOFT ACADEMY</b>, venons par la présente
                    lettre solliciter l'admission de l'Apprenant(e) <b class="ecole"><?php echo $nomA ?></b>, né(e) le
                    <?php echo $birthdate ?> &aacute; <?php echo $birthplace ?>, Matricule <b class=""><?php echo $mat ?></b> comme stagiaire au sein de votre
                    structure.
                </p>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En effet, l'interessé(e) a suivi une formation professionnelle en informatique de trois(03) mois dans la
                Filière de formation <b class="ecole"><?php echo $fil ?></b> au sein de notre établissement.
                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ce stage que nous sollicitons lui permettra non seulement de mettre en pratique les connaissances acquises lors de sa formation, mais
                aussi d'apprendre puis de s'imprégner des réalités professionnelles qui caractérisent les entreprises en général et celle dont vous avez la charge en particulier.
                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nous vous assurons par ailleurs des qualités disciplinaires et d'une remarquable volonté d'apprendre qu'à fait preuve l'interessé(e)
                durant sa formation et croyons en ses capacités à être à la hauteur des tâches qui lui seront confiées en tant que stagiaire au sein de votre Organisation.
                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comptant sur votre participation à oeuvrer pour la formation de nos jeunes, nous recommandons à cet effet que sa demande de stage ait une suite favorable.
                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Veuillez recevoir, Monsieur le Directeur Général, l'expression de nos salutations distinguées.
            </td>
        </tr>
       <tr>
            <td colspan="3" align="right">
               <br><b class="contenu">Le Directeur</b><br>
            </td>
       </tr>

    </table>
    <page_footer>
        <table class="page_footer" style="width: 100%;">
            <tr>
                <td align="center">
                    <p>
                        <b class="alert mini">
                            MULTISOFT ACADEMY&reg; RC N°438/2006/2007. Centre de formation agréé du Ministère de l'Emploi et de la Formation
                            Professionnelle sous Agrément n°0124/MINEFRP/SG/DFOP/SDGSF/SACD du 11 Août 2010. <br>Contacts : (+237)655811916/690983673/697969696 - Ngaoundéré(CAMEROUN)<br>
                            site web : www.msacad.com
                        </b>
                    </p>
                </td>
            </tr>
        </table>
    </page_footer>
</page>