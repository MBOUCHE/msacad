<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('modifier un évènement') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-padding-large">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/event') ?>">Liste des évènements</a>
                        </div>
                    </div>

                    <form class="w3-container" method="post" action="" enctype="multipart/form-data">
                        <?php if(isset($message)){ ?>
                            <div class="w3-row">
                                <div class="col-md-11">
                                    <?php foreach ($message as $item) { ?>
                                    <div class="alert <?php echo $item['class']; ?>">
                                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <?php  echo $item['msg']; ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="w3-row">
                            <div class="col-md-11">
                                <div class="w3-row">
                                    <div class="input-group w3-margin-bottom">
                                        <label class="input-group-addon">Titre: <span class="w3-text-red">*</span></label>
                                        <input class="form-control datetime" type="text" name="title" value="<?php echo set_value('title') ?>" required>
                                    </div>
                                    <?php echo form_error('title') ?>
                                </div>

                                <div class="w3-row">
                                    <div class="input-group w3-margin-bottom">
                                        <label class="input-group-addon">Date de début: <span class="w3-text-red">*</span></label>
                                        <input id="datetime1" class="form-control" type="text" name="start_date" value="<?php echo set_value('start_date') ?>" placeholder="jj/mm/aaaa hh:min" required>
                                    </div>
                                    <?php echo form_error('start_date') ?>
                                </div>

                                <div class="w3-row">
                                    <div class="input-group w3-margin-bottom">
                                        <label class="input-group-addon">Date de fin:</label>
                                        <input id="datetime2" class="form-control" type="text" name="end_date" value="<?php echo set_value('end_date') ?>" placeholder="jj/mm/aaaa hh:min">
                                    </div>
                                    <?php echo form_error('end_date') ?>
                                </div>

                                <div class="input-group w3-margin-bottom">
                                    <label class="input-group-addon">Contenu <span class="w3-text-red">*</span></label>
                                    <textarea class="form-control" type="text" name="text" required><?php echo set_value('text') ?></textarea>
                                </div>
                                <?php echo form_error('text') ?>
                            </div>
                        </div>

                        <div class="w3-row">
                            <div class="col-md-11">
                                <button class="w3-btn w3-blue w3-right">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('text');

    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>

        leftM(1, '#panel-agenda');

        (function($) {
            $.timepicker.regional['fr'] = {
                dateFormat: 'dd/mm/yy',
                dayNamesMin: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
                showAnim: "slideDown",
                monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
                monthNamesShort: [ "Jan", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Dec" ],
                timeOnlyTitle: 'Choisir une heure',
                timeText: 'Heure',
                hourText: 'Heures',
                showOtherMonths: true,
                showButtonPanel: true,
                minuteText: 'Minutes',
                secondText: 'Secondes',
                millisecText: 'Millisecondes',
                microsecText: 'Microsecondes',
                timezoneText: 'Fuseau horaire',
                currentText: 'Maintenant',
                closeText: 'Terminé',
                timeFormat: 'HH:mm',
                timeSuffix: '',
                amNames: ['AM', 'A'],
                pmNames: ['PM', 'P'],
                isRTL: false
            };
            $.timepicker.setDefaults($.timepicker.regional['fr']);
        })(jQuery);

        var controleTime = {
            inline: true,
            showOtherMonths: true,
            showButtonPanel: true,
            minDate: new Date()
        };

        $('#datetime1').datetimepicker({
            controleType: controleTime
        });

        $('#datetime2').datetimepicker({
            controleType: controleTime
        });
    })
</script>
<!--END PAGE CONTENT -->