<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('modifier des catégories') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-padding-large">
                    <form class="w3-container" method="post" id="categorieF">
                        <div class="w3-row">
                            <P>Enter les différentes catégories séparées par des points virgules (;)</P>
                            <P>Ex: Catégorie 1; Catégorie 2; Catégorie 3; ...</P>
                        </div>
                        <div class="w3-row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="input-group w3-margin-bottom">
                                    <label class="input-group-addon">Catégorie: </label>
                                    <input class="form-control" type="text" name="category" value="<?php echo set_value('category') ?>">
                                </div>
                            </div>
                        </div>
                        <?php echo form_error('category') .'<br>'.$error ?>

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
<!--END PAGE CONTENT -->