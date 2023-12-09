<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12 ">
                <div class="row">


                    <div class="col-sm-12 col-lg-8 offset-lg-2 ">
                        <?php
                            if(isset($state)){
                                ?>
                                <div class="alert <?php echo ($state)?'alert-success':'alert-danger' ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <?php echo $message ?>
                                </div>
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

</script>