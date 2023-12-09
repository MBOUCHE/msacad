<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo mb_strtoupper($titre) ?></h1>
                <hr >
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="">
                            <div class="inner" style="min-height: unset">
                                <div class="row">
                                    <div id="auth" class="col-lg-12" style="padding:30px;">
                                        <div class="row" style="margin-bottom: 50px">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('multimedia.png'); ?>" />
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>

                                        <p style="text-align:justify;color:gray;" class="w3-center">Entrez votre e-mail ou matricule pour procéder</p>
                                        <br>
                                        <br>
                                        <p id="lerror" style="text-align:justify;color:red; display: none" class="w3-left">Matricule ou e-mail inconnu</p>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="login" name="login" autocomplete="off" placeholder="E-mail ou matricule..."/>
                                            <br>
                                            <button class="btn w3-btn w3-blue" id="next1">Suivant</button>
                                        </div>
                                    </div>
                                    <div id="quest" class="col-lg-12 " style="padding:30px; display: none">
                                        <div class="row" style="margin-bottom: 50px">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('questions.png'); ?>" />
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                        <p id="numid" style="text-align:justify;color:gray;" class="w3-center"></p><br>
                                        <p style="text-align:justify;color:gray;" class="w3-center">Répondez à la question suivante pour recupérer votre mot de passe</p>
                                        <div class="form-group">
                                            <b><label for="answer" id="question_tag"></label></b><br><br>
                                            <p id="aerror" style="text-align:justify;color:red; display: none" class="w3-right">Cette réponse est erronée.</p>
                                            <input class="form-control" type="text" id="answer" name="answer" autocomplete="off"/>
                                            <br>
                                            <button class="btn w3-btn w3-blue" id="next2">Valider</button>
                                        </div>
                                    </div>
                                    <div id="final" class="col-lg-12" style="padding:30px; display: none">
                                        <div class="row" style="margin-bottom: 50px">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('tick_green.png'); ?>" />
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                        <p style="text-align:justify;color:gray;" class="w3-center">Votre nouveau mot de passe vous a été envoyé par mail.</p>
                                        <br>
                                        <a href="<?php echo base_url('account/login') ?>" class="btn w3-btn w3-blue" id="back">Retour à la page d'authentification</a>
                                    </div>
                                </div>
                                <input type="hidden" id="matricule" value="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!--END PAGE CONTENT -->

<script type="text/javascript">
    $(document).ready(function(){
        var login=$('#login');
        var answer=$('#answer');
        $('#next1').on('click', function(){
            $.loader({className: 'blue-with-image-2', content: ''});
            $('#matricule').prop('value', login.prop('value'));
            $.post("<?php echo base_url('account/resetPassword') ?>",
             {
                 log_in: login.prop('value'),
                 step: 1
             },
             function (data){
                 $.loader('close');
                 if (isNaN(data)===true)
                 {
                     var creds=data.split('/');
                     $('#numid').html('<b>'+creds[0]+'</b>');
                     $('#question_tag').text(creds[1]);
                     $('#auth').animate({
                         opacity: 'hide', // animate slideUp
                         right: '200px'  // slide left
                     }, 'slow', 'swing', function() {
                         $(this).remove();
                         $('#quest').animate({
                             opacity: 'show', // animate slideUp
                             right: '0px'  // slide left
                         }, 'slow', 'swing');
                     });
                 } else
                 {
                     login.addClass('w3-text-red');
                     $('#lerror').slideDown();
                 }
             }).fail(function() {
                $.loader('close');
            });
        });

        $('#next2').on('click', function(){
            $.loader({className: 'blue-with-image-2', content: ''});
            $.post("<?php echo base_url('account/resetPassword') ?>",
             {
                 answer: (answer.prop('value')===''?'/':answer.prop('value')),
                 step: 2,
                 numid: $('#matricule').prop('value')
             },
             function (data){
                 $.loader('close');

                 switch (parseInt(data))
                 {
                     case 1: $('#quest').animate({
                                 opacity: 'hide', // animate slideUp
                                 right: '200px'  // slide left
                             }, 'slow', 'swing', function() {
                                 $(this).remove();
                                 $('#final').animate({
                                     opacity: 'show', // animate slideUp
                                     right: '0px'  // slide left
                                 }, 'slow', 'swing');
                             });
                             break;
                     case 0: $('#aerror').slideDown(); break;
                     case -1: alertify.defaults.theme.ok = "btn w3-red";
                                 alertify.defaults.glossary.ok = "OK";
                                 alertify.alert("<span class='w3-text-red'><i class='w3-text-red fa fa-ban'></i>  Erreur</span>", "Vérifiez votre connection à Internet.", function(){});
                                 break;
                     case -2: alertify.defaults.theme.ok = "btn w3-red";
                         alertify.defaults.glossary.ok = "OK";
                         alertify.alert("<span class='w3-text-red'><i class='w3-text-red fa fa-ban'></i>  Erreur</span>", "Une erreur s'est produite. La réinitialisation du mot de passe a échoué.", function(){});
                         break;
                 }
             }).fail(function() {
                $.loader('close');
            });
        });
    });
</script>
