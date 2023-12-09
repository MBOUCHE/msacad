<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES REquêtes académiques') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
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
                                        <a href="#" class=" btn disabled btn-sm <?php echo $stateClass ?>"><?php echo $stateText ?></a>

                                    </div>
                                    <?php if($req->state == 1){
                                        ?> <hr>
                                        <div>
                                            <b>
                                                <?php echo $req->response ?>
                                            </b>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php if($req->state == 0){
                                        ?><hr>
                                        <div class="text-right">
                                            <a href="<?php echo base_url('admin/request/response/'.$req->id) ?>" class="btn btn-sm btn-primary">
                                                Traiter
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>



                                </td>
                            </tr>

                            <?php


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
            alm('collapseRequete', 0);
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->
