<style type="text/css">

</style>
<?php  //var_dump($ch1, $ch2, $ch3); die() ?>

<div class="content-wrapper py-3" style="background-image: url('<?php echo base_url().'assets/img/c.jpg'?>');background-size: cover;">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-11">
                <p style="color:red;font-size:30px;font-family:">classe virtuelle&ensp; <span style="color:indigo">#<?php echo $lister;?>#</span></p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>
        
        <div class="col-md-8 text-center">
            <?php
            foreach ($list as $key) {
                ?>
                    <div class="col-md-4" style="float:left"><p style="padding-left:35px;"><span class="fa fa-genderless"></span><p><span class="fa fa-user fa-2x" style="color:#dc143c;margin-top:-350px;"></span>&ensp;<p style="margin-top:-18px;color:blue;"><?php echo $key['firstname'];?></p></div>

                <?php
            }
            ?>
            <form action='<?php echo base_url().'trainner/send?name='.$_GET['name']?>' method="post" class="formulaire">
                <div class="col-md-8" style="padding-top:380px;padding-left: 220px;"><input type="text" name="message" class="form-control message" placeholder="envoyer un message " style="font-size:14px;font-family:Comic Sans MS;color:#444">
                  <input type="hidden" name="id_wav" value="<?php echo $_GET['name']?>">
                  <input type="submit" name="" value="ok" style="background-color:#a9a9a9" class="form-control submit">
                  <p><span class="fa fa-user fa-2x" style="color:#191970"></span></p><p style="margin-top:-18px;color:white"><?php  echo $lists;?></p></div>

              </div>
             </form>
        </div>


        <div class="col-md-4" id="chat_window_1" style="margin-left:750px;margin-top:-400px;">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar" style="background-color:#191970;height:50px;">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment" style="color:#f0e68c;font-size:15px;font-family:Comic Sans MS;padding-left:75px;"><?php echo '# '.$lists.' #'?></span> </h3>
                    </div>

                </div>
                <div class="panel-body msg_container_base" >
                    <div class="row msg_container base_sent" id="msg_chat_container" >
                          <?php
                          foreach ($message as $key) {
                            if ($key['id']==session_data('id')
) {
                              ?>
                              <div class="row msg_container base_receive">
                                <div class="col-md-10 col-xs-10">
                                  <div class="messages msg_sent" style="margin-top:10px;">
                                      <p><?php echo $key['message'];?></p>
                                      <time><?php echo $key['firstname'].'.'.$key['time_send'];?></time>
                                  </div>
                                </div>
                                <div class="col-md-2 col-xs-2 avatar">
                                    <img src="<?php echo base_url('assets/img/img_avatar.png')?>" class=" img-responsive ">
                                </div>
                            </div>

                      <?php

                            }
                        else {
                          ?>
                          <div class="row msg_container base_receive">
                              <div class="col-md-2 col-xs-2 avatar">
                                  <img src="<?php echo base_url('assets/img/img_avatar2.png')?>" class=" img-responsive ">
                              </div>
                              <div class="col-md-10 col-xs-10">
                                  <div class="messages msg_receive">
                                      <p><?php echo $key['message'];?></p>
                                      <time><?php echo $key['firstname'].'.'.$key['time_send'];?></time>
                                  </div>
                              </div>
                          </div>
                          <?php
                        }

                      }?>
    		     </div>
        </div>
    </div>
    <form action='<?php echo base_url().'trainner/send?name='.$_GET['name']?>' method="post" class="formulaire">
    <div class="panel-footer">
                   <div class="input-group">
                        <input type="text" name="message" class="form-control message" placeholder="write your message" style="font-size:14px;font-family:Comic Sans MS;color:#444">
                        <input type="hidden" name="id_wav" value="<?php echo $_GET['name']?>">
                       <span class="input-group-btn">
                       <button class="btn btn-primary btn-sm " class="formulaire" id="btn-chat"><span class="fa fa-location-arrow fa-2x"></span></button>
                       </span>
                   </div>
     </div>
      </form>
        <div class="afficher"></div>
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
                        <div class="messages msg_sent" style="margin-top:10px;">
                            <p>${donnees.message}</p>
                            <time><?php echo session_data('firstname') ?>, ${donnees.time_send}</time>
                        </div>
                      </div>
                      <div class="col-md-2 col-xs-2 avatar">
                          <img src="<?php echo base_url('assets/img/img_avatar.png')?>" class=" img-responsive ">
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
    height:400px;
    bottom: 0;
    float:right;
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
  max-height:300px;
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
  padding: 10px;
  border-radius: 2px;
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
img {
    display: block;
    width: 100%;
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
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}
.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
        </style>
