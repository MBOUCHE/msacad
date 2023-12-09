<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3">Les nouvelles à Multisoft academy</h1>
                <hr width="">
            </div>

            <div class="list-group col-sm-12">
            <?php

            foreach($agenda as $event){
                ?>


                <a href="<?php echo base_url("evenements")."/".permalink($event->title)."--".$event->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-uppercase"><?php echo $event->title ?></h5>
                        <small><?php echo moment($event->start_date)->fromNow()->getRelative() ?></small>
                    </div>
                    <p class="mb-1">
                        <?php echo $event->content ?>
                    </p>
                </a>


                <?php
            }
            ?>
            </div>
            <div class="col-sm-12 mt-5">
                <?php echo $pagination ?>
            </div>

        </div>
    </div>

</div>