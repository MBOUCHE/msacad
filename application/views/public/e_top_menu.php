<!DOCTYPE html>
<html lang="fr">
    <?php include_once "head.php" ?>

<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
  <header style="/*background: url('<?php echo img_url('noel-2.gif') ?>') no-repeat  30% top*/">
      <?php include_once "banner.php" ?>

      <div class="container-fluid mt-2 mb-3 main-menu">
          <div class="container">
              <?php include_once "menu.php";?>
          </div>
      </div>
  </header>
<body background="#fbffbd">
  <div class="row" style="background-color: #fbffbd;">
<!--     <div class="col-md-2"><img src="<?php echo base_url().'assets/img/logo/g70.png'?>" style='width: 100%; height: 71px; margin: 8px;'></div> -->

    <style type="text/css">
      .e-learning-menu{
        margin: auto;
        margin-top: 8px;
        width: auto;
        height: 49px;
        background-color: white;
        box-sizing: blue;
      }
         a{
            margin-left: -26px
            font-size: 15px;
            font-family: Times New Roman;
            color:indigo;
            transition: text-shadow, color 1s;
            text-decoration: none;
            text-align: left;
        }

    #e_menu li {
        width: 300px;
    }

    #e_menu a {
        line-height:44px;
        text-shadow: 0 1px 0 rgba(0,0,0,8);
        text-align: left;
        text-decoration: none;
    }
    </style>
<!-- 
    <div class="e-learning-menu col-md-10" id="contenu" style="background-color: #fedb95;border-radius: 17px;">
        <ul class="nav nav-tabs" id="e_menu">
            <li class="">
              <span><a class="navbar-brand" style="margin-left: 71px;" href="<?php echo base_url().'e_controllers/c_home_page/list_lesson';?>">FORMATIONS LONGUES</a></span>
            </li>
            <li class="">
              <span><a class="navbar-brand" style="margin-left: 71px;" href="<?php echo base_url().'e_controllers/c_home_page/list_lesson2'?>">FORMATIONS ACCELEREES</a></span>
            </li>
            <li class="">
              <span><a class="navbar-brand" style="margin-left: 71px;" href="<?php echo base_url().'e_controllers/c_home_page/list_lesson3'?>">FORMATIONS PROMOTIONELLES</a></span>
            </li>
        </ul>
      </div> -->
    </div>
  </div>