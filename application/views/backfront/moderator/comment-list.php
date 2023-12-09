<!--PAGE CONTENT -->
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Liste des commentaires<br>sujet: '.$title) ?>
                    <hr width="68%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-margin-top">
                    <div class="col-sm-12 w3-responsive">
                        <?php
                        if(isset($comment) And count($comment)>0)
                        {
                            $i=0;
                            ?>
                            <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Commentaires</th>
                                    <th class="w3-center">Statut</th>
                                    <th class="w3-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="table-list">
                                <?php foreach($comment as $liste)
                                {
                                    if($liste->visible == '1'){
                                        $data['b'] = '';
                                        $data['js'] = 'deleted(this)';
                                        $data['title'] = 'Bloquer';
                                        $data['class'] = 'w3-text-red delete w3-hover-text-red';
                                        $data['fa'] = 'fa-ban';
                                    }
                                    else {
                                        $data['b'] = 'Bloqué';
                                        $data['js'] = 'activated(this)';
                                        $data['title'] = 'Activer';
                                        $data['class'] = 'w3-text-green activated w3-hover-text-green';
                                        $data['fa'] = 'fa-check';
                                    }

                                    echo '<tr id="'.$liste->id.'"><td class="text-center"  style="vertical-align: middle">' . ++$i . '</td>';
                                    ?>
                                    <td>
                                        <?php echo $liste->content ?>
                                        Par <b><?php echo $liste->lastname ?></b><br>
                                        <b><?php echo moment($liste->post_date)->fromNow()->getRelative() ?></b><br>
                                    </td>
                                    <?php
                                    echo '<td class="w3-center" style="vertical-align: middle">'.$data['b'].'</td><td class="w3-center"><span title="'.$data['title'].'" class="w3-white w3-btn '.$data['class'].'" onclick="'.$data['js'].'"><i class="fa '.$data['fa'].' fa-2x" aria-hidden="true"></i></span></td></tr>';
                                } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                            <div class="h3 text-center w3-text-orange">Aucun sujet enregistré pour cette catégorie ...</div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <script src="<?php echo js_url('highlight.pack')?>"></script>
            <script type="text/javascript">

                function deleted($this){
                    var data = {type: 'comment', id: $($this).parent().parent().prop('id')};

                    alertify.confirm('Voulez vous vraiment bloquer ce commentaire?', function(){
                        $.loader({className: 'blue-with-image-2', content: ''});
                        $.post('<?php echo base_url('moderatorGate/forums/delete') ?>', data, function(rep){
                            $.loader('close');
                            if(rep.trim().split('*0*').length>1)
                                $(location).prop('href', '');
                        }).fail(function() {
                            $.loader('close');
                        });
                    }).setHeader('Blocage d\'un commentaire').set({reverseButtons: true});
                }

                function activated($this){
                    var data = {type: 'comment', id: $($this).parent().parent().prop('id')};

                    alertify.confirm('Voulez vous vraiment réactiver ce commentaire?', function(){
                        $.loader({className: 'blue-with-image-2', content: ''});
                        $.post('<?php echo base_url('moderatorGate/forums/activated') ?>', data, function(rep){
                            $.loader('close');
                            if(rep.trim().split('*0*').length>1)
                                $(location).prop('href', '');
                        }).fail(function() {
                            $.loader('close');
                        });
                    }).setHeader('Avtivation d\'un commentaire').set({reverseButtons: true});
                }

                $(document).ready(function(){
                    <?php if($val = get_flash_data()){
                        echo 'setTimeout(function(){
                            alertify.'.$val[0].'("'.$val[1].'");
                        }, 750);';
                    } ?>
                })
            </script>
        </div>
    </div>

</div>
<!--END PAGE CONTENT -->