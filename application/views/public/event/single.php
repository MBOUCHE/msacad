<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $event->title ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <span class="h5 green-color" >
                            Débute <b><?php echo moment($event->start_date)->fromNow()->getRelative() ?></b>
                        </span>
                        <div class="text-justify event py-3">

                            <?php echo ($event->content) ?>
                        </div>
                        
	<div class="fb-share-button" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Partager</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .event a{
        color: #0275d8
    }
</style>