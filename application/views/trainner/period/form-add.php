<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Enregistrer les périodes')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/period')?>" class="w3-btn w3-blue w3-round">Toutes les périodes</a>
            </div>

            <div class="col-md-6">
                <form class="form-horizontal" action="<?php echo base_url('trainner/period/formAdd') ?>" method="post">

                    <div class="col-sm-6">
                        <div class="input-group">
                            <label class="input-group-addon" for="start">Debut de la periode:</label>
                            <input type="number" name="start" id="start" placeholder="Entrer le debut" autocomplete="off">
                        </div>
                        <?php echo form_error('start') ?>
                    </div>
                    <br>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <label class="input-group-addon" for="end">Fin de la periode:</label>
                            <input type="number" name="end" id="end" placeholder="Entrer la fin ">
                        </div>
                        <?php echo form_error('end') ?>
                    </div>
                    <br>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="send" class="w3-btn w3-blue w3-round"><i class="fa fa-save"></i> Sauvegarder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>
        $(document).ready(function() {
            alm('collapsePeriode', 1);
        });
    </script>
</div>
<!-- /.content-wrapper -->