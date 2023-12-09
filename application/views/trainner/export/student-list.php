
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="h3 text-center"> LISTE DES APPRENANTS</div>
                <hr>
                <div class="h4">Vague : <b><?php echo $promo->code ?></b></div>
                <div class="h4">Enseignement : <b><?php echo mb_strtoupper($promo->label); ?></b></div>
                <hr/>
            </div>

            <div class="col-sm-12 table-responsive">
            <?php
            if ($students!=null)  { ?>
                <div class="w3-margin-bottom w3-btn-group">
                    <a target="_blank" href="<?php echo base_url('trainner/export/promotion/')."/".$promo->code."/students/certificate" ?>" class="w3-btn w3-blue w3-round"><i class="fa fa-certificate"></i>  Exporter les données pour certificats</a>
                    <a target="_blank" href="<?php echo base_url('trainner/export/promotion/')."/".$promo->code."/students/attestation" ?>" class="w3-btn w3-green w3-round"><i class="fa fa-certificate"></i>  Exporter les données pour attestations</a>
                    <a target="_blank" href="<?php echo base_url('trainner/export/promotion/')."/".$promo->code."/students/report" ?>" class="w3-btn w3-pink w3-round"><i class="fa fa-trophy"></i>  Exporter les données pour relevés de notes</a>
                </div>
                <?php } ?>
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Nom et prenoms</th>
                        <th>Date d'inscription</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if ($students!=null)
                    foreach ($students as $student)
                    {
                        $line++;
                        echo "<tr>";
                        echo "<td>".$line."</td>";
                        echo "<td><img width='100' height='100' src='".base_url($student->photo)."' alt='Photo ".mb_strtoupper($student->lastname).' '.ucwords(mb_strtolower($student->firstname))."' /></td>";
                        echo "<td>".$student->number_id."</td>";
                        echo "<td>".mb_strtoupper($student->lastname).' '.ucwords(mb_strtolower($student->firstname))."</td>";
                        echo "<td class='small'>".date_format(date_create($student->registration_date), 'd-m-Y')."</b></td>";
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
<?php
if(!empty($message)) {
    if (is_bool($status) and $status) echo "<script type='text/javascript'>alertify.success($message);</script>";
    else echo "<script type='text/javascript'>alertify.error($message);</script>";
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.changePromo').on('click', function(){
            var change=$(this).prop('id');
            var pcode=$('#pCode').prop('value');
            window.location.href="<?php echo base_url('promotion/changePromo')?>"+"/"+pcode+"/"+change;
        });
    });
</script>
