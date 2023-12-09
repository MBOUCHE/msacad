<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
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
            <div class="col-sm-12 offset-md-3 col-md-6">
                <?php
                if(isset($message))
                {
                    ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo $message ?>
                    </div>
                    <?php
                }
                ?>
                <form action="<?php echo base_url("admin/home/editProfile") ?>" method="post"  autocomplete="off">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="lastName" class="input-group-addon">Nom</label>
                                <input type="text" name="lastName" id="lastName" value="<?php echo (isset($user->lastname) ?  $user->lastname : set_value('lastName'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('lastName') ?>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="firstName" class="input-group-addon">Prénom</label>
                                <input type="text" name="firstName" id="firstName" value="<?php echo (isset($user->firstname) ?  $user->firstname : set_value('firstName'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('firstName') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="birthDate" class="input-group-addon">Date de naissance</label>
                                <input type="text" name="birthDate" id="birthDate" value="<?php echo (isset($user->birth_date) ?  date('d-m-Y', strtotime($user->birth_date)) : set_value('birthDate'))?>" class="form-control input-sm datepicker" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('birthDate') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="birthPlace" class="input-group-addon">Lieu de naissance</label>
                                <input type="text" name="birthPlace" id="birthPlace" value="<?php echo (isset($user->birth_place) ?  $user->birth_place : set_value('birthPlace'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('birthPlace') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="nationality" class="input-group-addon">Nationalité</label>
                                <select name="nationality" id="nationality" class="form-control">
                                    <option delete selected value="">Choisissez votre pays d'origine...</option>
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="address" class="input-group-addon">Adresse</label>
                                <input type="text" name="address" id="address" value="<?php echo (isset($user->address) ?  $user->address : set_value('address'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('address') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="phone" class="input-group-addon">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="<?php echo (isset($user->phone) ?  $user->phone : set_value('phone'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('phone') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="mail" class="input-group-addon">E-mail</label>
                                <input type="email" name="mail" id="mail" value="<?php echo (isset($user->mail) ?  $user->mail : set_value('mail'))?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('mail') ?>
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
                        </div>
                    </div>

                    <input type="hidden" id="country" value="" />
                    <!--div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="answer" class="input-group-addon">Réponse</label>
                                <input type="text" name="answer" id="question" value="<?php echo set_value('answer') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('answer') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="login" class="input-group-addon">Pseudonyme</label>
                                <input type="text" name="login" id="question" value="<?php echo set_value('login') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('login') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="pwd" class="input-group-addon">Mot de passe</label>
                                <input type="password" name="pwd" id="question" value="<?php echo set_value('pwd') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('pwd') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="cpwd" class="input-group-addon">Confirmer le mot de passe</label>
                                <input type="password" name="cpwd" id="question" value="<?php echo set_value('cpwd') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('cpwd') ?>
                        </div>
                    </div-->




                    <button type="submit" name="send" class="btn w3-btn w3-blue btn-primary"><i class="fa fa-fw fa-pencil"></i> Modifier</button>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

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