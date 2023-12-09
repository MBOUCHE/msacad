<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('enregistrer un matériel')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <dir class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('material/lyst')?>" class="w3-btn w3-blue w3-round">Tout le matériel</a>
            </div>

            <div class="col-md-6">
                <?php if(isset($message) And $message){ ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo $message ?>
                    </div>
                <?php } ?>
                <form action="<?php base_url("material/save") ?>" method="post" class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="nom" class="input-group-addon">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo set_value('nom') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('nom') ?>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="type" class="input-group-addon">Type</label>
                                <input type="text" name="type" id="type" value="<?php echo set_value('type') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('type') ?>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="emballage" class="input-group-addon">Conditionnement</label>
                                <input type="text" name="emballage" id="emballage" value="<?php echo set_value('emballage') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('emballage') ?>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="hidden" name="transaction" id="transaction" value="ajout" class="form-control" autocomplete="off"><br>
                        </div>
                        <?php echo form_error('transaction') ?>
                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="quantity" class="input-group-addon">Quantité</label>
                                <input type="number" name="quantity" id="quantity" value="<?php echo set_value('quantity') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('quantity') ?>
                        </div>
                    </div><br>

                    <button type="submit" name="send" class="w3-btn w3-blue w3-round"><i class="fa fa-save"></i> Sauvegarder</button>
                </form>
            </div>
        </dir>
    </div>
    <!-- /.container-fluid -->

    <script>
        $(document).ready(function(){
            alm('collapseMat', 2);
        });
    </script>
</div>
<!-- /.content-wrapper -->