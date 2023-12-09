<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center  col-sm-12">
                <?php echo mb_strtoupper('Liste des périodes')?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3">
                <a href="<?php echo base_url('admin/period/formAdd')?>" class="w3-btn w3-blue w3-round">Ajouter une période</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 w3-margin-bottom">
                <div class="input-group">
                    <label for="" class="input-group-addon">Modifier l'interval des periodes</label>
                    <select name="type" id="type" value="" class="form-control">
                        <option class="typ" id="j" value="2">2</option>
                        <option class="typ" id="k" value="3">3</option>
                    </select>
                    <a href="" type="submit" name="send" id="send" class="w3-btn w3-blue w3-round input-group-addon"><i class="fa fa-save"></i> Enregistrer</a>
                </div>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">N&#176;</th>
                            <th>Debut</th>
                            <th>Fin</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <?php
                            if(isset($query) And is_object($query))
                            {
                                $i=0;
                                foreach($query->result() as $liste)
                                {
                                    echo '<tr><td class="text-center">' . ++$i . '</td>';
                                    echo '<td class="num1">' . $liste->start . '</td>';
                                    echo '<td class="num2">' . $liste->end . '</td></tr>';
                                }
                            }
                            else
                            {
                                echo '<tr><td colspan="3"  class="h3 text-center"><a href="'.base_url('admin/period/save').'" class="text-warning">Aucune période enregistré pour le moment ...</a><td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->

<script src="<?php echo js_url('jquery.min')?>"></script>
<script>
    $(document).ready(function(){
        alm('collapsePeriode', 0);
       $('#send').mouseover(function(){
          $(this).attr('href', '<?php echo base_url('admin/period/savePeriod') ?>/'+$('#type').val());
       });
        $('#type').change(function(){
            var $tr = $('#table tr'),
                value = parseInt($(this).val()),
                num1 = 0, num2 = 8;

            for(var i=0; i<$tr.length; i++){
                num1 = num2;
                num2 = num1 + value;
                $tr.find('td.num1').eq(i).text(num1);
                $tr.find('td.num2').eq(i).text(num2);
            }
        });
    });
</script>