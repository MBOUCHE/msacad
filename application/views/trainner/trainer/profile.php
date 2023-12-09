<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Profil PROFESSIONNEL du formateur')?>
                <br> <b><?php echo strtoupper($trainer->lastname).' '.ucfirst($trainer->firstname) ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="row col-md-12 float-right">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <a href="<?php echo base_url("trainner/trainer/profile").'/'.$trainer->user.'/print' ?>" type="button" class="w3-btn w3-blue w3-round btn-block"><h4><i class="fa fa-id-card-o"></i> Imprimer le profil</h4></a>
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
                    //var_dump($trainer); die(0);
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


                    <form class="text-center" action="<?php echo base_url('trainner/trainer/profile').'/'.$trainer->user ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                            <img style="" id="photo" src="<?php echo isset($imgName) ? upload_url('images/'.$imgName) : base_url().$trainer->photo ?>" class="img-rounded" alt="Photo" width="200" height="150"><br><br>

                        <input style="cursor: pointer" type="file" class="filestyle float-right" data-buttonBefore="true" name="avatar" data-buttonText="Changer" data-icon="true" data-iconName="glyphicon glyphicon-inbox"><br>
                        <button name="send" type="submit" class="w3-btn w3-blue w3-round float-right"><i class="fa fa-upload" aria-hidden="true"></i> OK</button>
                    </form>
                </div>


                    <div class="col-md-8">
                        <div>
                            <p href="#">
                                Matricule : <b><?php echo $trainer->number_id ?></b><br>
                                Nom complèt : <b><?php echo strtoupper($trainer->lastname).' '.ucfirst($trainer->firstname) ?></b><br>
                                Née le <b><?php echo $dateBirth = date_format($dateReg, 'd').'/'.date_format($dateReg, 'm').'/'.
                                        date_format($dateReg, 'Y') ?></b> à <b><?php echo $trainer->birth_place ?></b><br>
                                Pays d'origine : <b><?php echo $trainer->nationality ?></b><br>
                                Téléphone : <b><?php echo $trainer->phone ?></b> <br>
                                Email : <b><?php echo $trainer->mail ?></b><br>
                                Adresse : <b><?php echo $trainer->address ?></b><br>
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
                                Login : <b><?php echo $trainer->mail .' | '. $trainer->number_id ?></b><br>
                                Mot de passe : <b>******** </b><br>
                                Date d'enregistrement : <b><?php echo $dateReg = ''.date_format($dateReg, 'd'). '-'.date_format($dateReg, 'm').'-'.date_format($dateReg, 'Y'); ?></b><br>
                                Derniere connexion : <b><?php  echo ($trainer->last_connexion!=null)?moment($trainer->last_connexion)->fromNow()->getRelative():"Jamais"; ?></b><br>
                            </p>

                        </div>
                    </div>
                <br>
            </div>
            <div class="col-sm-8  col-md-4">
                <div class="h5 font-weight-bold">Enseignement(s) dispensé(s)</div>
                <hr width="700">
            </div>
            <div class="row col-md-12">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div>
                            <ul>
                                <?php

                                    if(isset($lesson) and is_array($lesson) and ($lesson[0]->label)){
                                        //var_dump($lesson); die(0);
                                        for($i = 0; $i < count($lesson); $i++){
                                            echo "
                                                <li>
                                                <b>".$lesson[$i]->label."(".$lesson[$i]->code.")</b>
                                                <ul>
                                                    <li>Durée : <b>".$lesson[$i]->duration."h</b></li>
                                                    <li>Type : <b>".ucfirst($lesson[$i]->type)."</b></li>
                                                </ul>
                                                </li>
                                            ";
                                        }
                                    }
                                else{
                                    ?>
                                    <li>Aucun enseignement alloué!</li>
                                    <?php
                                }
                                ?>
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
                                <img src="<?php echo isset($imgName) ? upload_url('img/'.$imgName) : base_url().$trainer->photo ?>" width="50" height="50">
                                <h5 style="text-align: center;" class="modal-title">Choisissez la vague à bloquer pour l'apprenant <br> <b><?php echo strtoupper($trainer->lastname).' '.ucfirst($trainer->firstname) ?></b></h5>
                            </div>
                            <div class="modal-body">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nom de le lesson suivie</th>
                                        <th>Type de la lesson</th>
                                        <th>Frais de la lesson</th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($promotion) And is_array($promotion) and !empty($promotion))
                                    {
                                        //var_dump(count($promotion));
                                        //var_dump($promotion);
                                        $k = 0;
                                        //var_dump($promotion);
                                        for($i = 1; $i <= count($promotion); $i++)
                                        {

                                            echo '<tr><td class="text-center text-white">' . ++$k . '</td>';
                                            echo '<td>' . $promotion[$i-1]->code . '</td>';
                                            echo '<td>' . strtoupper($promotion[$i-1]->Ltype) . '</td>';
                                            echo '<td>' . $promotion[$i-1]->lFees .' FCFA</td>';
                                            echo '<td>
                                    <a href="'.base_url('student/profile').'/'.$promotion[$i-1]->id.'" data-toggle="tooltip" data-title="Profil"><i class="fa fa-fw fa-lock text-info" aria-hidden="true"></i></a>


                                    <a href="'.base_url('student/log').'/'.$promotion[$i-1]->id.'"><i class="fa fa-fw fa-unlock text-info red-tooltip" aria-hidden="true" style="cursor: pointer;" data-toggle="tooltip" data-title="Log"></i></td></tr></a>;

                                    </td></tr>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="10"  class="h3 text-center text-warning">'. strtoupper($trainer->lastname).' '.ucfirst($trainer->firstname) .' n\'est dans aucune vague ...<td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
    $(document).ready(function () {

        alm('collapseForm');
        $('input[type="file"]').on('change', function(){
            var files = $(this)[0].files;
            if (files.length > 0) {
                $("#photo").attr('src', window.URL.createObjectURL(files[0]));
            }
        });
    });

</script>