<head>
	<meta http-equiv="refresh" content="161">
	<title>Communication en classe virtuelle : Votre Matricule -><?php echo session_data('matricule').'/'.session_data('lastname').'/'.session_data('firstname'); ?></title>
</head>
<body style="background-image: url('<?php echo base_url().'assets/img/logo/g155.png';?>'); background-size: cover">
<div style="color: #ffcd42">

<div class="col-sm-2" style="margin-top: 4.04px">
	<h3 class="panel-title">
    	<span style="color:#f0e68c;font-size:13px;font-family:Comic Sans MS;padding-left:62px;">
        <?php 
        	echo '
        	<div class="btn-group btn-group-justified" style="margin-top: 8%" role="group">';
        		foreach ($isWave as $key) {
		        	echo '
					<button type="button" class="btn btn-default glyphicon glyphicon-qrcode" style="width: 184px;"> Vague : '.$key['code_wave'].'
					</button>
				</div>';
					if (sizeof($this->db->where('id_wv', $key['id_wave'])->get('e_course_session')->result_array())!=0) {
						$query = $this->db->where('id_wv', $key['id_wave'])->get('e_course_session')->last_row();
					}
					if (sizeof($query)!=0) {
						
						$id_sess = $query->id_sess;
						if (sizeof($this->db->where('id_user', session_data('id'))->where('id_sess', $id_sess)->get('e_presence')->result_array())==0) {
							$n=1;
							$t = moment()->format('Y/m/d H:i:s');
							$data=array('id_user'=>session_data('id'), 'id_sess'=>$id_sess, 'minutes'=>$n, 'last_time'=>$t);
							$this->db->insert('e_presence', $data);
						}
						$last_minutes = $this->db->where('id_user', session_data('id'))->where('id_sess', $id_sess)->get('e_presence')->row()->minutes;
			            if (sizeof($this->db->where('id_user', session_data('id'))->where('id_sess', $query->id_sess)->get('e_presence')->result_array())!=0) {
			            	$last = $this->db->where('id_user', session_data('id'))->where('id_sess', $query->id_sess)->get('e_presence')->row()->last_time;
			            	if (62-(moment()->format('s'))<=4) {
			            		$t = moment()->format('Y/m/d H:i:s');
				            	$last_minutes+=1;
				            	$this->db->set('minutes', $last_minutes);
				            	$this->db->set('last_time', $t);
								$this->db->where('id_user', session_data('id'));
								$this->db->where('id_sess', $query->id_sess);
								$this->db->update('e_presence');
			            	}
			            }
					}
				} 
		?>
		</span>
	</h3>
	<a href="<?php echo base_url().'e_controllers/c_take_courses' ?>" class="btn btn-default glyphicon glyphicon-circle-arrow-left" style="margin-top: 35%;">
		SORTIR
	</a><br>
<?php
	echo '<br><br><div class="btn btn-warning"> Liste des apprenants : </div>';
	foreach ($isWave as $key) {
		if ($key['status'] == 1) {
			$Wave = $this->db->where('id_wv', $key['id_wave'])->get('e_content')->result_array();
		}
		foreach ($Wave as $key1) {
			if(session_data('connect') /*or ($this->db->where('id_wv'))*/) {
				$firstname = $this->db->where('id', $key1['id_user'])->get('user')->row()->lastname;
				$avatar = $this->db->where('id', $key1['id_user'])->get('user')->row()->avatar;
				$sexe = $this->db->where('id', $key1['id_user'])->get('user')->row()->sexe;
				$matricule = $this->db->where('id', $key1['id_user'])->get('user')->row()->number_id;
				if ($sexe=='1' and $key1['status'] == 1) {
					echo '
						<div class="btn-group btn-group-justified" role="group" style="margin-top: 13%">
							<div class="btn-group btn-group-lg" role="group">
								<img src="'.base_url().$avatar.'" style="height: 49px; width: 53px;">
							</div>
							<div class="btn-group btn-group-sm" role="group">
								<button class="btn btn-default" style="color:blue; height: 49px; width: 200px; font-size: 17px;">'.$firstname.'</button>
							</div>
							<button class="btn btn-default" style="height: 22px;width: 76px; font-size: 10px">'.' '.$matricule.'
							</button>
						</div><br>';
				}
				else{
					echo '
						<div class="btn-group btn-group-justified" role="group" style="margin-top: 13%">
							<div class="btn-group btn-group-lg" role="group">
								<img src="'.base_url().$avatar.'" style="height: 53px; width: 53px;">
							</div>
							<div class="btn-group btn-group-sm" role="group">
								<button class="btn btn-default" style="color:#ff1ad6; height: 53px;width:200px; font-size: 17px;">'.$firstname.'</button>
							</div>
						</div><br>';
				}
			}
			else{
				$firstname = $this->db->where('id', $key1['id_user'])->get('user')->row()->firstname;
				echo '
					<span class="fa fa-user fa-2x" style="color:gary;margin-top:-350px;">
					</span>&ensp;<p style="color:blue;">
				'.$firstname.'</p><br>';
			}
		}
	}
