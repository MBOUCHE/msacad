<div id="content">
    <div class="inner" style="min-height: 700px;">

        <div class="content-wrapper py-3">

            <div class="container-fluid"><br>

                <div class="row">
                    <div class="h4 text-center col-sm-12">
                        SAISISSEZ VOTRE MESSAGE
                        <hr width="60%" style="margin: auto; margin-top: 10px">
                    </div>
                </div>
                <br><br>



                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form class="form-horizontal" action="<?php base_url('trainerGate/home/formNotifAdd') ?>" method="post">
                            <?php if(isset($message)){ ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <?php echo $message ?>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="idA" id="idA" value="">
                            <input type="hidden" name="mat" id="mat" value="">
                            <input type="hidden" name="code" id="mat" value="">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="input-group">
                                        <label for="pub_vague" class="input-group-addon">Vague</label>
                                        <select class="form-control custom-select" name="pub_vague" id="vague">
                                            <option delete selected value="" disabled>Choisissez une vague...</option>
                                            <?php foreach($vague as $value){ ?>
                                                <option class="vague" value="<?php echo $value->promo_id ?>"><?php echo strtoupper($value->code) ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                    <?php echo form_error('pub_vague') ?>
                                    <br>

                                    <div>Saisissez votre message ici</div>
                            <textarea name="destination">
                                <?php echo set_value('destination') ?>
                            </textarea><br>
                                </div>
                                <?php echo form_error('destination') ?>
                            </div>

                            <button type="submit" class="w3-btn w3-round w3-blue publier" name="send" value="1"><i class="fa fa-share-alt fa-fw"></i> Publier</button>

                        </form>

                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>

    </div>
</div>





<!-- /.content-wrapper -->
<script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
<script>

    CKEDITOR.replace('destination');

    $(document).ready(function(){
        leftM(1, '#panel-notification');
    });
</script>