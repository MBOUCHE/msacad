<div class="panel panel-default" style="margin-top: -1.5%">
  	<div class="panel-body">
		<div class="row">
		  <div class="h2 text-center  col-sm-12" style="color: orange">
		      SOUMETTEZ VOTRE DISPONIBILITÉ
		      <hr width="80%" style="margin: auto; margin-top: 10px">
		  </div>
		</div>
		<div class="panel panel-default" style="width: 81%; float: right;">
			<form action="submitAvailability" method="post">
				<table class="table" style="text-align: center;">
					<tr style="background-color: #fbffbd">
						<td colspan="7">
				            <a href="">
				              <label class="btn btn-info" style="width: 200px; float: left;color: black; float: right;">
				                <span>Réinitialiser le tableau</span>
				              </label>
				            </a>

			              	<button type="submit" class="btn btn-success" style="width: 202px; float: right; margin-right: 4px;">
			                	<span>Soumettre</span>
			              	</button>

							<span class="h5" style="color: #3710ff;">
								Cette soumission servira dans le cas du possible à vous établir des emplois du temps personnalisés .
							</span>
						</td>
					</tr>
					<tr class="h5" style="background-color: #4221ef;width: 161px;color:#21ef4f;">
						<th>Heures</th>
						<th>Lundi</th>
						<th>Mardi</th>
						<th>Mercredi</th>
						<th>Jeudi</th>
						<th>Vendredi</th>
						<th>Samedi</th>
					</tr>

					<?php 
						for ($i=7; $i < 17; $i++) { 
							$x = $i-6;
							$y = 1;
							echo '
								<tr>
									<td class="h5" style="background-color: gray; width: 161px;color:#21ef4f;">
										'.$i.' H 00 - '.($i+1).'H 00
									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']">
									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']">
									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']">
									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']"><label>

									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']">
									</td>
									<td style="background-color: #fefcf4;width: 161px;">
										<input type="checkbox" name="heure-jour['.($x).']['.($y++).']">
									</td>
								</tr>';
						}
					?>
				</table>
			</form>
		</div>
  	</div>
</div>
