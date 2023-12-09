<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h3 text-center col-sm-12">
                LISTE DES RÉSULTATS DES EVALUATIONS
                <hr>
            </div>

            <p style="margin-left: 25px;">L&eacute;gende : </p>
            <ul style="padding-bottom: 30px">
                <li class="legend"><span class="w3-orange w3-text-white">#</span> Pas encore prêt</li>
                <li class="legend"><span class="w3-green">#</span> En attente</li>
                <li class="legend"><span class="w3-white">#</span> Publiée</li>
            </ul>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-striped small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th  class="text-center">N&#176;</th>
                        <th>Enseignement</th>
                        <th>Vague</th>
                        <th>Evaluation</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php
                    $line=0;
        
                    if ($results!=null)
                        foreach ($results as $result)
                        {
			$line++;
			?>
			<tr>
				<td>
					<?php echo $line ?>
				</td>
				
				<td>
					<?php echo mb_strtoupper($result->promotion->label) ?>
					<br><br>
					<?php
					if (!$result->allPub)
						echo "<button data-idt='".$result->promotion->code."' type='button' class='publishAll w3-btn w3-white w3-margin-small w3-margin-right w3-border w3-border-green'><i class='fa fa-share-alt fa-2x w3-text-green'></i>  Publier tous les résultats</button>";
					if ($result->allMarked)
						echo "<a href='".base_url('trainner/examination/results/')."/".$result->promotion->code."/".permalink('all')."' class='showresult w3-btn w3-white w3-border w3-border-blue w3-margin-small' title='Consulter tous les résultats'><i class='fa fa-list fa-2x w3-text-blue'></i>  Consulter tous les résultats</a>";
					?>
				</td>
				
				<td>
					<?php echo $result->promotion->code ?>
				</td>
				
				<td>
				
				<table class='table'>
					<?php
					
					if ($result->results!=null)
					{
						foreach($result->results as $k=>$rs)
						{
							$stat="";
							$lock="";
							$title="";
							$show="";
							if ($k>0) echo "<tr>";
							switch ($rs->published)
							{
								case '0': $lock="fa-share-alt"; $title="Publier"; $stat="w3-text-green"; break;
								case '1': $stat="w3-white"; $show="w3-hide"; break;
							}
							echo "<td>".$rs->ecode."</td>";
							echo "<td class='small'><b>".($rs->date!=null?date('\L\e d-m-Y à H \h i \m\i\n s \s', strtotime('+1 hours', strtotime($rs->date))):'Pas encore publié')."</b></td>";
							echo "<td>
							  <button data-idt='$rs->pcode' data-code='".permalink($rs->ecode)."' type='button' class='publish w3-btn w3-green small w3-margin-small $show'>$title</button>
							  <a href='".base_url('trainner/examination/results/')."/".$rs->pcode."/".permalink($rs->ecode)."' class='showresult w3-btn w3-blue small w3-margin-small'>Consulter</a>";
							echo "</td>";
							echo "</tr>";
						}
					}
					
					?>
				</table>
				
				</td>
			</tr>
			<?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-chevron-up"></i>
</a>
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

<script type="text/javascript">
    $(document).ready(function(){
        alm('collapseExa',2);
        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
        (function(){
            <?php
            if ($message=get_flash_data())
            if ($message[0]== "success") {
            ?>
            alertify.success("<?php echo $message[1] ?>");
            <?php
            } else { ?>
            alertify.defaults.theme.ok = "btn w3-red";
            alertify.defaults.glossary.ok = "OK";
            alertify
                .alert("<span class='w3-text-red'><i class='w3-text-red fa fa-ban'></i>  Erreur</span>", "<?php echo $message[1] ?>", function(){
                    alertify.error('Echec');
                });
            <?php   }
            ?>

        })();
        alertify.defaults.theme.ok = "btn btn-primary";
       
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.publish').on('click', function(){
            alertify.defaults.glossary.ok = "Oui";
            alertify.defaults.glossary.cancel = "Non";
            var id=$(this).attr('data-idt');
            var code=$(this).attr('data-code');
            alertify.confirm("Confirmation de publication", "Voulez-vous vraiment publier les résultats de cette évaluation ?",
                function(){
                    window.location.href='<?php echo base_url('trainner/examination/publish/')?>'+'/'+id.toString()+'/'+code.toString();
                },
                function(){
                    alertify.error("Publication annulée");
                });
        });

        $('.publishAll').on('click', function(){
            alertify.defaults.glossary.ok = "Oui";
            alertify.defaults.glossary.cancel = "Non";
            var id=$(this).attr('data-idt');
            alertify.confirm("Confirmation de publication", "Voulez-vous vraiment publier les résultats de cette vague ?",
                function(){
                    window.location.href='<?php echo base_url('trainner/examination/publish/')?>'+'/'+id.toString();
                },
                function(){
                    alertify.error("Publication annulée");
                });
        });
    });
</script>