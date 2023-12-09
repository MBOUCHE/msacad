<!--PAGE CONTENT -->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="h4 text-center col-sm-12 w3-margin-top">
                <?php echo mb_strtoupper('Tableau de bord') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-padding-small">
            <div class="col-xl-3 col-sm-6 w3-margin-bottom">
                <div class="w3-card-2">
                    <div class="cart-block">
                        <div class="w3-xxlarge w3-text-orange w3-dark-grey">
                            <i class="fa fa-fw fa-bell"></i>
                        </div>
                        <div id="admin-notif" class="mr-auto w3-padding-small w3-center">
                            <div class="w3-xlarge"><?php echo count($home->notif) ?></div>
                            <div>Nouvelle(s) Notification(s)!</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/notifications?new=0') ?>" class="small" style="text-decoration: none;">
                        <div class="card-footer w3-blue text-center">
                            Détails <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 w3-margin-bottom">
                <div class="w3-card-2">
                    <div class="cart-block">
                        <div class="w3-xxlarge w3-text-orange w3-dark-grey">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div id="admin-notif" class="mr-auto w3-padding-small w3-center">
                            <div class="w3-xlarge"><?php echo count($home->users) ?></div>
                            <div>Nouveau(x) Inscrit(s)!</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/user/newUsers') ?>" class="small" style="text-decoration: none;">
                        <div class="card-footer w3-blue text-center">
                            Détails <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-sm-6 w3-margin-bottom">
                <div class="w3-card-2">
                    <div class="cart-block">
                        <div class="w3-xxlarge w3-text-orange w3-dark-grey">
                            <i class="fa fa-fw fa-forumbee"></i>
                        </div>
                        <div id="" class="mr-auto w3-padding-small w3-center">
                            <div class="w3-xlarge"><?php echo count($home->posts) ?></div>
                            <div>Sujet(s) posté(s)!</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('forum') ?>" class="small" style="text-decoration: none;">
                        <div class="card-footer w3-blue text-center">
                            Détails <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 w3-margin-bottom">
                <div class="w3-card-2">
                    <div class="cart-block">
                        <div class="w3-xxlarge w3-text-orange w3-dark-grey">
                            <i class="fa fa-fw fa-comments"></i>
                        </div>
                        <div id="" class="mr-auto w3-padding-small w3-center">
                            <div class="w3-xlarge"><?php echo count($home->comments) ?></div>
                            <div>Réponses(s) postée(s)</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('forum') ?>" class="small" style="text-decoration: none;">
                        <div class="card-footer w3-blue text-center">
                            Détails <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="container">
                <div class="chart-container" style="position: relative; height:128px; width:80%">
                    <div class="w3-center w3-margin-bottom">
                        <canvas id='first_graph'></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function(){
            leftM(0);
<?php
$labels = array();
$data = array();
    foreach ($home->chartUPM as  $key=>$val) {
        array_push($labels, moment()->setMonth($key)->format('F'));
        array_push($data, $val);
        if($key==moment()->getMonth()) break;
    }
?>
            var ctx = $('#first_graph').get(0).getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels) ?>,
                    datasets: [{
                        label: 'Membre / moi en <?php echo moment()->format('Y') ?>',
                        data: <?php echo json_encode($data) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255,99,132,1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>
</div>
<!--END PAGE CONTENT -->
