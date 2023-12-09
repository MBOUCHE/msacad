<div class="panel panel-default" style="margin-top: -1.5%">
  	<div class="panel-body">
  		<div class="h4 text-center  col-sm-10" style="color: orange; float: right;">
  			PLANNING DE VOS FORMATIONS
  			<hr width="60%" style="margin: auto; margin-top: 10px;">
  		</div>

		<div class="panel panel-default" style="width: 83%; float: right;text-align: center; margin-right:-13px">
		<table class="table" style="text-align: center; color: blue;">
			<tr class="h5" style="background-color: #4221ef;width: 166px;color:#21ef4f;">
				<th>Heures</th>
				<th>Lundi</th>
				<th>Mardi</th>
				<th>Mercredi</th>
				<th>Jeudi</th>
				<th>Vendredi</th>
				<th>Samedi</th>
			</tr>
			<?php

				$box = array();
	    		$week_bgn=null; $week_end=null;
				foreach ($IsWave as $nagato) {
					$allPrograms = $this->db->where('id_wv',$nagato['id_wv'])->get('e_provided')->result_array();
	    		foreach ($allPrograms as $key) {
					$id_wave = $key['id_wv'];
	    			if ($key['program']!=null) {
			   		foreach ($IsWave as $key5) {
		    			if ($key5['id_wv']!=null) {
							if ($week_bgn==null and $week_end==null) {
								$week_bgn = $this->db->where('id_wv', $id_wave)->limit(1)->get('e_provided')->row()->week_bgn;
								$week_end = $this->db->where('id_wv', $id_wave)->limit(1)->get('e_provided')->row()->week_end;
								echo '<div class="h4" style="color: blue; float: right;margin: 2%"> Semaine du '.(moment($week_bgn)->format('D d')).' au '.moment($week_end)->format('D d M Y').'.</div>';
							}
		    			}
		    		}
	    			$Tab_prog = str_split($key['program']);

					$j=0;
		    		foreach ($IsWave as $key5) {
		    			$id_wv = (int)$key5['id_wv'];
		    			if ($id_wave==$key5['id_wv']) {
	    					$Tab_prog = str_split($key['program']);
	    					$sizeTab = sizeof($Tab_prog);
	    					for($i = 0; $i < $sizeTab; $i++){
	    						if ($Tab_prog[$i]=='(') {
	    							if ($Tab_prog[$i+1]=='1' and $Tab_prog[$i+2]=='0') {
	    								$box[1] = '10';
	    								$box[2] = $Tab_prog[$i+4];
	    								if (($Tab_prog[$i+6]=='1' or $Tab_prog[$i+6]=='2' or $Tab_prog[$i+6]=='3' or $Tab_prog[$i+6]=='4' or $Tab_prog[$i+6]=='5' or $Tab_prog[$i+6]=='6' or $Tab_prog[$i+6]=='7') and $Tab_prog[$i+7]!=')') {	
	    									$box[3] = $Tab_prog[$i+6].$Tab_prog[$i+7];
	    								}else{
	    									$box[3] = $Tab_prog[$i+6];
	    								}
	    							}
	    							else{
	    								$box[1] = $Tab_prog[$i+1];
		    							$box[2] = $Tab_prog[$i+3];
		    							if (($Tab_prog[$i+6]=='1' or $Tab_prog[$i+6]=='2' or $Tab_prog[$i+6]=='3' or $Tab_prog[$i+6]=='4' or $Tab_prog[$i+6]=='5' or $Tab_prog[$i+6]=='6' or $Tab_prog[$i+6]=='7') and $Tab_prog[$i+6]!=')') {	
	    									$box[3] = $Tab_prog[$i+6].$Tab_prog[$i+7];
	    								}else{
		    								$box[3] = $Tab_prog[$i+5];
	    								}
	    							}
	    							$cell[$j++]=$box;
	    						}
	    					}
		    			}
					}
	    			}
				}
	    		}
	    	$k=0;

    		foreach ($IsWave as $key5) {
    			$IsWaveWv[$k++] = $this->db->where('id_wave', $key5['id_wv'])->get('e_wave')->result_array();
    		}
    		$k=0;
	    	foreach ($IsWaveWv as $key) {
	    		foreach ($key as $Ned) {
	    			$IsModule[$k++] = $this->db->where('id_lesson', $Ned['id_lesson'])->get('e_composed')->result_array();
	    		}
	    	}
			for ($i=7; $i < 17; $i++) {
				$y=0;
				$x = $i-6;
				echo '
				<tr>
					<td class="h5" style="background-color: gray; width: 166px;color:#21ef4f;">
						'.$i.' H 00 - '.($i+1).'H 00
					</td>
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($cell as $key) {
						foreach ($IsModule as $peter) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(1) and $fana['id_mod']==$key[3]) {
										echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									}
								}
							}
						}
					}
					echo '</td>
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($cell as $key) {
						foreach ($IsModule as $peter) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(2) and $fana['id_mod']==$key[3]) {
									//$id_trainner = $this->db->where('id_wv', $id_wave)->get('e_provided')->row()->id_user;
									/*if ($this->db->where('id_mod', $nagato['id_mod'])->get('e_provided')->row()->id_mod==$fana['id_mod']) {*/
									//echo ;
									echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									//echo $this->db->where('id', $id_trainner)->get('user')->row()->lastname;
									//}
									}
								}
							}
						}
					}
					'</td>';
					echo '
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($cell as $key) {
						foreach ($IsModule as $peter) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(3) and $fana['id_mod']==$key[3]) {
										echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									}
								}
							}
						}
					}
					'</td>';
					echo '
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($cell as $key) {
						foreach ($IsModule as $peter) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(4) and $fana['id_mod']==$key[3]) {
										echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									}
								}
							}
						}
					}
					'</td>';
					echo '
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($IsModule as $peter) {
						foreach ($cell as $key) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(5) and $fana['id_mod']==$key[3]) {
										echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									}
								}
							}
						}
					}
					'</td>';
					echo '
					<td style="background-color: #fefcf4;width: 166px;">';
					foreach ($cell as $key) {
						foreach ($IsModule as $peter) {
							foreach ($peter as $fana) {
								if (sizeof($fana)==6) {
									if ($key[1]==$x and $key[2]==(6) and $fana['id_mod']==$key[3]) {
										echo '<label style="font-size: 17px; font-family: SimSun;">'.$this->db->where('id_mod', $key[3])->get('e_module_teach')->row()->code_mod.'</label> ';
									}
								}
							}
						}
					}
					'</td>
				</tr>';
			}
		?>
		</table>
		<?php
		if ($cell!=null) {
			echo '<div class="h4" style="color: blue; float: right; margin: 2%; font-family: Algerian;"> 
					L\'administrateur.
				</div>';
		}
		?>
		</div>
  	</div>
</div>
