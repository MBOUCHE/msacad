<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Niconne">choix de  la vague</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>

        <div class="row">
            <?php
                foreach ($list as $key ) {?>
                    <div class="col-xl-4 col-sm-8 mb-4">
                        <div class="card card-inverse card-success o-hidden h-100">
                            <div class="card-block">
                                <div class="card-block-icon">
                                    <i class="fa fa-fw fa-calendar" style="color:#7fffd4 "></i></div>
                                <div id="trainner/-notif" class="mr-auto">
                                    <div class="w3-xlarge"></div>
                                    <div style="color:white;font-family: Comic Sans MS;font-size:20px; "><?php echo $key['code_wave'];?></div>

                                </div>
                            </div>
                            <b class="card-footer clearfix small z-1">
                                <span class="float-left" style="color:indigo;font-size: 13px;">lesson:<?php echo $key['label'];?></span>
                            </b>
                            <a href="<?php echo base_url('trainner/timetable/generate')?>?name=<?php echo $key['id_wave']?>" class="card-footer clearfix small z-1">
                                <span class="float-right" style="color:white;font-size: 13px;">Generer l'emploie de temps &ensp;<span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                    </div>
             <?php   }
            ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#2').on('click',function(){
      $('#2').html('<span class="badge badge-info" id="2">0</span>')
    })
  })
</script>