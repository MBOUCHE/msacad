<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Liste des Logs')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Motifs</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($log) And is_array($log) and !empty($log))
                    {
                        $k = 0;
                        for($i = 1; $i <= count($log); $i++)
                        {
                            echo "<tr>";
                            echo '<td class="text-center">' . ++$k . '</td>';
                            echo '<td>' . $log[$i-1]->date . '</td>';
                            echo '<td>' . $log[$i-1]->action . '</td>';
                            echo '<td>' . $log[$i-1]->motivation . '</td>';
                            echo "</tr>";
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="10"  class="h3 text-center">Aucun log pour cet apprenant ...<td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function(){
            $('#log').DataTable();
        })
    </script>
</div>
<!-- /.content-wrapper -->
