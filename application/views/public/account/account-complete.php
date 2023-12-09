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
                        <div id="content  w3-card-2">
                            <div class="inner" style="min-height: 700px;">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class=" card">
                                            <div class="card-header w3-blue">
                                                <b><?php echo ($user->sexe==0?'Mme ':'M. ').mb_strtoupper($user->lastname).' '.ucwords($user->firstname) ?></b>
                                            </div>
                                            <div class="card-body">
                                                <form id="wizardV" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('account/completeAccount')?>">
                                                    <h2> Préambule </h2>
                                                    <section data-step="0">
                                                        <div class="row" style="margin-bottom: 40px">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-4">
                                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('user-shield-filled.png'); ?>" />
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>
                                                        <p style="text-align:justify;color:gray;">IL est important et impératif que vous complétiez votre compte utilisateur sur la plateforme Multisoft Academy. <br><br>
                                                            <i class="fa fa-fw fa-check w3-text-green"></i> Cela vous permet d'utiliser nos services avec une identité claire et congrue<br>
                                                            <i class="fa fa-fw fa-check w3-text-green"></i> Cela vous permet de sécuriser votre compte<br>
                                                            <i class="fa fa-fw fa-check w3-text-green"></i> Cela nous permet de vous reconnaître<br>
                                                        </p>


                                                    </section>
                                                    <h2> Personnel </h2>
                                                    <section data-step="1">

                                                        <div class="form-group row">
                                                            <div class="col-lg-4"><p>Avatar</p></div>
                                                            <div class="fileinput fileinput-new col-lg-4" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                    <img src="<?php echo ($user->sexe==0?img_url('img_avatar2.png'):img_url('img_avatar.png')) ?>" alt="Changer..." style="width: 100%; height: 100%;">
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 200px;"></div>
                                                                <div>
                                                                    <span class="btn btn-secondary btn-file" style="cursor:pointer;"><span class="fileinput-new" style="cursor:pointer;">+</span><span class="fileinput-exists">Changer</span><input type="file" name="user_avatar" accept=".jpg,.png,.gif"></span>
                                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Effacer</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="question">Question secrète</label>
                                                            <input class="form-control" name="question" id="question" type="text" autocomplete="off"/>
                                                            <!--p class="help-block">Entrez une question à laquelle seul vous pouvez répondre dans la mesure du possible.</p-->
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="answer">Réponse</label>
                                                            <input class="form-control" name="answer" id="answer" type="text" autocomplete="off"/>
                                                            <!--p class="help-block">Entrez la réponse à votre question secrète.</p-->
                                                        </div>

                                                    </section>

                                                    <h2> Authentification </h2>
                                                    <section data-step="2">
                                                        <div class="row" style="margin-bottom: 40px">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-4">
                                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('shield_green.png'); ?>" />
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>
                                                        <p style="text-align:justify;color:gray;">Veuillez entre un mot de passe que vous serez à mesure de retenir (minimum 9 caractères)<br><br>
                                                        </p>
                                                        <div class="form-group">
                                                            <label for="npwd">Nouveau mot de passe</label>
                                                            <input class="form-control" type="password" id="npwd" name="npwd" autocomplete="off"/>
                                                            <!--p class="help-block">Veuillez entre un mot de passe que vous serez à mesure de retenir (minimum 9 caractères)</p-->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cpwd">Confirmation du mot de passe</label>
                                                            <input class="form-control" type="password" id="cpwd" name="cpwd" autocomplete="off"/>
                                                            <!--p class="help-block">Veuillez entre un mot de passe que vous serez à mesure de retenir (minimum 9 caractères)</p-->
                                                        </div>
                                                    </section>

                                                    <h2>Extras </h2>
                                                    <section data-step="3">
                                                        <div class="row" style="margin-bottom: 40px">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-4">
                                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('tasklist.png'); ?>" />
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>
                                                        <p style="text-align:justify;color:gray;" class="w3-center">Par quel(s) biais avez-vous été informé sur notre Centre et ses activités? </p>
                                                        <div class="form-group">
                                                            <fieldset>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="styled" id="aff" name="aff"><label for="aff">Les affiches</label><br>
                                                                </div>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="styled" id="pro" name="pro"><label for="pro">Un proche</label><br>

                                                                </div>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="styled" id="rad" name="rad"><label for="rad">La radio</label><br>

                                                                </div>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="styled" id="pla" name="pla"><label for="pla">La plaque d'information</label><br>

                                                                </div>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input type="checkbox" class="styled" id="aut" name="aut"><label for="aut">Autre à préciser...</label><br>

                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </section>

                                                    <h2>Finalisation</h2>
                                                    <section data-step="4">
                                                        <div class="row" style="margin-bottom: 40px">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-4">
                                                                <img style="width: 170px; height: 170px;" src="<?php echo img_url('tick_green.png'); ?>" />
                                                            </div>
                                                            <div class="col-lg-4"></div>
                                                        </div>
                                                        <p style="text-align:justify;color:gray;">Votre compte est fin prêt! Cliquez sur <b>"Finish"</b> pour appliquer les changements et commencer à utiliser nos services.<br><br>
                                                        </p>
                                                    </section>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


    <!--END PAGE CONTENT -->

<script src="<?php echo js_url('WizardInit')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.fileinput').fileinput();
        function changeState(el) {
            if (el.readOnly) el.checked=el.readOnly=false;
            else if (!el.checked) el.readOnly=el.indeterminate=true;
        }
        $('#aut').on('change', function(){
            if(this.checked){
                var par=$(this).parent();
                var other=$("<input>").prop({'type':'text', 'name':'oth', 'id':'oth', 'class':'form-control'}).css('display', 'none');
                par.append(other);
                other.fadeIn();
            }else{
                $('#oth').fadeOut();
                $('#oth').remove();
            }
        });
    });
</script>

<!--END MAIN WRAPPER -->
