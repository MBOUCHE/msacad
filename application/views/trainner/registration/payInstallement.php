<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Veuillez vérifier les informations avant de payer la tranche')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="offset-md-3 col-md-6">

                <form class="form-horizontal" action="<?php echo base_url('trainner/registration/payInstallement') ?>" method="post">
                    <?php if(isset($message)){ ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $message ?>
                        </div>
                    <?php } ?>
                    <div class="input-group">
                        <label for="nom" class="input-group-addon">Nom de l'apprenant</label>
                        <input type="text" name="nom" id="nom" value="<?php echo (isset($user) ?  $user['firstname'] ." ".$user['lastname'] : set_value('Nom')) ?>" class="form-control" autocomplete="off" disabled><br>
                    </div>
                    <?php echo form_error('nom') ?>
                    <br>
                    <div class="input-group">
                        <label for="type" class="input-group-addon">Cours suivie</label>
                        <input type="text" name="type" id="type" value="<?php echo (isset($user) ?  $user['label'] : set_value('Type')) ?>" class="form-control" autocomplete="off" disabled><br>
                    </div>
                    <?php echo form_error('type') ?>
                    <br>
                    <div class="input-group">
                        <label for="type" class="input-group-addon">Frais de la l'enseignement</label>
                        <input type="text" name="type" id="type" value="<?php echo (isset($user) ?  $user['fees'] ." FCFA" : set_value('Type')) ?>" class="form-control" autocomplete="off" disabled><br>
                    </div>
                    <?php echo form_error('type') ?>
                    <br>
                    <div class="input-group">
                        <label for="type" class="input-group-addon">Somme versée</label>
                        <input type="text" name="type" id="type" value="<?php echo (isset($user) ?  $user['installment'] ." FCFA" : set_value('Type')) ?>" class="form-control" autocomplete="off" disabled><br>
                    </div>
                    <?php echo form_error('type') ?>
                    <br>
                    <div class="input-group">
                        <label for="type" class="input-group-addon">Somme restante</label>
                        <input type="text" name="type" id="type" value="<?php echo (isset($user) ?  $user['fees'] - $user['installment'] . " FCFA" : set_value('Type')) ?>" class="form-control" autocomplete="off" disabled><br>
                    </div>
                    <?php echo form_error('type') ?>
                    <br>
                    <div class="input-group">
                        <label for="installemnt" class="input-group-addon">Montant reçu</label>
                        <input type="number" name="installemnt" id="installemnt" value="<?php set_value('installemnt') ?>" class="form-control" autocomplete="off"><br>
                    </div>
                    <?php echo form_error('installemnt') ?><br>
                    <input type="hidden" name="idU" id="idA" value="<?php echo (isset($user) ? $user['userId'] : 0) ?>">
                    <input type="hidden" name="idR" id="mat" value="<?php echo (isset($user) ? $user['regId'] : 0) ?>">
                    <input type="hidden" name="fees" id="mat" value="<?php echo (isset($user) ? $user['fees'] : 0) ?>">
                    <input type="hidden" name="tour" id="mat" value="<?php echo (isset($tour) ? 1 : 2) ?>">
                    <?php
                    if(isset($user)) {
                        echo '<input type="hidden" name="mode" id="mat" value="'.$user['state'].'">';
                        echo '<input type="hidden" name="prom" id="mat" value="'.$user['promotion'].'">';
                    }else{
                        echo '<input type="hidden" name="mode" id="mat" value="">';
                        echo '<input type="hidden" name="prom" id="mat" value="">';
                    }
                    ?>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="w3-btn w3-green" name="send" value="1">Payer</button>
                        </div>
                    </div>
                </form>
            </div><br>

        </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->


    <script type="text/javascript">
        $(document).ready(function(){
            alm('collapseReg');
        });
    </script>