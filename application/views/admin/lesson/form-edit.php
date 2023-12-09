<script src="<?php echo js_url('ckeditor/ckeditor')?>"></script>

<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('MODIFIER L\'enseignement') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <?php
                //var_dump($req);
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
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="code" class="input-group-addon">Code</label>
                                <input id="code" type="text" name="code" value="<?php echo (isset($req[0]->code) ?  $req[0]->code : set_value('code')) ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('code') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="lessonType" class="input-group-addon">Type</label>
                                <select name="type" id="lessonType" data-value="<?php echo (isset($req[0]->type) ?  $req[0]->type : set_value('type')) ?>" class="form-control">
                                    <option value="cours">Cours</option>
                                    <option value="filière">Filière</option>
                                    <option value="promotion">Promotion</option>
                                </select>
                                <script>
                                    $(document).ready(function(){
                                        $("#lessonType").val($('#lessonType').attr('data-value'));
                                    });
                                </script>
                            </div>
                            <?php echo form_error('type') ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="lessonTop" class="input-group-addon">Top</label>
                                <input type="number" name="top" id="lessonTop" value="<?php echo (isset($req[0]->top) ?  $req[0]->top : set_value('top')) ?>" class="form-control" autocomplete="off" min="1" max="3"><br>
                                    <span> 1:Elevé</span> -
                                    <span> 2:Moyen</span> -
                                    <span> 3:Normal</span>
                            </div>
                            <?php echo form_error('top') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="nom" class="input-group-addon">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo (isset($req[0]->label) ?  $req[0]->label : set_value('nom')) ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('nom') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="dure" class="input-group-addon">Durée</label>
                                <input type="number" name="dure"  id="dure" value="<?php echo (isset($req[0]->duration) ?  $req[0]->duration : set_value('dure')) ?>" class="form-control"><br>
                            </div>
                            <?php echo form_error('dure') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="fees" class="input-group-addon">Frais</label>
                                <input type="number" name="fees" id="fees" value="<?php echo (isset($req[0]->fees) ?  $req[0]->fees : set_value('fees')) ?>" class="form-control"><br>
                            </div>
                            <?php echo form_error('fees') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="desc">Syllabus</label>
                            <textarea name="syllabus" id="desc"><?php echo (isset($req[0]->syllabus) ?  $req[0]->syllabus : set_value('syllabus')) ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="idft" id="idft" value="<?php echo isset($req[0]->id) ? $req[0]->id : 0 ; ?>" class="form-control" autocomplete="off">
                    <input type="hidden" name="idfT" id="idfT" value="<?php echo isset($req[0]->idT) ? $req[0]->idT : 0 ; ?>" class="form-control">

                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-pencil fa-fw"></i> Modifier</button>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('syllabus');
        alm('collapseEns');
    });
</script>
<!-- /.content-wrapper -->