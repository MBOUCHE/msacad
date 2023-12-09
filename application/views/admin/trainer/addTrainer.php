<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Ajout d\'un formateur')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainer/lyst')?>" class="w3-btn w3-blue w3-round">Tous les formateurs</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12">
                    <a href="<?php echo base_url("admin/trainer/formAdd") ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12"><i class="fa fa-1x fa-user-plus"></i>   Nouveau formateur</a>
                </div>
                <div class="col-sm-12">
                    <a href="<?php echo base_url("admin/trainer/allocation") ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12 w3-margin-top"><i class="fa fa-1x fa-save"></i>   Utilisateur existant</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        alm('collapseForm',2);

    });
</script>