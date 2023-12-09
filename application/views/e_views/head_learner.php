<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Espace Apprenant </title>

    <link rel="icon" href="<?php echo base_url().'assets/img/logo/logo-sm.png'?>" sizes="16x16 32x32" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" media="all" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url().'assets/css/font-awesome/css/font-awesome.min.css'?>" media="all" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo base_url().'assets/css/w3.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/alertify/alertify.min.css'; ?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/css/alertify/themes/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/alertify/bootstrap.min.css'; ?>" media="all" rel="stylesheet" type="text/css">
    <!--script src="" media="all" rel="stylesheet" type="text/css"></script>-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url().'assets/css/color.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/sb-admin.css'; ?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/css/msoft-admin.css'; ?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/css/themes/icon.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/themes/metro/easyui.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery-ui.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery-ui.structure.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery-ui.theme.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery-editable-select.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.loader.min.css" rel="stylesheet'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/style.css'; ?>" rel="stylesheet"> 
    <!--A enlever-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap/css/bootstrap.min.css';?>">

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url().'assets/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery-ui.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/tether.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap/js/bootstrap.min.js'; ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url().'assets/js/jquery-easing/jquery.easing.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/alertify/alertify.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/datatables/jquery.dataTables.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/datatables/dataTables.bootstrap4.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/pageloader.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-filestyle.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery-editable-select.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/preloader/jquery.loader.min.js'; ?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url().'assets/js/sb-admin.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/canvas/canvasjs.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/canvas/jquery.canvasjs.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/alertify/alertifyInitScript.js'; ?>"></script>

    <script src="<?php echo base_url()?>assets/js/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            $(document).ready(function() {
                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });
            });
            CKEDITOR.replace('justification');
        });
    </script>

    <!-- Classe virtuelle (Zetsou) -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/e_learning/jquery-1.8.2.js"></script>
    <script type="text/javascript">

        function refresh(){
            $(document).ready(function(){
                $('#auto').load('e_add_minutes.php');
                refresh();
            })

            setTimeout( function () {
            $('#auto').fadeOut('slow').load('e_add_minutes.php').fadeIn('slow');
            refresh();
            }, 1000);

        }
    </script>
</head>