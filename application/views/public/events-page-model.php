<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <section id="main-contain" class="">

                <div class="row" id="breadcrumb">
                    <?php
                    breadcrumb($breadcrumb);
                    ?>
                </div>
                <?php

                if(isset($view) && $view)
                    include_once "event/".$view.".php";
                else
                    show_404();
                ?>
            </section>
        </div>
        <div class="col-lg-3">
            <section id="sidebar-left" class="">
                <?php include_once "sidebar-left.php" ?>
            </section>
        </div>
    </div>
</div>
