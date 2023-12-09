<div id="content"><br>
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="h4  text-center col-sm-12"><b>
                    <?php echo (isset($availability) ? mb_strtoupper('Modifiez votre disponibilité') : mb_strtoupper('Soumettez votre disponibilité'))  ?></b>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
            <br>

        </div>

        <?php if(isset($message) And $message){ ?>
            <div class="alert alert-info text-center">
                <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <form role="form" action="<?php echo (isset($availability) ? base_url('studentGate/timetable/updateAvailability') : base_url('studentGate/timetable/availability')) ?>" method="post">
            <small class="text-justify w3-padding">
                Cette matrice vous permet de définir votre disponibilité de la semaine en cours. ceci permettra de générer un emploi de temps optimal en tenant compte de votre disponibilité.<br>
                <b>Cependant,</b> l'emploi peut ne pas totalement vous satisfaire. Dans ce cas bien vouloir nous signaler à l'avance.
            </small>
            <table class="w3-table w3-border w3-card-4">
                <thead>
                <tr class="w3-blue">
                    <td>Heure</td>
                    <td>Lundi</td>
                    <td>Mardi</td>
                    <td>Mercredi</td>
                    <td>Jeudi</td>
                    <td>Vendredi</td>
                    <td>Samedi</td>
                </tr>
                </thead>
                <tbody>
                <?php
                //$h = 7;

                if(isset($period) and is_array($period) and !isset($availability)){
                    $i = 0; //var_dump(1); die(0);
                    foreach ($period as $item) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++){
                            if ($j == 0){
                                echo "<td class='w3-text-center'><input type='hidden'>" . $item->start . "h - " . $item->end    . "h</td>";

                            } else {
                                echo "<td>
                                    <div class=\"pretty success smooth w3-xxlarge\" id=\"customFontSize\">
                                        <input type=\"checkbox\" name=\"".$i.'_'.($j-1).'_'.$item->id."\">
                                        <label><i class=\"fa fa-check\"></i></label>
                                    </div>
                                </td>";
                            }
                        }
                        echo "</tr>";
                        $i++;
                    }
                }elseif(isset($period) and is_array($period) and isset($availability) and is_array($availability)) {
                    $k = 0; $i = 0; $tab = array(); //var_dump($availability); die(0);
                    foreach ($period as $item) {
                        echo "<tr>";
                        //$f = 0;
                        for ($j = 0; $j < 7; $j++) {
                            if ($j == 0) {
                                echo "<td class='w3-text-center'><input type='hidden'>" . $item->start . "h - " . $item->end    . "h</td>";
                            } else {
                                $checked = '';
                                if($availability[$k]->available == '1')
                                    $checked = 'checked';

                                echo "<td>
                                                <div class=\"pretty success smooth w3-xxlarge\" id=\"customFontSize\">
                                                    <input type=\"checkbox\" name=\"".$i.'_'.($j-1).'_'.$item->id."\"".$checked.">
                                                    <label><i class=\"fa fa-check\"></i></label>
                                                </div>
                                             </td>";
                                $k++;
                            }
                        }
                        $i++;
                    }
                    echo "</tr>";

                }

                ?>
                </tbody>
            </table>
            <br><br>
            <button name="send" value="ok" type="submit" class="w3-btn w3-blue w3-round w3-right"><i class="fa fa-send" aria-hidden="true"></i> <?php echo (isset($availability)) ? "Modifier" : "soumettre" ?></button>
        </form>
    </div>
    </div>

<!--END PAGE CONTENT -->

<script>
    $(document).ready(function(){
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>

        leftM(1, '#panel-timetable');
    });
</script>