<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES ENSEIGNEMENTS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/lesson/formAdd')?>" class="w3-btn w3-blue w3-round">Ajouter un enseignement</a>
            </div>
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">N&#176;</th>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Détails</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //LE&Ccedil;ONS
                            if(isset($query) And is_object($query))
                            {
                                $i=0;
                                foreach($query->result() as $liste)
                                {
                                    echo '<tr><td class="text-center">' . ++$i . '</td>';
                                    echo '<td>' . mb_strtoupper($liste->code) . '</td>';
                                    echo '<td>' . mb_strtoupper($liste->label) . '</td>';
                                    echo '<td>Durée : <b>' . $liste->duration . 'h</b> <br> Type : <b>' . ucfirst($liste->type) . '</b><br> Frais : <b>' .number_format($liste->fees,0,'',' ') . ' FCFA</b></td>';
                                    echo '<td>
                                            <a href='.base_url('trainner/lesson/edit/'.$liste->id).' title="modifier" class="lock w3-btn w3-white w3-small w3-margin-small"><i class="fa fa-pencil fa-2x w3-text-black"></i></a>
                                            <a title="supprimer" class="drop lock w3-btn w3-white w3-small w3-margin-small" value='.$liste->id.' onclick="drop(this)"><i class="fa fa-trash fa-2x w3-text-red"></i></a>
                                        </td></tr>';
                                }
                            }
                            else
                            {
                                echo '<tr><td colspan="6"  class="h3 text-center"><a href="'.base_url('trainner/lesson/save').'" class="text-warning">Aucun enseignement enregistré pour le moment ...</a><td></tr>';
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
            alm('collapseEns', 0);

            $('.drop').click(function(){
                var idL = $(this).attr('value'),
                    $tr = $(this).parent().parent();
                alertify.confirm(
                    '<p style="text-align: center;">Voulez vous vraiment suprimer l\'enseignement <br>'
                    + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
                    + '</p>',
                    function(){
                        $(location).attr('href', '<?php echo base_url('trainner/lesson/delete') ?>'+'/'+idL);
                    }
                ).setHeader('Confirmation de supression').set({reverseButtons: true});
            });

        });
    </script><script>
        function drop($this){
            var idL = $($this).attr('value'),
                $tr = $($this).parent().parent();
            alertify.confirm(
                '<p style="text-align: center;">Voulez vous vraiment suprimer l\'enseignement <br>'
                + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
                + '</p>',
                function(){
                    $(location).attr('href', '<?php echo base_url('trainner/lesson/delete') ?>'+'/'+idL);
                }
            ).setHeader('Confirmation de supression').set({reverseButtons: true});
        }

        $(document).ready(function(){
            alm('collapseEns', 0);
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->