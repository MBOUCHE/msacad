<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $new->title ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <span class="" style="color: grey">
                            Publié  <b><?php echo fromNow($new->save_date) ?></b>
                        </span>
                        <div class="text-justify new my-3">
                            <?php
                            if($new->thumbnail!=null){
                                ?>
                                <img  class="mr-4 mb-4 img-fluid float-left new-thumb" alt="<?php echo permalink($new->title) ?>" src="<?php echo base_url($new->thumbnail )?>">
                                <?php
                            }
                            ?>
                            <?php echo ($new->content) ?>
                        </div>
                        
<div class="fb-share-button" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Partager</a></div>
<a href="http://twitter.com/share" class="twitter-share-button" data-size="large"  data-count="vertical" data-via="MsoftAcad">Tweet</a>
<g:plusone size="standard"></g:plusone>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .new a{
        color: #0275d8
    }
</style>