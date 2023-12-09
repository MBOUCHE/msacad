<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Profil académique de l\'apprenant')?>
                <br> <b><?php echo ucfirst($student->firstname).' '. strtoupper($student->lastname) ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="row col-md-12 float-right">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <a href="<?php echo base_url("trainner/student/profile").'/'.$student->user.'/print' ?>" type="button" class="w3-btn w3-blue w3-round btn-block"><h4><i class="fa fa-id-card-o"></i> Imprimer le profil</h4></a>
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
                    //var_dump($student); die(0);
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


                    <form class="text-center" action="<?php echo base_url('trainner/student/profile').'/'.$student->user ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <img style="" id="photo" src="<?php echo isset($imgName) ? upload_url('images/'.$imgName) : base_url().$student->photo ?>" class="img-rounded" alt="Photo" height="150"><br><br>


                        <input type="file" class="filestyle float-right" data-buttonBefore="true" name="avatar" data-buttonText="Changer" data-icon="true" data-iconName="glyphicon glyphicon-inbox"><br>
                        <button name="send" type="submit" class="w3-btn w3-blue w3-round float-right"><i class="fa fa-upload" aria-hidden="true"></i> OK</button>
                    </form>
                </div>


                    <div class="col-md-8">
                        <div>
                            <p href="#">
                                Matricule : <b><?php echo $student->number_id ?></b><br>
                                Nom complèt : <b><?php echo strtoupper($student->lastname).' '.ucfirst($student->firstname) ?></b><br>
                                Née le <b><?php echo $dateBirth = date_format($dateReg, 'd').'/'.date_format($dateReg, 'm').'/'.
                                        date_format($dateReg, 'Y') ?></b> à <b><?php echo $student->birth_place ?></b><br>
                                Pays d'origine : <b><?php echo $student->nationality ?></b><br>
                                Téléphone : <b><?php echo $student->phone ?></b> <br>
                                Email : <b><?php echo $student->mail ?></b><br>
                                Adresse : <b><?php echo $student->address ?></b><br>
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
                                Login : <b><?php echo $student->mail .' | '. $student->number_id ?></b><br>
                                Mot de passe : <b>******** </b><br>
                                Date d'enregistrement : <b><?php echo $dateReg = ''.date_format($dateReg, 'd'). '-'.date_format($dateReg, 'm').'-'.date_format($dateReg, 'Y'); ?></b><br>
                                Derniere connexion : <b><?php echo ($student->last_connexion!=null)? moment($student->last_connexion)->fromNow()->getRelative():"Jamais connecté"; ?></b><br>
                            </p>

                        </div>
                    </div>
                <br>
            </div>
            <div class="col-sm-8  col-md-4">
                <div class="h5 font-weight-bold">Enseignement(s) suivi(s)</div>
                <hr width="700">
            </div>
            <div class="row col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div>
                            <ul>
                                <?php
                                    if(isset($lesson) and is_array($lesson)){
                                        //var_dump($lesson); die(0);
                                        for($i = 0; $i < count($lesson); $i++){
                                            $registration_date = date_create($lesson[$i]->registration_date);
                                            $registration_date = ''.date_format($registration_date, 'd'). '/'.date_format($registration_date, 'm').'/'.date_format($registration_date, 'Y');
                                            echo "
                                                <li>
                                                    <b>".mb_strtoupper($lesson[$i]->label)."(".$lesson[$i]->code.")</b>
                                                    <ul>
                                                        <li>Vague : <b>".$lesson[$i]->promCode."</b></li>
                                                        <li>Inscrit le : <b>".$registration_date."</b></li>
                                                    </ul>
                                                </li>
                                            ";
                                        }
                                    }
                                ?>
                            </ul>
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
    alm('collapseStudent');
    $('input[type="file"]').on('change', function(){
        var files = $(this)[0].files;
        if (files.length > 0) {
             $("#photo").attr('src', window.URL.createObjectURL(files[0]));
        }
    });
</script>