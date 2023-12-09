<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Inscription : <br>Choix de l\'enseignement')?>
                <?php if (isset($user)){ ?>
                    <br>
                    <div class="h5 text-center">Inscrire <b><?php echo mb_strtoupper($user['lastname']).ucwords(mb_strtolower(' '.$user['firstname'])) ?></b> à un enseignement</div>
                <?php } ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/registration/addRegistration')?>" class="w3-btn w3-blue w3-round">Ajouter une inscription</a>
            </div>
            <div class="col-sm-12 col-md-6" style="min-height: 500px">
                <?php
                //var_dump($allLess); die();
                if(isset($status) and $status==1)
                {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo "<i class='fa fa-chevron-circle-left fa-2x w3-text-green'></i> ".$message ?>
                    </div>
                    <?php
                } else
                {
                    if(isset($message))
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
                <form action="<?php echo base_url('admin/registration/registerToLessons')?>" method="post" class="">

                    <?php
                    if(isset($user))
                    {
                        ?>
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>"/>
                        <?php
                    }?>

                    <!--input type="hidden" name="lessonFee" id="lessonFee" value="0"/-->

                    <div class="row">
                        <?php if (!empty($users)){?>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <label for="user" class="input-group-addon"> Apprenant </label>
                                    <select id="ulist" class="form-control">
                                        <?php
                                        foreach ($users as $u)
                                        {
                                            ?>
                                            <option value="<?php echo $u['id'] ?>" contenteditable="true"><?php echo $u['lastname'].' '.$u['firstname']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('lesson') ?>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="user" value="" />
                        <?php }?>

                        <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <label for="lesson" class="input-group-addon"> Enseignement </label>
                                <select id="llist" class="form-control">
                                    <?php
                                    foreach ($allLess['allLess'] as $value)
                                    {
                                        ?>
                                        <option class="opts" id="<?php echo $value['fees'] ?>" value="<?php echo $value['id'] ?>" <?php echo set_select('lesson', $value['id']) ?>><?php echo mb_strtoupper($value['label']).' ('.strtoupper($value['code']).')' ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                            <?php echo form_error('lesson') ?>
                        </div>
                        <input type="hidden" name="lesson" id="lesson" value="" />

                        <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <label class="input-group-addon" for="sum">Montant</label>
                                <input type="text" value="<?php echo set_value('sum') ?>" name="sum" min="0" max="" id="sum" class="form-control" readonly="readonly"/>
                                <?php echo form_error('sum') ?>
                            </div>
                        </div>

                        <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <label class="input-group-addon" for="fee">Montant perçu</label>
                                <input type="number" value="<?php echo set_value('installment') ?>" name="installment" min="0" max="" id="fee" class="form-control"/>
                                <?php echo form_error('installment') ?>
                            </div>
                        </div>

                        <?php
                        if(session_data('role')==ADMIN){
                            ?>
                            <div class="col-sm-12 w3-margin-top">
                                <div class="input-group">
                                    <button id="negociate" type="button" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-2x fa-fw fa-credit-card"></i> Prix négocié</button>
                                </div>
                            </div>


                            <div class="col-sm-12 w3-margin-top" id="negociation"  style="display: none">
                                <div class="input-group">
                                    <label class="input-group-addon w3-blue" for="nego-fee">Montant négocié</label>
                                    <input type="number" value="<?php echo set_value('negociated') ?>" name="negociated" min=0 max="" id="nego-fee" class="form-control"/>
                                    <button id="negociated" type="button" name="ok" class="w3-btn w3-round w3-blue input-group-addon"><i class="fa fa-2x fa-fw fa-check-circle"></i></button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        
                          <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <label for="promo" class="input-group-addon"> Vague </label>
                                <select id="vlist" class="form-control" name="plist">

                                </select>

                            </div>
                            <?php echo form_error('lesson') ?>
                        </div>
                        <input type="hidden" name="promo" id="promo" value="" />


                        <div class="col-sm-12 w3-margin-top" id="negociation">
                            <div class="input-group">
                                <label class="input-group-addon w3-blue" for="newpromo">Créer une nouvelle vague</label>
                                <input type="checkbox" name="newpromo" id="newpromo" class="form-control"/>
                            </div>
                        </div>

                        
                    </div>


                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-2x fa-fw fa-user-plus"></i>  Inscrire</button>
                </form>

            </div>
        </div>


    </div>

</div>


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<style>
    .hide-option
    {
        display: none;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        alm('collapseReg',1);
        var users=[];
        var lessons=[];
        var promos=[];
        <?php
        if (!empty($users))
        foreach ($users as $u)
        {
        ?>
        users.push({id: <?php echo $u['id'] ?>,  name: "<?php echo $u['lastname'].' '.$u['firstname']?>"});
        <?php
        }
        ?>

        <?php
        foreach ($allLess['allLess'] as $value)
        {
        ?>
        lessons.push({fee: <?php echo $value['fees'] ?>, id: <?php echo $value['id'] ?>, label: "<?php echo ucfirst($value['label']).' ('.strtoupper($value['code']).')' ?>"});
        <?php
        }
        ?>
        
         <?php
        if (!empty($promotions))
        foreach ($promotions as $pr)
        {
        ?>
        promos.push({id: <?php echo $pr->id ?>,  code: "<?php echo $pr->code?>", lesson: "<?php echo $pr->lesson ?>" });
        <?php
        }
        ?>

        $('#negociate').on('click', function(){
            $(this).fadeOut(500);
            $('#negociation').fadeIn(500);
        });

        $('#negociated').on('click', function(){
            changeFee($('#nego-fee').prop('value'));
            $('#negociation').fadeOut(500);
            $('#negociate').fadeIn();
        });

        function changeFee(fees) {
            var fee=fees;
            if (fee!==undefined)
                $('#sum').prop('value', fee+' (Avance minimale de '+(Math.ceil((parseInt(fee)*30)/100))+')');
            else
                $('#sum').prop('value', '');
        }

        $('#ulist').editableSelect().on('select.editable-select', function (e, li) {
            for (var i = 0, len = users.length; i < len; i++) {
                if (users[i].id===li.val())
                {
                    $('#user').prop('value', users[i].id);
                    i=len;
                }

            }

        });

       $('#llist').editableSelect().on('select.editable-select', function (e, li) {
            for (var i = 0, len = lessons.length; i < len; i++) {
                if (lessons[i].id===li.val())
                {
                    $('#lesson').prop('value', lessons[i].id);
                    changeFee(lessons[i].fee);
                    var vlist=$('#vlist');
                    vlist.empty();
                    //alert('gta');
                    for (var j=0, len=promos.length; j<len; j++){
                        //alert(promos[j].lesson+'-->'+lessons[i].id);
                        if (promos[j].lesson==lessons[i].id)
                        {
                            //alert('gta'+i);
                            var opt=$('<option></option>'); //.prop('{id: '+promos[j].id+', value: '+promos[j].id+'}');
                            opt.prop('id', promos[j].id);
                            opt.prop('value', promos[j].id);
                            //alert(opt);
                            opt.text(promos[j].code);
                            vlist.append(opt);
                        }
                    }
                    i=len;
                }

            }
        });

    });
</script>