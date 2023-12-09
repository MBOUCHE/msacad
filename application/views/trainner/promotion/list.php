<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center col-sm-12">
                LISTE DES PROMOTIONS
                <hr>
            </div>

            <p style="margin-left: 25px;">L&eacute;gende : </p>
            <ul style="padding-bottom: 30px">
                <li class="legend"><span class="w3-red">#</span> Bloquée</li>
                <li class="legend"><span class="w3-green">#</span> Ouverte</li>
                <li class="legend"><span class="w3-white">#</span> En cours</li>
                <li class="legend"><span class="w3-grey">#</span> Achevée</li>
            </ul>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Code</th>
                        <th>Enseignement</th>
                        <th>Dates</th>
                        <th>Options</th>

                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if ($allPromo[0]['code']!=null)
                        foreach ($allPromo as $promo)
                        {
                            $line++;
                            echo "<tr>";
                            $stat="";
                            $lock="";
                            $title="";
                            $show="";
                            switch ($promo['state'])
                            {
                                case '-1': echo "<td><span class='w3-red' style='padding: 7px'>".$line."</span></td>"; $lock="fa-play"; $title="Relancer"; $stat="w3-text-green"; break;
                                case '0': echo "<td><span class='w3-green' style='padding: 7px'>".$line."</span></td>"; $lock="fa-play"; $title="Commencer"; $stat="w3-text-green"; break;
                                case '1': echo "<td><span class='w3-white' style='padding: 7px;'>".$line."</span></td>"; $lock="fa-pause"; $title="Suspendre"; $stat="w3-text-red"; break;
                                case '2': echo "<td><span class='w3-grey' style='padding: 7px'>".$line."</span></td>"; $show="w3-hide"; break;
                                default: echo "<td>".$line."</td>"; break;
                            }

                            echo "<td><b>".$promo['code']."</td>";
                            echo "<td>".mb_strtoupper($promo['label'])."</td>";
                            $state="";
                            switch ($promo['state'])
                            {
                                case '0': $state='opened'; break;
                                case '1': $state='pending'; break;
                                case '-1': $state='suspended'; break;
                                case '2': $state='ended'; break;
                            }
                            echo "<td class='small'>Début : <b>".date_format(date_create($promo['start_date']), 'd-m-Y')."</b><br>
                                    Fin : <b>".($promo['end_date']!=NULL?date_format(date_create($promo['end_date']), 'd-m-Y'):'Pas encore')."</b></td>";

                            echo "<td id='{$promo['id']}'>
                                      <button id='$state' type='button' class='lock w3-btn w3-white w3-small w3-margin-small $show' title='$title' onclick='lock(this)'><i class='fa $lock fa-2x $stat'></i></button>
                                      <button class='endpromo w3-btn w3-white w3-margin-small $show'  title=\"Terminer la promotion\" onclick='endpromo(this)'><i class='fa fa-check-circle fa-2x w3-text-green'></i></button>
                                      <a href='".base_url('trainner/promotion/printStudents')."/".$promo['id']."' class='promolist w3-btn w3-white w3-margin-small' title=\"Afficher la liste des apprenants\"><i class='fa fa-list fa-2x w3-text-blue'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<style>
    .legend
    {
        text-decoration: none;
        display: inline-block;
        float: left;
        margin-left: 15px;
    }

    .legend span
    {
        padding: 7px;
        border: dashed;
        border-color: #0a0a0a;
    }
</style>

<script type="text/javascript">
    function lock($this){
        var ids=$($this).parent();
        var id=ids.prop('id');
        var idt=$($this).prop('id');
        var title="";(idt==='opened'?'Démarrage':'Suspension');
        var message="";(idt==='opened'?'démarrer':'suspendre');
        var state="";(idt==='opened'?'annulé':'annulée');

        switch (idt)
        {
            case 'opened': title="Démarrage"; message="démarrer"; state="annulé"; break;
            case 'pending': title="Suspension"; message="suspendre"; state="annulée"; break;
            case 'suspended': title="Relancement"; message="relancer"; state="annulé"; break;
        }

        alertify.confirm("Confirmation de "+title, "Voulez-vous vraiment <b>"+message+"</b> cette vague ?",
            function(){
                window.location.href='<?php echo base_url('trainner/promotion/lock/')?>'+'/'+id.toString();
            },
            function(){
                alertify.error(title+' '+state);
            });
    }

    function endpromo($this){
        var ids=$($this).parent();
        var id=ids.prop('id');
        alertify.confirm("Confirmation de terminaison", "Voulez-vous vraiment <b>achever</b> cette vague?",
            function(){
                window.location.href='<?php echo base_url('trainner/promotion/endPromo/')?>'+'/'+id.toString();
            },
            function(){
                alertify.error('Cancel');
            });
    }

    $(document).ready(function(){
        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
        (function(){
            <?php
            if(!empty($message)) {
            if ($status != -1) {
            ?>
            alertify.success("<?php echo $message ?>");
            <?php
            } else { ?>
            alertify.defaults.theme.ok = "btn w3-red";
            alertify.defaults.glossary.ok = "OK";
            alertify
                .alert("<span class='w3-text-red'><i class='w3-text-red fa fa-ban'></i>  Erreur</span>", "<?php echo $message ?>", function(){
                    alertify.error('Echec');
                });
            <?php   }
            }
            ?>

        })();
        alertify.defaults.theme.ok = "btn btn-primary";
        <?php if($val = get_flash_data()){
           echo 'setTimeout(function(){
               alertify.'.$val[0].'("'.$val[1].'");
           }, 750);';
       } ?>
    });
</script>