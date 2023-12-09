<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Liste des emplois du temps') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/session/generateTimetable')?>" class="w3-btn w3-blue w3-round">Générer un emploi du temps</a>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <!--th rowspan="2">Photo</th-->
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
                                  <a href='".base_url('trainner/session/timetable')."/$sd' id='$sd' class='w3-btn w3-white w3-margin-small'  title=\"visualiser\" target=\"_blank\"><i class='fa fa-search fa-2x w3-text-blue'></i></a>
                                  <button id='$sd' class='w3-btn w3-white w3-margin-small $stat delTb'  title=\"Supprimer\" onclick='delTb(this)'><i class='fa fa-trash fa-2x w3-text-red'></i></button>";
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
<!-- /.content-wrapper -->

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
<?php
if(!empty($message)) {
    if (is_bool($status) and $status) echo "<script type='text/javascript'>alertify.success($message);</script>";
    else echo "<script type='text/javascript'>alertify.error($message);</script>";
}
?>

<script type="text/javascript">
    function delTb($this){
        var id=$($this).prop('id');
        alertify.confirm("Suppression de l'emploi du temps", "Êtes-vous sûr de vouloir supprimer cet emploi du temps?",
            function(){
                window.location.href="<?php echo base_url('trainner/session/timetableDelete/') ?>"+'/'+id;
            },
            function(){
                alertify.error('Annulé');
            });
    }

    $(document).ready(function(){
        alm('collapseSess', 0);
    });
</script>
