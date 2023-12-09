<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6" style="min-height: 500px">
                <div class="h4 text-center">
                    <?php echo mb_strtoupper('Ajout d\'un gérant')?>
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
                <form action="<?php echo base_url('admin/manager/regManager') ?>" method="post" class="">
                    <div class="row">
                        <?php if (!empty($users)){?>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <label for="user" class="input-group-addon"> Utilisateurs </label>
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
                                <?php echo form_error('id') ?>
                            </div>
                        </div>
                            <input type="hidden" name="id" id="user" value="" />
                        <?php } else if (empty($users)) { ?>
                        <p class="h5 w3-text-red">Aucun utilisateur disponible pour occuper ce poste.</p>
                        <?php } ?>

                    </div>


                    <button type="submit" name="send" class="w3-btn w3-round w3-blue"><i class="fa fa-1x fa-fw fa-user-plus"></i>  Assigner</button>
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
        alm('collapseGerant',1);

        var users=[];
        <?php
        if (!empty($users))
        foreach ($users as $u)
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
                    $('#user').prop('value', users[i].id);
                    i=len;
                }

            }

        });

    });
</script>