<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="h4 text-center  col-sm-12"><br>
                <?php echo mb_strtoupper('B').'ienvenue '.session_data('firstname').' '.session_data('lastname') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <h2><?php echo mb_strtoupper("Planning de la semaine").'' ?></h2>
            <!?php $pro = '23.9%' ?>
            <div class="col-md-12 col-lg-12">
                <table class="table table-user-information">
                    <tbody>
                    <?php
                    if(isset($planning)) {
                        //var_dump($planning);
                        $i = 0;
                        //if ($somH[$i] == null) $somH[$i] = 0;  //var_dump($planning); //die(0); ?>
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
                    }else echo '<tr>
                                    <td>
                                        Aucun emploi de temps disponible pour cette semaine
                                    </td>
                                </tr>';
                    ?>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
	 <div class="col-md-12">
            <h2><?php echo mb_strtoupper("Documents utiles") ?></h2>

            <a href="<?php echo upload_url('static/evaluation.docx') ?>" class="btn btn-default ">
                <i class="fa fa-download"></i> Modèle d'épreuve pour une évaluation
            </a>
            <a href="<?php echo upload_url('static/examen.docx') ?>" class="btn btn-default">
                <i class="fa fa-download"></i> Modèle d'épreuve pour un examen
            </a>
            <a href="#<?php //echo upload_url('static/manuel-formateur.pdf') ?>" class="btn btn-default">
                <i class="fa fa-download"></i> Manuel de procédures
            </a>
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