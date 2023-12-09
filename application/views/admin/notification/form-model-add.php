<script src="<?php echo js_url('ckeditor-full/ckeditor')?>"></script>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo (isset($model))?mb_strtoupper('Modification du model de notification') : mb_strtoupper('Enregistrer un model de notification')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/notification/allModel')?>" class="w3-btn w3-blue w3-round">Tous les models</a>
            </div>

            <div class="offset-2 col-8">
                <?php if(isset($model)){ ?>
                    <form action="<?php echo base_url('admin/notification/modify/'.$model->id)?>" method="post">
                        <h3 for="notif" class="">Votre notification: </h3><br>
                        <textarea name="my_notif"><?php echo $model->content ?>
                <?php }else{ ?>
                    <form action="<?php echo base_url('admin/notification/formAdd')?>" method="post">
                        <h3 for="notif" class="">Entrer votre model: </h3><br>
                        <textarea name="my_notif">
                <?php } ?>
                            </textarea><br>
                            <button type="submit" class="w3-btn w3-blue w3-round" name="send" value="1"><i class="fa fa-save" aria-hidden="true"></i> Enregister</button>
                    </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function(){
            alm('collapseNotif', 1);
            CKEDITOR.replace('my_notif');
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->