<!DOCTYPE html>
<html lang="fr">

    <?php include_once "head.php" ?>

<body id="page-top">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <header style="/*background: url('<?php echo img_url('noel-2.gif') ?>') no-repeat  30% top*/">
        <?php include_once "banner.php" ?>

        <div class="container-fluid mt-2 mb-3 main-menu" >
            <div class="container">
                <?php include_once "e_views/v_home_page_menu.php" ?>
            </div>
        </div>
    </header>

