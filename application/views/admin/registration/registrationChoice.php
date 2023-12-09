<div class="content-wrapper py-3" >
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Nouvelle inscription')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('registration')?>" class="w3-btn w3-blue w3-round">Toutes les inscriptions</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('admin/student/formAdd') ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12"><i class="fa fa-1x fa-user-plus"></i>   Nouvel apprenant</a>
                    </div>
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('admin/registration/registerToLessons') ?>" class="btn w3-btn w3-blue btn-primary btn-lg col-sm-12 w3-margin-top"><i class="fa fa-1x fa-save"></i>   Choisir un apprenant</a>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        alm('collapseReg', 1);
    })
</script>