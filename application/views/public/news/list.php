<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3">Les nouvelles à Multisoft academy</h1>
                <hr width="">
            </div>

            <?php


            foreach($allNews as $new){
                if($new->thumbnail!=null){
                    ?>
                    <div class="col-sm-12 new-block">
                        <div class="row h-100">
                            <div class="col-sm-6">
                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class="h4 new-title"><?php echo $new->title ?></a><br>
                                <small class="small" style="color: grey">
                                    Publié <b><?php echo  fromNow($new->save_date) ?></b>
                                </small>
                                <div class="text-justify">
                                    <?php echo excerpt($new->content) ?> <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class=" blue-color">Lire plus</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>"><img width="" class="img-fluid" src="<?php echo base_url($new->thumbnail )?>"></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                else{
                    ?>

                    <div class="col-sm-12 new-block">
                        <div class="row ">
                            <div class="col-sm-12">
                                <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class="h4 new-title"><?php echo $new->title ?></a><br>
                                <small class="small" style="color: grey">
                                    Publié <b><?php echo fromNow($new->save_date) ?></b>
                                </small>
                                <div class="text-justify">
                                    <?php echo excerpt($new->content) ?> <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class=" blue-color">Lire plus</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
            <div class="col-sm-12 mt-5">
                <?php echo $pagination ?>
            </div>

        </div>
    </div>

</div>