?>
</div>

<?php
	foreach ($isWave as $key) {
		if ($key['status_classe'] == 1) {
			if ($key['status'] == 1) {
				$code_wave = $key['code_wave'];
				$id_wave = $key['id_wave'];
			}
			else{
				echo '
				<div class="alert alert-danger" role="alert" style="text-align: center;margin-top: 202px; margin-left: -80px;">Cette classe a fini les cours (Veuillez consulter le planing des examens ou contacter l\'admininstration plus de détails" ) !
					<span class="input-group-btn">
				        <a href="'.base_url().'/e_controllers/c_take_courses'.'"><button class="btn btn-info" type="button">OK</button></a>
				    </span>
				</div>';
			}
		}
		else{
			echo '
			<div class="alert alert-danger" role="alert" style="text-align: center;margin-top: 103px; margin-left: -80px;">Cette classe est momentanément fermée !<br>
				<span class="input-group-btn">
			        <a href="'.base_url().'/e_controllers/c_take_courses'.'"><button class="btn btn-info" type="button">OK</button></a>
			    </span>
			</div>';
		}
	}
?>
<div class="col-md-4" style="margin-top: 4.04px">
    <form action='<?php echo base_url().'trainner/send?name='.$id_wave ?>' method="post" class="formulaire">
		<div class="panel-heading top-bar" style="background-color:#191970;color: yellow; text-align: center; font-size: 62px;">
       		<?php
       			$id_l = $this->db->where('id_wave', $id_wave)->get('e_wave')->row()->id_lesson;
       			echo '# '.$this->db->where('id', $id_l)->get('lesson')->row()->code.' #' ;?>
       	</div>
       	<div class="input-group">
       		<input type="text" name="message" class="form-control message" placeholder="envoyer un message simple" style="font-size:13px; font-family:Comic Sans MS;color: #444">
            <input type="hidden" name="id_wav" value="<?php echo $id_wave ;?>">
           	<span class="input-group-btn">
           		<button class="btn btn-primary" class="formulaire" id="btn-chat">
           			<span class="fa fa-location-arrow"></span>
           		</button>
           	</span>
       	</div>
    </form>


<br>
    <div class="col-md-2">
        <div class="dropdown d-inline-block">
            <span class="btn btn-default dropdown-header" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseInfoFlash" style=" color: black; font-family: Algerian;" title="Cliquez pour voir toutes les infos vous consernant.">
                    <i class="fa fa-bullhorn fa-2x float-left"> </i>&nbsp; Infos Flashs
                </a>
            </span>
            <div class="dropdown-menu">
                <ul class="sidebar-second-level collapse" id="collapseInfoFlash" style="color: gray; font-size: 14px">
                    <marquee behavior="scroll" scrolldelay="300" direction="up" onmouseover="this.stop();" onmouseout="this.start();" style="margin-right: 22px; width: 310px; height: 202px;font-family: Times New Roman">
<?php
$waves_user = $this->db->select('*')->from('e_content')->where('id_user', session_data('id'))->get()->result_array();
foreach ($waves_user as $key404) {
    $session_user = $this->db->where('id_wv', $key404['id_wv'])->get('e_course_session')->result_array();
    $waves = $this->db->where('id_wave', $key404['id_wv'])->get('e_wave')->result_array();
    foreach ($waves as $key040) {
        $all_info_flash = $this->db->where('id_wav', $key404['id_wv'])->where('type_com', 'Info Flash')->get('e_communication')->result_array();
        foreach ($session_user as $key22) {
            foreach ($all_info_flash as $info) {
                    $role = $this->db->where('user', $info['id_user'])->get('user_role')->result_array();
                    $user = $this->db->where('id', $info['id_user'])->get('user')->result_array();
                    foreach ($user as $key26) {
                        foreach ($role as $key35) {
                            $Signature ='';
                            if ($key35['role'] == 6) {
                                $Signature = 'La Direction.';
                            }else{
                                $Signature = 'Le formateur';
                            }
                        }
                        echo '
                        <span class="info-flash">
                            <p style="float: right;"> '.$key040['code_wave'].'</p><br>
                            <label style="width: 112%, margin-right: 10%; color: green">'.$info['message'].'</label>
                            <strong> Depuis le '.moment($info['time_send'])->format('d/m/Y').' .</strong><br/>
                            <p style="float: right;">'.$Signature.'</p><br>
                            <strong style="color: blue"> M. '.$key26['lastname'].'</strong>
                        </span>
                        <hr style="border: 1px dashed #FF8E0F">';
                }
                if ($all_info_flash==null) {
                        echo '
                        <span class="info-flash">
                            <p style="float: right;"> Aucune vague consernée</p><br>
                            <p class="btn btn-primary" style="width: 100%">Rien pour le moment</p>
                            <p style="float: right;">MULTISOFT ACADEMY</p><br>
                        </span>
                        <hr style="border: 1px dashed #FF8E0F">'; 
                }
            }
        }
    }
}
?>
                    </marquee>
                </ul>
            </div>
        </div>
    </div>



    <div id="auto"></div>

    </div>
    <div class="col-md-6" id="chat_window_1" style="float: right;margin-top: 4.04px">
        <div class="col-xs-12 col-md-12" style="min-height: 602px;">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar" style="background-color:#191970;height:44px;">

                </div>
                <div class="panel-body msg_container_base">
                    <div class="row msg_container base_sent" id="msg_chat_container" >
                <?php
                	if ($message==null) {
                		$message = $this->db->select('*')
									        ->from('e_communication')
									        ->join('e_wave','e_wave.id_wave=e_communication.id_wav')
									        ->join('user','user.id=e_communication.id_user')
									        ->where('e_communication.id_wav='.$id_wave)
									        ->get()->result_array();
                	}
                    foreach ($message as $key) {
                        if ($key['id']==session_data('id')){
                ?>
                        <div class="row msg_container base_receive">
                            <div class="col-md-10 col-xs-10">
                              	<div class="messages msg_sent" style="margin-top:10px;overflow-y:scroll;">
                                  	<p><?php echo htmlspecialchars($key['message']) ; ?></p>
                                  	<time><?php echo $key['firstname'].' . '.$key['time_send'];?></time>
                              	</div>
                            </div>
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="<?php
                                $avatar = $this->db->where('id', $key['id'])->get('user')->row()->avatar; echo base_url().$avatar;?>" class="img-responsive">
                            </div>
                        </div>

                      	<?php
                        }
                        else {
                        	if ($key['type_com']) {
                        	if ($key['type_com']!='Info Flash') {
                        ?>
                      	<div class="row msg_container base_receive">
                          	<div class="col-md-2 col-xs-2 avatar">
                              	<img src="<?php
                                $avatar = $this->db->where('id', $key['id'])->get('user')->row()->avatar; echo base_url().$avatar;?>" class="img-responsive">
                          	</div>
                          	<div class="col-md-10 col-xs-10">
                              	<div class="messages msg_receive">
                                  	<?php echo htmlspecialchars($key['message']) ; ?>
                                  	<time>
                                  		<?php echo $key['firstname'].' . '.$key['time_send'];?>
                              		</time>
                              	</div>
                          	</div>
                      	</div>
                        <?php
                        	}
                        	}
                        }
                      }?>
    		    </div>
        	</div>
    	</div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('.formulaire').submit(function(e){
      var $this = $(this);

      e.preventDefault();
      $.ajax({
        url: "<?php echo base_url().'trainner/send/ajax'?>",
        type: 'POST',
        data: $this.serializeArray(),
        success: function(donnees){
            var sender = `
            <div class="row msg_container base_receive">
              <div class="col-md-10 col-xs-10">
                <div class="messages msg_sent" style="margin-top:4px;">
                    ${donnees.message}
                    <time><?php echo session_data('firstname') ?>, ${donnees.time_send}</time>
                </div>
              </div>
              <div class="col-md-2 col-xs-2 avatar">
                  <img src="<?php echo base_url().session_data('avatar');?>" class=" img-responsive ">
              </div>
            </div>`;

            sender = $('<div></div>').append(sender).html();
            $('#msg_chat_container').append(sender);
            $this.find('input').each(function(k, val){
              $(val).val('');
            })
          },
      });
    });
 });
