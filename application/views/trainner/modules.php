<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Cookie"><?php echo $liste.' #'.$lister.' #'?></p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>
    <div class="row">
        <a href="<?php echo base_url('trainner/student/all').'?name='.$_GET['vague']?>" style="padding-bottom:10px;font-family:;font-size:25px;text-decoration:none;color:indigo;"><span class="fa fa-sort-amount-desc">&ensp;</span>&ensp;&ensp;liste des apprenants</a>
    </div>
  <div class="row">
            <?php
                foreach ($list as $key ) {?>
                    <div class="col-xl-4 col-sm-8 mb-4">
                        <div class="card card-inverse card-danger o-hidden h-100">
                            <div class="card-block">
                                <div class="card-block-icon">
                                    <i class="fa fa-fw fa-skyatlas" style="color:#7fffd4 "></i></div>
                                <div id="trainner/-notif" class="mr-auto">
                                    <div class="w3-xlarge"></div>
                                    <div style="color:white;font-family: Comic Sans MS;font-size:20px; "><?php echo $key['label_mod'];?></div>

                                </div>
                            </div>
                            <b class="card-footer clearfix small z-1">
                                <span class="fa fa-clock-o float-right" style="color:indigo;font-size: 13px;">&ensp;Nombre heure:&ensp;<?php echo $key['duration_mod'].'H';?></span>
                            </b>
                            <a href="<?php echo base_url('trainner/cours').'?name='.$key['id_mod']?>" class="card-footer clearfix small z-1">
                                <span class="float-right" style="color:white;font-size: 13px;">voir&ensp;<span class="fa fa-eye"></span>
                            </a>
                        </div>
                    </div>
             <?php   }
