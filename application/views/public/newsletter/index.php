<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3">INSCRIPTION À LA NEWSLETTER</h1>
                <hr width="">
            </div>

            <div class="col-sm-12 ">
                <div class="row">
                    <p class="h4 py-4 px-2">
                        Bien vouloir renseigner votre adresse mail à laquelle vous recevrez nos informations.<br>
                        NB : <b>Vous pourrez vous désabonner de la newsletter à tout moment</b>
                    </p>

                    <div class="col-sm-12 col-lg-8 offset-lg-2 ">
                        <div id="msg_result" class="alert hidden" role="alert">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                                <span id="msg_content">

                                </span>
                        </div>

                        <form class="<?php //echo base_url('newsletter/check_form') ?>" action="" method="post">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="email" class="input-group-addon">Votre adresse *</label>
                                    <input name="email" onblur="verifMail(this)" autofocus required id="email" class="form-control">
                                        <p class="form_erreur text-danger small"></p>
                                    <br>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="sendMail" name="send" class="mt-3 btn btn-primary my-3"><i id="loading" class='fa fa-circle-o-notch fa-spin hidden'></i> M'inscrire</button>
                        </form>
			<div class="fb-like" data-layout="standard" data-action="recommend" data-size="large" data-show-faces="true" data-share="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('.btn').on('click', function() {
        var $this = $(this);
        $this.button('loading');
        setTimeout(function() {
            $this.button('reset');
        }, 8000);
    });

    function surligne(champ, erreur)
    {
        if(erreur)
        {
            champ.style.backgroundColor = "#feaba3";

        }
        else
        {
            champ.style.backgroundColor = "";
        }
    }
    function verifMail(champ)
    {
        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        if(!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        }
        else
        {
            surligne(champ, false);
            return true;
        }
    }
    $('#sendMail').click(function(){
        $('#msg_result').addClass('hidden')
            .removeClass('alert-success')
            .removeClass('alert-danger');
        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        if(!regex.test(email.value))
        {
            surligne(email, true);
            return false;
        }
        else
        {
            $('i#loading').removeClass('hidden');
            surligne(email, false);
            $.post('newsletter/check_mail',{email:email.value},function(data){

                if(data==1){
                    //return true;
                    setTimeout(function() {
                        $('i#loading').addClass('hidden');
                        $('#msg_result').addClass('alert-success')
                            .removeClass('hidden');
                        $('#msg_content').html('Votre inscription a été bien enregistrée. Vous recevrez désormais des mails venant de notre site web.');
                        $.post("newsletter/sendnewsletter",{email:email.value},function(data1){
                            if(data1==true){

                            }
                        });
                    }, 1500);
                }
                else{
                    setTimeout(function() {

                        $('i#loading').addClass('hidden');
                        $('#msg_result').addClass('alert-danger')
                            .removeClass('hidden');
                        $('#msg_content').html(data);
                    }, 500);

                }
                return false;
            });

        }
    });
</script>