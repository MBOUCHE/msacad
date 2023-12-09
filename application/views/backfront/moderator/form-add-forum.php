<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper(trim(set_value('title'))) ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-padding-large">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/forums') ?>">Liste des forums</a>
                        </div>
                    </div>

                    <form class="w3-container" method="post" action="">
                        <div class="w3-row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="input-group w3-margin-bottom">
                                    <label class="input-group-addon">Nom du forum</label>
                                    <input class="form-control" type="text" name="forum" value="<?php echo set_value('forum') ?>">
                                </div>
                                <?php echo form_error('forum') ?>
                            </div>
                        </div>

                        <div class="w3-row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <button class="w3-btn w3-blue w3-right">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>

        leftM(1, '#panel-forum');
    })
</script>
<!--END PAGE CONTENT -->