<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:33px;font-family:Niconne">Tableau de bord</p>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-sm-8 mb-4">
                <div class="card card-inverse card-primary o-hidden h-100">
                    <div class="card-block">
                        <div class="card-block-icon">
                            <i class="fa fa-fw fa-desktop"></i>
                        </div>
                        <div id="trainner/-notif" class="mr-auto">
                            <div class="w3-xlarge">
                                <?php
                                    echo count($liste);
                                ?>
                                </div>
                            <div>cour(s)  enseigné(s) actuellement </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('trainner/notification') ?>" class="card-footer clearfix small z-1">
                        <span class="float-left">Détails</span>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-8 mb-4">
                <div class="card card-inverse card-danger o-hidden h-100">
                    <div class="card-block">
                        <div class="card-block-icon">
                            <i class="fa fa-fw fa-paint-brush"></i>
                        </div>  <div class="w3-xlarge">
                                <?php
                                    echo count($list);
                                ?>
                                </div>
                        <div class="mr-auto">
                            <div class="w3-xlarge"></div>
                            <div>Voir le(s) notification(s)</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('trainner/gerer') ?>" class="card-footer clearfix small z-1">
                        <span class="float-left">Détails</span>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
             <div class="col-xl-4 col-sm-8 mb-4">
                <div class="card card-inverse card-info o-hidden h-100">
                    <div class="card-block">
                        <div class="card-block-icon">
                            <i class="fa fa-fw fa-windows"></i>
                        </div>
                        <div id="trainner/-notif" class="mr-auto">
                            <div class="w3-xlarge"></div>
                            <div>autres informations</div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('trainner/notification').'?new=0' ?>" class="card-footer clearfix small z-1">
                        <span class="float-left">Détails</span>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
            </div>
</div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7" style="padding-top:50px;">
            <p style="color: gray;font-family: Comic Sans MS;font-size: 18px">nombre d'etudiant par vague</p>
            <canvas id="mychart"></canvas>
        </div>
        <div class="col-md-5" style="color: gray;font-family: Comic Sans MS;font-size: 18px;padding-top:50px;">
            <p>progression par vague</p>
            <canvas id="mchart"  style="padding-top: 55px"></canvas>
        </div>
     </div>
    </div>
</div>
<script type="text/javascript">
    let mychart=document.getElementById('mychart').getContext('2d');
    let variable2=new Chart(mychart,{
        type:'pie',
        data:{
            labels:[<?php
                    foreach ($liste as $key) {
                        echo "'"."(".$key['code_wave'].")'".",";
                    }
                ?>],
            datasets:[{
                label:'cours',
                data:[

                    50,
                    70,
                    10,
                    80,
                    
                ],
                backgroundColor:[

                    'pink',
                    '#db7093',
                    '#9370db',
                    'indigo',
                    '#1e90ff',
                ],
                borderWidth:1,
                borderColor:'#444',
                hoverBorderWidth:2,
                hoverBorderColor:'gray'
            }]
        },
        option:{}
    });
     let mchart=document.getElementById('mchart').getContext('2d');
    let variable1=new Chart(mchart,{
        type:'bar',
        data:{
            labels:[<?php
                    foreach ($liste as $key) {
                        echo "'".$key['code_wave']."'".",";
                    }
                ?>],
            datasets:[{
                label:'vagues',
                data:[

                    50,
                    70,
                    10,
                    80,
                    
                ],
                backgroundColor:[

                    '#00bfff',
                    '#8b0000',
                    '#00ff7f',
                    '#9370db',
                ],
                borderWidth:1,
                borderColor:'#444',
                hoverBorderWidth:2,
                hoverBorderColor:'gray'
            }]
        },
        option:{
            title:{
                display:true,
                text:'progression des vagues'
            },
            legend:{
                position:'right',
                labels:{
                    display:false,
                    fontColor:'red'
                }

            }
        }
    });
</script>












            