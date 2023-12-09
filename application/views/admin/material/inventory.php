<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('TRANSACTION du matériel')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('material/lyst')?>" class="w3-btn w3-blue w3-round">Tout le matériel</a>
            </div>

            <div class="row col-md-12 float-right">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <a href="<?php echo base_url("material/printInventory") ?>" title="Imprimer l'inventaire!" class="w3-btn w3-blue w3-round w3-block"><h5><i class="fa fa-print"></i> Imprimer la liste</h5></a>
                </div>
                <div class="col-md-3">
                </div>
            </div>
            <div class="row col-md-12 float-right">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <?php
                    if(isset($message) And $message)
                    {
                        ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $message ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Nom</th>
                        <th>Conditionnemnt</th>
                        <th>Quantité</th>
                        <th>Type de transaction</th>
                        <th>Date de transaction</th>
                        <th>Transacteur</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $k = 0;
                    //$inventory = $inventory;
                    //var_dump($inventory[0]->name);
                    //var_dump($inventory['userName']);
                    //var_dump($inventory); die(0);
                    if(isset($inventory) And is_array($inventory) and !empty($inventory)) {
                        for ($i = 1; $i <= count($inventory['inventory']); $i++) {
                            //var_dump($inventory[$i]->id);
                            echo '<tr><td class="text-center">' . ++$k . '</td>';
                            echo '<td>' . ucfirst($inventory['inventory'][$i - 1]->name) . '</td>';
                            echo '<td>' . ucfirst($inventory['inventory'][$i - 1]->packaging) . '</td>';
                            echo '<td>' . $inventory['inventory'][$i - 1]->qty . '</td>';
                            echo '<td>' . strtoupper($inventory['inventory'][$i - 1]->transType) . '</td>';
                            echo '<td>' . $inventory['inventory'][$i - 1]->transDate . '</td>';
                            echo '<td>' . $inventory['userName'][$i - 1] . '</td></tr>';
                        }
                    }else
                    {
                        echo '<tr><td colspan="7"  class="h3 text-center"><a class="text-warning">Aucune transaction n\'a été trouvé ...</a><td></tr>';
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
            alm('collapseMat', 1);
        });
    </script>
</div>
<!-- /.content-wrapper -->