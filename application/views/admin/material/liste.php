<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('inventaire du matériel')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('material/save')?>" class="w3-btn w3-blue w3-round">Ajouter le matériel</a>
            </div>

            <div class="row col-md-12 float-right">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <a href="<?php echo base_url("material/printLysts") ?>" title="Imprimer l'inventaire!" class="w3-btn w3-blue w3-round w3-block"><h5><i class="fa fa-print"></i> Imprimer la liste</h5></a>
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
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
                            <th>Type de matériel</th>
                            <th>Conditionnement</th>
                            <th>Quantité</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $k = 0;
                                //var_dump($material);
                        if(isset($material) And is_array($material) and !empty($material)){
                                for($i = 1; $i <= count($material); $i++)
                                {
                                    //var_dump($material[$i]->id);
                                    echo '<tr><td class="text-center">' . ++$k . '</td>';
                                    echo '<td>' . ucfirst($material[$i-1]->name) . '</td>';
                                    echo '<td>' . ucfirst($material[$i-1]->type) . '</td>';
                                    echo '<td>' . ucfirst($material[$i-1]->packaging) . '</td>';
                                    echo '<td>'. $material[$i-1]->qty .'</td>';
                                    echo '<td>
                                                <a href="modify/'.$material[$i-1]->id.'" title="modifier"><i class="w3-btn fa fa-pencil fa-2x fa-w"></i></a>
                                                <a href="'.base_url("material/materialAction").'/'.$material[$i-1]->id.'/add" title="Ajouter du materiel" ><i class="w3-btn fa fa-plus fa-2x fa-w w3-text-green"></i></a>
                                                <a href="'.base_url("material/materialAction").'/'.$material[$i-1]->id.'/remove" title="retirer du materiel"><i class="w3-btn fa fa-minus fa-2x fa-w w3-text-red"></i></a>

                                            </td></tr>';
                                }
                            }
                            else
                            {
                                echo '<tr><td colspan="6"  class="h3 text-center"><a class="text-warning">Aucun Inventaire trouvé ...</a><td></tr>';
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
            alm('collapseMat', 0);
        });
    </script>
</div>
<!-- /.content-wrapper -->