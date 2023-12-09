<div id="content">
    <div class="inner" style="min-height: 700px;"><br>
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Fiche de suivi des cours')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <br><br>
        <div class="row w3-margin-top">
            <div class="row">
                <p style="margin-left: 25px;">L&eacute;gende : </p>
                <ul style="padding-bottom: 30px">
                    <li class="legend"><span class="w3-red">#</span> Fiche de suivie remplie</li>
                </ul>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Enseignement</th>
                        <th>Resumé</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($lessonDispense)){
                        $k = 0;
                        foreach ($lessonDispense as $item) {
                            echo "<tr>";
                            switch ($item->locked)
                            {
                                case '0': echo "<td><span class='w3-green' style='padding: 7px;'>".++$k."</span></td>";  break;
                                case '1': echo "<td><span class='w3-red' style='padding: 7px'>".++$k."</span></td>"; break;
                                default: echo "<td>".++$k."</td>"; break;
                            }
                            $nAll = 'Non alloué'; $n = $item->firstname . $item->lastname;
                            switch($item->day){
                                case '1': $item->day = 'lundi'; break;
                                case '2': $item->day = 'mardi'; break;
                                case '3': $item->day = 'mercredi'; break;
                                case '4': $item->day = 'jeudi'; break;
                                case '5': $item->day = 'vendredi'; break;
                                case '6': $item->day = 'samedi'; break;
                                default : $item->day = '-1';
                            }
                            echo '<td>' . mb_strtoupper($item->label) . ' <br> Semaine du '.$item->start_date.' ~ '.$item->day.' de '.$item->start.'H à '.$item->end.'H</td>';
                            echo '<td id="nameF">' . (empty($item->content) ? 'Fiche de suivie vide' : ($item->content)) . '</td>';

                            echo '</tr>'; //$i++;
                        }
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





    <style>
        .legend
        {
            text-decoration: none;
            display: inline-block;
            float: left;
            margin-left: 15px;
        }

        .legend span
        {
            padding: 7px;
            border: dashed;
            border-color: #0a0a0a;
        }
    </style>


    <!-- /.container-fluid -->
    <script type="text/javascript">
        $(document).ready(function () {

            leftM(1, '#panel-suivie');

        });
    </script>
<!-- /.content-wrapper -->