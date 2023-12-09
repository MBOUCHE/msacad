<!-- Navigation -->
<nav id="mainNav" class="navbar static-top navbar-toggleable-sm navbar-inverse bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url('trainner/home') ?>">
        <img src="<?php echo img_url('logo/logo-sm.png') ?>" alt="<?php echo strtoupper(APPNAME) ?>" class="rounded float-left" style="width: 30px; height: 30px; margin-right: 5px;">
        <?php echo strtoupper(APPNAME) ?>
    </a>
    <div class="collapse navbar-collapse" id="navbarExample">
        <?php
            include_once('topMenu.php');
            if(session_data('connect'))
            include_once('leftMenu.php');
        ?>
    </div>
</nav>
