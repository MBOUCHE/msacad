<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4><b><?php echo mb_strtoupper('Choix de la vague') ?> </b></h4>
            </div>
        </div>
        <hr />

        <div class="row">
	         <div class="col-sm-12 table-responsive">
	                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
	                    <thead>
	                    <tr>
	                        <th  class="text-center hide">N&#176;</th>
	                        <th>Code</th>
	                        <th>Enseignement</th>
	                        <th>Option</th>
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
	                            echo "<td class='hide'>".$line."</td>";
	                            echo "<td>$promo->code</td>";
	                            echo "<td>".mb_strtoupper($promo->label)."</td>";
	                            echo "<td>
	                                      <a href='".base_url('trainerGate/examination/promotions/')."/".$promo->code."' class='w3-btn w3-blue '>Détails</a>
	                                      ";
	                            echo "</td>";
	                            echo "</tr>";
	                        }
	                    ?>
	                    </tbody>
	                </table>
	            </div>
            
        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function(){
            leftM(1, '#panel-evaluation');
        });
    </script>
</div>
<!--END PAGE CONTENT -->