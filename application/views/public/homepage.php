<div class="container">
    <div class="row d-none d-md-flex">
        <div class="col-sm-12">
            <section  class="mb-4">
                <div id="carouselExampleIndicators" class="carousel  slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" class="active" data-slide-to="<?php echo 0 ?>"></li>
                        <?php

                        foreach($slides as $key=>$slide){
                            ?>

                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key+1 ?>"></li>

                            <?php


                        }
                        ?>
                    </ol>


                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active" style="background-image: url(<?php echo img_url('msoft-profil.png') ?>">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Bienvenue à MULTISOFT ACADEMY</h4>
                            </div>
                        </div>
                        <?php
                        foreach($slides as $key=>$slide){
                            $visible = "";
                            if($slide->thumbnail){
                                
                                ?>

                                <div class="carousel-item" style="background-image: url(<?php echo base_url($slide->thumbnail) ?>">
                                    <?php
                                    
                                    if($slide->title!=''){
                                        ?>
                                    	<div class="carousel-caption d-none d-md-block <?php echo $visible ?>">
                                            <h4><?php echo $slide->title ?></h4>
                                        </div>
                                    <?php
                                    }
                                    else{
                                        $visible = "hidden";
                                    }
                                    
                                     ?>
                                </div>

                                <?php
                            }
                            ?>

                            <?php


                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <section id="sidebar-left" class="">
                <?php include_once "sidebar-left.php" ?>
            </section>
        </div>
        <div class="col-lg-6">
            <section id="main-contain" class="">
                <?php
                include_once "home.php";
                ?>
            </section>
            <hr>
            <section>
            <h3 class='blue-color'>L'AVIS DES APPRENANTS FORMÉS</h3>
		<div class="row">
		    <div class="col-sm-12">
		        <div id="testimonial-slider" class="owl-carousel">
		            <?php
		            foreach($testimonials as $testi){
		            
			            ?>
			            <div class="testimonial">
			                <div class="pic">
			                    <img src="<?php echo $testi->avatar ?>" alt="<?php echo $testi->lastname?>">
			                </div>
			                <div class="description">
			                    <?php echo $testi->content ?>
			                </div>
			                <h3 class="title"><?php echo $testi->lastname." ".$testi->firstname ?>
			                    <span class="post"> - N° <?php echo $testi->number_id?></span>
			                </h3>
			            </div>
			            <?php
		            
		            }
		            ?>
		        </div>
		    </div>
		    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
		    <script>
			$(document).ready(function(){
			    $("#testimonial-slider").owlCarousel({
			        items:1,
			        itemsDesktop:[1000,1],
			        itemsDesktopSmall:[979,1],
			        itemsTablet:[768,1],
			        pagination:false,
			        navigation:true,
			        navigationText:["",""],
			        autoPlay:true,
			        autoplayTimeout:5000,
				autoplayHoverPause:true
			    });
			});
			</script>
		</div>
            </section>
        </div>
        <div class="col-lg-3">
            <section id="sidebar-right" class="">
                <?php include_once "sidebar-right.php" ?>
            </section>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="<?php echo css_url('testimonial')?>">
 
    
    
    <div class="row">
        <div class='col-sm-12'>
       		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- home_large -->
<ins class="adsbygoogle"
     style="display:inline-block;width:100%;height:90px"
     data-ad-client="ca-pub-4021148906475843"
     data-ad-slot="7125068095"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> 
        </div>
    </div>

    <div class="row jumbotron">
        <div class="col-sm-12 col-md-6">
            <h2>MULTISOFT ACADEMY EN VIDEO</h2>
            Votre choix pour une formation multidimensionnelle.
        </div>
        <div class="col-sm-12 col-md-6">
            <iframe style='width:100%; height:315px;'  src="https://www.youtube.com/embed/-o085Ndfd_k" allowfullscreen></iframe>
        </div>
    </div>
</div>
