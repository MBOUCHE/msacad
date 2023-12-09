<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <?php if ($status==true){?>
            <div class="col-lg-12" style="margin: 0 !important">
                <h3 class="text-center"><?php echo mb_strtoupper('Emploi du temps') ?></h3>
                <hr width="60%" style="margin: auto; margin-top: 10px" class="w3-margin-bottom">
                <h5 class="text-center"><b>Semaine :</b> du <?php echo "lundi ".$week['debut']." au samedi ".$week['fin'] ?></h5>
            </div>
        </div>
        <hr />
        <br><br>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 table-responsive ">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 right">
                        <table class="col-md-12 col-lg-12 col-sm-12 w3-card">
                            <tr id="head">
                                <td class="title w3-white">
                                    <a href="<?php echo base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/timetable/planning/'.$forID.'/print') ?>" class="w3-btn w3-blue w3-round" target="_blank"><i class="fa fa-print w3-text-white" aria-hidden="true"></i> </a>
                                </td>
                                <td class="title w3-green">Lundi</td>
                                <td class="title w3-green">Mardi</td>
                                <td class="title w3-green">Mercredi</td>
                                <td class="title w3-green">Jeudi</td>
                                <td class="title w3-green">Vendredi</td>
                                <td class="title w3-green">Samedi</td>
                            </tr>
                            <?php
                                foreach ($timetable as $time=>$val){
                                    echo "<tr class='tofix' style=''>";
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
                <i class="fa fa-times"></i> Cet emploi du temps n'existe pas.
                <hr>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<style type="text/css">


    #head{
        background: navy;
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

        leftM(0, '#DDL2-nav');
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
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