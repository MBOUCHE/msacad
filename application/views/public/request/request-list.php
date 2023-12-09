<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <table class="table table-bordered table-hover " width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center" width="3%">N&#176;</th>
                        <th>Requête</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if (isset($requetes) and $requetes!=null and !empty($requetes))
                        foreach ($requetes as $req)
                        {
                            if($req->state==1){
                                ?>

                                <tr>
                                    <td><?php echo (++$line) ?></td>
                                    <td>
                                        Requête du <b class="w3-grey-text small"><?php echo moment($req->save_date)->format('d M Y')?></b> Par <b><?php echo mb_strtoupper($req->lastname).' '.$req->firstname ?></b><br>
                                        <u>Objet</u> : <b><?php echo mb_strtoupper($req->subject) ?></b><br>
                                        <div class="w3-margin-top w3-margin-bottom">
                                            <?php echo $req->content ?>
                                        </div>
                                        <?php
                                        if($req->state==1){
                                            $stateClass="btn-success";
                                            $stateText = "Déjà traitée";
                                        }
                                        else{
                                            $stateClass="btn-default";
                                            $stateText = "Pas encore traitée";
                                        }
                                        ?>
                                        <div class="text-right">
                                            <a class=" btn disabled btn-sm <?php echo $stateClass ?>"><?php echo $stateText ?></a>
                                        </div>
                                        <hr>
                                        <div>
                                            <b>
                                                <?php echo $req->response ?>
                                            </b>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }

                        }

                    ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

</div>