<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php
                $modeText = ($mode=="unshelve")?"Réactivation":"Suspension";
                echo mb_strtoupper("Motif de la $modeText du formateur").'<br><b>'.$name.'</b> ?' ?>
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
                <form action="<?php echo base_url("trainner/manager/motivation") ?>" method="post" class="">
                    <div class="form-group">
                        <label for="motivation">Motif:</label>
                        <textarea class="form-control" value="<?php echo set_value('motivation') ?>" rows="3" name="motivation" id="motivation"></textarea>
                        <?php echo form_error('motivation') ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode) ? $mode : 0 ; ?>" class="form-control" autocomplete="off"><br>
                                <input type="hidden" name="idUr" id="idUr" value="<?php echo isset($idUr) ? $idUr : 0; ?>" class="form-control" autocomplete="off">
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

<script>
    $(document).ready(function() {
        alm('collapseGerant');
    });
</script>