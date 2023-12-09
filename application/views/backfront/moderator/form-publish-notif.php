<div id="content">
    <div class="inner" style="min-height: 700px;">

        <div class="content-wrapper py-3">

            <div class="container-fluid"><br>

                <div class="row">
                    <div class="h4 text-center col-sm-12">
                        <?php echo mb_strtoupper('Publier une notification'); ?>
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

                                    <P>Entrer le nom ou le matricule.</P>
                                    <div class="input-group">
                                        <label for="target" class="input-group-addon">Publié à:</label>
                                        <input type="text" id="target" class="form-control">
                                        <input type="hidden" name="target" value="<?php echo set_value('target') ?>">
                                    </div>
                                    <?php echo form_error('target') ?>
                                    <br>

                                    <span class="w3-text">Votre publication:</span>
                                    <textarea name="publication">
                                        <?php echo set_value('publication') ?>
                                    </textarea><br>
                                </div>
                                <?php echo form_error('publication') ?>
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
    <script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
    <script>
        CKEDITOR.replace('publication');

        $(document).ready(function(){

            leftM(1, '#panel-notification');

            var source = [];
            $.each(<?php echo json_encode($users); ?>, function(key, value){
                source[source.length] = {
                    id: value.id,
                    label: value.firstname+' '+value.lastname+ "<span class='w3-right w3-small w3-margin-left'>" + 'matricule: <b>'+value.number_id+'</b>' + "</span>",
                    value: value.firstname+' '+value.lastname
                }
            });

            $("#target").autocomplete({
                source: source,
                autoFocus:true,
                select: function (event, ui) {
                    $('input[name="target"]').val(ui.item.id);
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<p>" + item.label +"</p>")
                    .appendTo(ul);
            };
        });
    </script>
</div>
<!-- /.content-wrapper -->