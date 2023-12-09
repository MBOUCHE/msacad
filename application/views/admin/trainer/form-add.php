<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Enregistrer un formateur') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/trainer')?>" class="w3-btn w3-blue w3-round">Tous les formateurs</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <?php
                if(isset($message))
                {
                    ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo $message ?>
                    </div>
                    <?php
                }
                ?>
                <form action="<?php echo base_url('admin/trainer/formAdd') ?>" method="post" class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="lastName" class="input-group-addon">Nom</label>
                                <input type="text" name="lastName" id="lastName" value="<?php echo set_value('lastName') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('lastName') ?>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="firstName" class="input-group-addon">Prénom</label>
                                <input type="text" name="firstName" id="firstName" value="<?php echo set_value('firstName') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('firstName') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="birthDate" class="input-group-addon">Date de naissance</label>
                                <input type="text" name="birthDate" id="birthDate" value="<?php echo set_value('birthDate') ?>" class="form-control input-sm datepicker" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('birthDate') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="birthPlace" class="input-group-addon">Lieu de naissance</label>
                                <input type="text" name="birthPlace" id="birthPlace" value="<?php echo set_value('birthPlace') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('birthPlace') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="nationality" class="input-group-addon">Nationalité</label>
                                <select name="nationality" id="nationality" value="<?php echo set_value('nationality') ?>" class="form-control">
                                    <option delete selected>Choisissez votre pays d'origine...</option>
                                </select>
                            </div>
                            <?php echo form_error('birthPlace') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="genre" class="input-group-addon">Genre</label>
                                <select name="genre" id="genre" value="<?php echo set_value('genre') ?>" class="form-control">
                                    <option name="genre" value="1" selected>Masculin</option>
                                    <option name="genre" value="-1" selected>Féminin</option>
                                </select>
                            </div>
                            <?php echo form_error('genre') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="address" class="input-group-addon">Adresse</label>
                                <input type="text" name="address" id="address" value="<?php echo set_value('address') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('address') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="phone" class="input-group-addon">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="<?php echo set_value('phone') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('phone') ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="mail" class="input-group-addon">E-mail</label>
                                <input type="email" name="mail" id="mail" value="<?php echo set_value('mail') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('mail') ?>
                        </div>
                    </div>

                    <button type="submit" name="send" class="w3-btn w3-blue w3-round">Sauvegarder</button>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>

<script type="application/json" src="<?php echo json_url('countries-FR'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        alm('collapseForm', 2);
        var nationalities=$("#nationality");
        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        $(".datepicker").datepicker({
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            showAnim: "slideDown",
            showButtonPanel: true,
            monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
            monthNamesShort: [ "Jan", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Dec" ],
            maxDate: new Date(d.getFullYear(), month, day)
        });
        $.ajax({
            url: '<?php echo json_url('fr-countries'); ?>',
            dataType: 'json',
            success: function(json) {
                for(var key in json) {
                   nationalities.append("<option value='"+json[key]+"'>"+json[key]+"</option>");
                }
            }
        });
    });
</script>