</script>
<style>
	body{
	    height:521px;
	    bottom: 0;
	}
	.col-md-2, .col-md-10{
	    padding:0;
	}
	.panel{
	    margin-bottom: 0px;
	}
	.chat-window{
	    bottom:0;
	    position:fixed;
	    float:right;
	    margin-left:10px;
	    text-decoration: none;
	}
	.chat-window > div > .panel{
	    border-radius: 5px 5px 0 0;
	}
	.icon_minim{
	    padding:2px 10px;
	}
	.msg_container_base{
	  background: #e5e5e5;
	  margin: 0;
	  padding: 0 10px 10px;
	  max-height:494px;
	  overflow-x:hidden;
	}
	.top-bar {
	  background: #666;
	  color: white;
	  padding: 10px;
	  position: relative;
	  overflow: hidden;
	}
	.msg_receive{
	    padding-left:0;
	    margin-left:0;
	}
	.msg_sent{
	    padding-bottom:20px !important;
	    margin-right:0;
	}
	.messages {
	  background: white;
	  padding: 8px;
	  border-radius: 1px;
	  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
	  max-width:100%;
	}
	.messages > p {
	    font-size: 13px;
	    margin: 0 0 0.2rem 0;
	  }
	.messages > time {
	    font-size: 11px;
	    color: #ccc;
	}
	.msg_container {
	    padding: 10px;
	    overflow: hidden;
	    display: flex;
	}
	.avatar {
	    position: relative;
	}
	.base_receive > .avatar:after {
	    content: "";
	    position: absolute;
	    top: 0;
	    right: 0;
	    width: 0;
	    height: 0;
	    border: 5px solid #FFF;
	    border-left-color: rgba(0, 0, 0, 0);
	    border-bottom-color: rgba(0, 0, 0, 0);
	}

	.base_sent {
	  justify-content: flex-end;
	  align-items: flex-end;
	}
	.base_sent > .avatar:after {
	    content: "";
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 0;
	    height: 0;
	    border: 4px solid white;
	    border-right-color: transparent;
	    border-top-color: transparent;
	    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
	}

	.msg_sent > time{
	    float: right;
	}
	.msg_container_base::-webkit-scrollbar-track{
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	    background-color: #F5F5F5;
	}
	.msg_container_base::-webkit-scrollbar{
	    width: 12px;
	    background-color: #F5F5F5;
	}
	.msg_container_base::-webkit-scrollbar-thumb{
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	    background-color: #555;
	}
	.btn-group.dropup{
	    position:fixed;
	    left:0px;
	    bottom:0;
	}
</style>
</div> 

</div>
 </body>