
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="h3 text-center"> LISTE DES APPRENANTS</div>
                <input type="hidden" name="pCode" id="pCode" value="<?php echo $allPromoUsers[0]['code']; ?>" />
                <hr>
                <div class="h4">Vague : <b><?php echo $allPromoUsers[0]['code']; ?></b></div>
                <div class="h4">Enseignement : <b><?php echo mb_strtoupper($allPromoUsers[0]['label']); ?></b></div>
                <hr/>
            </div>

            <div class="col-sm-12 table-responsive">

                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <!--th rowspan="2">Photo</th-->
                        <th>Code</th>
                        <th>Nom et prénoms</th>
                        <th>Matricule</th>
                        <th>Date d'incription</th>
                        <th>Option</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
                    if ($allPromoUsers[0]['lastname']!=NULL)
                    foreach ($allPromoUsers as $student)
                    {
                        $line++;
                        echo "<tr>";

                        echo "<td><b>".$line."</td>";
                        echo "<td><b>".$student['code']."</td>";
                        echo "<td>".$student['firstname'].' '.strtoupper($student['lastname'])."</td>";
                        echo "<td>".$student['number_id']."</td>";
                        echo "<td class='small'>".date_format(date_create($student['reg_date']), 'd-m-Y')."</b></td>";
                        echo "<td>";
                        if ($student['pstate']!='1' and $student['pstate']!='2') echo "<button class='changePromo w3-btn w3-white w3-margin-small' id='{$student['uid']}' title=\"Déplacer vers une autre promotion\" onclick='changePromo(this)'><i class='fa fa-exchange fa-2x w3-text-blue'></i></button>";
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
<?php
if(!empty($message)) {
    if (is_bool($status) and $status) echo "<script type='text/javascript'>alertify.success($message);</script>";
    else echo "<script type='text/javascript'>alertify.error($message);</script>";
}
?>

<script type="text/javascript">
    function changePromo($this){
        var change=$($this).prop('id');
        var pcode=$('#pCode').prop('value');
        window.location.href="<?php echo base_url('admin/promotion/changePromo')?>"+"/"+pcode+"/"+change;
    }
    $(document).ready(function(){

    });
</script>
