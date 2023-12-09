<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="h4 text-center  col-sm-12"><br>
                <?php echo (isset($codeSession) ? mb_strtoupper("veuillez vérifier les informations du code de session : ").'<br><b>'.$codeSession.'</b>' : mb_strtoupper('Remplissage de la fiche de suivi des cours')) ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
        <br>

        <div class="row">
            <?php
            if(isset($message))
            {
                ?>
                <div class="w3-row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="alert alert-info col-md-12 text-center off">
                            <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $message ?>
                        </div>
                    </div>
                </div>


                <?php
            }
            ?>
            <?php
            if(isset($lesson)){ ?>
                <div class="col-sm-12 col-md-1">

                </div>
                <div class="col-sm-12 col-md-10">
                    <form action="<?php echo base_url('trainerGate/home/giveLessonDispense') ?>/slip " method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <input type="hidden" name="codeSession" value="<?php echo $codeSession ?>">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 text-center">
                                <div>
                                    <label for="" class="">Enseignement :
                                        <br>
                                        <b>
                                            <?php 
                                            foreach($lesson['lesson'] as $l)
                                            {
                                                echo mb_strtoupper($l->label)." - ";
                                            }
                                            
                                             ?>
                                        </b>
                                    
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="input-group">
                                    <label for="code" class="input-group-addon">Code(s) </label>
                                    <?php
                                    
                                        $codes="";
                                        $type="";
                                        $proms="";
                                        foreach($lesson['lesson'] as $l)
	                                {
	                                    $codes .= mb_strtoupper($l->code)." - "; 
	                                    $type.= mb_strtoupper($l->type)." - ";
	                                }
	                                foreach($lesson['promotion'] as $p)
	                                {
	                                    $proms.= mb_strtoupper($p->code)." - ";
	                                }
                                    
                                     ?>
                                    <input type="text" name="code" id="code" value="<?php echo $codes ?>" class="form-control" autocomplete="off" disabled><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="input-group">
                                    <label for="code" class="input-group-addon">Type(s) d'enseignement </label>
                                    <input type="text" name="code" id="code" value="<?php echo $type ?>" class="form-control" autocomplete="off" disabled><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="input-group">
                                    <label for="code" class="input-group-addon">Vague </label>
                                    <input type="text" name="code" id="code" value="<?php echo $proms ?>" class="form-control" autocomplete="off" disabled><br>
                                </div>
                            </div>
                        </div>

                        <div>Contenu de la session</div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                    <textarea name="lessonInfo">
                                        <?php echo set_value('lessonInfo') ?>
                                </textarea><br>
                                <?php echo form_error('lessonInfo') ?>
                            </div>
                        </div>

                        <button name="send" type="submit" class="w3-btn w3-blue w3-round float-right "><i class="fa fa-send" aria-hidden="true"></i> Envoyer</button>
                    </form>

                </div>
                <div class="col-sm-12 col-md-1">

                </div>

                <?php
            }else{
                echo '
                    <div class="col-md-2"></div>
                    <div class="col-sm-12 col-md-8">
                        <form action="'.base_url('trainerGate/home/giveLessonDispense').'" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="code" class="input-group-addon">Veuillez entrer le code la session</label>
                                        <input type="text" name="code" id="code" value="'.set_value('code').'" class="form-control" autocomplete="off"><br>
                                    </div>
                                    '.form_error('code').'
                                </div>
                            </div>

                            <button name="send" type="submit" class="w3-btn w3-blue w3-round float-right "><i class="fa fa-send" aria-hidden="true"></i> Envoyer</button>
                        </form>

                    </div>
                ';
            }
            ?>
        </div>





    </div>
</div>
<?php if(isset($codeSession)){ ?>
<script type="text/javascript" src="<?php echo js_url('ckeditor/ckeditor') ?>"></script>
    <script>
        $(document).ready(function(){
            leftM(1, '#panel-suivie');
            CKEDITOR.replace('lessonInfo');
        });
    </script>
<?php }else{ ?>
<script>
    $(document).ready(function(){
        leftM(1, '#panel-suivie');
    });
</script>
<?php } ?>