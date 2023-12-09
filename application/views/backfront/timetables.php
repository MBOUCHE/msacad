<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12" style="margin: 0 !important">
                <h3 class="text-center"><?php echo mb_strtoupper('Emplois du temps') ?> </h3>
            </div>
        </div>
        <hr />
        <br><br>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 table-responsive w3-padding-24">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Semaine</th>
                        <th>Options</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    foreach ($timetables as $tb)
                    {
                        $line++;
                        $stat="";
                        $date = explode("/", $tb['debut']);
                        $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
                        $sd=date('Y-m-d', $time);
                        $date = explode("/", $tb['fin']);
                        $time = strtotime($date[2].'-'.$date[1].'-'.$date[0]);
                        $ed=date('Y-m-d', $time);
                        if ($sd<=date('Y-m-d', strtotime($today['debut']))) $stat="w3-hide";
                        echo "<tr>";
                        echo "<td><span style='padding: 7px;'>".$line."</span></td>";

                        echo "<td> Du ".date('d/m/Y', strtotime($sd))." au ".date('d/m/Y', strtotime($ed))."</td>";
                        echo "<td>
                                  <a href='".base_url(lcfirst(role_tostring(session_data('role'), 'en')).'Gate/timetable/planning/')."/$sd' id='$sd' class='w3-btn w3-white w3-margin-small look'  title=\"Visualiser\"><i class='fa fa-search fa-2x w3-text-blue'></i></a>";
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
<!-- END PAGE CONTENT -->


<script type="text/javascript">
    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
    <?php
    if(!empty($message)) {
        if (is_bool($status) and $status) echo "alertify.success($message);";
        else echo "alertify.error($message);";
    }
    ?>
        leftM(0, '#panel-timetable');
    });
</script>
