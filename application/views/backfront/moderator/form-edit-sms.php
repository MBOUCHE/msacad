<div id="content">
    <div class="inner" style="min-height: 700px;">

        <div class="content-wrapper py-3">

            <div class="container-fluid"><br>

                <div class="row">
                    <div class="h4 text-center col-sm-12">
                        <?php echo mb_strtoupper('Modifier une Message'); ?>
                        <hr width="60%" style="margin: auto; margin-top: 10px">
                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form class="form-horizontal" action="" method="post">
                            <?php if(isset($message)){ ?>
                                <div class="alert <?php echo $message['class']; ?>">
                                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <?php echo $message['msg'] ?>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-sm-12">

                                    <label for="contenu" class="w3-text">Message:</label>
                                    <textarea name="contenu" id="contenu">
                                        <?php echo (set_value('contenu'))?set_value('contenu'):$sms->content ?>
                                    </textarea><br>
                                </div>
                                <?php echo form_error('contenu') ?>
                            </div>

                            <button type="submit" class="w3-btn w3-round w3-blue publier" name="send" value="1"><i class="fa fa-share-alt fa-fw"></i> Mettre à jour</button>

                        </form>

                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </div>
    <script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
    <script>
        CKEDITOR.replace('contenu');
        $(document).ready(function(){
            leftM(0, '#panel-msg');
        });
    </script>
</div>
<!-- /.content-wrapper -->