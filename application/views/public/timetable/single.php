<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <table class="col-sm-12 edt mb-2 table-responsive">
                    <tr id="head">
                        <td class="title w3-white hor" style="width: 3%" align="center">
                            <a href="<?php echo base_url('emplois-de-temps/planning/'.$forID.'/print') ?>" class="w3-btn top-link orange-bg-color w3-round" target="_blank"><i class="fa fa-print w3-text-white" aria-hidden="true"></i> </a>
                        </td>
                        <td class="title ">Lundi</td>
                        <td class="title ">Mardi</td>
                        <td class="title ">Mercredi</td>
                        <td class="title ">Jeudi</td>
                        <td class="title ">Vendredi</td>
                        <td class="title ">Samedi</td>
                    </tr>
                    <?php
                    foreach ($timetable as $time=>$val){
                        echo "<tr class='tofix' style=''>";
                        echo '<td class="time w3-text-white " align="center">'.$time.'</td>';

                        foreach ($val as $class)
                        {
                            echo '<td class="drop">';
                            echo '<div class="fixed assigned w3-card  w3-display-container" style="position: static; left: 23px; top: 555px;">'.($class=="Libre"?'<p style="vertical-align: middle">'.$class.'</p>': '<p>'.$class.'</p>').'</div>';
                            echo '</td>';
                        }

                        echo "</tr>";
                    }
                    ?>
                </table>
                <div class="fb-share-button" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Partager</a></div>
            </div>



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