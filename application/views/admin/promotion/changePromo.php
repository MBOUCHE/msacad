
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6" style="min-height: 500px">
                <div class="h3 text-center">CHANGEMENT DE VAGUE</div>
                <br>
                <div class="h5 ">Apprenant : <b><?php echo $user['firstname'].' '.$user['lastname']?><b></div>
                <div class="h5 ">vague actuelle : <b><?php echo $pcode ?></b></div>
                <div class="h5 ">Enseignement : <b><?php echo $promoInfo['lesson'] ?></b></div>

                <hr>
                <?php
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
                            <?php echo "<i class='fa fa-2x fa-stop'></i>  ".$message ?>
                        </div>
                        <?php
                    }
                }


                ?>
                <form action="changePromo" method="post" class="">
                    <input type="hidden" name="id" value="<?php echo $uid; ?>" />
                    <input type="hidden" name="code" value="<?php echo $pcode; ?>" />
                    <div class="row">

                        <div class="col-sm-12 w3-margin-top">
                            <div class="input-group">
                                <?php if($promoInfo['promoList'][0]['code']!=NULL and isset($promoInfo['promoList'])){ ?>
                                <label for="newPromo" class="input-group-addon"> Promotions</label>
                                <select name="newPromo" id="newPromo" class="form-control">
                                    <?php

                                    foreach ($promoInfo['promoList'] as $value)
                                    {
                                        ?>
                                        <option class="opts" id="<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>" <?php if ($value['code']==$pcode) echo 'selected'; ?>><?php echo strtoupper($value['code']) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('promotion') ?>
                                <?php } else {?>
                                <div class="h4 text-center">Pas de vague disponible pour cet enseignement</div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>

                    <?php if($promoInfo['promoList'][0]['code']!=NULL and isset($promoInfo['promoList'])){ ?>
                        <button type="submit" name="send" class="btn btn-primary">Changer</button>
                    <?php } ?>
                </form>
                <button class="btn btn-primary" onclick="history.go(-1)"><i class="fa fa-fw fa-angle-left"></i>  Retour</button>
            </div>
        </div>


    </div>

</div>


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<script type="text/javascript">
    $(document).ready(function(){
        /*var lessons=new Array();
         var option;
         $('.opts').on('click', function(){
         option=$(this);
         var fees=option.prop('id');
         $('#lessonFee').prop('value', fees);
         });*/
    });
</script>