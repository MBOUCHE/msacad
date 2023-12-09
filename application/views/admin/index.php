<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Tableau de bord') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card card-inverse card-primary o-hidden h-100">
                    <div class="card-block">
                        <div class="card-block-icon">
                            <i class="fa fa-fw fa-bell"></i>
                        </div>
                        <div id="admin-notif" class="mr-auto">
                            <div class="w3-xlarge"><?php echo $notif ?></div>
                            <div>Nouvelle(s) Notification(s)!</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('admin/notification').'?new=0' ?>" class="card-footer clearfix small z-1">
                        <span class="float-left">Détails</span>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card card-inverse card-success o-hidden h-100">
                    <div class="card-block">
                        <div class="card-block-icon">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div class="mr-auto">
                            <div class="w3-xlarge"><?php echo $inscrit ?></div>
                            <div>Nouveau(x) Inscrit(s)!</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('admin/registration') ?>" class="card-footer clearfix small z-1">
                        <span class="float-left">Détails</span>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
             <div class="col-md-12">
                <h2><?php echo mb_strtoupper("PROGRESSION DES VAGUES").'' ?></h2>

                <div class="col-md-12 col-lg-12">
                    <table class="table small" id='dataTable'>
                    	<thead>
                            <tr>
                            	<th class="w3-hide">#</th>
                                <th>Vagues</th>
                                <th>Progression</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($pending) and isset($somH) and is_array($pending) and is_array($somH)){
                            //var_dump($code);
                            $i = 0;
                            foreach ($pending as $item) {
                                if($somH[$i] == null)
                                    $somH[$i] = 0;
                                ?>
                                <tr>
	                                <td class="w3-hide"><?php echo $i ?></td>
                                    <td style="width: 50%;">

                                        <?php echo mb_strtoupper($acadProfil[$i]->label) ?> <br>
                                        Vague : <b><?php echo $acadProfil[$i]->promCode ?></b><br>
                                    </td>
                                    <td>
                                        <div class="progress mini">
                                            <div class="progress-bar progress-bar-success" style="width: <?php echo $item ?>%"></div>
                                        </div>
                                        <span>Progression</span><span class="pull-right"><small><?php echo $somH[$i]?>h/<?php echo $acadProfil[$i]->duration?></small></span>

                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 col-lg-12">
                <br><br>
                <div id="chartContainer1" style="width: 100%; height: 500px;display: inline-block;"></div>
                <br><br>
                <div id="chartContainer2" style="width: 100%; height: 500px;display: inline-block;"></div>
                <br><br>
                <div id="chartContainer3" style="width: 45%; height: 400px;display: inline-block;"></div>
                <div id="chartContainer4" style="width: 45%; height: 400px;display: inline-block;"></div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
         $(function () {
            //Better to construct options first and then pass it as a parameter
            var options1 = {
                zoomEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Inscriptions par filières"
                },
                axisY: {
                    stripLines: [{
                        value: <?php echo $avg1 ?>,
                        label: "Moyenne",
                        showOnTop: true
                    }
                    ]
                },

                data: [
                    {
                        type: "bar",
                        dataPoints: [
                            <?php
                                $start=10;
                                if(!empty($ch1))
                                foreach ($ch1 as $k=>$ch)
                                {
                                    echo "{ x: $start, y: $ch->reg, label: '".mb_strtoupper(excerpt($ch->code,30))."' }";
                                    $start+=10;
                                    if ($k<count($ch1)-1)
                                        echo ",";
                                }
                            ?>
                        ]
                    }
                ]
            };
            $("#chartContainer1").CanvasJSChart(options1);
        });
        $(function () {
            //Better to construct options first and then pass it as a parameter
            var options2 = {
                zoomEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Inscriptions par cours"
                },
                axisY: {
                    stripLines: [{
                        value: <?php echo $avg2 ?>,
                        label: "Moyenne",
                        showOnTop: true
                    }
                    ]
                },

                data: [
                    {
                        type: "bar",
                        dataPoints: [
                            <?php
                                $start=10;
                                if(!empty($ch5))
                                foreach ($ch5 as $k=>$ch)
                                {
                                    echo "{ x: $start, y: $ch->reg, label: '".mb_strtoupper(excerpt($ch->code,30))."' }";
                                    $start+=10;
                                    if ($k<count($ch5)-1)
                                        echo ",";
                                }
                            ?>
                        ]
                    }
                ]
            };
            $("#chartContainer2").CanvasJSChart(options2);
        });
        
         $(function () {
            //Better to construct options first and then pass it as a parameter
            var options2 = {
                title: {
                    text: "Inscriptions par mois et par année"
                },
                animationEnabled: true,
                axisY: {
                    includeZero: true,
                    maximum: 50,
                    valueFormatString: "#",
                    suffix: ""
                },
                axisX: {
                    title: "Mois"
                },
                toolTip: {
                    shared: true,
                    content: "<span style='\"'color: {color};'\"'><strong>{name}</strong></span> {y}"
                },

                data: [
                    <?php
                    $months=array('Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Dec');

                    if ($ch2)
                        foreach($ch2 as $i=>$ch)
                        {
                            echo "{type: 'splineArea', showInLegend: true, name: '$ch->name', dataPoints: [";
                            foreach ($ch->months as $k=>$mnt)
                            {
                                echo "{ x: $mnt->month, y: {$mnt->value}}".PHP_EOL;
                                if ($k<11) echo ",";
                            }
                            echo "]}";
                            if ($i<5) echo ",";
                        }
                    ?>
                ]
            };
            $("#chartContainer3").CanvasJSChart(options2);
        });

        $(function () {
            //Better to construct options first and then pass it as a parameter
            var options = {
                title: {
                    text: "Vagues"
                },
                animationEnabled: true,
                legend: {
                    verticalAlign: "bottom",
                    horizontalAlign: "center"
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{y} - <strong>#percent%</strong>",
                        dataPoints: [
                            { y: <?php echo $ch3->opened ?>, legendText: "Ouvertes", indexLabel: "O" },
                            { y: <?php echo $ch3->suspended ?>, legendText: "Suspendues", indexLabel: "S" },
                            { y: <?php echo $ch3->pending ?>, legendText: "En cours", exploded: true, indexLabel: "E" },
                            { y: <?php echo $ch3->finished ?>, legendText: "Achevées", indexLabel: "A" }
                        ]
                    }
                ]
            };
            $("#chartContainer4").CanvasJSChart(options);
        });
    });
</script>
