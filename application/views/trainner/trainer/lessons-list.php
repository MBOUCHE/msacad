<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php  echo mb_strtoupper('Enseignements dispensés par :').'<br><b id="nameF">'.mb_strtoupper($trainer->firstname.' '.$trainer->lastname).'</b>' ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/trainer')?>" class="w3-btn w3-blue w3-round">Tous les formateurs</a>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Dernière allocation</th>
                        <th>Dernière Suspension</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($lessonDispense) And is_array($lessonDispense) and !empty($lessonDispense))
                    {
                        $i=0;
                        $k = 0;
                        for($i = 1; $i <= count($lessonDispense); $i++)
                        {
                            switch ($lessonDispense[$i-1]->locked)
                            {
                                case '1': echo "<td><span class='w3-red' style='padding: 7px;'>".++$k."</span></td>";  break;
                                case '0': echo "<td><span class='w3-green' style='padding: 7px'>".++$k."</span></td>"; break;
                                default: echo "<td>".++$k."</td>"; break;
                            }
                            echo '<td>' . mb_strtoupper($lessonDispense[$i-1]->label) . '</td>';
                            echo '<td>' . ucfirst($lessonDispense[$i-1]->type) . '</td>';
                            echo '<td>' . ucfirst($lessonDispense[$i-1]->start_date) . '</td>';
                            echo '<td>' . ucfirst($lessonDispense[$i-1]->end_date) . '</td>';
                            echo '<td>';
                            switch ($lessonDispense[$i-1]->locked)
                            {
                                case '0':
                                    echo '<a title="Suspendre" class="unshelve" value='.$lessonDispense[$i-1]->laId.' onclick="unshelve(this)"><i class="w3-btn w3-text-red fa fa-2x fa-pause text-info" aria-hidden="true"></i></a>';
                                    break;
                                case '1':
                                    echo '<a title="Activer" class="shelve" value='.$lessonDispense[$i-1]->laId.' onclick="shelve(this)"><i class="w3-btn  fa fa-2x w3-text-green  fa-check text-info" aria-hidden="true"></i></a>';
                                    break;
                                default:
                                    echo ++$k;
                                    break;
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="6"  class="h4 text-center"><a href="'.base_url('trainner/trainer/addTrainer').'" class="text-warning">Aucun formateur enregistré pour le moment ...</a><td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script type="text/javascript">

        function unshelve($this){
            var idLa = $($this).attr('value'),
                $tr = $($this).parent().parent();
            alertify.confirm(
                '<p style="text-align: center;">Voulez vous vraiment suspendre <br>'
                + '<b>'+$('#nameF').html()+'</b> pour l\'enseignement <br>'
                + '<b>'+$tr.find('td').eq(1).text()+'</b> ?'
                + '</p>',
                function(){
                    $(location).attr('href', '<?php echo base_url('trainner/trainer/shelve') ?>'+'/'+idLa);
                }
            ).setHeader('Confirmation de suspension').set({reverseButtons: true});
        }

        function shelve($this){
            var idLa = $($this).attr('value'),
                $tr = $($this).parent().parent();
            alertify.confirm(
                '<p style="text-align: center;">Voulez vous vraiment activer <br>'
                + '<b>'+$('#nameF').html()+'</b> pour l\'enseignement <br>'
                + '<b>'+$tr.find('td').eq(1).text()+'</b> ?'
                + '</p>',
                function(){
                    $(location).attr('href', '<?php echo base_url('trainner/trainer/unshelve') ?>'+'/'+idLa);
                }
            ).setHeader('Confirmation d\' activation').set({reverseButtons: true});
        }

        $(document).ready(function () {
            alm('collapseForm', 2);
             <?php
                if(isset($message)){
                    echo "alertify.success(\"$message\");";
                }
              ?>
            <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
        });
    </script>
</div>
<!-- /.content-wrapper -->