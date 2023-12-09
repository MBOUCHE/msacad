<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">


                <div class="row">

                    <?php

                    $curForum = '';
                    $lastForum = '';

                    foreach ($forums as $forum) {
                        $curForum = $forum->forName;
                        if($curForum != $lastForum){
                            $lastForum = $curForum;
                            ?>
                            <div class="col-sm-12 my-3">
                                <h4 class="text-uppercase card-header"><?php echo mb_strtoupper($curForum) ?></h4>
                            </div>
                            <?php
                        }
                        if($forum->catId!=null){
                            ?>
                            <div class="col-sm-4 mb-1">
                                <div class="card" style="">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title  text-uppercase">
                                            <a href="<?php echo base_url('forum').'/categorie/'.permalink($forum->catName) ?>" class="font-weight-bold " style="border-radius: 0"><?php echo $forum->catName ?></a>
                                        </h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="fa fa-hashtag green-color"></i>&nbsp;
                                            Nombre de sujets : &nbsp;<b><?php echo $forum->post_nbr; ?></b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div>

            </div>



        </div>
    </div>

</div>