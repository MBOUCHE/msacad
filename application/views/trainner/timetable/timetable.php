<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <?php if ($status==true){?>
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Emploi du temps') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px" class="w3-margin-bottom">
                <b>Semaine :</b> du <?php echo "lundi ".$week['debut']." au samedi ".$week['fin'] ?>
                <hr width="70%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/session/generateTimetable')?>" class="w3-btn w3-blue w3-round">Générer un emploi du temps</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <a href="<?php echo base_url('trainner/session/printTimeTable/'.$timetableStartDate) ?>" class="w3-right w3-btn w3-blue w3-round" target="_blank"><i class="fa fa-print w3-text-white" aria-hidden="true"></i> Imprimer</a>
            </div>
            <div class="col-sm-12 table-responsive ">
                <div style="min-width:700px; max-width: 1000px; font-family: Oxygen;" class="w3-margin">
                    <div class="right">
                        <table>
                            <tr>
                                <td class="blank"></td>
                                <td class="title">Lundi</td>
                                <td class="title">Mardi</td>
                                <td class="title">Mercredi</td>
                                <td class="title">Jeudi</td>
                                <td class="title">Vendredi</td>
                                <td class="title">Samedi</td>

                            </tr>
                            <?php
                                foreach ($timetable as $time=>$val){
                                    echo "<tr class='tofix'>";
                                    echo '<td class="time w3-light-green w3-text-white ">'.$time.'</td>';

                                    foreach ($val as $class)
                                    {
                                        echo '<td class="drop">';
                                        echo '<div class="fixed assigned w3-card small w3-display-container" style="position: static; left: 23px; top: 555px;">'.($class=="Libre"?'<p style="vertical-align: middle">'.$class.'</p>': '<p>'.$class.'</p>').'</div>';
                                        echo '</td>';
                                    }

                                    echo "</tr>";
                                }
                            ?>
                        </table>

                    </div>
                </div>
            </div>
            <?php } else {?>
            <div class="h3 text-center col-sm-12 w3-text-red">
                <i class="fa fa-table"></i> Cet emploi du temps n'existe pas.
                <hr>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<style type="text/css">
    .left{
        width:auto;
        float:left;
    }
    .right{
        float:right;
        min-width:570px;
        max-width: 1000px;
    }
    .right table{
        background:#E0ECFF;
        width:100%;
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
    .right td.drop{
        background:#CCCCCC;
        width:100px;
    }
    .right td.over{
        background:#FBEC88;
    }
    .item{
        text-align:center;
        background:#fafafa;
        /*color:#444;*/
        min-width: 110px;
        max-width: 130px;
        margin:2px;
        padding: 2px;
    }

    .assigned{
        /*border:1px solid #BC2A4D;*/
        padding: 5px;
        height: inherit;
    }
    .trash{
        background-color:red;
    }

</style>
<script>
    $(document).ready(function(){
        alm('collapseSess');
        (function () {
            $('.tofix').each(function(){
                var tr=$(this);
                var h=tr.css('height');
                var divs=tr.find('div.w3-card');
                divs.each(function(){
                    var toFix=$(this);
                    toFix.css('text-align', 'center');
                    toFix.css('background', '#fafafa');
                    toFix.css('width', '135px');
                    toFix.css('height', h);
                    //toFix.css('margin', '2px');
                    //toFix.css('padding', '2px');
                });
            });

        })();
    });
</script>