<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Allocation d\'un enseignement: <br>Choix de l\'enseignement')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
                <?php if (isset($user)){ ?>
                    <br>
                    <div class="h5 text-center">Assigner <b><?php echo $user->firstname.' '.$user->lastname ?></b> à un enseignement</div>
                <?php } ?>
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/trainer/all')?>" class="w3-btn w3-blue w3-round">Tous les formateurs</a>
            </div>

            <div class="col-sm-12 col-md-6" style="min-height: 500px">
                <?php
                if(isset($status) and $status==1)
                {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
                <form action="<?php echo base_url('trainner/trainer/allocation')?>" method="post" class="">
                    <?php
                    if(isset($user))
                    {
                    ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <?php
                    }?>


                    <div class="row">
                        <?php if (!empty($users)){?>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="user" class="input-group-addon"> Formateur </label>
                                    <select id="ulist" class="form-control">
                                    <?php
                                        foreach ($users as $u)
                                        {
                                    ?>
                                        <option value="<?php echo $u->id ?>" contenteditable="true"><?php echo $u->lastname.' '.$u->firstname?></option>
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
                                <?php echo form_error('lesson') ?>
                            </div>
                        </div>
                        <input type="hidden" name="lesson" id="lesson" value="" />


                        <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <label for="allDate" class="input-group-addon">Date d'allocation</label>
                                <input type="text" name="allDate" id="allDate" value="<?php echo set_value('allDate') ?>" class="form-control input-sm datepicker" autocomplete="off"><br>
                            </div>
                            <?php echo form_error('birthDate') ?>
                        </div>

                    </div>


                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-1x fa-fw fa-user-plus"></i>  Assigner</button>
                </form>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        alm('collapseForm', 3);
        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        $(".datepicker").datepicker({
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            showAnim: "slideDown",
            showButtonPanel: true,
            monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
            monthNamesShort: [ "Jan", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Dec" ],
            minDate: new Date(d.getFullYear(), month, day)
        });

        var users=[];
        var lessons=[];
        <?php
        if (!empty($users)){
        foreach ($users as $u)
        {
        ?>
        users.push({id: <?php echo $u->id ?>,  name: "<?php echo $u->lastname.' '.$u->firstname?>"});
        <?php
        }}
        ?>

        <?php

        if (!empty($allLess['allLess'])){
        foreach ($allLess['allLess'] as $value)
        {
        ?>
        lessons.push({fee: <?php echo $value['fees'] ?>, id: <?php echo $value['id'] ?>, label: "<?php echo ucfirst($value['label']).' ('.strtoupper($value['code']).')' ?>"});
        <?php
        }}
        ?>


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
                    i=len;
                }

            }
        });

    });
</script>