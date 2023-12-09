<script src="<?php echo js_url('ckeditor/ckeditor')?>"></script>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('ENREGISTRER UN ENSEIGNEMENT') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/lesson/all')?>" class="w3-btn w3-blue w3-round">Tous les enseignements</a>
            </div>
            <div class="col-sm-12 col-md-6">
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
                <form action="<?php echo base_url("trainner/lesson/formAdd") ?>" method="post" class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="code" class="input-group-addon">Code</label>
                                <input type="text" name="code" value="<?php echo set_value('code') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('code') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="" class="input-group-addon">Type</label>
                                <select name="type" id="" value="<?php echo set_value('type') ?>" class="form-control">
                                    <option value="cours">Cours</option>
                                    <option value="filière">Filière</option>
                                    <option value="promotion">Promotion</option>
                                </select>
                            </div>
                            <?php echo form_error('type') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">

                                <label for="lessonTop" class="input-group-addon">Top</label>
                                <input type="number" name="top" id="lessonTop" value="<?php echo set_value('top') ?>" class="form-control" autocomplete="off" min="1" max="3"><br>
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
                                <input type="text" name="nom" value="<?php echo set_value('nom') ?>" class="form-control" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('nom') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="dure" class="input-group-addon">Durée</label>
                                <input type="number" name="dure" value="<?php echo set_value('dure') ?>" class="form-control"><br>
                            </div>
                            <?php echo form_error('dure') ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <label for="fees" class="input-group-addon">Frais</label>
                                <input type="number" name="fees" value="<?php echo set_value('fees') ?>" class="form-control"><br>
                            </div>
                            <?php echo form_error('fees') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="desc">Syllabus</label>
                            <textarea name="syllabus" id="desc"><?php echo set_value('syllabus') ?></textarea>
                        </div>
                    </div>

                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-save fa-fw"></i> Sauvegarder</button>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    <script>
        $(document).ready(function(){
            alm('collapseEns', 1);
            CKEDITOR.replace('syllabus');
        });
    </script>
</div>
<!-- /.content-wrapper -->