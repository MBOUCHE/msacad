<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Liste des évènements') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-margin-top">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/event/formAdd') ?>">Ajouter un évènement</a>
                        </div>
                    </div>
                    <div class="col-sm-12 w3-responsive">
                        <?php
                        if(isset($events) And count($events)>0) {
                            $i=0;
                            ?>
                        <form class="w3-container" method="post" action="<?php echo base_url('moderatorGate/event/active') ?>" id="postForm">
                            <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Contenu</th>
                                    <th>Etat</th>
                                    <th>Statut</th>
                                    <th class="w3-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="table-list">
                                <?php foreach($events as $liste)
                                {
                                    if(moment($liste->start_date)->fromNow()->getSeconds()<0) {
                                        $statue = ucfirst(fromNow($liste->start_date));
                                        $edit = true;
                                    }
                                    else {
                                        $statue = 'Est passé ('.fromNow($liste->start_date).')';
                                        $edit = false;
                                    }


                                    if($liste->state == 1){
                                        $data = '';
                                    }
                                    else {
                                        $data = 'Bloqué';
                                    }

                                    echo '<tr id="'.$liste->id.'"><td class="text-center" style="vertical-align: middle">' . ++$i . '</td> ';


                                    echo '<td style="vertical-align: middle;"><div><b>'.$liste->title.'</b><br>'.excerpt($liste->content, 200).'</div></td>';

                                    echo '<td style="vertical-align: middle"><div>'.$statue.'</div></td>';

                                    echo '<td style="vertical-align: middle"><div>'.$data.'</div></td>';

                                    echo '<td class="w3-center">';

                                    if($edit)
                                        echo '<a href="'.base_url('moderatorGate/event/formEdit/'.$liste->id).'" title="Modifier" class="w3-white w3-btn w3-margin-left w3-margin-top edit"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>';

                                    if($data)
                                        echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-green" value="'.$liste->id.'" name="aid" title="activer"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i></button>';
                                    else
                                        echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-red" value="'.$liste->id.'" name="bid" title="bloquer"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></button>';

                                    echo '</td></tr>';
                                } ?>
                                </tbody>
                            </table>
                            </form>
                        <?php }else{ ?>
                            <div class="h3 text-center w3-text-orange">Aucun évènement enregistré ...</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    <?php if($val = get_flash_data()){
                        echo 'setTimeout(function(){
                            alertify.'.$val[0].'("'.$val[1].'");
                        }, 750);';
                    } ?>

                    leftM(0, '#panel-agenda');
                })
            </script>
        </div>
    </div>

</div>
<!--END PAGE CONTENT -->