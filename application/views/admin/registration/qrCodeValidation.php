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
        font-size:10px;
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

<style type="text/css">
    .scanner-laser{
        position: absolute;
        margin: 40px;
        height: 30px;
        width: 30px;
    }
    .laser-leftTop{
        top: 0;
        left: 0;
        border-top: solid red 5px;
        border-left: solid red 5px;
    }
    .laser-leftBottom{
        bottom: 0;
        left: 0;
        border-bottom: solid red 5px;
        border-left: solid red 5px;
    }
    .laser-rightTop{
        top: 0;
        right: 0;
        border-top: solid red 5px;
        border-right: solid red 5px;
    }
    .laser-rightBottom{
        bottom: 0;
        right: 0;
        border-bottom: solid red 5px;
        border-right: solid red 5px;
    }
</style>

<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <div class="h4 text-center">VALIDATION DE L'INSCRIPTION</div>
                <hr>
                <br><br>
            </div>
            <div class="col-sm-12 col-md-12">
                <div id="QR-Code" class="container" style="width:100%">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="display: inline-block;width: 100%;">
                            <h4 style="width:50%;float:left;">Validation par Code QR</h4>
                            <div style="width:50%;float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                                <select id="cameraId" class="form-control" style="display: inline-block;width: auto;"></select>
                                <button id="save" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-info btn-sm disabled"><span class="fa fa-fw fa-1x fa-file-photo-o"></span></button>
                                <button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="fa fa-fw fa-1x fa-play"></span></button>
                                <button id="stop" data-toggle="tooltip" title="Stop" type="button" class="btn btn-warning btn-sm"><span class="fa fa-fw fa-1x fa-stop"></span></button>
                                <button id="stopAll" data-toggle="tooltip" title="Stop streams" type="button" class="btn btn-danger btn-sm"><span class="fa fa-fw fa-1x fa-stop-circle-o"></span></button>
                            </div>
                        </div>
                        <div class="panel-body row">
                            <div class="col-md-5" style="text-align: center;">
                                <div class="well" style="position: relative;display: inline-block;">
                                    <canvas id="qr-canvas" width="320" height="240"></canvas>
                                    <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                    <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                    <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                    <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                </div>
                                <div class="well" style="position: relative;" >
                                    <label id="zoom-value" width="100">Zoom: 2</label>
                                    <input type="range" id="zoom" value="20" min="10" max="30" onchange="Page.changeZoom();"/><br>
                                    <label id="brightness-value" width="100">Luminosit&eacute; : 0</label>
                                    <input type="range" id="brightness" value="0" min="0" max="128" onchange="Page.changeBrightness();"/><br>
                                    <label id="contrast-value" width="100">Contraste: 0</label>
                                    <input type="range" id="contrast" value="0" min="0" max="64" onchange="Page.changeContrast();"/><br>
                                    <label id="threshold-value" width="100">Netteté: 0</label>
                                    <input type="range" id="threshold" value="0" min="0" max="512" onchange="Page.changeThreshold();"/><br>
                                    <label id="sharpness-value" width="100">Seuil: off</label>
                                    <input type="checkbox" id="sharpness" onchange="Page.changeSharpness();"/><br>
                                    <label id="grayscale-value" width="100">Echelle de gris: off</label>
                                    <input type="checkbox" id="grayscale" onchange="Page.changeGrayscale();"/>
                                </div>
                            </div>
                            <div class="col-md-5" style="text-align: center;">
                                <div id="result" class="thumbnail">
                                    <div class="well" style="position: relative;display: inline-block;">
                                        <img id="scanned-img" src="" width="320" height="240">
                                    </div>
                                    <div class="caption">
                                        <h3>Résultat</h3>
                                        <p id="scanned-QR"></p>
                                    </div>
                                </div>
                            </div>
                        </div>


            </div>
        </div>
    </div>
</div>

<input type="hidden" id="link" value="<?php echo base_url('admin/registration/qrValidationModal/') ?>" />
<input type="hidden" id="slink" value="<?php echo base_url('admin/registration/payInstallement') ?>" />
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>

<script type="text/javascript" src="<?php echo js_url('webcodecam/qrcodelib') ?>"></script>
<script type="text/javascript" src="<?php echo js_url('webcodecam/WebCodeCam') ?>"></script>
<script type="text/javascript" src="<?php echo js_url('webcodecam/main') ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){
            alm('collapseReg', 2);

        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
        (function(){
            <?php
            if(isset($message)) {
            ?>
            alertify.defaults.theme.ok = "btn w3-red";
            alertify.defaults.glossary.ok = "OK";
            alertify
                .alert("<span class='w3-text-red'><i class='w3-text-red fa fa-fw fa-ban'></i>  Erreur</span>", "<?php echo $message ?>", function(){
                    alertify.error('Echec');
                });
            <?php
            }
            ?>
        })();

        $('#qrVal').on('click', function(){
            alertify.confirm("Validation du Code QR", "This is a confirm dialog.",
                function(){
                    alertify.success('Ok');
                },
                function(){
                    alertify.error('Cancel');
                });
        });
    });
</script>

