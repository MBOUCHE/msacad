<div class="content-wrapper py-3" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6"  style="">
                <div class="h4 text-center  col-sm-12">
                    <?php echo mb_strtoupper('Nouveau gérant')?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('admin/manager/formAdd') ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12"><i class="fa fa-1x fa-user-plus"></i>   Nouveau gérant</a>
                    </div>
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('admin/manager/regManager') ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12 w3-margin-top"><i class="fa fa-1x fa-save"></i>   Utilisateur existant</a>
                    </div>
                    <br><br>
                </div>
                <button class="btn w3-btn w3-blue btn-primary w3-left" onclick="window.location.href='<?php echo base_url('registration/registrationList/') ?>'"><i class="fa fa-fw fa-arrow-circle-left"></i>  Retour</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        alm('collapseGerant', 1);
    });
</script>
