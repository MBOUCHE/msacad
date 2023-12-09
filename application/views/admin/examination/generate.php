<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Génération d\'un planning d\'examen') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/examination/planning')?>" class="w3-btn w3-blue w3-round">Tous les emplois du temps</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <form action="<?php echo base_url('admin/examination/planning/generate/') ?>" method="post" class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="start" class="input-group-addon"> Début de semaine : </label>
                                <input type="text" class="form-control input-sm datepicker" name="start" id="start"  min="<?php echo date('Y-m-d')?>" required/>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <br>
                            <div class="input-group">
                                <label for="prog" class="input-group-addon"> Document du planning </label>
                                <select name="prog" id="prog" class="form-control">
                                    <?php
                                        if (!empty($docs) and isset($docs))
                                            foreach ($docs as $doc)
                                            {
                                                echo "<option value='$doc->id'>".mb_strtoupper('('.$doc->code.') '.$doc->name)."</option>";
                                            }
                                    ?>
                                </select>
                                    <br>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="send" name="send" class="btn w3-btn btn-primary w3-blue"><i class="fa fa-1x fa-fw fa-chevron-circle-right"></i>Suivant</button>
                </form>
            </div>
        </div>


    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        alm('collapseExa', 1);

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();

        $(".datepicker").datepicker({
            inline: true,
            showOtherMonths: true,
            firstDay: 1,
            dateFormat: "dd/mm/yy",
            dayNamesMin: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            showAnim: "slideDown",
            showButtonPanel: true,
            monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
            monthNamesShort: [ "Jan", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Dec" ],
            minDate: new Date(d.getFullYear(), month, day),
            changeYear: true
        });

        /*$('#send').on('click', function () {
            var form=$('form');
            //form.prop('action', "<-?php echo base_url('admin/examination/planning/generate/') ?>");
            form.submit();
        });*/

        <?php
        if(isset($message))
        {
        ?>
            alertify.confirm("Conflit", "<?php echo $message ?>",
            function(){
                window.location.href="<?php echo base_url('admin/session/timetableList/') ?>";
            },
            function(){
                alertify.error('Annulé');
            });
        <?php
        }
        ?>

    });
</script>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>

