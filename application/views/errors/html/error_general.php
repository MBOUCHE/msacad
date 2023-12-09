<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Problème dans la page</title>
    <link href="<?php echo css_url('bootstrap.min')?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('w3')?>" rel="stylesheet">
    <link href="<?php echo css_url('custom/basic')?>" rel="stylesheet">
    <link href="<?php echo css_url('custom/menu')?>" rel="stylesheet">
    <link href="<?php echo css_url('font-awesome/css/font-awesome.min')?>" media="all" rel="stylesheet" type="text/css">

    <script src="<?php echo js_url('jquery.min')?>"></script>
    <script src="<?php echo js_url('bootstrap.min')?>"></script>
    <script src="<?php echo js_url('custom/basic')?>"></script>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	color: #4F5155;
}

#container {
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}


    table th{
        font-size: 2rem;
        text-transform: uppercase;
        background: red;
        color: white;
        font-weight: bold;
        text-align: center;
        font-family: arial, sans-serif;
        letter-spacing: 2px;
        height: 100px;
    }

</style>
</head>
<body>
<header>

    <?php include_once VIEWPATH."/public/banner.php" ?>

    <div class="container-fluid mt-2 mb-3 main-menu" >
        <div class="container">
            <?php include_once VIEWPATH."/public/menu.php" ?>
        </div>
    </div>
</header>

    <table width="100%" id="container" class="container">
        <tr>
            <th class="" colspan="3" align="center">
                <?php echo $heading; ?>
            </th>
        </tr>
        <tr>
            <td  colspan="3" style="color: #343434; font-weight: 500; height: 75px" align="center">
                <h4><?php echo $message; ?></h4>
            </td>
        </tr>
    </table>
</body>
</html>