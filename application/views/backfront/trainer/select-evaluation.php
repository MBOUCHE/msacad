<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12">
                <h4><?php echo mb_strtoupper('Choix de l\'évaluation') ?> </h4>
            </div>
        </div>
        <hr />

        <div class="row">
            <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                <div class="btn-group">
                <?php
                    foreach ($evaluations as $ev)
                    {
                        echo "<a href='".base_url('trainerGate/examination/promotions/')."/$promo/".permalink($ev->code)."' class='w3-btn w3-blue w3-block w3-padding-top w3-padding-bottom w3-margin-bottom' width='500'>".$ev->label."</a>";
                    }
                    echo "<a href='".base_url('trainerGate/examination/promotions/')."/$promo/".permalink('all')."' class='w3-btn w3-blue w3-block w3-padding-top w3-padding-bottom w3-margin-bottom' width='500'>Toutes les évaluations</a>";

                ?>
                </div>
            </div>
        </div>

    </div>

</div>
<!--END PAGE CONTENT -->

<script type="text/javascript">
    $(document).ready(function(){
        leftM(1, '#panel-evaluation');
    });
</script>