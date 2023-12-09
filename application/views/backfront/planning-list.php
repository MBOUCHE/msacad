<div id="content">
    <div class="inner" style="min-height: 700px;">
            <div class="row">
                <div class="col-lg-12 w3-text-dark-gray">
                    <h3><b><?php echo mb_strtoupper("Plannings d'examens") ?></b> </h3>
                </div>
            </div>
            <hr />
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Semaine</th>
                        <th>Date de publication</th>
                        <th>Option</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if ($plannings!=null)
                        foreach ($plannings as $plan)
                        {
                            $line++;
                            $week=getWeek($plan->week, 'd/m/Y');
                            echo "<tr>";
                            echo "<td>".$line."</td>";
                            echo "<td>Du $week->start au $week->end</td>";
                            echo "<td>".date('\L\e d/m/Y à H \h i \m\i\n s \s', strtotime($plan->publish_date))."</td>";
                            echo "<td>
                                      <a href='".base_url().$plan->link."' class='w3-btn w3-white w3-margin-small' title='Télécharger'><i class='fa fa-download fa-2x w3-text-blue'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>

<!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function(){
        leftM(0, '#panel-evaluation');

        (function(){
            <?php
            if ($message=get_flash_data())
            if ($message[0]== "success") {
            ?>
            alertify.success("<?php echo $message[1] ?>");
            <?php
            } else { ?>
            alertify.defaults.theme.ok = "btn w3-red";
            alertify.defaults.glossary.ok = "OK";
            alertify
                .alert("<span class='w3-text-red'><i class='w3-text-red fa fa-ban'></i>  Erreur</span>", "<?php echo $message[1] ?>", function(){
                    alertify.error('Echec');
                });
            <?php   }
            ?>

        })();
    });
</script>