<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Liste des infos flash') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-margin-top">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/infoFlash/formAdd') ?>">Ajouter un info flash</a>
                        </div>
                    </div>
                    <div class="col-sm-12 w3-responsive">
                        <?php
                        if(isset($flashs) And count($flashs)>0) {
                            $i=0;
                            ?>
                            <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Contenu</th>
                                    <th>Statut</th>
                                    <th class="w3-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="table-list">
                                <?php foreach($flashs as $liste)
                                {
                                    if(!(int)$liste->state) {
                                        $statue = 'Bloqué';
                                        $btn['js'] = 'onclick="unlock('.$liste->id.')"';
                                        $btn['fa'] = '<i class="fa fa-unlock fa-2x w3-text-green" aria-hidden="true"></i>';
                                        $btn['title'] = 'Débloqué';
                                    }
                                    else {
                                        $statue = '';
                                        $btn['js'] = 'onclick="lock('.$liste->id.')"';
                                        $btn['fa'] = '<i class="fa fa-lock fa-2x w3-text-red" aria-hidden="true"></i>';
                                        $btn['title'] = 'Bloqué';
                                    }

                                    echo '<tr id="'.$liste->id.'"><td class="text-center" style="vertical-align: middle">' . ++$i . '</td> ';

                                    echo '<td style="vertical-align: middle;"><div>'.excerpt($liste->content, 200).'</div></td>';

                                    echo '<td style="vertical-align: middle"><div>'.$statue.'</div></td>';

                                    echo '<td class="w3-center">
                                            <button class="w3-white w3-btn w3-margin-left w3-margin-top" title="'.$btn['title'].'" '.$btn['js'].'>'.$btn['fa'].'</button>
                                            <a href="'.base_url('moderatorGate/infoFlash/formEdit/'.$liste->id).'" title="Modifier" class="w3-white w3-btn w3-margin-left w3-margin-top edit"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                        </td></tr>';
                                } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                            <div class="h3 text-center w3-text-orange">Aucun info flash enregistré ...</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">

                function lock(id)
                {
                    alertify.confirm('Voulez vous vraiment bloquer ce flash?', function(){
                        $.loader({className:"blue-with-image-2", content:''});
                        var data = {lock_id: id, mode: 'js'};
                        $.post('<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/infoFlash/updateState') ?>', data, function(){
                            $.loader('close');
                            $(location).prop('href', '');
                        }).fail(function() {
                            $.loader('close');
                        });
                    }).setHeader('Confimation de blocage:');
                }

                function unlock(id)
                {
                    alertify.confirm('Voulez vous vraiment débloquer ce flash?', function(){
                        $.loader({className:"blue-with-image-2", content:''});
                        var data = {unlock_id: id, mode: 'js'};
                        $.post('<?php echo base_url(strtolower(role_tostring(session_data('role'), 'en')).'Gate/infoFlash/updateState') ?>', data, function(){
                            $.loader('close');
                            $(location).prop('href', '');
                        }).fail(function() {
                            $.loader('close');
                        });
                    }).setHeader('Confimation de déblocage:');
                }

                $(document).ready(function(){
                    <?php if($val = get_flash_data()){
                        echo 'setTimeout(function(){
                            alertify.'.$val[0].'("'.$val[1].'");
                        }, 750);';
                    } ?>

                    leftM(0, '#panel-flash');
                })
            </script>
        </div>
    </div>

</div>
<!--END PAGE CONTENT -->