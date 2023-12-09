<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-lg-3"></div>
        <div class="col-sm-8 col-lg-6">
            <div class="card w3-margin w3-card-2 w3-white w3-padding-small" style="width: 95% !important;">
                <div class="card-header text-center">
                    <div>
                        <a href="<?php echo base_url() ?>">
                        <img class="responsive-img" height="150" src="<?php echo img_url('logo/logo.png') ?>" alt="<?php echo APPNAME ?>"></a>
                    </div>
                    <div class="w3-text-blue h2">Authentification</div>
                    <hr class="w3-border-grey w3-hover-border-black">
                </div>
                <div class="card-block">
                    <form action="" method="post">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <?php echo $error ?>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <input name="email" autofocus tabindex="0" type="text" class="w3-input" id="exampleInputEmail2" placeholder="Adresse E-mail ou Matricule" autocomplete="off" required>
                                <?php echo form_error('email')?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <input name="pwd" type="password" class="w3-input" id="exampleInputPassword2" placeholder="Mot de Passe" required>
                                <?php echo form_error('pwd')?>
                            </div>
                        </div>
                        <div class="row w3-margin-top">
                            <div class="col-sm-6 w3-left-align custom-checkbox">
                                <input type="checkbox" name="remember" class="checkbox w3-show-inline-block"> Se souvenir de moi
                            </div>
                            <div class="col-sm-6 w3-right-align w3-hide-small"><a href="<?php echo base_url('account/resetPassword') ?>">Mot de passe oublié?</a></div>
                        </div>
                        <div class="row w3-margin-top">
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-sign-in" aria-hidden="true"></i> Connection</button>

                            </div>
                            <div class="col-sm-8 text-right">
                                <i>Pas encore de compte ?</i> <a href="<?php echo base_url('account/signup') ?>" class=" link">Inscription</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<style>
    .link {
        color: #0275d8 !important;
    }

    .link:hover{
        text-decoration: underline !important;
        color: #0275d8 !important;
    }
</style>