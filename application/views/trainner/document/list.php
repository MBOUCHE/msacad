<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTES DES DOCUMENTS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/document/formUpload')?>" class="w3-btn w3-blue w3-round">Gerer une vague</a>
            </div>

            <div class="col-sm-12 w3-responsive">
                <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Code</th>
                        <th>Détails</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody id="table-list">
                    <?php
                    if(isset($document) and count($document)>0)
                    {
                        $i=0;
                        foreach($document as $liste)
                        {
							echo '<tr id="' . $liste->id . '"><td class="text-center">' . ++$i . '</td>';
							echo '<td>' . strtoupper($liste->code) . '</td>';
							echo '<td class="detail"><b>' . $liste->name.'</b>';
							if($liste->post_date = moment($liste->post_date))
								echo '<br><i>Mis en ligne le <span class="post_date">' . $liste->post_date->format('l, jS F Y à H:i:s') . '</span></i>';
							echo '<br><i class="w3-small w3-text-dark-grey">Derniere publication <span class="date">';
							echo ($liste->last_publish_date = moment($liste->last_publish_date))?$liste->last_publish_date->fromNow()->getRelative():'(Pas encore publié)';
							echo '</span></i></td>';
							echo '<td>
										<a href="' . base_url() . $liste->path . '" target="_blank" class="lock w3-btn w3-white w3-small w3-margin-small" title="Télécharger">
											<i class="fa fa-2x fa-download" aria-hidden="true"></i>
										</a>
										<button class="lock w3-btn w3-white w3-small w3-margin-small publier" title="Publier" onclick="publish(this)">
											<i class="fa fa-2x fa-share-alt-square w3-text-blue" aria-hidden="true" style="cursor: pointer;"></i>
										</button>
									</td></tr>';
						}
                    }
                    else
                    {
                        echo '<tr><td colspan="6"  class="h3 text-center"><a href="'.base_url('trainner/document/formUpload').'" class="text-warning">Aucun document enregistré pour le moment ...</a><td></tr>';
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
<script type="text/javascript">

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
        var idDoc = $($this).parent().parent().attr('id'),
            titre = 'Publier: '+$('#table-list tr#'+idDoc+' td').eq(2).find('b').text();
        $.post('<?php echo base_url('trainner/document/modalPublishContent')?>', {mode: 'js', doc: idDoc}, function(rep){
                $.loader('close');
                alertify.confirm(rep,
                    function(){$('#formPublish').trigger('submit');}
                ).setHeader(titre).set({reverseButtons: true});
            }
        ).fail(function() {
                $.loader('close');
            });
    }

    $(document).ready(function(){
        alm('collapseDoc', 0);
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
    })
</script>