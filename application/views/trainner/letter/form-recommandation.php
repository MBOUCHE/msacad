<script src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
<div class="content-wrapper py-3">

    <div class="container-fluid">

        <div class="row">
            <div class="h4 text-center col-sm-12">
                RENSEIGNEMENT LES CHAMPS POUR L'IMPRESSION
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>



        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="form-horizontal" action="<?php base_url('trainner/letter/recommandationLetter') ?>" method="post">
                    <?php if(isset($message)){ ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $message ?>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="idA" id="idA" value="">
                    <input type="hidden" name="mat" id="mat" value="">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label class="input-group-addon" for="nomA">Nom complèt de l'apprenant:</label>
                                <input type="search" class="form-control" name="nomA" id="nomA" placeholder="Nom de l'apprenant" value="<?php echo set_value('nomA') ?>">
                            </div>
                            <?php echo form_error('nomA') ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="" class="input-group-addon">Filière achevée :</label>
                                <select name='lesson' id='lesson' value='' class='form-control'>
                                    <option value="nothing">Veuillez entrer le nom ci-dessus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label class="input-group-addon" for="bp">Boite postale:</label>
                                <input type="text" class="form-control" name="bp" id="bp" placeholder="Boite postale" value="<?php echo set_value('bp') ?>">
                            </div>
                            <?php echo form_error('bp') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <textarea name="destination">
                                <?php echo set_value('destination') ?>
                            </textarea><br>
                        </div>
                        <?php echo form_error('destination') ?>
                    </div>



                    <button type="submit" class="w3-btn w3-round w3-blue" name="send" value="1"><i class="fa fa-print fa-fw"></i> Imprimer</button>

                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<script>

        CKEDITOR.replace('destination');

    $(document).ready(function(){
        alm('collapseLetter', 0);

        $("#nomA").keyup(function(){
            var val = $(this).val();

                var data = 'val='+val;
                $.ajax({
                    type : "POST",
                    url : "<?php echo base_url('trainner/letter/searchVal'); ?>",
                    data : data,
                    success : function(server_response){
                        if(server_response[1]=='{') {
                            var nomA = $("#idA"); var mat = $("#mat");
                            $("#nomA").autocomplete({
                                source: $.parseJSON(server_response),
                                select: function (event, ui) {
                                    var e = ui.item;
                                    nomA.attr('value', e.id);
                                    mat.attr('value', e.number_id);
                                    var data = 'idA='+e.id;
                                    $.ajax({
                                        type : "POST",
                                        url : "<?php echo base_url('trainner/letter/searchLesson'); ?>",
                                        data : data,
                                        success : function(server_response){
                                            $('#lesson').html(server_response);
                                        }

                                    });
                                }
                            });
                        }
                    }

                });
        });
    });
</script>