<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Niconne">Rapport de fin de formation</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>

        <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-striped small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">Theme</th>
                        <th>Enseignement</th>
                        <th>Vague</th>
                        <th>telecharger</th>
                        <th>Note</th>
                    </tr>
                <?php
                foreach($list as $key)
                {
                    ?>
                        <tr style="font-family:Comic Sans MS;font-size:13px;">
                        <td><?php
                            echo $key['theme_rpt']
                        ?></td>
                        <td><?php
                            echo $key['label']
                        ?></td>
                         <td><?php
                            echo $key['code_wave']
                        ?></td>
                         <td><a style="text-decoration:none" href="assets">&ensp;&ensp;&ensp;&ensp;&ensp;<span class="fa fa-file-pdf-o fa-2x" style="color:red"></span></a></td>
                         <td><input type="number" min="0" max="20">&ensp;&ensp;&ensp;&ensp;&ensp;<a href="#"><span class="fa fa-check fa-2x" style="color:red " onclick="alert( 'la note a ete enregistrer')"></span></a></td>

                        </tr>
                    <?php
                }
                ?>
