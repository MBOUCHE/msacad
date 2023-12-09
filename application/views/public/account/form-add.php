<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo mb_strtoupper($titre) ?></h1>
                <hr >
            </div>

            <div class="col-sm-12">
                <form action="<?php echo base_url('account/signup') ?>" method="post" class="">

                    <div class="row">

                        <div class="col-sm-12 col-lg-6">
                            <?php
                            if(isset($message))
                            {
                                ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <?php echo $message ?>
                                </div>
                                <?php
                            }
                            ?>

                            <h4>Informations personnelles</h4>
                            <div class="dropdown-divider"></div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="lastName" class="input-group-addon">Nom * </label>
                                        <input type="text" name="lastName" id="lastName" required value="<?php echo set_value('lastName') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('lastName') ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="firstName" class="input-group-addon">Prénom </label>
                                        <input type="text" name="firstName" id="firstName" value="<?php echo set_value('firstName') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('firstName') ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="birthDate" class="input-group-addon">Date de naissance *</label>
                                        <input type="text" name="birthDate" id="birthDate" required value="<?php echo set_value('birthDate') ?>" class="form-control input-sm datepicker" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('birthDate') ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="birthPlace" class="input-group-addon">Lieu de naissance *</label>
                                        <input type="text" name="birthPlace" id="birthPlace" required value="<?php echo set_value('birthPlace') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('birthPlace') ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="nationality" class="input-group-addon">Nationalité *</label>
                                        <select name="nationality" required id="nationality" value="<?php echo set_value('nationality') ?>" class="form-control">
                                            <option value=""  selected>Choisissez votre pays d'origine...</option>
                                            <script>
                                                $.ajax({
                                                    url: '<?php echo json_url('fr-countries'); ?>',
                                                    dataType: 'json',
                                                    success: function(json) {
                                                        for(var key in json) {
                                                            var cont=$('#country');
                                                            cont.prop('value', json[key]);
                                                            $('#nationality').append("<option value='"+json[key]+"'>"+json[key]+"</option>");
                                                            $("#nationality").val("<?php echo (isset($user->nationality) ?  $user->nationality : set_value('nationality'))?>");
                                                        }
                                                    }
                                                });
                                            </script>
                                        </select>
                                    </div>
                                    <?php echo form_error('birthPlace') ?>
                                </div>
                            </div>

                            <div class="row  mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="genre" class="input-group-addon">Genre *</label>
                                        <select name="genre" required id="genre" value="<?php echo set_value('genre') ?>" class="form-control">
                                            <option name="genre" value="1" selected>Masculin</option>
                                            <option name="genre" value="-1" selected>Féminin</option>
                                            <script>
                                                $('#genre').val(<?php echo set_value('genre') ?>);
                                            </script>
                                        </select>
                                    </div>
                                    <?php echo form_error('genre') ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="address"  class="input-group-addon">Adresse *</label>
                                        <input type="text" required name="address" id="address" value="<?php echo set_value('address') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('address') ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="phone" class="input-group-addon">Téléphone *</label>
                                        <input type="text" required name="phone" id="phone" value="<?php echo set_value('phone') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('phone') ?>
                                </div>
                            </div>



                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <h4>Informations du compte</h4>
                            <div class="dropdown-divider"></div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="mail" class="input-group-addon">E-mail *</label>
                                        <input type="email" required name="mail" id="mail" value="<?php echo set_value('mail') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('mail') ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="pwd" class="input-group-addon">Mot de passe *</label>
                                        <input type="password" required name="pwd" id="pwd" value="" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('pwd') ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="pwd2"  class="input-group-addon">Confirmer le mot de passe *</label>
                                        <input type="password" required name="pwd2" id="pwd2" value="" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('pwd2') ?>
                                </div>
                            </div>
                            
                            
	                    <div class="g-recaptcha" data-sitekey="6LfFLjAUAAAAAOHjNRE0b9n4LILDJkb8OvGCkjdi"></div>

                            <p class="text-justify">
                                Devenir membre sur <b>MULTISOFT ACADEMY</b>, vous permettra d'accéder non seulement au contenu exclusif des nouvelles du Centre mais aussi d'intervenir dans les forums de discussion.<br>
                                Par ailleurs il est indispensable d'avoir un compte <b>*MEMBRE*</b> pour postuler à un cours.<br>
                                La création d'un compte est <b class="green-color">totalement gratuite</b>! Vous pourrez ensuite vous inscrire à un enseignement afin d'accéder aux interfaces pour <b>*Apprenants*</b>.
                                <br>
                                <b>(*) Champs obligatoires</b>
                            </p>

                            <button type="submit" name="send" class="mt-3 float-right btn btn-primary" style="border-radius: 0">S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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