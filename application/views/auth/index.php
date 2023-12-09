<div class="container-fluid bg-faded">
    <div class="row">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <div class="card w3-margin w3-card-2">
                <div class="card-header text-center w3-responsive">
                    <div>
                        <a href="<?php echo base_url() ?>"><img src="<?php echo img_url('logo/logo.png') ?>" alt="<?php echo APPNAME ?>" height="75%" width="50%"></a>
                    </div>
                    <div class="w3-text-blue h2">Authentification</div>
                </div>
                <div class="card-block">
                    <form action="<?php echo base_url('admin/auth') ?>" method="post">
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $error ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <input name="email" autofocus tabindex="0" type="text" class="form-control" id="exampleInputEmail2" placeholder="Adresse E-mail ou Matricule" autocomplete="off" required>
                            <?php echo form_error('email')?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input name="pwd" type="password" class="form-control" id="exampleInputPassword2" placeholder="Mot de Passe" required>
                            <?php echo form_error('pwd')?>
                        </div>
                    </div>
                    <div class="row col-sm-6" style="margin: 0; padding: 0;">
                        <div class="form-group" style="margin: 0; padding: 0;">
                            <button type="submit" class="w3-btn w3-blue w3-round"> <i class="fa fa-fw fa-sign-in" aria-hidden="true"></i> Connection</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->