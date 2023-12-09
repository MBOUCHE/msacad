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
                    include_once "search/$view.php";
                else
                    show_404();
                ?>
            </section>
        </div>
        <div class="col-lg-3">
            <section id="sidebar-right" class="">
                <?php include_once "sidebar-right.php" ?>
            </section>
        </div>
    </div>
</div>
