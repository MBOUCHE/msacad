<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->
    <title><?php echo (isset($titre) and $titre)? ($titre.' | ADMINISTRATION '.APPNAME) : ('Sans titre | ADMINISTRATION '.APPNAME) ?></title>

    <link rel="icon" href="<?php echo img_url('logo/logo-sm.png') ?>" sizes="16x16 32x32" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo css_url('bootstrap.min')?>" media="all" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template -->
    <link href="<?php echo css_url('font-awesome/css/font-awesome.min')?>" media="all" rel="stylesheet" type="text/css">

    <!--Added by Simo -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/e_bootstrap.min.css" type="text/css" media="all">

    <!-- Plugin CSS -->
    <link href="<?php echo css_url('datatables/dataTables.bootstrap4')?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('w3')?>" rel="stylesheet">
    <link href="<?php echo css_url('alertify/alertify.min')?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('alertify/themes/bootstrap')?>" rel="stylesheet">
    <link href="<?php echo css_url('alertify/bootstrap.min')?>" media="all" rel="stylesheet" type="text/css">
    <!--script src="<?php //echo css_url('fileuploader/jquery.fileuploader')?>" media="all" rel="stylesheet" type="text/css"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo css_url('color')?>" rel="stylesheet">
    <link href="<?php echo css_url('sb-admin')?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('msoft-admin')?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('themes/icon')?>" rel="stylesheet">
    <link href="<?php echo css_url('themes/metro/easyui')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.structure.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-ui.theme.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('jquery-editable-select.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('preloader/jquery.loader.min')?>" rel="stylesheet">
    <link href="<?php echo css_url('style')?>" rel="stylesheet"> <!--A enlever-->


    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo js_url('jquery.min')?>"></script>    <script src="<?php echo js_url('jquery-ui.min')?>"></script>
    <script src="<?php echo js_url('jquery-ui.min')?>"></script>
    <script src="<?php echo js_url('tether.min')?>"></script>
    <script src="<?php echo js_url('bootstrap.min')?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo js_url('jquery-easing/jquery.easing.min')?>"></script>
    <script src="<?php echo js_url('alertify/alertify.min')?>"></script>
    <script src="<?php echo js_url('datatables/jquery.dataTables')?>"></script>
    <script src="<?php echo js_url('datatables/dataTables.bootstrap4')?>"></script>
    <script src="<?php echo js_url('pageloader')?>"></script>
    <script src="<?php echo js_url('bootstrap-filestyle.min') ?>"> </script>
    <script src="<?php echo js_url('jquery-editable-select.min')?>"></script>
    <script src="<?php echo js_url('preloader/jquery.loader.min')?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo js_url('sb-admin.min')?>"></script>
    <script src="<?php echo js_url('canvas/canvasjs.min')?>"></script>
    <script src="<?php echo js_url('canvas/jquery.canvasjs.min')?>"></script>
    <script src="<?php echo js_url('alertify/alertifyInitScript')?>"></script>

</head>

<body id="page-top">
