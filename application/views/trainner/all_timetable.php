<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>

  <div class="row">
            <?php
                foreach ($listee as $key ) {?>
                <?php echo $key['label_mod'];?>
                              
             <?php   }
             ?>

             <script type="text/javascript">
                 $(document).ready(function(){
                     $(".datepicker").datepicker({
                         inline: true,
                         regional:'fr',
                         firstDay: 1,
                         showOtherMonths: true,
                         dayNamesMin: [ 'Dim','Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                         monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
                     });

                 });
             </script>
