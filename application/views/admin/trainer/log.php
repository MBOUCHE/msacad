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
                    //var_dump($log); die(0);
                    if(isset($log) And is_array($log) and !empty($log))
                    {
                        //var_dump(count($log));
                        //var_dump($log);
                        $k = 0;
                        //var_dump($log);
                        for($i = 1; $i <= count($log); $i++)
                        {
                            //$state = $log[$i-1]->date;
                            //$bgcolor = ($state == -1)? 'red':($state == 0)? 'grey':'green';
                            echo '<tr><td class="text-center">' . ++$k . '</td>';
                            echo '<td>' . $log[$i-1]->date . '</td>';
                            echo '<td>' . $log[$i-1]->action . '</td>';
                            echo '<td>' . $log[$i-1]->motivation . '</td></tr>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="10"  class="h3 text-center">Aucun log pour ce formateur ...<td></tr>';
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
            alm('collapseForm');
            $('#log').DataTable();
        })
    </script>
</div>
<!-- /.content-wrapper -->
