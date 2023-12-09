<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Votre profil formateur')?>
                <br> <b style="font-family:Italianno;"><?php echo ucfirst($user->firstname).' '.mb_strtoupper($user->lastname) ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="row col-md-12 float-right">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <a href="<?php echo base_url("trainner/home/editProfile")?>" type="button" class="w3-btn w3-blue w3-round btn-block"><h4><i class="fa fa-edit"></i> Modifier</h4></a>
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
                    //var_dump($user); die(0);
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


                    <form class="text-center" action="<?php echo base_url('trainner/home/profile') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <img style="" id="photo" src="<?php echo isset($imgName) ? upload_url('images/'.$imgName) : base_url().$user->photo ?>" class="img-rounded" alt="Photo" height="150"><br><br>


                        <input type="file" class="filestyle float-right" data-buttonBefore="true" name="avatar" data-buttonText="Changer" data-icon="true" data-iconName="glyphicon glyphicon-inbox"><br>
                        <button name="send" type="submit" class="w3-btn w3-blue w3-round float-right "><i class="fa fa-upload" aria-hidden="true"></i> OK</button>
                    </form>
                </div>


                    <div class="col-md-8">
                        <div>
                            <p href="#">
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
                                Derniere connexion : <b><?php echo moment($user->last_connexion)->fromNow()->getRelative();  ?></b><br>
                            </p>

                        </div>
                    </div>
                <br>
            </div>
            <div class="row col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div>
                            <ul>
                            </ul>
                        </div>
                    </div>
                <br>
            </div>


            <div class="row col-md-12">
                <hr><hr>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <img src="<?php echo isset($imgName) ? upload_url('img/'.$imgName) : base_url().$user->photo ?>" width="50" height="50">
                                <h5 style="text-align: center;" class="modal-title">Choisissez la vague à bloquer pour l'apprenant <br> <b><?php echo strtoupper($user->lastname).' '.ucfirst($user->firstname) ?></b></h5>
                            </div>
                            <div class="modal-body">
                            <div class="col-sm-12 table-responsive">
                            </div>






                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<script>

    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
        $('input[type="file"]').on('change', function(){
            var files = $(this)[0].files;
            if (files.length > 0) {
                $("#photo").attr('src', window.URL.createObjectURL(files[0]));
            }
        });
    });
</script>