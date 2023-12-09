
<style>

    div.attestation {
      background-image: url(<?php echo base_url()."assets/img/logo/border_attestation.png" ?>);
      background-repeat: no-repeat;
      background-position: 0px 0px;
      background-attachment: fixed;
      /*background: url("border_attestation.png" ) ;*/
    }
    .content_perso{

    }

    table.bordered {
        border-collapse: collapse;
    }
    table.bordered td,th{
        border: 1px solid black;
        padding: 4px;
    }
    table.bordered tr{
       
    }

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
          font-size: 22px;
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
      
       
</style>

<page format="A4" orientation="L" backtop="0mm" backleft="0mm" backright="0mm" backbottom="0mm">
  <div class="attestation" style="">

    <table  cellspacing="2mm" style="width: 100%; padding-top: 15px">
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
                <!-- <img src="logo.png" height="80"> -->
               <img src="<?php echo base_url()."assets/img/logo/logo.png" ?>" height="80">
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

    <table cellspacing="2mm" style="width: 100%;">
      <?php
        ($learner->sexe == '1')? $sexe='Monsieur' : $sexe = 'Madame';
      ?>
        
        <tr>
            <td align="center" class="">
                <!--img src="profil.jpg" height="120"-->
                <img src="<?php echo base_url()."assets/img/logo/barnner_attestation2.png" ?>" height="130">
            </td>
        </tr>
        <tr>
            <td align="" colspan="" class=" justify" style="width: 80%;">
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le Directeur du centre de formation proffessionnelle
                   <b class="ecole">MULTISOFT ACADEMY(Dang-Université de Ngaoundéré)</b>, sousigné, atteste que:<br><br>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="ecole"><?php echo $sexe.' '.mb_strtoupper($learner->firstname).' '.mb_strtoupper($learner->lastname) ?></b>, né(e) le <b class="ecole"><?php echo moment($learner->birth_date)->format('d/M/Y') ?></b> á <b class="ecole"><?php echo $learner->birth_place ?></b>, apprenant(e) régulierement inscrit(e) audit Centre sous le Matricule <b class="ecole"><?php echo $learner->number_id ?></b>, a subi avec succés l'examen de fin de formation en informatique dans la filiére <b class="ecole"><?php echo $details['lesson']->label ?></b>.<br><br>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En foi de quoi la presente Attestation lui est bétablie pour servir et valoir ce que de droit.
                   <?php echo br(5) ?>

                   <div style="text-align: right; position: left;">Fait á Ngaoundéré, le <b class="ecole"><?php echo moment(date('Y-m-d h:i:s'))->format('D d M Y') ?></b></div>
            </td>
        </tr>
    </table>

    
<page_footer>
        <table class="page_footer" style="width: 100%; height: 100%;">
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

  </div>
sdfgdgsfgsf
</page>
