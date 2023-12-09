<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTES DES INSCRIPTIONS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/registration/addRegistration')?>" class="w3-btn w3-blue w3-round">Ajouter une inscription</a>
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <p style="margin-left: 25px;">L&eacute;gende : </p>
                        <ul style="padding-bottom: 30px">
                            <li class="legend"><span class="w3-red">#</span> Suspendue</li>
                            <li class="legend"><span class="w3-green">#</span> Ouverte</li>
                            <li class="legend"><span class="w3-white">#</span> En cours</li>
                            <li class="legend"><span class="w3-grey">#</span> Achevée</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                            <tr>
                                <th  class="text-center">N&#176;</th>
                                <th>Enseignement</th>
                                <th>Apprenant</th>
                                <th  style="text-align: center">Frais (FCFA)</th>
                                <th>Date</th>
                                <th>Options</th>

                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            $line=0;
                            $mAll=$mRecu=$mReste=0;
                            foreach ($allReg as $reg)
                            {
                                $line++;
                                echo "<tr class='cl'>";
                                $stat="";
                                switch ($reg['state'])
                                {
                                    case '-1': echo "<td><span class='w3-red' style='padding: 7px;'>".$line."</span></td>";  break;
                                    case '0': echo "<td><span class='w3-green' style='padding: 7px'>".$line."</span></td>"; break;
                                    case '1': echo "<td><span class='w3-white' style='padding: 7px;'>".$line."</span></td>"; $stat="w3-hide"; break;
                                    case '2': echo "<td><span class='w3-grey' style='padding: 7px'>".$line."</span></td>"; $stat="w3-hide"; break;
                                    default: echo "<td>".$line."</td>"; break;
                                }
                                echo "<td class='lesson'>". mb_strtoupper($reg['label']) ."<br>Vague : <b>".$reg['pcode']."<b></td>";
                                echo "<td><b class='name'>".$reg['firstname']." ".$reg['lastname']."</b><br>".$reg['phone']."</td>";
				 $class="";
                                $retard = intval(moment($reg['dead_line'])->fromNow()->getDays());
                                if($retard>0){
                                    $class='w3-text-orange';
                                }else{
                                    $class = 'w3-hide';
                                }
                                if($reg['state']!=-1)
                                {
	                                $mAll+=$reg['fees'];
	                                $mRecu+=$reg['installment'];
                                }
                                
                                
                                echo "<td>À Payer : <b>".$reg['fees']."</b><br>
                                Payé : <b>".$reg['installment']."</b><br>
                                Restant : <b>".($reg['fees']-$reg['installment'])."</b></td>";
                                echo "<td class='small'>Inscription : <b>".date_format(date_create($reg['reg_date']), 'd-m-Y')."</b><br>
                                    Validation : <b>".($reg['val_date']!=NULL?date_format(date_create($reg['val_date']), 'd-m-Y'):'Pas encore')."</b><br>
                                    Délai : <b>".($reg['dead_line']!=NULL?date_format(date_create($reg['dead_line']), 'd-m-Y'):'Aucun')."</b>
                                    <br><span class='".$class."'>Retard <b>".intval(moment($reg['dead_line'])->fromNow()->getDays())."</b> jours </span><br></td></td>";
                                echo "<td>
                                      ";
                                if( $reg['state'] == 0 ){
                                    echo "<button value=".$reg['regId']." data-target=\"#myModal\" class='lock w3-btn w3-white w3-small w3-margin-small shelve'  title=\"Suspendre\" onclick='shelve(this)'>
                                                <i class='fa fa-trash fa-2x w3-text-red'></i>
                                            </button>";
                                }else{

                                }
                                if($reg['state']!=-1 and $reg['state']!='0')
                                    echo "<a href=".base_url('admin/registration/printQuitus')."/".$reg['regId']." class='w3-btn w3-white w3-margin-small' title=\"Imprimer le quitus\">
                                                <i class='fa fa-print fa-2x w3-text-blue'></i>
                                              </a>";
                                if (($reg['fees']-$reg['installment'])!=0 && $reg['state']!='0')
                                    echo "<a href=".base_url('admin/registration/payInstallement')."/".$reg['regId']."/".$reg['userId']." class='lock w3-btn w3-white w3-small w3-margin-small' title=\"Payer une tranche\">
                                                <i class='fa fa-credit-card fa-2x w3-text-orange'></i>
                                              </a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 ">
                    	<table class="table">
                    	 
                    	<thead>
                    		<th>Montant attentu</th>
                    		<th>Montant reçu</th>
                    		<th>Montant restant</th>
                    	</thead>
                    	<tbody>
	                    	
	                    	<tr>
	                    		<td class="text-info bold"><?php echo formatMonnaie($mAll) ?></td>
	                    		<td class="text-success bold"><?php echo formatMonnaie($mRecu) ?></td>
	                    		<td class="text-danger bold"><?php echo formatMonnaie($mAll-$mRecu) ?></td>
	                    	</tr>
                    	
                    	</tbody>
                    	
                    	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.content-wrapper -->
<style>
    .legend
    {
        text-decoration: none;
        display: inline-block;
        float: left;
        margin-left: 15px;
    }
    
    .bold{
    font-weight:bold;
    }

    .legend span
    {
        padding: 7px;
        border: dashed;
        border-color: #0a0a0a;
    }
</style>

<?php
if(!empty($message)) {
    if (is_bool($status) and $status) echo "<script type='text/javascript'>alertify.success($message);</script>";
    else echo "<script type='text/javascript'>alertify.error($message);</script>";
}
?>

<script type="text/javascript">

    function shelve($this){
        var idReg = $($this).attr('value'),
            $tr = $($this).parent().parent();
        alertify.confirm(
            '<p style="text-align: center;">Voulez vous vraiment suspendre l\'inscription de<br>'
            + '<b>'+$tr.find('td b').eq(0).text()+'</b> pour l\'enseigenement <br>'
            + '<b>'+$tr.find('td').eq(1).text()+'</b> ?'
            + '</p>',
            function(){
                $(location).attr('href', '<?php echo base_url('admin/registration/shelveRegistration') ?>'+'/'+idReg);
            }).setHeader('Confirmation de suspension').set({reverseButtons: true});
    }

    $(document).ready(function(){
        alm('collapseReg', 0);
        <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
    });
</script>
