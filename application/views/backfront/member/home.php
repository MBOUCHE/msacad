<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="h4 text-center  col-sm-12"><br>
                <b><?php echo mb_strtoupper('B').'ienvenue '.session_data('firstname').' '.session_data('lastname') ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h2><?php echo mb_strtoupper("PANEL ACADEMIQUE").'' ?></h2>
            <table class="small table table-bordered table-hover" id="dataTable">
                <thead class="">
                    <tr>
                        <th class="hidden">#</th>
                        <th><b>N°</b><b></th>
                        <th><b>Détails<b></th>
                        <th><b>Délai de validation<b></th>
                    </tr>
                </thead>
                <tbody>

                <?php

                if(isset($registrations) and !empty($registrations)) {
                    foreach ($registrations as $key => $reg) {
                        ?>
                        <tr>
                            <td class="hidden"><b><?php echo $key?></b></td>
                            <td><b><?php echo $reg->code?></b></td>
                            <td>
                                <?php
                                if($reg->state=='0')
                                {
                                    ?>
                                    <b class="w3-text-orange">En attente</b>
                                    <?php
                                }elseif($reg->state=='1')
                                {
                                    ?>
                                    <b class="w3-text-green">En Cours</b>
                                    <?php
                                }elseif($reg->state=='-1')
                                {
                                    ?>
                                    <b class="w3-text-red">Bloqué</b>
                                    <?php
                                }elseif($reg->state=='2')
                                {
                                    ?>
                                    <b class="w3-text-grey">Terminé</b>
                                    <?php
                                }

                                ?>

                                    <br>Titre de l'enseignement : <?php echo mb_strtoupper($reg->label) ?> (<?php echo $reg->lCode ?>)
                                    <br>Date d'enregistrement : <?php echo moment($reg->registration_date)->format('d M Y') ?> <i>(<?php echo moment($reg->registration_date)->fromNow()->getRelative() ?>)</i>
                            </td>
                            <td>Délai de validation : <b><?php echo ($reg->dead_line!=null)?$reg->dead_line:'Déjà validé!' ?> </b></td>
                        </tr>


                        <?php
                    }
                }?>

                </tbody>
            </table>

        </div>

    </div>
</div>


<script>
    $(document).ready(function(){
        leftM(0);
        $('a#reg0').prop('aria-expanded','true')
    });
</script>
