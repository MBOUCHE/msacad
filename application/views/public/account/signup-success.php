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
                        <h4>Bravo <b><?php echo $user->firstname ?> <?php echo mb_strtoupper($user->lastname) ?></b>!</h4>
                        <p style="font-size: 16px">Votre compte a été crée avec succès!<br>
                        Vos informations de connexion ont été envoyées à l'adresse <b><?php echo $user->mail ?></b>;
                        vous pouvez <a class="btn btn-primary" href="<?php echo base_url('account/login') ?>">cliquer ici</a> pour vous connecter.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

