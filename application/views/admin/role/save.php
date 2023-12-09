<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Enregistrer un rôle')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <?php if(isset($message) And $message) { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <?php echo $message ?>
                </div>
            <?php } ?>
            <form action="save" method="post" class="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label for="label" class="input-group-addon">Nom</label>
                            <input type="text" name="label" id="label" value="<?php echo set_value('label') ?>" class="form-control" autocomplete="off" placeholder="Entrez le label du rôle..."><br>
                        </div>
                        <?php echo form_error('label') ?>
                    </div>
                </div>


                <button type="submit" name="send" class="btn btn-primary">Sauvegarder</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->