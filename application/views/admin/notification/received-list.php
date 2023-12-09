<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES NOTIFICATIONS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 w3-responsive">
                    <?php
                    if(isset($notif) And count($notif))
                    {
                        $i=0;
                        ?>
                    <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Content</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody id="table-list">
                        <?php
                        foreach($notif as $liste)
                        {
                            echo '<tr id="'.$liste->id.'"><td class="text-center">' . ++$i . '</td>';
                            echo '<td><div>'.trim($liste->content).'</div><div class="w3-margin-top">Envoyé par <b>' . ucfirst($liste->firstname).' '.(mb_strtoupper($liste->lastname)).'</b> ';
                            echo ($liste->send_date)?'<i class="w3-tiny w3-text-dark-grey w3-hide-small"><span class="send_date">'.moment($liste->send_date)->fromNow()->getRelative().'</span></i></div></td>':'<i class="w3-small w3-text-red">Pas publié</i></td>';
                            echo '<td>';
                            if($liste->url And !in_array(mb_strtolower($liste->url), array('#'))) {
                                $linkInfo = pathinfo($liste->url);
                                //var_dump($linkInfo); echo '<br>';
                                if (count($linkInfo) == 4 And in_array($linkInfo['extension'], array('pdf', 'doc', 'docx'))) {
                                    echo '<a href="' . $liste->url . '" target="_blank" data-toggle="tooltip" data-title="Télécharger">
                                            <i class="fa fa-2x fa-download w3-margin-right" aria-hidden="true"></i>
                                        </a>';
                                }else{
                                    echo '<a href="' . $liste->url . '" target="_blank" data-toggle="tooltip" data-title="Cliqué pour accéder au lien">
                                            <i class="fa fa-2x fa-link w3-margin-right" aria-hidden="true"></i>
                                        </a>';
                                }
                            }
                            echo '</td></tr>';
                        } ?>
                        </tbody>
                    </table>
                        <?php
                    }else{
                        echo '<div class="h3 text-center text-warning">Aucune notification pour le moment ...</div>';
                    }
                    ?>
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

    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
    })
</script>