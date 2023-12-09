<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                MODIFIER UN MAT&Eacute;RIEL
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <?php if(isset($message) And $message) { ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo $message ?>
                    </div>
                <?php } ?>
                <form action="<?php echo base_url("material/update") ?>" method="post" class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="nom" class="input-group-addon">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo (isset($req[0]->name) ?  $req[0]->name : set_value('Nom')) ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('nom') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="type" class="input-group-addon">Type</label>
                                <input type="text" name="type" id="type" value="<?php echo (isset($req[0]->type) ?  $req[0]->type : set_value('Type')) ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('type') ?>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="emballage" class="input-group-addon">Conditionnement</label>
                                <input type="text" name="emballage" id="emballage" value="<?php echo (isset($req[0]->packaging) ?  $req[0]->packaging : set_value('Conditionnement')) ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('emballage') ?>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label for="motivation">Motif:</label>
                        <textarea class="form-control" value="<?php echo set_value('motivation') ?>" rows="3" name="motivation" id="motivation"></textarea>
                        <?php echo form_error('motivation') ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="hidden" name="idft" id="idft" value="<?php echo isset($req[0]->id) ? $req[0]->id : 0 ; ?>" class="form-control" autocomplete="off"><br>
                                <input type="hidden" name="idfT" id="idfT" value="<?php echo isset($idfT) ? $idfT : 0; ?>" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>


                    <button type="submit" name="send" class="w3-btn w3-blue w3-round">Sauvegarder</button>
                </form>

            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->