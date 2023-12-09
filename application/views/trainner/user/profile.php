<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Profil de l\'utilisateur')?>
                <br> <b><?php echo  ucfirst($user->firstname).' '.strtoupper($user->lastname) ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="row col-md-12 float-right">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="col-sm-8  col-md-4">
                <div class="h5 font-weight-bold">Informations personnelles</div>
                <hr width="700">
            </div>

            <div class="row col-md-12">
                <div class="col-md-4">
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


                    <form class="text-center" action="<?php echo base_url('trainner/user/profile').'/'.$user->id ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <img style="" id="photo" src="<?php echo isset($imgName) ? upload_url('images/'.$imgName) : base_url().$user->photo ?>" class="img-rounded" alt="Photo"  height="150"><br><br>
                    </form>
                </div>


                    <div class="col-md-8">
                        <div>
                            <p >
                                Matricule : <b><?php echo $user->number_id ?></b><br>
                                Nom complet : <b><?php echo strtoupper($user->lastname).' '.ucfirst($user->firstname) ?></b><br>
                                Né(e) le <b><?php echo $dateBirth = date_format($dateBirth, 'd').'/'.date_format($dateBirth, 'm').'/'.
                                        date_format($dateBirth, 'Y') ?></b> à <b><?php echo $user->birth_place ?></b><br>
                                Pays d'origine : <b><?php echo $user->nationality ?></b><br>
                                Téléphone : <b><?php echo $user->phone ?></b> <br>
                                Email : <b><?php echo $user->mail ?></b><br>
                                Adresse : <b><?php echo $user->address ?></b><br>
                            </p>
                        </div>
                    </div>
                <br>
            </div>
            <div class="col-sm-8  col-md-4">
                <div class="h5 font-weight-bold">Informations du compte utilisateur</div>
                <hr width="700">
            </div>
            <div class="row col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div>
                            <p >
                                Login : <b><?php echo $user->mail .' | '. $user->number_id ?></b><br>
                                Mot de passe : <b>******** </b><br>
                                Date d'enregistrement : <b><?php echo $dateReg = ''.date_format($dateReg, 'd'). '-'.date_format($dateReg, 'm').'-'.date_format($dateReg, 'Y'); ?></b><br>
                                Derniere connexion : <b><?php
                                    if($user->last_connexion!=null)
                                        echo moment($user->last_connexion)->fromNow()->getRelative();
                                    else
                                        echo "Jamais";
                                    ?></b><br>
                            </p>

                        </div>
                    </div>
                <br>
            </div>
            <div class="col-sm-8  col-md-4">
                <div class="h5 font-weight-bold">Différents rôles</div>
                <hr width="700">
            </div>
            <div class="row col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div>
                            <p>
                                <?php if (isset($roles) and !empty($roles)){
                                        foreach ($roles as $role)
                                        {
                                            switch ($role->role)
                                            {
                                                case 1: echo "Membre<br>";  break;
                                                case 2: echo "Apprenant<br>";  break;
                                                case 3: echo "Formateur<br>";  break;
                                                case 4: echo "Modérateur<br>";  break;
                                                case 5: echo "Gérant<br>";  break;
                                                case 6: echo "Administrateur<br>";  break;
                                            }
                                        }
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                <br>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<script>

    $('input[type="file"]').on('change', function(){
        var files = $(this)[0].files;
        if (files.length > 0) {
             $("#photo").attr('src', window.URL.createObjectURL(files[0]));
        }
    });
</script>