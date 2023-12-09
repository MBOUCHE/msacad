
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <div class="h4 text-center">VALIDATION DE L'INSCRIPTION</div>
                <hr>
                <br><br>
                <form action="getRegInfos" method="post"  class="w3-round w3-card-2" style="padding: 20px !important;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="code" class="input-group-addon"> Code d'inscription de l'apprenant </label>
                                <input type="text" class="form-control" name="code" value="<?php echo form_error('installment') ?>" id="code" />
                            </div>
                            <?php echo form_error('code') ?>
                        </div>
                    </div>
                    <br>

                    <button type="submit" name="send_vreg" class="btn w3-btn w3-blue btn-primary"><i class="fa fa-arrow-circle-right fa-fw"></i> Suivant</button>
                    <hr>
                    <a href="<?php echo base_url('admin/registration/qrValidation/')?>" type="button" id="qrVal" class="btn w3-btn w3-blue btn-primary w3-center"><i class="fa fa-check-circle fa-fw"></i> Valider le code QR</a>
                </form>
            </div>
        </div>
    </div>
</div>


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>

<script type="text/javascript">
    $(document).ready(function(){
            alm('collapseReg',2);

        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
        (function(){
            <?php
            if(isset($message)) {
            ?>
            alertify.defaults.theme.ok = "btn w3-red";
            alertify.defaults.glossary.ok = "OK";
            alertify
                .alert("<span class='w3-text-red'><i class='w3-text-red fa fa-fw fa-ban'></i>  Erreur</span>", "<?php echo $message ?>", function(){
                    alertify.error('Echec');
                });
            <?php
            }
            ?>
        })();

        $('#qrVal').on('click', function(){
            /*alertify.confirm("Validation du Code QR", "This is a confirm dialog.",
                function(){
                    alertify.success('Ok');
                },
                function(){
                    alertify.error('Cancel');
                });*/
            window.location.href="";
        });
    });
</script>
