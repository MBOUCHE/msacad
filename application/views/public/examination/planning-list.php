<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="row btn-sm">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover " width="100%" id="dataTable" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="hidden">#</th>
                                <th>Semaine</th>
                                <th>Date de publication</th>
                                <th></th>
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
                                    echo "<td class='hidden'>".$line."</td>";
                                    echo "<td>Du $week->start au $week->end</td>";
                                    echo "<td>".date('\L\e d/m/Y à H \h i \m\i\n s \s', strtotime($plan->publish_date))."</td>";
                                    echo "<td>
                                      <a href='".base_url().$plan->link."' class='btn btn-primary btn-sm' title='Télécharger'><i class='fa fa-download fa-2x'></i> Télécharger</a>";
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
    </div>

</div>

<!-- /.content-wrapper -->
