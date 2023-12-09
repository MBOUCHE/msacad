<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Liste des nouvelles') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-margin-top">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/news/formAdd') ?>">Ajouter une nouvelle</a>
                        </div>
                    </div>
                    <div class="col-sm-12 w3-responsive">
                        <?php
                        if(isset($news) And count($news)>0) {
                            $i=0;
                        ?>
                        <form class="w3-container" method="post" action="<?php echo base_url('moderatorGate/news/active') ?>" id="postForm">
                            <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Contenu</th>
                                    <th class="w3-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="table-list">
                                <?php foreach($news as $liste)
                                {
                                    $statut = '';
                                    if($liste->state == 0) {
                                        $statut = '<span class="w3-text-red">Bloqué</span>';
                                    }

                                    $slider = true;
                                    if($liste->show_in_slider == 0){
                                        $slider = false;
                                    }

                                    ?>

                                    <tr id="<?php echo $liste->id?>">
                                        <td class="text-center" style="vertical-align: middle"><?php echo ++$i ?>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <div style="">
                                                <b><?php echo $liste->title?></b>
                                                <br><?php echo excerpt($liste->content, 150)?>

                                                <?php
                                                if($liste->thumbnail){
                                                    ?>
                                                    <div>
                                                        <img class="img-responsive w3-border" src="<?php echo base_url($liste->thumbnail)?>" alt="" style="max-height: 200px !important;">
                                                    </div><br>
                                                    <?php
                                                }?>
                                                <div><?php echo $statut?></div>
                                            </div>
                                        </td>


                                        <td class="w3-center">
                                            <?php
                                            if($liste->thumbnail) {
                                                if ($slider){
                                                    ?>
                                                    <button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top" value="<?php echo $liste->id?>" name="d_show" title="Ne pas afficher dans le slider"><i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i></button>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top" value="<?php echo $liste->id?>" name="show" title="Afficher dans le slider"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></button>
                                                    <?php
                                                }
                                            }
                                            if($statut){
                                                ?>
                                                <button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-green" value="<?php echo $liste->id?>" name="aid" title="activer"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i></button>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-red" value="<?php echo $liste->id?>" name="bid" title="bloquer"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></button>
                                                <?php
                                            }
                                                ?>
                                            <a href="<?php echo base_url('moderatorGate/news/formEdit/'.$liste->id)?>" title="Modifier" class="w3-white w3-btn w3-margin-left w3-margin-top edit"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                    <?php

                                    /*echo '<tr id="'.$liste->id.'"><td class="text-center" style="vertical-align: middle">' . ++$i . '</td> ';

                                    echo '<td style="vertical-align: middle;"><div style="height: 75px !important;"><b>'.$liste->title.'</b><br>'.excerpt($liste->content, 150).'</div>

                                    </td>';

                                    echo '<td style="vertical-align: middle">';
                                    if($liste->thumbnail)
                                        echo '<div><img class="img-responsive w3-border" src="'.base_url($liste->thumbnail).'" alt="" style="height: 120px !important;"></div><br>';
                                    echo '<div>'.$statut.'</div></td>';
                                    echo '<td class="w3-center">';

                                    if($liste->thumbnail){
                                        if($slider)
                                            echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top" value="'.$liste->id.'" name="d_show" title="Ne pas afficher dans le slider"><i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i></button>';
                                        else
                                            echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top" value="'.$liste->id.'" name="show" title="Afficher dans le slider"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></button>';
                                    }
                                    if($statut)
                                        echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-green" value="'.$liste->id.'" name="aid" title="activer"><i class="fa fa-unlock fa-2x" aria-hidden="true"></i></button>';
                                    else
                                        echo '<button type="submit" class="w3-btn w3-white w3-margin-left w3-margin-top w3-text-red" value="'.$liste->id.'" name="bid" title="bloquer"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></button>';

                                    echo '<a href="'.base_url('moderatorGate/news/formEdit/'.$liste->id).'" title="Modifier" class="w3-white w3-btn w3-margin-left w3-margin-top edit"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></td></tr>';*/
                                } ?>
                                </tbody>
                            </table>
                        </form>
                        <?php }else{ ?>
                            <div class="h3 text-center w3-text-orange">Aucune nouvelle enregistré ...</div>
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

                    leftM(0, '#panel-news');
                })
            </script>
        </div>
    </div>

</div>
<!--END PAGE CONTENT -->