<div class="panel panel-default" style="margin-top: -3%">
  	<div class="panel-body">
		<div class="row" style="color: #ff9000">
			<div class="col-sm-2"></div>
		    <div class="text-center  col-sm-10">
		    	<h3 class="page-title mb-3">
		    		<?php 
		    			if (sizeof($amountPosted)==1) {
		    				echo '(1) COUPON DISPONIBLE';
		    			}
		    			else{ 
		    				echo '('.sizeof($amountPosted).') COUPONS DISPONIBLES';
		    			}
		    		?>		
		    	</h3>
		        <hr width="60%" style="margin: auto; margin-top: 10px">
		    </div>
		</div>
		<div class="row" style=" width: 78%; float: right; margin-right: 22px; font-size: 17px">
			<table class="table" style="">
				<thead>
					<th>##</th>
					<th>Formation</th>
					<th>Date de payement</th>
					<th>Tranche correspondante</th>
					<th>Action</th>
				</thead>
		<?php
			$i = 1;
			foreach ($amountPosted as $key) {
				$lesson = $this->db->where('id', $key['id_lesson'])->get('lesson')->row()->label;
			echo '
				<tr>
					<td>'.($i++).'</td>
					<td>'.mb_strtoupper($lesson).'</td>
					<td>'.moment($key['date_paid'])->format(' d M Y').'</td>
					<td style="text-align: center">'.$key['num_slice'].' / '.$key['total_slice'].'</td>
					<td><a style="text-decoration: none;" href="'.base_url().'e_controllers/e_admin/generate/printQuitus/'.$key['id_paid'].'" class="glyphicon glyphicon-download-alt"> Télécharger</a>
					</td>
				</tr>';
			}
		?>
			</table>	
		</div>
  	</div>
</div>
