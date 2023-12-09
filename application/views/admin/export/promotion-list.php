<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center col-sm-12">
                LISTE DES PROMOTIONS
                <hr>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Code</th>
                        <th>Enseignement</th>
                        <th>Options</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if ($promotions!=null)
                        foreach ($promotions as $promo)
                        {
                            $line++;
                            echo "<tr>";
                             echo "<td>".$line."</td>";
                            echo "<td><b>".$promo->code."</td>";
                            echo "<td>".mb_strtoupper($promo->label)."</td>";
                            echo "<td>
                                      <a href='".base_url('admin/export/promotion/')."/".$promo->code."/"."students"."' class='promolist w3-btn w3-white w3-margin-small' title=\"Afficher la liste des apprenants\"><i class='fa fa-list fa-2x w3-text-blue'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>

<script type="text/javascript">
    $(document).ready(function(){
    });
</script>