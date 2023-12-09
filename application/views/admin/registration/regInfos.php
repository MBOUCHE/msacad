<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Vérifiez les informations de l\'inscription')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <form method="post" action="<?php echo base_url('admin/registration/payInstallement') ?>">
                    <input type="hidden" name="code" value="<?php echo $infos->reg_code; ?>" />
                    <input type="hidden" name="idR" value="<?php echo $infos->regId; ?>" />
                    <input type="hidden" name="idU" value="<?php echo $infos->idU; ?>" />
                    <table class="table-fill">
                        <tr>
                            <td  class="text-left th">
                                <label class=""><b>Code d'inscription : </b> </label>
                            </td>
                            <td class="text-left">
                                <p class="form-control-static"><?php echo $infos->reg_code; ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td  class="text-left th">
                                <label class=""><b>Enseignement : </b> </label>
                            </td>
                            <td class="text-left">
                                <p class="form-control-static"><?php echo mb_strtoupper($infos->label); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-left th">
                                <label class=""><b>Nom et prénoms de l'apprenant : </b> </label>
                            </td>
                            <td class="text-left">
                                <p class="form-control-static"><?php echo $infos->lastname.' '.$infos->firstname ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-left th">
                                <label class=""><b>Date d'inscription : </b> </label>
                            </td>
                            <td class="text-left">
                                <p class="form-control-static"><?php echo date('d-m-Y', strtotime($infos->reg_date)); ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-left th">
                                <label class=""><b>&Eacute;tat de l'inscription : </b></label>
                            </td>
                            <td class="text-left">
                                <p class="form-control-static"><?php
                                    switch ($infos->reg_state)
                                    {
                                        case '0': echo "En attente"; break;
                                        case '-1': echo "Suspendue"; break;
                                        case '1': echo "Validée"; break;
                                        case '2': echo "Finalisée"; break;
                                        default: echo "Etat non reconnu"; break;
                                    }
                                    ?></p>
                            </td>
                        </tr>
                    </table>
                    <?php
                    if(isset($infos->reg_state)) {
                        echo '<input type="hidden" name="mode" id="mat" value="unshelve">';
                    }else{
                        echo '<input type="hidden" name="mode" id="mat" value="">';
                    }
                    ?>
                    <br>

                    <button type="submit" name="send_rinfos" class="btn w3-btn w3-blue w3-center btn-primary"><i class="fa fa-fw fa-1x fa-check-circle"></i> Valider</button>
                </form>

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<style>
    .table-fill {
        background: white;
        border-radius:3px;
        border-collapse: collapse;
        height: 320px;
        margin: auto;
        max-width: 700px;
        padding:5px;
        width: 100%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        animation: float 5s infinite;
    }


    .th
    {
        min-width:220px;
    }

    th:first-child {
        border-top-left-radius:3px;
    }

    th:last-child {
        border-top-right-radius:3px;
        border-right:none;
    }

    tr {
        border-top: 1px solid #C1C3D1;
        font-size:16px;
        font-weight:normal;
    }

    tr:first-child {
        border-top:none;
    }

    tr:last-child {
        border-bottom:none;
    }

    tr:nth-child(odd) td {
        background:#EBEBEB;
    }

    tr:last-child td:first-child {
        border-bottom-left-radius:3px;
    }

    tr:last-child td:last-child {
        border-bottom-right-radius:3px;
    }

    td {
        background:#FFFFFF;
        padding:8px;
        padding-bottom: 15px;
        padding-top: 15px;
        text-align:left;
        vertical-align:middle;
        font-size:18px;
        border-right: 1px solid #C1C3D1;
    }

    td:last-child {
        border-right: 0px;
    }

    th.text-left {
        text-align: left;
    }


    td.text-left {
        text-align: left;
    }


</style>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
