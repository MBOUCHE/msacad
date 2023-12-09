<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper(explode(' ', $titre)[0].' des infos flash') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-padding-large">
                    <form class="w3-container" method="post">
                        <div class="w3-row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="input-group w3-margin-bottom">
                                    <label class="input-group-addon">Contenue de l'info flash: </label>
                                    <textarea class="form-control" name="flash_content">
                                        <?php echo set_value('flash_content') ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <?php echo form_error('flash_content') ?>

                        <div class="w3-row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <button class="w3-btn w3-blue w3-right">Enregister</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('flash_content');
    $(document).ready(function(){
        leftM(1, '#panel-flash');
    })
</script>
<!--END PAGE CONTENT -->