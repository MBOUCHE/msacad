<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES LOGS')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Motifs</th>
                        <th>Auteur</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $k = 0;

                    for($i = 1; $i <= count($log); $i++)
                    {
                        echo '<tr><td class="text-center">' . ++$k . '</td>';
                        echo '<td>' . $log[$i-1]->date . '</td>';
                        echo '<td>' . $log[$i-1]->action . '</td>';
                        echo '<td>' . $log[$i-1]->motivation . '</td>';
                        echo '<td>' . $author[$i-1] . '</td></tr>';
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<script>
    $(document).ready(function(){
        alm('collapseJournaux', 0);
    });
</script>