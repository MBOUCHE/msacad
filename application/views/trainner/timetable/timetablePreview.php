<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <?php if(!isset($status)){ ?>
            <div class="h3 text-center col-sm-12">
                Emploi du temps
                <hr>
            </div>
            <div class="h4 text-center col-sm-12">
                <b>Semaine : </b> Du lundi <?php echo $week['debut']." au samedi ".$week['fin'] ?>
                <hr>
            </div>

            <div class="col-sm-12 table-responsive ">
<script src="<?php echo js_url('jquery.easyui.min')?>"></script>
<div class="demo-info" style="margin-bottom:10px">
    <div class="h3 text-center">Glissez et déposer les promotions vers le planning.</div>
</div>
<div class="demo-info" style="margin-bottom:10px">
    &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn w3-btn w3-blue" id="subT"><i class="fa fa-1x fa-check"></i>  Confirmer</button>
</div>

<div style="min-width:700px; max-width: 880px; font-family: Oxygen;" class="w3-margin">
    <div class="left">
        <table>
            <tr><td class="text-center">module</td></tr>

            <?php
            echo "<tr>";
            echo '<td>';
            echo '</td>';
            echo "</tr>";
            $colors=array(
                    array('w3-blue', 0),
                    array('w3-green', 0),
                    array('w3-purple', 0),
                    array('w3-teal', 0),
                    array('w3-yellow', 0),
                    array('w3-brown', 0),
                    array('w3-orange w3-text-white', 0),
                    array('w3-pink', 0),
                    array('w3-indigo', 0),
                    array('w3-cyan', 0)
            );

                foreach ($promotions as $key=>$pr)
                {
                    $color="";
                    $emphasis="";
                    $cnt=0;
                    $vague="";
                    for ($i=0; $i<sizeof($colors) && $cnt!=1; $i++)
                    if (is_integer($colors[$i][1])) {
                        $color=$colors[$i][0];
                        $promotions[$key][4]=$color;
                        $vague="Vague " . $pr[2] . "</b> <br>(<em>" . $pr[3]."</em>)";
                        $colors[$i][1]=$vague;
                        $cnt=1;
                        if ($pr[1] > 0) {
                            $emphasis = " nprog w3-border w3-border-green";
                        }
                    }
                    $color.=$emphasis;

                    echo "<tr>";
                    echo '<td>';
                    echo '<div class="item '. $color .' w3-card small" id="pr'.$pr[0].'">'.$vague.'</div>';
                    echo '</td>';
                    echo "</tr>";
                }
            echo "<tr>";
            echo '<td>';
            echo "<div></div>";
            echo '</td>';
            echo "</tr>";

            echo "<tr>";
                echo '<td>';
                    echo '<div class="item w3-red w3-card small crash" id="cr"><i class="fa fa-2x fa-trash"></i> Effacer</div>';
                echo '</td>';
            echo "</tr>";
            ?>

        </table>
    </div>
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
                /*var_dump($timetable);
                var_dump($promotions);
                die();*/
                $line=0;
                $idTd=0;
                //var_dump($promotions);
                foreach ($periods as $period){
                  $line++;
                    $day=0;

                        foreach ($timetable[$line] as $time)
                        {
                            $color="";$vide="";
                            $cnt=0;
                            $day++;
                            $idTd++;
                            $pid=0;
                            foreach ($promotions as $pr)
                            {
                                $vague="Vague " . $pr[2] . "</b> <br>(<em>" . $pr[3]."</em>)";
                                if ($vague==$time[0])
                                {
                                    $color=$pr[4];
                                    $pid="pr".$pr[0];
                                    break;
                                } else if ($time[0]=="Libre")
                                {
                                    $color="w3-white";
                                    $vide="clean";
                                }
                            }
                            echo '<td class="drop d'.$day.' '.$vide.'" id="pid'.$idTd.'">';
                            echo '<div class="fixed assigned '.$color.' w3-card small" style="position: static; left: 23px; top: 555px;" id="'.$pid.'">'.$time[0].'</div>';
                            echo '</td>';
                        }

                    echo "</tr>";
                }
            ?>
        </table>

    </div>
</div>
                <form method="post" action="saveTimetable" id="generate">
                    <input type="hidden" name="program" id="subTest" value=""/>
                    <input type="hidden" name="start_date" id="start_date" value="<?php echo $week['debut'] ?>"/>
                    <input type="hidden" name="end_date" id="end_date" value="<?php echo $week['fin'] ?>"/>
                    <!--input type="submit" name="send" value="Confirmer" /-->
                </form>
            </div>
            <?php } else { ?>
            <div class="h3 text-center col-sm-12 w3-text-red">
                <i class="fa fa-table"></i> Désolé mais cette page est inaccessible
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
    .left table{
        background:#E0ECFF;
    }
    .left td{
        background:#eee;
    }
    .right{
        float:right;
        min-width:570px;
        max-width: 650px;
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

    .fixed
    {
        text-align:center;
        background:#fafafa;
        /*color:#444;*/
        width: 110px;
        height: 100px;
        margin:2px;
        padding: 2px;
        hei
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
    $(function(){
        alm('collapseSess', 1);
        $('.nprog').append('<br><i class="fa fa-warning w3-text-yellow"></i><b>  Non ou pas totalement programmé</b>');
        $('.left .item').draggable({
            revert:true,
            proxy:'clone'
        });
        function fix() {
            var toFix=$('.fixed');
            toFix.css('text-align', 'center');
            toFix.css('background', '#fafafa');
            toFix.css('width', '110px');
            toFix.css('height', '100px');
            toFix.css('margin', '2px');
            toFix.css('padding', '2px');
        }

        function fixP(elm) {
            elm.css('text-align', 'center');
            elm.css('background', '#fafafa');
            elm.css('width', '110px');
            elm.css('height', '100px');
            elm.css('margin', '2px');



            elm.css('padding', '2px');
        }
        fix();
        $('.right td.drop').droppable({
            onDragEnter:function(){
                $(this).addClass('over');
            },
            onDragLeave:function(){
                $(this).removeClass('over');
            },
            onDrop:function(e,source){
                $(this).removeClass('over');
                if($(source).hasClass('crash')){
		var free=$("<div id='0'></div>").text("Libre");
                    free.addClass("fixed assigned w3-white w3-card small");
                    $(this).empty().append(free);

                    $(this).addClass('clean');
                    fixP(free);
                }
                else if ($(source).hasClass('assigned')){
                    $(this).append(source);
                } else {
                    var c = $(source).clone().addClass('fixed assigned');
                    c.removeClass('nprog');
                    c.removeClass('item');
                    c.removeClass('w3-border');
                    c.removeClass('w3-border');
                    if($(this).hasClass('clean'))
                    {
                        $(this).empty().append(c);
                        $(this).removeClass('clean');
                    }
                    else
                        $(this).append(c);
                    fixP(c);
                    c.find('b').remove();
                    c.find('i').remove();
                    /*c.draggable({
                        revert:false
                    });*/
                }
                //console.log(source);
            }
        });
        $('.left').droppable({
            accept:'.assigned',
            onDragEnter:function(e,source){
                $(source).addClass('trash');
            },
            onDragLeave:function(e,source){
                $(source).removeClass('trash');
            },
            onDrop:function(e,source){
                $(source).remove();
            }
        });

        function tryTime()
        {
            var program=[];
            for (i=1; i<=6; i++)
            {
                var curDay=$('.d'+i.toString());
                for (j=0; j<6; j++)
                {
                    var currentTD=curDay.eq(j);
                    var curClass=currentTD.children('div.w3-card');
                    if (curClass!==undefined)
                    {
                        if (curClass.prop('id')!=='0' && curClass.prop('id')!==undefined)
                        {
                            var prom ='#';
                            var k=0;
                            for( k=0;k<curClass.length;k++){
                                prom+=curClass.eq(k).prop('id').slice(2)+'#';
                            }
                            program.push([i, j+1, prom]);
                        }
                    }
                }
            }

        }

        /*$("#generate").submit(function () {
            $('#subTest').prop('value', tryTime());
        });*/

        $("#subT").on('click', function(){
            $('#subTest').prop('value', tryTime());
            //alert($('#subTest').prop('value'));
            alertify.confirm("Confirmation de l'emploi du temps", "Êtes-vous sûr de vouloir confirmer cet emploi du temps?",
                function(){
                    $("#generate").submit();
                },
                function(){
                    alertify.error('Annulé');
                });
        });
    });
</script>
