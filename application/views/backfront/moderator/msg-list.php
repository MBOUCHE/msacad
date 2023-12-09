<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="w3-row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('LISTE DES Messages') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="w3-row">
                <p style="margin-left: 25px;">L&eacute;gende : </p>
                <ul style="padding-bottom: 30px">
                    <li class="legend"><span class="w3-green">#</span> Visible</li>
                    <li class="legend"><span class="w3-grey">#</span> Pas visibe</li>
                </ul>

                <div class="col-sm-12 ">
                    <?php
                    if(isset($messages) And is_array($messages) and !empty($messages))
                    {
                        $k = 0;
                        ?>
                        <table class="table table-responsive table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php
                            foreach ($messages as $sms)
                            {
                                $unlock = false;
                                if($sms->state=='0'){
                                    $bgcolor = 'grey';
                                }elseif($sms->state=='1') {
                                    $unlock  = true;
                                    $bgcolor = 'green';
                                }
                                $sms->avatar = ($sms->avatar)?$sms->avatar:'/logo/logo.png';
                                ?>
                                <tr>
                                    <td style="border-left: solid 3px <?php echo $bgcolor ?>">
                                        <div class="">
                                            <img height="80" src="<?php echo base_url($sms->avatar) ?>" class="responsive-img  pull-left w3-margin-right w3-margin-bottom">
                                            <p>
                                                <?php
                                                echo $sms->lastname." ".$sms->firstname.'<br>';
                                                echo moment($sms->save_date)->fromNow()->getRelative();
                                                ?>
                                            </p>
                                        </div>

                                        <div class="">
                                            <blockquote>
                                                <?php echo $sms->content ?>
                                            </blockquote>
                                        </div>

                                        <div class="text-right">
                                            <a  href="<?php echo base_url('moderatorGate/message/edit/'.$sms->id)?>" class="btn btn-primary btn-sm">Modifier</a>
                                            <?php
                                            if($unlock){
                                                ?>
                                                <a id="<?php echo $sms->id ?>" class="btn btn-default btn-sm" onclick="lock(this)">Désactiver</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a id="<?php echo $sms->id ?>" class="btn btn-success btn-sm" onclick="unlock(this)">Activer</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                        <?php
                    }else {
                        echo '<div class="h3 text-center text-warning">Aucun message pour le moment ...</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <style scoped>
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

            function unlock($this){
                var id = $($this).prop('id'),
                    data = {};
                alertify.confirm("<div class='w3-center'>Voulez vous Afficher cette information dans le site?", function(){
                    $.loader({className: 'blue-with-image-2', content: ''});
                    data = {id:id};
                    $.post('<?php echo base_url('moderatorGate/message/unlock') ?>', data, function(rep){
                        $.loader('close');
                        if(rep.trim().split('*0*').length>1){
                            $(location).prop('href', '');
                        }else{
                            alertify.error('Une erreur c\'est produite.');
                        }
                    }).fail(function() {
                        $.loader('close');
                    });
                }).setHeader('Activation');
            }
            function lock($this){
                var id = $($this).prop('id'),
                    data = {};
                alertify.confirm("<div class='w3-center'>Voulez vous Désactiver cette information ?", function(){
                    $.loader({className: 'blue-with-image-2', content: ''});
                    data = {id:id};
                    $.post('<?php echo base_url('moderatorGate/message/lock') ?>', data, function(rep){
                        $.loader('close');
                        if(rep.trim().split('*0*').length>1){
                            $(location).prop('href', '');
                        }else{
                            alertify.error('Une erreur c\'est produite.');
                        }
                    }).fail(function() {
                        $.loader('close');
                    });
                }).setHeader('Désactivation');
            }
            $(document).ready(function(){
                <?php
                    if (isset($status) and !empty($status))
                    {
                        if ($status)
                        {
                ?>
                alertify.defaults.theme.ok = "w3-btn w3-green";
                alertify.alert("<i class='fa fa-fw fa-check-circle w3-text-green'></i> Succès", "<?php echo $message ?>", function(){});
                <?php
                        } else {
                ?>
                alertify.defaults.theme.ok = "btn w3-btn btn-primary w3-red";
                alertify.alert("<i class='fa fa-fw fa-ban w3-text-red'></i> Echec", "<?php echo $message ?>", function(){});
                <?php
                        }
                    }
                ?>
                alertify.defaults.theme.ok = "w3-btn w3-blue";
                alertify.defaults.theme.cancel = "w3-btn w3-red";
                leftM(0, '#panel-msg');
            })
        </script>
    </div>

</div>
<!--END PAGE CONTENT -->