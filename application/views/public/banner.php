    <div class="container">
    <!-- float facebook like box start -->
<script id="float_fb" src="//pic.sopili.net/pub/float_fb/widget.js" data-href="https://www.facebook.com/msoftacademy/" async></script>
<!-- float facebook like box end -->
        <div class="row d-none d-md-flex ">
            <div class="col-lg-9 col-md-12">
                <a href="<?php echo base_url() ?>" class="logo">
                    <img style='height:85px;' alt="multisoft-academy" src="<?php echo img_url("logo/logo.png") ?>">
                </a>
                <h4 class="site-desc"><a class="site-desc" href="<?php echo base_url() ?>">Centre de Formation Professionnelle <b><?php echo APPNAME ?></b></a></h4><br>
                <span class="slogan">POUR UNE FORMATION MULTIDIMENSIONNELLE</span><br>
                
                
                <span class="agrement"><b>Agrément N° 0124/MINEFOP/SG/DFOP/SDGSF/SACD du 11 Août 2010</b></span><br>
                <span><i class="fa fa-phone w3-blue p-1 w3-circle"></i> 655811916 / 690983673</span>
                <span><i class="fa fa-envelope-open w3-blue p-1 w3-circle"></i> <a href="mailto:multisoftacademy@gmail.com">multisoftacademy@gmail.com</a> |  <a href="mailto:infos@msacad.com">infos@msacad.com</a></span>
            </div>
            <div class="col-lg-3 col-md-12 static">
                <?php
                   include 'panel-user.php'
                ?>

                <form action="<?php echo base_url('search') ?>" method="get" class="form-inline my-2 mr-lg-2">
                    <div class="input-group">
                        <input required class="form-control w3-input"  style="border-radius: 0" placeholder="Recherche ..." name="key" type="text">
                            <span class="input-group-btn ">
                                <button  style="border-radius: 0" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                    </div>
                </form>

                <span>Situé à Dang, Ngaoundéré, <b>Derrière l'hôtel PACKEM PALACE</b>.</span>

            </div>
        </div>
        <div class="row d-sm-block d-md-none d-lg-none">
            <div class="col-sm-12">
                <a style="font-size: 125%" class="orange-color text-center d-block" href="<?php echo base_url() ?>">Centre de Formation Professionnelle<br> <b><?php echo APPNAME ?></b></a><br>
                <a href="<?php echo base_url() ?>" class="d-block text-center" >
                    <img style='height:85px;' alt="multisoft-academy" src="<?php echo img_url("logo/logo.png") ?>">
                </a>
                <br><span>Situé à Dang, Ngaoundéré, <b>Derrière l'hôtel PACKEM PALACE</b>.</span>
                
            </div>

            <div class="col-sm-12">
                <?php
                include 'panel-user.php'
                ?>


                <form action="<?php echo base_url('search') ?>" method="get" class="form-inline my-2 mr-lg-2">
                    <div class="input-group">
                        <input required class="form-control w3-input"  style="border-radius: 0" placeholder="Recherche ..." name="key" type="text">
                            <span class="input-group-btn ">
                                <button  style="border-radius: 0" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                    </div>
                </form>



            </div>
        </div>
    </div>