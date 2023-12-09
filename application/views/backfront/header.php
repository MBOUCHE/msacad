<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="The Pocket" name="author" />

     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <?php $title = (session_data('role'))? role_tostring(session_data('role')) : ''; ?>
    <title><?php echo (isset($titre) and $titre)? ($titre.' | Portail  '.$title.' '.APPNAME) : ('Sans titre | '.APPNAME) ?></title>

    <!--ICON-->
    <link rel="icon" href="<?php echo img_url('logo/logo-sm.png') ?>" sizes="16x16 32x32" type="image/png">
    <!-- GLOBAL STYLES -->
        <!-- Plugin styles -->
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap/css/bootstrap.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('alertify/alertify.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('alertify/themes/bootstrap') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('alertify/bootstrap.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('datatables/dataTables.bootstrap4') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('font-awesome/css/font-awesome.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('main') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('theme') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('pretty/pretty.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('w3') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('jquery-ui.min') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('jquery-ui-timepicker-addon') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('preloader/jquery.loader.min') ?>" />

        <!-- Custom styles -->
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('MoneAdmin') ?>" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo css_url('layout2') ?>"  />
    <!--END GLOBAL STYLES -->



    <!-- GLOBAL SCRIPTS -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script type="application/javascript" src="<?php echo js_url('html5shiv.min') ?>"></script>
            <script type="application/javascript" src="<?php echo js_url('respond.min') ?>"></script>
        <![endif]-->
    
        <!-- Plugin JavaScript -->
        <script type="application/javascript" src="<?php echo js_url('jquery-2.0.3.min') ?>"></script>
        <script type="application/javascript"  src="<?php echo js_url('jquery-ui.min')?>"></script>
        <script type="application/javascript"  src="<?php echo js_url('jquery-ui-timepicker-addon')?>"></script>
        <script type="application/javascript" src="<?php echo js_url('bootstrap/js/bootstrap.min') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('bootstrap-filestyle.min') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('alertify/alertify.min') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('datatables/jquery.dataTables') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('datatables/dataTables.bootstrap4') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('inputmask/jquery.inputmask.bundle.min') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('Chart/Chart.min') ?>"></script>
        <script src="<?php echo js_url('canvas/canvasjs.min')?>"></script>
        <script src="<?php echo js_url('canvas/jquery.canvasjs.min')?>"></script>
        <script type="application/javascript" src="<?php echo js_url('pageloader') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('modernizr-respond') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('preloader/jquery.loader.min') ?>"></script>

        <!-- Custom scripts for this template -->
        <script type="application/javascript" src="<?php echo js_url('alertify/alertifyInitScript') ?>"></script>
        <script type="application/javascript" src="<?php echo js_url('msa_user') ?>"></script>
    <!-- END GLOBAL SCRIPTS -->
</head>

<body class="padTop53 ">

    <!-- MAIN WRAPPER -->
    <div id="wrap" >
        

       