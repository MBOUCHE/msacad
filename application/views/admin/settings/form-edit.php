<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Modifier les paramètres')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <form class="col-sm-12 offset-md-2 col-md-8 " action="<?php echo base_url('admin/settings/edit') ?>" method="post">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="payDL">Nombre limite de jours pour délai de paiement:</label>
                            <input type="number" class="form-control" name="payDL" id="payDL" placeholder="Date limite" min="0" value="<?php echo $settings->pay_dead_line ?>">
                        </div>
                        <?php echo form_error('payDL') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="lessonSDL">Nombre limite d'heure pour le remplissage de la fiche de suivi:</label>
                            <input type="number" class="form-control" name="lessonSDL" id="payDL" placeholder="Entrer le debut" min="0" value="<?php echo $settings->lesson_slip_dead_line ?>">
                        </div>
                        <?php echo form_error('lessonSDL') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="regI">Tranche minimale à l'inscription (en %):</label>
                            <input type="number" class="form-control" name="regI" id="regI" placeholder="Entrer la fin " value="<?php echo $settings->reg_instalment ?>">
                        </div>
                        <?php echo form_error('regI') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="minML">Dur&eacute;e minimale d'une fili&egrave;re:</label>
                            <input type="number" class="form-control" name="minML" id="minML" placeholder="Entrer la fin " value="<?php echo $settings->min_mention_last ?>">
                        </div>
                        <?php echo form_error('minML') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="minLL">Dur&eacute;e minimale d'un cours:</label>
                            <input type="number" class="form-control" name="minLL" id="minLL" placeholder="Entrer la fin " value="<?php echo $settings->min_lesson_last ?>">
                        </div>
                        <?php echo form_error('minLL') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <label class="input-group-addon" for="maxAB">Nombre d'heures d'absences maximal:</label>
                            <input type="number" class="form-control" name="maxAB" id="maxAB" placeholder="Entrer la fin " value="<?php echo $settings->max_absence_nbr ?>">
                        </div>
                        <?php echo form_error('maxAB') ?>
                    </div>
                </div>

                <button type="submit" name="send" class="btn w3-btn w3-blue w3-round "><i class="fa fa-fw fa-1x fa-edit"></i> Modifier</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function(){
            <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->