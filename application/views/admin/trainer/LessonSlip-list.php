<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Fiche de suivi des cours')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/trainer/addTrainer')?>" class="w3-btn w3-blue w3-round">Ajouter un formateur</a>
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="row">
                <p style="margin-left: 25px;">L&eacute;gende : </p>
                <ul style="padding-bottom: 30px">
                    <li class="legend"><span class="w3-red">#</span> Fiche de suivie bloquée</li>
                    <li class="legend"><span class="w3-green">#</span> Fiche de suivie en cours</li>
                </ul>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center w3-hide">N&#176;</th>
                        <th class="text-center">Session</th>
                        <th>Formateur</th>
                        <th>Contenu</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($lessonDispense)){
                        $k = 0;
                        foreach ($lessonDispense as $key=>$item) {
                            echo "<tr>";
                            echo "<td class='w3-hide'>".($key+1)."</td>";
                            echo "<td>";
                            switch ($item->locked)
                            {
                                case '0': echo "<span class='w3-green' style='padding: 7px;'>".$item->code."</span>";  break;
                                case '1': echo "<span class='w3-red' style='padding: 7px'>".$item->code."</span>"; break;
                                default: echo $item->code; break;
                            }
                            switch($item->day){
                                case '1': $item->day = 'lundi'; break;
                                case '2': $item->day = 'mardi'; break;
                                case '3': $item->day = 'mercredi'; break;
                                case '4': $item->day = 'jeudi'; break;
                                case '5': $item->day = 'vendredi'; break;
                                case '6': $item->day = 'samedi'; break;
                                default : $item->day = '-1';
                            }
                            echo '<br><br>' . mb_strtoupper($item->label) . ' <br> Semaine du '.$item->start_date.' ~ '.$item->day.' de '.$item->start.'H à '.$item->end.'H';

                            echo "</td>";
                            $nAll = 'Non alloué';
                            $n = $item->firstname .' '. $item->lastname;
                            echo '<td>' .(empty(trim($n)) ? $nAll : $n). ' </td>';

                            echo '<td id="nameF">' . (empty($item->content) ? 'Fiche de suivie vide' : ($item->content)) . '</td>';
                            echo '<td> <button data-pk="'.$item->id.'" class="w3-btn w3-white w3-text-black edit"> <span class="fa fa-fw fa-2x fa-edit"> </span> </button> </td>';

                            echo '</tr>'; //$i++;
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="10"  class="h4 text-center"><a class="text-warning">Aucune session enregistrée pour le moment ...</a><td></tr>';
                    }

                    ?>
                    </tbody>
                </table>
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
            alm('collapseForm',1);
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
            $('.edit').on('click', function(){
                window.location.href="<?php echo base_url('admin/trainer/edit'); ?>"+'/'+$(this).attr('data-pk');
            });

        });
    </script>
</div>
<!-- /.content-wrapper -->