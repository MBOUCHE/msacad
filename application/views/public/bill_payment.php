<?php


// if ( true )
// {
  

?>

<!-- <page> -->
  
  <!-- <img src="logo2.png" style="width: 10mm;" alt="Photo de montagne" > -->

  <!-- <img src="<?php // echo base_url()."assets/img/logo/logo-black.png" ?>" height="80"> -->

<style>
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
                <!-- <img src="logo.png" height="80"> -->
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

    <?php 
        $wave = $this->db->get_where('e_wave' , array('id_wave'=>$inscription['id_wave']))->row();
        $total = $this->db->get_where('e_slices' , array('id_lesson'=>$wave->id_lesson))->row()->mtn1;
        $montant = $total - $inscription['remaining_amount'];

    ?>

    <table cellspacing="2mm" style="width: 100%;">
        <tr>
            <td align="center">
                <br><span class="titre underline" style="text-align:center;">FACTURE DE PAYEMENT</span><br>
                    <span class="" style="text-align:center;">BILL PAYEMENT</span><br><br>
            </td>
        </tr>

        <tr>
            <td align="justify" class="contenu justify">
                <!--img src="profil.jpg" height="120"-->
                
            </td>
        </tr>

        <tr>
            <td align="justify" colspan="" class="contenu justify">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nous, soussigné Centre de Formation Professionnelle en informatique <br><b >MULTISOFT ACADEMY</b>, reconnaissons par la présente facture delivré à l'Apprenant(e) <b class="ecole"><?php echo $details['firstname']  ?></b>,  Matricule <b class="ecole"><?php echo $this->db->get_where('user',array('id'=>$inscription['id_user']))->row()->number_id ?></b>, avoir percu de ce(cette) dernier(e) un montant de <b class="ecole"><?php echo $montant  ?></b>, faisant office de <b class="ecole"><?php echo $inscription['num_slice'].'/'.$inscription['total_slice']  ?></b> tranches.<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A cet effet le(la) dit(e) apprenant(e) pourra ainsi continuer à suivre la formation  de <b class="ecole"><?php echo mb_strtoupper($details['label'])  ?></b>, jusqu'au <b class="ecole"><?php echo moment($details['limit_date'])->format('D d M Y à H:i')  ?></b>.
            </td>
        </tr>

    </table>

    <hr>

    <table class="bordered" width="100%" id="" cellspacing="0">
            <thead>
                <tr>
                        <th><i class="fa fa-user fa-1x"></i> Vague</th>                                
                        <th><i class="fa fa-user fa-1x"></i> type</th>                                
                        <th><i class="fa fa-user fa-1x"></i> Montant</th>                                
                        <th><i class="fa fa-circle-o fa-1x"></i> Restant</th>
                        <th><i class="fa fa-circle-o fa-1x"></i> total</th>
                        <th><i class="fa fa-clock-o fa-1x"></i> Tranches</th>
                        <th><i class="fa fa-clock-o fa-1x"></i> reference</th>
                        <th><i class="fa fa-wrench fa-1x"></i> operateur</th>
                </tr>

            </thead>
            <tbody>
              
                  <tr>
                    
                    <td><?php echo $wave->code_wave ?></td>
                    <td><?php echo $wave->type_wave ?></td>
                    <td> <?php echo $montant; ?> </td>
                    <td> <?php echo $inscription['remaining_amount'] ?> </td>
                    <td> <?php echo $total; ?> </td>
                    <td> <?php echo $inscription['num_slice'].'/'.$inscription['num_slice']; ?> </td>
                    <td> <?php echo $inscription['reference']; ?> </td>
                    <td> <?php echo $details['name_op']; ?> </td>                
                  </tr>
              

            </tbody>
        </table>

     


<!-- </page> -->

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

