<script src="<?php echo js_url('ckeditor/ckeditor')?>"></script>

<div class="content-wrapper py-3">



    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 offset-md-3 col-md-6" style="min-height: 500px">

                <div class="h4 text-center">

                    <?php echo mb_strtoupper('Editer une fiche de suivi')?>

                    <hr width="60%" style="margin: auto; margin-top: 10px">

                    <br>

                </div>

                <div class="h6 text-center">

                    <?php echo mb_strtoupper($lesson)?><br>

                    <?php echo mb_strtoupper($period)?>

                    <hr width="60%" style="margin: auto; margin-top: 10px">

                    <br>

                </div>

                <br><br>

                <?php

                if(isset($status) and $status==true)

                {

                    ?>

                    <div class="alert alert-success" role="alert">

                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                        <?php echo "<i class='fa fa-chevron-circle-left fa-2x w3-text-green'></i> ".$message ?>

                    </div>

                    <?php

                } else

                {

                    if (isset($message))

                    {

                        ?>

                        <div class="alert alert-danger" role="alert">

                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                            <?php echo "<i class='fa fa-2x fa-ban'></i>  ".$message ?>

                        </div>

                        <?php

                    }

                }





                ?>

                <form action="<?php echo base_url('trainner/trainer/edit') ?>" method="post" class="">

                    <div class="row">

                        <?php if (!empty($trainers)){?>

                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class="input-group">

                                <label for="trainer" class="input-group-addon"> Formateurs </label>

                                    <select id="ulist" class="form-control">

                                    <?php

                                        foreach ($trainers as $tr)

                                        {

                                    ?>

                                        <option value="<?php echo $tr->id ?>" contenteditable="true"><?php echo $tr->lastname.' '.$tr->firstname?></option>

                                    <?php

                                        }

                                    ?>

                                    </select>

                                

                            </div>

                            <?php echo form_error('trainer') ?>

                        </div>

                        <input type="hidden" name="trainer" id="trainer" value="" />

                        <input type="hidden" name="session" id="session" value="<?php echo $session ?>" />

                        <br><br>

                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class="input-group">

                                <label for="content" class="input-group-addon"> Contenu </label>

                                <textarea id="content" name="content"><?php set_value('content') ?></textarea>

                            </div>

                            <?php echo form_error('content') ?>

                        </div>

                        



                    </div>

                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-1x fa-fw fa-check-circle"></i> Remplir</button>

                    <?php } else if (empty($trainers)) { ?>

                        <p class="h5 w3-text-red">Aucun formateur disponible.</p>

                        <?php } ?>



                </form>

            </div>

        </div>





    </div>



</div>





<a class="scroll-to-top rounded" href="#page-top">

    <i class="fa fa-chevron-up"></i>

</a>



<script type="text/javascript">

    $(document).ready(function(){

        alm('collapseMod',1);

        CKEDITOR.replace('content');

        var users=[];

        <?php

        if (!empty($trainers))

        foreach ($trainers as $u)

        {

        ?>

        users.push({id: <?php echo $u->id ?>,  name: "<?php echo $u->lastname.' '.$u->firstname?>"});

        <?php

        }

        ?>





        $('#ulist').editableSelect().on('select.editable-select', function (e, li) {

            for (var i = 0, len = users.length; i < len; i++) {

                if (users[i].id===li.val())

                {

                    $('#trainer').prop('value', users[i].id);

                    i=len;

                }



            }



        });



    });

</script>