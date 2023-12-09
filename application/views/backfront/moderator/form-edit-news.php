<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Modifier une nouvelle') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-padding-large">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/news') ?>">Toutes les nouvelles </a>
                        </div>
                    </div>

                    <form class="w3-container" method="post" action="" enctype="multipart/form-data">
                        <?php if(isset($message)){ ?>
                            <div class="w3-row">
                                <div class="col-md-11">
                                    <div class="alert <?php echo $message['class']; ?>">
                                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <?php echo $message['msg'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="w3-row">
                            <div class="col-md-11">
                                <div class="w3-row">
                                    <div class="input-group w3-margin-bottom">
                                        <label class="input-group-addon">Titre:</label>
                                        <input class="form-control" type="text" name="titre" value="<?php echo set_value('titre') ?>" placeholder="Pas obligatoire">
                                    </div>
                                    <?php echo form_error('titre') ?>
                                </div>
                                <div class="w3-row">
                                    <div id="content_image" class="col-xs-6 w3-responsive w3-centre <?php echo set_value('image')?'':'w3-hide' ?>" style="max-width: 450px;">
                                        <i class="fa fa-close close w3-text-red" aria-hidden="true" title="Annuler"></i>
                                        <img style="" id="photo" src="<?php echo base_url(set_value('image')) ?>" class="w3-hover-opacity w3-image w3-round" alt="Photo"  height="150" title="Cliquer pour changer" onclick='$("input[type=\"file\"]").trigger("click")'>
                                        <input type="hidden" name="has_change" value="0">
                                    </div>
                                    <div class="input-group w3-margin-bottom" style="width: 100%">
                                        <input class="form-control filestyle float-right" type="file" name="image" data-buttonBefore="true" data-buttonText="Image" data-icon="true" data-iconName="fa fa-photo">
                                    </div>
                                </div>
                                <div class="input-group w3-margin-bottom">
                                    <label class="input-group-addon">Contenu</label>
                                    <textarea class="form-control"  name="text"><?php echo set_value('text') ?></textarea>
                                </div>
                                <?php echo form_error('text') ?>
                            </div>
                        </div>

                        <div class="w3-row">
                            <div class="col-md-11">
                                <div class="w3-left custom-checkbox">
                                    <input type="checkbox" name="show_in_slide" class="checkbox w3-show-inline-block" <?php echo (set_value('image'))?'checked':'' ?>> Afficher dans le slide
                                </div>
                                <button class="w3-btn w3-blue w3-right">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo js_url('ckeditor-full/ckeditor') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('text');

    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';

        } ?>

        leftM(1, '#panel-news');

        $('input[name="show_in_slide"]').on('click', function(){
            var slide = <?php echo set_value('image')? 1:0 ?>;
            if(!$('input[type="file"]').val() && slide==0)
                $(this).prop('checked', false);
        });

        $('input[type="file"]').on('change', function(){
            var files = $(this)[0].files;
            if (files.length > 0) {
                $("#photo").prop('src', window.URL.createObjectURL(files[0]));
                $('#content_image').removeClass('w3-hide');
                $('input[name="has_change"]').val(1);
            }
        });

        $('#content_image .close').on('click', function(){
            $('input[name="has_change"]').val(1);
            $('#content_image').addClass('w3-hide');
            $('input[type="file"]').parent().find('input').each(function(){
                $(this).val('');
            });
        });
    })
</script>
<!--END PAGE CONTENT -->