<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper("Résultats de recherche pour: <br>'").$query."'" ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row" style="">
            <div class="container">
                <div class="row">
                <?php
                    $test = array();
                    foreach($result as $key=>$value)
                    {
                        if(is_array($value) And count($value)>0)
                        {
                            $test[count($test)] = $key;
                        }
                    }

                    if(count($test)>0){
                        if(in_array('document', $test)){
                ?>
                    <div class="col-sm-12 w3-responsive w3-margin-top">
                        <div class="col-12 w3-left-align h5 w3-margin-bottom"><span class="w3-border-bottom w3-border-grey w3-text-grey">Résultats documents</span></div>
                        <table class="table w3-table-all small dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Code</th>
                                <th>Détails</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody id="table-list">
                            <?php
                                $i=0;
                                foreach($result['document'] as $liste)
                                {
									echo '<tr id="' . $liste->id . '"><td class="text-center">' . ++$i . '</td>';
									echo '<td>' . strtoupper($liste->code) . '</td>';
									echo '<td class="detail"><b>' . $liste->name.'</b>';
									if($liste->post_date = moment($liste->post_date))
										echo '<br><i>Mis en ligne le <span class="post_date">' . $liste->post_date->format('l, jS F Y à H:i:s') . '</span></i>';
									echo '<br><i class="w3-small w3-text-dark-grey">Derniere publication <span class="date">';
									echo ($liste->last_publish_date = moment($liste->last_publish_date))?$liste->last_publish_date->fromNow()->getRelative():'(Pas encore publié)';
									echo '</span></i></td>';
									echo '<td>
												<a href="' . base_url() . $liste->path . '" target="_blank" class="lock w3-btn w3-white w3-small w3-margin-small" title="Afficher">
													<i class="fa fa-2x fa-file-pdf-o text-danger" aria-hidden="true"></i>
												</a>
												<button class="lock w3-btn w3-white w3-small w3-margin-small publier" title="Publier" onclick="publish(this)">
													<i class="fa fa-2x fa-share-alt-square w3-text-blue" aria-hidden="true" style="cursor: pointer;"></i>
												</button>
											</td></tr>';
								}
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }

                        if(in_array('lesson', $test)) {
                    ?>
                    <div class="col-sm-12 table-responsive w3-margin-top">
                        <div class="col-12 w3-left-align h5 w3-margin-bottom"><span class="w3-border-bottom w3-border-grey w3-text-grey">Résultats enseignements</span></div>
                        <table class="table table-bordered table-hover small dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">N&#176;</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Details</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=0;
                                foreach($result['lesson'] as $liste)
                                {
                                    echo '<tr><td class="text-center">' . ++$i . '</td>';
                                    echo '<td>' . strtoupper($liste->code) . '</td>';
                                    echo '<td>' . $liste->label . '</td>';
                                    echo '<td>Durée : ' . $liste->duration . '<br> Type de lesson : ' . $liste->type . '<br> Frais : ' . $liste->fees . ' FCFA</td>';
                                    echo '<td>
                                            <a href='.base_url('admin/lesson/modify/'.$liste->id).' title="modifier!" class="lock w3-btn w3-white w3-small w3-margin-small"><i class="fa fa-pencil fa-2x w3-text-black"></i></a>
                                            <a title="supprimer!" class="drop lock w3-btn w3-white w3-small w3-margin-small" value='.$liste->id.' onclick="drop(this)"><i class="fa fa-trash fa-2x w3-text-red"></i></a>
                                    </td></tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }

                        if(in_array('promotion', $test)) {
                    ?>
                    <div class="col-sm-12 table-responsive w3-margin-top">
                        <div class="col-12 w3-left-align h5 w3-margin-bottom"><span class="w3-border-bottom w3-border-grey w3-text-grey">Resultats promotions</span></div>
						<table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                            <thead>
								<tr>
									<th  class="text-center">N&#176;</th>
									<th>Code</th>
									<th>Enseignement</th>
									<th>Dates</th>
									<th>Options</th>
								</tr>
							</thead>
                            <tbody>
                            <?php
                            $line=0;
                            foreach ($result['promotion'] as $promo)
                            {
								$line++;
								echo "<tr>";
								$stat="";
								$lock="";
								$title="";
								$show="";
								switch ($promo['state'])
								{
									case '-1': echo "<td><span class='w3-red' style='padding: 7px'>".$line."</span></td>"; $lock="fa-play"; $title="Relancer"; $stat="w3-text-green"; break;
									case '0': echo "<td><span class='w3-green' style='padding: 7px'>".$line."</span></td>"; $lock="fa-play"; $title="Commencer"; $stat="w3-text-green"; break;
									case '1': echo "<td><span class='w3-white' style='padding: 7px;'>".$line."</span></td>"; $lock="fa-pause"; $title="Suspendre"; $stat="w3-text-red"; break;
									case '2': echo "<td><span class='w3-grey' style='padding: 7px'>".$line."</span></td>"; $show="w3-hide"; break;
									default: echo "<td>".$line."</td>"; break;
								}

								echo "<td><b>".$promo['code']."</td>";
								echo "<td>".mb_strtoupper($promo['label'])."</td>";
								$state="";
								switch ($promo['state'])
								{
									case '0': $state='opened'; break;
									case '1': $state='pending'; break;
									case '-1': $state='suspended'; break;
									case '2': $state='ended'; break;
								}
								echo "<td class='small'>Début : <b>".date_format(date_create($promo['start_date']), 'd-m-Y')."</b><br>
										Fin : <b>".($promo['end_date']!=NULL?date_format(date_create($promo['end_date']), 'd-m-Y'):'Pas encore')."</b></td>";

								echo "<td id='{$promo['id']}'>
										  <button id='$state' type='button' class=' lock w3-btn w3-white w3-small w3-margin-small $show' title='$title' onclick='lock(this)'><i class='fa $lock fa-2x $stat'></i></button>
										  <button class='endpromo w3-btn w3-white w3-margin-small $show'  title=\"Terminer la vague\" onclick='endpromo(this)'><i class='fa fa-check-circle fa-2x w3-text-green'></i></button>
										  <a href='".base_url('admin/promotion/printStudents')."/".$promo['id']."' class='promolist w3-btn w3-white w3-margin-small' title=\"Afficher la liste des apprenants\"><i class='fa fa-list fa-2x w3-text-blue'></i></a>";
								echo "</td>";
								echo "</tr>";
							}
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }

                        if(in_array('registration', $test)) {
                    ?>
                    <div class="col-sm-12 table-responsive w3-margin-top">
                        <div class="col-12 w3-left-align h5 w3-margin-bottom"><span class="w3-border-bottom w3-border-grey w3-text-grey">Resultats inscriptions</span></div>
                        <table class="table table-bordered table-hover small dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th  class="text-center">N&#176;</th>
                                <!--th rowspan="2">Photo</th-->
                                <th>Apprenant</th>
                                <th>Enseignement</th>
                                <th  style="text-align: center">Frais (FCFA)</th>
                                <th>Date</th>
                                <th>Options</th>

                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            //var_dump($allReg); die(0);
                            $line=0;
                            foreach ($result['registration'] as $reg)
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

                                echo "<td><b class='name'>".$reg['firstname']." ".$reg['lastname']."</b><br>".$reg['phone']."</td>";
                                echo "<td class='lesson'>". mb_strtoupper($reg['label']) ."</td>";
                                echo "<td>À Payer : <b>".$reg['fees']."</b><br>
                                Payé : <b>".$reg['installment']."</b><br>
                                Restant : <b>".($reg['fees']-$reg['installment'])."</b></td>";
                                echo "<td class='small'>Inscription : <b>".date_format(date_create($reg['reg_date']), 'd-m-Y')."</b><br>
                                    Validation : <b>".($reg['val_date']!=NULL?date_format(date_create($reg['val_date']), 'd-m-Y'):'Pas encore')."</b><br>
                                    Délai : <b>".($reg['dead_line']!=NULL?date_format(date_create($reg['dead_line']), 'd-m-Y'):'Aucun')."</b></td>";
                                echo "<td>
                                      ";
                                if( $reg['state'] == 0 ){
                                    echo "<button value=".$reg['regId']." data-target=\"#myModal\" class='lock w3-btn w3-white w3-small w3-margin-small shelve'  title=\"Suspendre\" onclick='shelve(this)'>
                                                <i class='fa fa-trash fa-2x w3-text-red'></i>
                                            </button>";
                                }else{

                                }
                                if($reg['state']!=-1)
                                    echo "<a href=".base_url('admin/registration/printQuitus')."/".$reg['regId']." class='w3-btn w3-white w3-margin-small' title=\"Imprimer le quitus\">
                                                <i class='fa fa-print fa-2x w3-text-blue'></i>
                                              </a>";
                                if (($reg['fees']-$reg['installment'])!=0)
                                    echo "<a href=".base_url('admin/registration/payInstallement')."/".$reg['regId']."/".$reg['userId']." class='w3-btn w3-white w3-small w3-margin-small' title=\"Payer une tranche\">
                                                <i class='fa fa-credit-card fa-2x w3-text-orange'></i>
                                              </a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }

                        if(in_array('user', $test)) {
                    ?>
                    <div class="col-sm-12 table-responsive w3-margin-top">
                        <div class="col-12 w3-left-align h5 w3-margin-bottom"><span class="w3-border-bottom w3-border-grey w3-text-grey">Resultats utilisateur</span></div>
                        <table class="table table-bordered table-hover small dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Photo</th>
                                <th>Matricule</th>
                                <th>Noms et Prénoms</th>
                                <th>Contacts</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $k = 0;
                                foreach($result['user'] as $user)
                                {
                                    $k++;
                                    $state = $user->state;
                                    $bgcolor = ($state == '-1')? 'w3-red':(($state == '0')? 'w3-green':'w3-white');
                                    $toHide = ($state == '0')?'w3-hide toHide':'';
                                    echo '<tr><td><span class="text-center '.$bgcolor.' text-white" style="padding: 7px">' . $k . '</span></td>';
                                    echo isset($user->photo) ? '<td class="text-center"><img src="' . base_url().$user->photo . '" class="responsive-img" height="50"></td>' :
                                        '<td class="text-center"><img src="' . img_url('/logo/logo.png') . '" class="responsive-img" height="50"></td>';
                                    echo '<td>' . $user->number_id . '</td>';
                                    echo '<td>' . strtoupper($user->lastname) . ' ' . ucfirst($user->firstname) . '</td>';
                                    echo '<td>' . $user->phone .'<br>'. $user->mail . '</td>';
                                    echo '<td>
                                    <a href="'.base_url('admin/user/profile').'/'.$user->uid.'" class="w3-btn w3-white w3-margin-small" title="Profil"><i class="fa fa-2x fa-user w3-text-blue" aria-hidden="true"></i></a>
                                    <button class="'.$toHide.' w3-btn w3-white w3-margin-small" title="'.($user->state=='-1'?'Déverouiller':'Vérouiller').'" onclick="alertify.confirm(\'Confirmation de '.($user->state=='-1'?'réactivation':'suspension').'\', \'Voulez-vous vraiment <b>'.($user->state=='-1'?'réactiver':'suspendre').'</b> cet utilisateur ?\', function(){
                                            window.location.href=\''.base_url('admin/user/lock/').'\'+\'/\'+'.$user->uid.';
                                        },
                                        function(){
                                            alertify.error(\' '.($user->state=='-1'?'Réactivation ':'Suspension').' Annulée \');
                                        })
                                    "><i class="fa fa-2x '.($user->state=='-1'?'fa-unlock w3-text-green':'fa-lock w3-text-red').'" aria-hidden="true"></i></button>
                                    </td></tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                        }
                    }else{
                ?>
                    <div class="col-sm-12 h4 text-center w3-padding-16 w3-margin-top"><span>Aucun resultat trouvé...</span></div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        function rolesChange($this){
            $this = $($this);
            var $vague = $this.parent().parent().parent().parent().find('#vague');
            if($this.val() == 2){
                $vague.removeClass('w3-hide');
            }else if(!$vague.hasClass('w3-hide')){
                $vague.addClass('w3-hide');
            }
        }

        function shelve($this){
            var idReg = $($this).attr('value'),
                $tr = $($this).parent().parent();
            alertify.confirm(
                '<p style="text-align: center;">Voulez vous vraiment suspendre l\'inscription de<br>'
                + '<b>'+$tr.find('td b').eq(0).text()+'</b> pour le cour <br>'
                + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
                + '</p>',
                function(){
                    $(location).attr('href', '<?php echo base_url('admin/registration/shelveRegistration') ?>'+'/'+idReg);
                }).setHeader('Confirmation de suspension').set({reverseButtons: true});
        }

        function drop($this){
            var idL = $($this).attr('value'),
                $tr = $($this).parent().parent();
            alertify.confirm(
                '<p style="text-align: center;">Voulez vous vraiment suprimer l\'enseignement <br>'
                + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
                + '</p>',
                function(){
                    $(location).attr('href', '<?php echo base_url('admin/lesson/delete') ?>'+'/'+idL);
                }
            ).setHeader('Confirmation de supression').set({reverseButtons: true});
        }

        function publish($this){
            var idDoc = $($this).parent().parent().attr('id'),
                titre = 'Publier: '+$('#table-list tr#'+idDoc+' td').eq(2).find('b').text();
            $.post('<?php echo base_url('admin/document/modalPublishContent')?>', {mode: 'js', doc: idDoc}, function(rep){
                    $.loader('close');
                    alertify.confirm(rep,
                        function(){$('#formPublish').trigger('submit');}
                    ).setHeader(titre).set({reverseButtons: true});
                }
            ).fail(function() {
                    $.loader('close');
                });
        }

        function lock($this){
            console.log('ok');
            var ids=$($this).parent();
            var id=ids.prop('id');
            var idt=$($this).prop('id');
            var title="";(idt==='opened'?'Démarrage':'Suspension');
            var message="";(idt==='opened'?'démarrer':'suspendre');
            var state="";(idt==='opened'?'annulé':'annulée');


            switch (idt)
            {
                case 'opened': title="Démarrage"; message="démarrer"; state="annulé"; break;
                case 'pending': title="Suspension"; message="suspendre"; state="annulée"; break;
                case 'suspended': title="Relancement"; message="relancer"; state="annulé"; break;
            }

            alertify.confirm("Confirmation de "+title, "Voulez-vous vraiment <b>"+message+"</b> cette vague ?",
                function(){
                    window.location.href='<?php echo base_url('admin/promotion/lock/')?>'+'/'+id.toString();
                },
                function(){
                    alertify.error(title+' '+state);
                });
        }

        function endpromo($this){
            var ids=$($this).parent();
            var id=ids.prop('id');
            //alert(id);
            alertify.confirm("Confirmation de terminaison", "Voulez-vous vraiment <b>achever</b> cette vague?",
                function(){
                    window.location.href='<?php echo base_url('admin/promotion/endPromo/')?>'+'/'+id.toString();
                },
                function(){
                    alertify.error('Cancel');
                });
        }

        $(document).ready(function(){
            $('.dataTable').DataTable();
        })
    </script>
</div>
<!-- /.content-wrapper -->