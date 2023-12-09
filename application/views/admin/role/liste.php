<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Liste des rôles')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">N&#176;</th>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($query) And is_object($query))
                            {
                                $i=0;
                                foreach($query->result() as $role)
                                {
                                    echo '<tr><td class="text-center">' . ++$i . '</td>';
                                    echo '<td>' . $role->label . '</td>';
                                }
                            }
                            else
                            {
                                echo '<tr><td colspan="6"  class="h3 text-center"><a href="'.base_url('admin/lesson/save').'" class="text-warning">Aucune lesson enregistré pour le moment ...</a><td></tr>';
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