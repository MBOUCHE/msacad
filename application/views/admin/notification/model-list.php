<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES MODELS DE NOTIFICATION') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/notification/formAdd')?>" class="w3-btn w3-blue w3-round">Ajouter un model</a>
            </div>

            <div class="col-sm-12 w3-responsive">
                <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Models</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody id="table-list">
                    <?php
                    if(isset($notif) And count($notif)>0)
                    {
                        $i=0;
                        foreach($notif as $liste)
                        {
                            echo    '<tr id="'.$liste->id.'"><td class="text-center">' . ++$i . '</td>'.
                                        '<td>' . $liste->content . '</td>'.
                                        '<td class="text-center">
                                            <a href="'.base_url('notification/modify/'.$liste->id).'" class="w3-btn w3-white w3-small w3-margin-small" title="Modifier">
                                                <i class="fa fa-2x fa-pencil w3-text-dark-grey" aria-hidden="true" style="cursor: pointer;"></i>
                                            </a>
                                            <button class="lock w3-btn w3-white w3-small w3-margin-small publier" title="Publier" onclick="publish(this)">
                                                <i class="fa fa-2x fa-share-alt w3-text-blue" aria-hidden="true" style="cursor: pointer;"></i>
                                            </button>
                                        </td>'.
                                    '</tr>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="3"  class="h3 text-center"><a href="'.base_url('notification/save').'" class="text-warning">Aucune notification enregistré pour le moment ...</a><td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>

        function rolesChange($this){
            $this = $($this);
            var $vague = $this.parent().parent().parent().parent().find('#vague');
            if($this.val() == 2){
                $vague.removeClass('w3-hide');
            }else if(!$vague.hasClass('w3-hide')){
                $vague.addClass('w3-hide');
            }
        }

        function publish($this){
            $.loader({className: 'blue-with-image-2', content: ''});
            var idDoc = $($this).parent().parent().attr('id');
            $.post('<?php echo base_url('admin/notification/modalPublishContent')?>', {mode: 'js', notif: idDoc}, function(rep){
                    $.loader('close');
                    alertify.confirm(rep,
                        function(){$('#formPublish').trigger('submit');}
                    ).setHeader('Publicaion de notification').set({reverseButtons: true});
                }
            ).fail(function() {
                    $.loader('close');
                });
        }

        $(document).ready(function(){
            alm('collapseNotif', 0);
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>

        });
    </script>
</div>
<!-- /.content-wrapper -->