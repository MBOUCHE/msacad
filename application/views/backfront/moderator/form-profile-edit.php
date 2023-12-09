<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="content-wrapper py-3">

            <div class="container-fluid">
                <div class="row">
                    <div class="h4 text-center col-sm-12"><br>
                        <?php echo mb_strtoupper('MODIFICATION DU PROFIL') ?><br><br>
                        <?php if ($user)
                        {
                            echo "<b>Utilisateur : </b>".mb_strtoupper($user->lastname)." ".$user->firstname;
                        }
                        ?>
                        <hr width="60%" style="margin: auto; margin-top: 10px">
                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-sm-12 col-md-8">
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
                        <form action="<?php echo base_url("ModeratorGate/home/editProfile") ?>" method="post"  autocomplete="off">
                            <small class="text-center">
                                Ne remplissez les champs que vous voulez modifier. <br>
                                A la fin mettez le mot de passe pour confirmer votre action.
                            </small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="lastName" class="input-group-addon">Nom</label>
                                        <input type="text" name="lastName" id="lastName" value="<?php echo ((set_value('lastName')) ?  set_value('lastName') : $user->lastname)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('lastName') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="firstName" class="input-group-addon">Prénom</label>
                                        <input type="text" name="firstName" id="firstName" value="<?php echo ((set_value('firstName')) ? set_value('firstName') : $user->firstname )?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('firstName') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="birthDate" class="input-group-addon">Date de naissance</label>
                                        <input type="text" name="birthDate" id="birthDate" value="<?php echo ((set_value('birthDate')) ? set_value('birthDate')  : date('d-m-Y', strtotime($user->birth_date)))?>" class="form-control input-sm datepicker" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('birthDate') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="birthPlace" class="input-group-addon">Lieu de naissance</label>
                                        <input type="text" name="birthPlace" id="birthPlace" value="<?php echo ((set_value('birthPlace')) ? set_value('birthPlace')   : $user->birth_place)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('birthPlace') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="nationality" class="input-group-addon">Nationalité</label>
                                        <select name="nationality" id="nationality" class="form-control">
                                            <option selected value="">Choisissez votre pays d'origine...</option>
                                            <script>
                                                $.ajax({
                                                    url: '<?php echo json_url('fr-countries'); ?>',
                                                    dataType: 'json',
                                                    success: function(json) {
                                                        for(var key in json) {
                                                            var cont=$('#country');
                                                            cont.prop('value', json[key]);
                                                            $('#nationality').append("<option value='"+json[key]+"'>"+json[key]+"</option>");
                                                            $("#nationality").val("<?php echo ((set_value('nationality')) ? set_value('nationality')   : $user->nationality)?>");
                                                        }
                                                    }
                                                });
                                            </script>
                                        </select>
                                    </div>
                                    <?php echo form_error('nationality') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="address" class="input-group-addon">Adresse</label>
                                        <input type="text" name="address" id="address" value="<?php echo ((set_value('address')) ? set_value('address')  : $user->address)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('address') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="phone" class="input-group-addon">Téléphone</label>
                                        <input type="text" name="phone" id="phone" value="<?php echo ((set_value('phone')) ? set_value('phone')  : $user->phone)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('phone') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="mail" class="input-group-addon">E-mail</label>
                                        <input type="email" name="mail" id="mail" value="<?php echo ((set_value('mail')) ? set_value('mail')  : $user->mail)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('mail') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="school" class="input-group-addon"><?php echo mb_strtoupper("é").'tablissemnt' ?></label>
                                        <input type="text" name="school" id="school" value="<?php echo ((set_value('school')) ? set_value('school')  : $user->school)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('school') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="fil" class="input-group-addon">Filière</label>
                                        <input type="text" name="fil" id="fil" value="<?php echo ((set_value('fil')) ?   set_value('fil')  : $user->school_area)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('fil') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="level" class="input-group-addon">Niveau</label>
                                        <input type="text" name="level" id="level" value="<?php echo (( set_value('level')) ?  set_value('level')  :$user->school_level)?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('level') ?>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="pwd" class="input-group-addon">Mot de passe :</label>
                                        <input type="password" name="pwd" id="pwd" value="<?php echo  set_value('pwd') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('pwd') ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="npwd" class="input-group-addon">Nouveau mot de passe :</label>
                                        <input type="password" name="npwd" id="npwd" value="<?php echo  set_value('npwd') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('npwd') ?>
                                    <small>Mettez-le si vous voulez changer de mot de passe.</small>
                                </div>
                            </div>

                            <input type="hidden" id="country" value="" />

                            <button type="submit" name="send" class="btn w3-btn w3-blue btn-primary"><i class="fa fa-fw fa-pencil"></i> Modifier</button>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>

<!-- /.content-wrapper -->

<script type="application/json" src="<?php echo json_url('countries-FR'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
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

    });
</script>