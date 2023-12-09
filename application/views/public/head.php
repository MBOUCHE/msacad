<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4021148906475843",
    enable_page_level_ads: true
  });
</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0275d8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="<?php echo 'Centre de Formation Professionnelle '.APPNAME ?>" />
    <meta property="fb:app_id"          content="847781188703691" /> 
    <?php if(!isset($meta)){
        ?>
        <meta name="description" content="Centre de Formation Professionnelle MULTISOFT ACADEMY, Ngaoundéré">
        <meta name="author" content="Le Findex, MULTISOFT ACADEMY">
        <meta name="keywords" content="Le Findex, MULTISOFT ACADEMY, Centre de formation Professionnelle MULTISOFT ACADEMY, Ngaoundéré">

        <meta property="og:title" content="<?php echo 'Centre de Formation Professionnelle '.APPNAME ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo base_url() ?>" />
        <meta property="og:image" content="<?php echo img_url('logo/logo.png') ?>" />
        <?php
    }
    else{
        ?>
        <meta name="description" content="<?php echo $meta['description'] ?>">
        <meta property="og:description" content="<?php echo $meta['description'] ?>">
        <meta property="og:title" content="<?php echo (isset($titre) and $titre)? ($titre.' | '.APPNAME) : (APPNAME) ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo $meta['url'] ?>" />
        <meta property="og:image" content="<?php echo $meta['image'] ?>" />
        <?php
    }?>

    <title><?php echo (isset($titre) and $titre)? ($titre.' | '.APPNAME) : (APPNAME) ?></title>

    <!--ICON-->
    <link rel="icon" href="<?php echo img_url('logo/logo-sm.png') ?>" sizes="16x16 32x32" type="image/png">

    <!-- Plugin CSS -->
    <link href="<?php echo css_url('datatables/dataTables.bootstrap4')?>" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo css_url('main')?>" />
    <link rel="stylesheet" href="<?php echo css_url('build')?>" />
    <link rel="stylesheet" href="<?php echo css_url('normalize')?>" />
    <link rel="stylesheet" href="<?php echo css_url('wizardMain')?>" />
    <link rel="stylesheet" href="<?php echo css_url('jquery.steps')?>" />
    <link rel="stylesheet" href="<?php echo css_url('jasny-bootstrap.min')?>" />
    <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('alertify/alertify.min') ?>" />

    <link href="<?php echo css_url('jquery-ui.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.structure.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.theme.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-editable-select.min')?>" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo css_url('w3')?>" rel="stylesheet">
    <link href="<?php echo css_url('bootstrap.min')?>" media="all" rel="stylesheet" type="text/css">


    <!-- Custom fonts for this template -->
    <link href="<?php echo css_url('font-awesome/css/font-awesome.min')?>" media="all" rel="stylesheet" type="text/css">



    <!-- Custom css for the front end -->
    <link href="<?php echo css_url('custom/basic')?>" rel="stylesheet">
    <link href="<?php echo css_url('custom/menu')?>" rel="stylesheet">
    <!--link href="<?php echo css_url('slider/style')?>" rel="stylesheet"-->
    <link href="<?php echo css_url('slider/style-')?>" rel="stylesheet">
    <link href="<?php echo css_url('preloader/jquery.loader.min')?>" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo js_url('jquery.min')?>"></script>
    <script src="<?php echo js_url('jquery-ui.min')?>"></script>
    <script src="<?php echo js_url('tether.min')?>"></script>
    <script src="<?php echo js_url('bootstrap.min')?>"></script>

    <!-- Plugin JavaScript -->

    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

    <script src="<?php echo js_url('jquery-easing/jquery.easing.min')?>"></script>
    <script src="<?php echo js_url('datatables/jquery.dataTables')?>"></script>
    <script src="<?php echo js_url('datatables/dataTables.bootstrap4')?>"></script>
    <script src="<?php echo js_url('pageloader')?>"></script>
    <script src="<?php echo js_url('bootstrap-filestyle.min') ?>"> </script>
    <script src="<?php echo js_url('jquery-editable-select.min')?>"></script>
    <script src="<?php echo js_url('modernizr-respond')?>"></script>
    <script src="<?php echo js_url('jquery.cookie-1.3.1')?>"></script>
    <script src="<?php echo js_url('jquery.steps.min')?>"></script>
    <script src="<?php echo js_url('jasny-bootstrap.min')?>"></script>
    <script src="<?php echo js_url('jquery.validate.min')?>"></script>
    <script type="application/javascript" src="<?php echo js_url('alertify/alertify.min') ?>"></script>
    <script src="<?php echo js_url('preloader/jquery.loader.min')?>"></script>

    <!-- Custom scripts for this template -->
    <script type="application/javascript" src="<?php echo js_url('alertify/alertifyInitScript') ?>"></script>
    <script src="<?php echo js_url('custom/basic')?>"></script>
    <script src="<?php echo js_url('custom/numscroller')?>"></script>
    <script src="<?php echo js_url('slider/index')?>"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>

    .panel-user .dropdown-menu li {
        display: block;
    }

    .panel-user .dropdown-alerts {
        width: 250px;
        min-width: 0;
    }

    .panel-user .dropdown-menu {
        right: 0;
        left: auto;
    }

    .panel-user .dropdown-menu a:hover {
        text-decoration: none;
    }



    @media (min-width: 768px)
        .panel-user .dropdown-alerts {
            margin-left: auto;
        }
</style>
</head>