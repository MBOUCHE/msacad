<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                RETIRER UN MAT&Eacute;RIEL
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <?php if(isset($message) And $message){ ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo $message ?>
                    </div>
                <?php } ?>
                <form action="<?php echo isset($req[0]->id) ?(base_url("material/save") ."/".  $req[0]->id) ."/remove" : base_url("admin/material/save/0") ?>" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="nom" class="input-group-addon">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo (isset($req[0]->name) ?  $req[0]->name : set_value('Nom')) ?>" class="form-control" autocomplete="off" disabled><br>
                            </div>
                            <?php echo form_error('nom') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="type" class="input-group-addon">Type</label>
                                <input type="text" name="type" id="type" value="<?php echo (isset($req[0]->type) ?  $req[0]->type : set_value('Type')) ?>" class="form-control" autocomplete="off" disabled><br>
                            </div>
                            <?php echo form_error('type') ?>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="emballage" class="input-group-addon">Conditionnement</label>
                                <input type="text" name="emballage" id="emballage" value="<?php echo (isset($req[0]->packaging) ?  $req[0]->packaging : set_value('Conditionnement')) ?>" class="form-control" autocomplete="off" disabled><br>
                            </div>
                            <?php echo form_error('emballage') ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="hidden" name="transaction" id="transaction" value="retrait" class="form-control" autocomplete="off"><br>
                        </div>
                        <?php echo form_error('transaction') ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="quantity" class="input-group-addon">Quantité</label>
                                <input type="text" name="quantity" id="quantity" value="<?php echo set_value('quantity') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('quantity') ?>
                        </div>
                    </div><br>

                    <button type="submit" name="send" class="w3-btn w3-round w3-blue">Retirer</button>
                </form>

            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->