<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="h4 text-center  col-sm-12"><br>
                <b><?php echo mb_strtoupper('B').'ienvenue '.session_data('firstname').' '.session_data('lastname') ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h2><?php echo mb_strtoupper("Planning de la semaine").'' ?></h2>
            <div class="col-md-12 col-lg-12">
                <table class="table table-user-information">
                    <tbody>
                    <?php
                    if(isset($pending) and isset($somH) and is_array($pending) and is_array($somH)) {
                        //var_dump($planning);
                        $i = 0;
                        //foreach ($pending as $item) {
                        if ($somH[$i] == null) $somH[$i] = 0;  //var_dump($planning); //die(0); ?>
                        <?php
                        if ($planning == -1) { ?>
                            <tr>
                                <td>
                                    Aucun emploi de temps disponible pour cette semaine
                                </td>
                            </tr>
                            <?php
                        }else {
                            ?>
                            <tr>
                                <td>
                                    <table class="col-md-12 col-lg-12 col-sm-12 w3-card">
                                        <tr id="head">
                                            <td class="title w3-white">
                                                <a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')) . 'Gate/timetable/planning/' . $forID . '/print') ?>"
                                                   class="w3-btn w3-blue w3-round" target="_blank"><i
                                                        class="fa fa-print w3-text-white"
                                                        aria-hidden="true"></i> </a>
                                            </td>
                                            <td class="title w3-green">Lundi</td>
                                            <td class="title w3-green">Mardi</td>
                                            <td class="title w3-green">Mercredi</td>
                                            <td class="title w3-green">Jeudi</td>
                                            <td class="title w3-green">Vendredi</td>
                                            <td class="title w3-green">Samedi</td>
                                        </tr>
                                        <?php
                                        foreach ($timetable as $time => $val) {
                                            echo "<tr class='tofix' style=''>";
                                            echo '<td class="time w3-light-green w3-text-white ">' . $time . '</td>';

                                            foreach ($val as $class) {
                                                echo '<td class="drop">';
                                                echo '<div class="fixed assigned w3-card small w3-display-container" style="position: static; left: 23px; top: 555px;">' . ($class == "Libre" ? '<p style="vertical-align: middle">' . $class . '</p>' : '<p>' . $class . '</p>') . '</div>';
                                                echo '</td>';
                                            }

                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>


                        <?php }
                        $i++;
                        //}
                    }
                    ?>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12">
            <h2><?php echo mb_strtoupper("PROGRESSION DES ENSEIGNEMENTS").'' ?></h2>
            <!?php $pro = '23.9%' ?>
            <div class="col-md-12 col-lg-12">
                <table class="table table-user-information">
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
                                <td style="width: 50%;">

                                    <?php echo mb_strtoupper($acadProfil[$i]->label) ?> <br>
                                    Vague : <b><?php echo $acadProfil[$i]->promCode ?></b><br>
                                    Frais de formation : <b><?php echo number_format($acadProfil[$i]->amount,0,'',' ')  ?></b> CFA<br>
                                    Payé :  <b class="w3-text-green"><?php echo number_format($acadProfil[$i]->installment,0,'',' ') ?></b> CFA<br>
                                    Reste : <b class="w3-text-red"><?php echo number_format(intval($acadProfil[$i]->amount)- intval($acadProfil[$i]->installment),0,'',' ') ?></b> CFA

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
                    <tr>
                        <td colspan="2" align="center">
                            <a target="_blank" class="btn btn-success" href="<?php echo base_url('enseignements') ?>">S'inscrire à un autre enseignement</a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        
       <div class="col-md-12">
            <h2><?php echo mb_strtoupper("Documents utiles") ?></h2>

            <a href="<?php echo upload_url('static/livret-apprenant.pdf') ?>" class="btn btn-default">
                <i class="fa fa-download"></i> Livret de l'apprenant
            </a>
            <a href="#<?php //echo upload_url('static/manuel-apprenant.pdf') ?>" class="btn btn-default">
                <i class="fa fa-download"></i> Manuel de d'utilisation
            </a>
        </div>
        
        
        <div class="col-md-12 w3-margin-bottom" id="request">
            <h2><?php echo mb_strtoupper("VOS REQUêtes Envoyées") ?></h2>
            <div class="text-right"> <a href="<?php echo base_url('studentGate/home/submitRequest') ?>" class=" btn btn-primary w3-margin-bottom">Envoyer une requête <i class="fa fa-send"></i></a></div>
            <table class="table table-bordered table-hover small " width="100%" id="dataTable" cellspacing="0">
                <thead>
                <tr>
                    <th class="text-center" width="3%">N&#176;</th>
                    <th>Requête</th>
                </tr>

                </thead>
                <tbody>
                <?php
                $line=0;
                if (isset($requetes) and $requetes!=null and !empty($requetes))
                    foreach ($requetes as $req)
                    {
                        ?>

                        <tr>
                            <td><?php echo (++$line) ?></td>
                            <td>
                                <small class="w3-grey-text small">Requête du <?php echo moment($req->save_date)->format('d M Y')?></small><br>
                                <u>Objet</u> : <b><?php echo mb_strtoupper($req->subject) ?></b><br>
                                <div class="w3-margin-top w3-margin-bottom">
                                    <?php echo $req->content ?>
                                </div>
                                <?php
                                if($req->state==1){
                                    $stateClass="btn-success";
                                    $stateText = "Déjà traitée";
                                }
                                else{
                                    $stateClass="btn-default";
                                    $stateText = "Pas encore traitée";
                                }
                                ?>
                                <a class="pull-right btn disabled btn-xs <?php echo $stateClass ?>"><?php echo $stateText ?></a>
                            </td>
                        </tr>

                        <?php
                    }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style type="text/css">

    td.title{
        text-align: center;
    }

    .hor{
        width: 85px;
    }
    tr#head td:first-child{
        margin: 0;
    }
    tr#head,.time{
        background: #0275d8;
        color: #ffffff;
    }
    .right td{
        background:#fafafa;
        color:#444;
        text-align:center;
        padding:2px;
    }

    .right td{
        background:#E0ECFF;
    }

    .right td.over{
        background:#FBEC88;
    }
    .assigned{
        padding: 5px;
        height: inherit;
    }

    #table-planing td:first-child {
        vertical-align: middle !important;
    }

</style>

<script>
    $(document).ready(function(){
        leftM(0);
        (function () {
            $('.tofix').each(function(){
                var tr=$(this);
                var h=tr.css('height');
                var divs=tr.find('div.w3-card');
                divs.each(function(){
                    var toFix=$(this);
                    toFix.css('text-align', 'center');
                    toFix.css('background', '#ffffff');
                    //toFix.css('width', '120px');
                    toFix.css('height', h);
                    //toFix.css('margin', '2px');
                    //toFix.css('padding', '2px');
                });
            });

        })();
    });
</script>
