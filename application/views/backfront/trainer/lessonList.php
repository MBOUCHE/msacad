<div id="content">
    <div class="inner" style="min-height: 700px;"><br>
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Mes enseignements')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <br><br>
        <div class="row w3-margin-top">

            <div class="col-sm-12 ">
                <table class="table table-responsive table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Titre</th>
                        <th>Détails</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($lessonDispense as $key=>$l) {
                       ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo mb_strtoupper($l->label) ?></td>
                            <td>
                                Code <b><?php echo $l->code ?></b><br>
                                Durée <b><?php echo $l->duration ?> H</b><br>
                                Type <b><?php echo $l->type ?> </b><br>
                                Contenu <b><?php echo $l->syllabus ?> </b><br>

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
</div>

<!-- /.container-fluid -->
<script type="text/javascript">
    $(document).ready(function () {

        leftM(0, '#panel-suivie');

    });
</script>
<!-- /.content-wrapper -->