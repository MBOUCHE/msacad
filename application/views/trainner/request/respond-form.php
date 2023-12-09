<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Traitement d\'une REquête académique') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">

            <div class="col-lg-2">

            </div>
            <div class="col-sm-8 table-responsive">

                <div class="col-sm-12 col-md-3 w3-margin-bottom">
                    <a href="<?php echo base_url('trainner/request/')?>" class="w3-btn w3-blue w3-round btn-sm">Toutes les requêtes</a>
                </div>
                <div class="col-sm-12">
                    Requête de <b><?php echo mb_strtoupper($request->lastname)." ".$request->firstname ?></b><br>
                    Envoyée le <b><?php echo moment($request->save_date)->format('d M Y') ?></b><br>
                    Objet : <b><?php echo mb_strtoupper($request->subject); ?></b><br>
                    Contenu :
                    <div class="text-justify alert alert-warning">
                        <?php echo $request->content ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <?php
                    if(isset($info) And is_array($info))
                    {
                        ?>
                        <div class="<?php echo $info['class'] ?>">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $info['sms'] ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form action="" method="post" class="">

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="contenu">Réponse</label>
                                <textarea name="contenu" id="contenu"><?php echo set_value('contenu') ?></textarea>
                            </div>
                            <?php echo form_error('response') ?>
                        </div>

                        <button type="submit" name="send" class="w3-btn w3-round w3-blue">
                            <i class="fa fa-save fa-fw"></i> Sauvegarder
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script src="<?php echo js_url('ckeditor/ckeditor')?>"></script>
    <script>
        $(document).ready(function(){

            CKEDITOR.replace('contenu');
            alm('collapseRequete', 0);
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->
