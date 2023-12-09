<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center col-sm-12">
                LISTE DES PLANNINGS D'EXAMENS
                <hr>
            </div>

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

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<style>
    .legend
    {
        text-decoration: none;
        display: inline-block;
        float: left;
        margin-left: 15px;
    }

    .legend span
    {
        padding: 7px;
        border: dashed;
        border-color: #0a0a0a;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        alm('collapseExa',0);
        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
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
        alertify.defaults.theme.ok = "btn btn-primary";
    });
</script>