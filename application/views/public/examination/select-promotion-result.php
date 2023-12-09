<!--PAGE CONTENT -->
<?php //var_dump($promotions); die(); ?>

<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="row btn-sm">
                    <div class="col-sm-12 table-responsive">
                        <table class=" table table-bordered table-hover" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                            <tr class='w-100'>
                                <th class="text-center hidden">N&#176;</th>
                                <th>Vague</th>
                                <th>Enseignement</th>
                                <th>Evaluation</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $line=0;

                            if ($promotions!=null and !empty($promotions))
                                foreach ($promotions as $promo)
                                {
                                    if ($promo->results!=null){
                                        foreach ($promo->results as $res) {
                                            $line++;
                                            echo "<tr>";
                                            echo "<td class='hidden'>$line</td>";
                                            echo "<td><b>" . $promo->promotion->code . "</b></td>";
                                            echo "<td>" . mb_strtoupper($promo->promotion->label) . "</td>";
                                            echo "<td><b>" . $res->label . "</b></td>";
                                            echo "<td><a href='" . base_url('resultats') . '/' . $promo->promotion->code . '/' . permalink($res->code) . "' class='btn btn-primary btn-sm'>Afficher</a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.content-wrapper -->

