<!--PAGE CONTENT -->
<?php //var_dump($all, $mode, $marks, $marked); die();?>
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12 w3-text-dark-gray">
                <?php if (!$marked) { ?>
                    <h3><b><?php echo mb_strtoupper('Enregistrement des notes') ?></b> </h3>
                <?php } else { ?>
                    <h3><b><?php echo mb_strtoupper('Modification des notes') ?></b> </h3>
                <?php } ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-8 col-md-8 col-md-offset-2 col-lg-offset-2 w3-text-dark-gray">
                <h4><b>Vague : </b><?php echo $promo->code ?> </h4>
                <h4><b>Enseignement : </b><?php echo $lesson->label ?> </h4>
                <?php if ($all) { ?>
                    <h4><b>Evaluation : </b>Toutes</h4>
                <?php } else { ?>
                    <h4><b>Evaluation : </b><?php echo $evaluation->label ?></h4><br>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <form id="markForm" method="post" action="<?php echo base_url('trainerGate/examination/save/') ?>" <?php if ($marked) echo "style='display: none'" ?>>
                    <table class="w3-table w3-striped w3-border w3-bordered w3-hoverable">
                        <thead class="w3-blue">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom(s) et prénom(s)</th>
                            <?php $nbe=0; if ($all) {
                                foreach ($evaluations as $ev)
                                {
                                    $nbe++;
                                    echo "<th>".$ev->label."</th>";
                                }
                            } else {
                                $nbe++;
                                echo "<th>Note</th>";
                            } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($mode=='add') {
                            foreach ($students as $st) {
                                echo "<tr>";
                                echo "<td>" . $st->number_id . "</td>";
                                echo "<td>" . mb_strtoupper($st->lastname) . " " . ucwords($st->firstname) . "</td>";
                                echo "<p class='mark' data-std='$st->id'>";
                                if ($all) {
                                    foreach ($evaluations as $ev) {
                                        echo "<td><input type='text' class='form-control markn$st->id' step='0.01' name='mark' data-std='$st->id' data-eva='$ev->id' min='00.00' max='20.00' value='00.00' /></td>";
                                    }
                                } else {
                                    echo "<td><input type='text' class='form-control markn$st->id' step='0.01' name='mark' data-std='$st->id' data-eva='$evaluation->id' min='00.00' max='20.00' value='00.00'/></td>";
                                }
                                echo "</p>";
                                echo "</tr>";
                            }
                        } else if ($mode=='update')
                        {
                            if ($all) {
                                foreach ($marks as $mark) {
                                    echo "<tr>";
                                    echo "<td>" . $mark->number_id . "</td>";
                                    echo "<td>" . $mark->names . "</td>";
                                    echo "<p class='mark' data-std='$mark->id'>";
                                    foreach ($evaluations as $k=>$ev) {
                                        if (count($mark->notes)>=($k+1))
                                            echo "<td><input type='text' class='form-control markn$mark->id' step='0.01' name='mark' data-std='$mark->id' data-eva='".$mark->notes[$k]->evaluation."' min='00.00' max='20.00' value='".$mark->notes[$k]->value."' /></td>";
                                        else
                                            echo "<td><input type='text' class='form-control markn$mark->id' step='0.01' name='mark' data-std='$mark->id' data-eva='$ev->id' min='00.00' max='20.00' value='00.00' /></td>";
                                    }
                                    echo "</p>";
                                    echo "</tr>";
                                }
                            } else {

                                foreach ($marks as $mark) {
                                    echo "<tr>";
                                    echo "<td>" . $mark->number_id . "</td>";
                                    echo "<td>" . $mark->names . "</td>";
                                    echo "<p class='mark' data-std='$mark->id'>";
                                    echo "<td><input type='text' class='form-control markn$mark->id' step='0.01' name='mark' data-std='$mark->id' data-eva='".$mark->note->evaluation."' min='00.00' max='20.00' value='".$mark->note->value."'/></td>";
                                    echo "</p>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="promo" id="promo" value="<?php echo $promo->id ?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $mode ?>" />
                    <input type="hidden" name="all" id="all" value="" />
                    <input type="hidden" name="evals" id="evals" value="<?php echo $all?'all':$evaluation->code ?>" />
                    <br><br>
                    <button id="ok" type="button" class="w3-btn btn w3-blue"><i class="fa fa-fw fa-cloud-upload"></i>  Enregistrer</button>
                </form>

                <?php if ($marked and !$pub) { ?>
                    <div class="alert alert-info text-center">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo "Les résultats d'une ou de plusieurs évaluations ont déjà été enregistrées. Entrer de nouvelles notes reviendrait à les modifier. Cliquez sur le bouton ci-dessous pour les modifier." ?>
                        <button class="btn w3-btn w3-blue" id="modif">Modifier</button>
                    </div>
                <?php } elseif($pub) { ?>
                    <div class="alert alert-danger text-center">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <?php echo "Les résultats de cette vague  ont déjà été publiées. Vous ne pouvez plus les modifier." ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ok').click( function () {
            //var nbe=parseInt($('#nbe').prop('value'));
            var marks=$('.mark');
            var marksArray='[';
            marks.each(function (index) {
                var mark=$(this);
                marksArray+='{"student": '+mark.attr('data-std')+', "marks": [';//+mark.prop('value')+']},';
                var inputs=$('.markn'+mark.attr('data-std'));
                inputs.each(function (ind) {
                    var input=$(this);
                    var note;
                    if (input.prop('value')==='' || input.prop('value')===undefined)
                        note=0;
                    else
                        note=parseFloat(input.prop('value'));
                    marksArray+='{"ev": '+input.attr('data-eva')+', "value": '+note+'},';
                });
                var txt=marksArray.split("");
                txt.pop();
                marksArray=txt.join('');
                marksArray+=']},';
            });
            var txt=marksArray.split("");
            txt.pop();
            marksArray=txt.join('');
            marksArray+=']';
            
            $('#all').prop('value', marksArray);
            $('form').submit();
        });
        $('#modif').on('click', function () {
            $('.alert-info').hide();
            $('#markForm').show();
        });
        $('.form-control').inputmask("99.99");

    });
</script>
<!--END PAGE CONTENT -->