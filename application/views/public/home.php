<div class="row">
    <p class="main-title">LES nouvelles</p>

    <?php


    foreach($allNews as $new){
        if($new->thumbnail!=null){
            ?>
            <div class="col-sm-12 new-block">
                <div class="row ">
                    <div class="col-sm-6">
                        <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class="h4 new-title"><?php echo $new->title ?></a><br>
                        <small class="small" style="color: grey">
                            Publié le <b><?php echo fromNow($new->save_date) ?></b>
                        </small>
                        <div class="text-justify">
                            <?php echo excerpt($new->content,200) ?> <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class=" blue-color">Lire plus</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>"><img alt='<?php echo permalink($new->title) ?>' class="img-fluid" src="<?php echo base_url($new->thumbnail )?>"></a>
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
                            Publié le <b><?php echo fromNow($new->save_date) ?></b>
                        </small>
                        <div class="text-justify">
                            <?php echo excerpt($new->content,200) ?> <a href="<?php echo base_url("nouvelles")."/".permalink($new->title)."--".$new->id?>" class=" blue-color">Lire plus</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }

    ?>

    <div class="col-sm-12">
        <a href="<?php echo base_url("nouvelles") ?>" class="link mt-5 float-right">Toutes les nouvelles &rightarrow;</a>
    </div>


</div>