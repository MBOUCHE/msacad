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
                        for($i = 0; $i < count($log); $i++)
                        {
                            echo '<tr><td class="text-center>' . $i . '</td>';
                            echo '<td>' . $log[$i]->date . '</td></td>';
                            echo '<td>' . $log[$i]->action . '</td></td>';
                            echo '<td>' . $log[$i]->motivation . '</td></td>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="3"  class="h4 text-center">Aucun log pour ce gérant ...<td></tr>';
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
            alm('collapseGerant');
        })
    </script>
</div>
<!-- /.content-wrapper -->
