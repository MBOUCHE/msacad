
<style>

    div.attestation {
      /*background-image: url(<?php //echo base_url()."assets/img/logo/border_attestation.png" ?>);
      background-repeat: no-repeat;
      background-position: 0px 0px;
      background-attachment: fixed;*/
      /*background: url("border_attestation.png" ) ;*/
      width: 100%;
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
          font-size: 15px;
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

<page format="A4" orientation="P" backtop="0mm" backleft="0mm" backright="0mm" backbottom="0mm">
  

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

    <table cellspacing="" style="width: 100%;">
      <?php
        ($learner->sexe == '1')? $sexe='Monsieur' : $sexe = 'Madame';
      ?>
        
        
        <tr>
            <td style="border:1px solid red; width: 50%;" align="" class="">
                <!--img src="profil.jpg" height="120"-->
                <div style="text-align: left; ">
                Details sur l'apprenant<br>
                Nom: <b class="ecole"><?php echo mb_strtoupper($learner->lastname) ?></b><br>
                Prenom: <b class="ecole"><?php echo mb_strtoupper($learner->firstname) ?></b><br>
                Date et lieu de naissance: <b class="ecole"><?php echo moment($learner->birth_date)->format('d/M/Y') ?></b> á <b class="ecole"><?php echo $learner->birth_place ?></b>
              </div>
            </td>
            <td style=" border:1px solid red; width: 50%;">
              <div style="text-align: left; ">
                Details sur la Vague/promotion<br>
                Code: <b class="ecole"><?php echo $details_wave['lesson']->code ?></b><br>
                Lesson: <b class="ecole"><?php echo $details_wave['lesson']->label ?></b><br>
                Cout de la formation: <b class="ecole"><?php echo $this->db->get_where('e_slices' , array('id_lesson'=>$details_wave['lesson']->id ) )->row()->mtn1; ?></b>                
              </div>
            </td>
        </tr>
    </table>

    <br>

    <div style="text-align: center;">
     
        LISTE DES PAYEMENTS
            
    </div>

    <br>

    <table class="bordered" cellspacing="0" style="width: 100%;" >
      <thead>
        <tr>
            <th class="text-center">N&#176;</th>
            <th><i class="fa fa-user fa-1x"></i>Date de payement</th>                                
            <th><i class="fa fa-clock-o fa-1x"></i>Montant</th>
            <th><i class="fa fa-clock-o fa-1x"></i>Restant</th>
            <th><i class="fa fa-clock-o fa-1x"></i> Tranches</th>
            <th><i class="fa fa-clock-o fa-1x"></i>reference</th>
            <th><i class="fa fa-wrench fa-1x"></i>operateur</th>
            <th><i class="fa fa-wrench fa-1x"></i>etat</th>
        </tr>

      </thead>
      <tbody>
      <?php

        $numero = 1;

        foreach ( $list_paid_user_wave as $paid ) {
          $details = $this->paid->get_details($paid->id_paid);

          $total = $this->db->get_where('e_slices' , array('id_lesson'=>$details_wave['lesson']->id ) )->row()->mtn1;
          $montant = $total - $paid->remaining_amount;
      ?>
              
          <tr>            
            <td><?php echo $numero++ ?></td>
            <td><?php echo moment($paid->date_paid)->format('D d M Y A H:i')  ?></td>
            <td> <?php echo $montant; ?> </td>
            <td> <?php echo $paid->remaining_amount ?> </td>
            <td> <?php echo $paid->num_slice.'/'.$paid->total_slice; ?> </td>
            <td> <?php echo $paid->reference; ?> </td>
            <td> <?php echo $details['name_op']; ?></td>                
            <td> <?php 
              if ($paid->validation_state == '1') {
                echo '<span>Valider</span>';
              }elseif ($paid->validation_state == '0') {
                echo '<span>En attente</span>';
              }elseif ($paid->validation_state == '-1') {
                echo '<span>Rejeter</span>';
              } ?></td>                
          </tr>
             
      <?php
        }
      ?>

      </tbody>
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

</page>
