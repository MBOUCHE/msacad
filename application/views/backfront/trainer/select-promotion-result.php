<!--PAGE CONTENT -->
<?php //var_dump($promotions); die(); ?>
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-sm-12 text-center" style="margin: 0 !important">
                <h4 class=""><b><?php echo mb_strtoupper('Choix de la vague') ?> </b></h4>
            </div>
        </div>
        <hr />
        <br><br>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 table-responsive w3-padding-24">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Evaluation</th>
                        <th>Vague</th>
                        <th>Enseignement</th>
                        <th>Option</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;

                    if ($promotions!=null and !empty($promotions))
                        foreach ($promotions as $promo)
                        {
                            if ($promo->results!=null)
                                foreach ($promo->results as $res) {
                                    $line++;
                                    echo "<tr>";
                                    echo "<td>$line</td>";
                                    echo "<td>" . $res->label . "</td>";
                                    echo "<td>" . $promo->promotion->code . "</td>";
                                    echo "<td>" . mb_strtoupper($promo->promotion->label) . "</td>";
                                    echo "<td><a href='" . base_url('trainerGate/examination/results/') . '/' . $promo->promotion->code . '/' . permalink($res->code) . "' class='btn btn-sm btn-primary''>Afficher</a></td>";
                                    echo "</tr>";
                                }
                        }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT -->

<?php
if(!empty($message)) {
    if (is_bool($status) and $status) echo "<script type='text/javascript'>alertify.success($message);</script>";
    else echo "<script type='text/javascript'>alertify.error($message);</script>";
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        leftM(2, '#panel-evaluation');
    });
</script>
