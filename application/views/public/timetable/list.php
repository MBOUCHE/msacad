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
                                <th class="hidden text-center">N&#176;</th>
                                <th>Semaine</th>
                                <th>Options</th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            $line= 1;
                            foreach ($timetables as $tb)
                            {

                                $stat="";
                                $date = explode("/", $tb['debut']);
                                $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
                                $sd=date('Y-m-d', $time);
                                $date = explode("/", $tb['fin']);
                                $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
                                $ed=date('Y-m-d', $time);
                                if ($sd<=date('Y-m-d', strtotime($today['debut']))) $stat="w3-hide";
                                echo "<tr>";
                                echo "<td class='hidden'><span style='padding: 7px;'>".$line++."</span></td>";

                                echo "<td> Du ".date('d/m/Y', strtotime($sd))." au ".date('d/m/Y', strtotime($ed))."</td>";
                                echo "<td>
                                  <a href='".base_url('emplois-de-temps'.'/planning/')."/$sd' id='$sd' class='btn btn-primary btn-sm  w3-margin-small look'  title=\"Visualiser\">Afficher</a>";
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