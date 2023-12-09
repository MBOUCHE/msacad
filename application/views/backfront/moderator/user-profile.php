<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <br>
                <h4>Profil de l'utilisateur </h4>
                <hr width="100%" style="margin-top: 10px">

                <div class="col-md-4 w3-center">
                    <h5>Photo de profil</h5>

                    <form class="text-center" style="width: 100%" action="<?php echo base_url('moderatorGate/home/profil') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <?php if(isset($message)){ ?>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <?php echo $message ?>
                            </div>
                        <?php } ?>
                        <div class="col-xs-12">
                            <i class="fa fa-close w3-text-red close w3-hide" aria-hidden="true" title="Annuler"></i>
                            <img style="" id="photo" src="<?php echo base_url($user->avatar) ?>" class="w3-hover-opacity w3-image w3-round" alt="Photo"  height="150" >
                        </div><br><br>
                    </form>
                </div>
                <div class="col-md-8">
                    <h2>Informations personnelles</h2>
                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Matricule :</td>
                                <td><b><?php echo $user->number_id ?></b></td>
                            </tr>
                            <tr>
                                <td>Nom complet:</td>
                                <td><b><?php echo strtoupper($user->firstname).' '.ucfirst($user->lastname) ?></b></td>
                            </tr>
                            <tr>
                                <td>Né(e) le</td>
                                <td><b><?php echo $dateBirth = date_format($dateBirth, 'd').'/'.date_format($dateBirth, 'm').'/'.
                                            date_format($dateBirth, 'Y') ?></b> à <b><?php echo $user->birth_place ?></b></td>
                            </tr>

                            <tr>
                            <tr>
                                <td>Pays d'origine</td>
                                <td><b><?php echo $user->nationality ?></b></td>
                            </tr>
                            <tr>
                                <td>Téléphone</td>
                                <td><b><?php echo $user->phone ?></b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><b><?php echo $user->mail ?></b></td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td><b><?php echo $user->address ?></td>
                            </tr>
                            <tr>
                                <td><?php echo mb_strtoupper("é").'tablissemnt' ?></td>
                                <td><b><?php echo (empty($user->school) ? 'Non renseigné' : $user->school )  ?></td>
                            </tr>
                            <tr>
                                <td>Filière</td>
                                <td><b><?php echo (empty($user->school_area) ? 'Non renseignée' : $user->school_area ) ?></td>
                            </tr>
                            <tr>
                                <td>Niveau</td>
                                <td><b><?php echo (empty($user->school_level) ? 'Non renseigné' : $user->school_level ) ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<style>
    .close{
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>
<script>
    /*$(document).ready(function(){
        var imgUrl = $('img#photo').prop('src');

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

        $('img#photo').on('click', function(){
            $('input[type="file"]').trigger('click');
        });
    });*/
</script>