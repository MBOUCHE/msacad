<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
                
                                    
<div class="fb-like" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </div>

            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="card mb-3 " style="width: 100%">
                        <div class="card-header">
                            <h3>Sujet : </h3>
                            <span class="h4"><?php echo $post->title ?></span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa fa-user-circle green-color"></i>&nbsp;
                                Posté par  &nbsp;<b><?php echo $post->lastname." ".$post->firstname; ?></b>
                            </li>
                        </ul>
                        <div class="card-body">
                            <?php echo $post->content ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <h4 class="w3-grey px-2 py-2">Réponses au sujet </h4>
                </div>
                <div class="col-sm-12 text-right mb-3">
                    <a class="top-link orange-bg-color btn w3-text-white" href="#newComment">Répondre</a>
                </div>
                <table class="table w3-table-all " width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="hidden">#</th>
                        <th width="20%">Auteurs</th>
                        <th >Contenu du message</th>
                    </tr>
                    </thead>
                    <tbody id="table-list">
                    <?php

                    foreach($comments as $key=>$comment) {
                        ?>
                        <tr id="<?php echo $comment->id ?>">
                            <td class="hidden"><?php echo $key ?></td>
                            <td align="center" class="text-center">
                                <small><?php  echo fromNow($comment->post_date) ?></small><br>
                                par  <br>
                                <b><?php echo $comment->lastname." ".$comment->firstname ?></b>
                                <img src="<?php echo base_url($comment->avatar )?>" height="100"><br>

                            </td>
                            <td class="">

                                <?php echo $comment->content ?>
                            </td>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>
                </table>
<div class="fb-like" data-layout="standard" data-action="recommend" data-size="large" data-show-faces="true" data-share="true"></div>

            </div>

            <?php

            if(session_data_isset('connect') and session_data('connect'))
            {
                if (!session_data_isset('sudo') and !session_data('sudo'))
                {
                    if($post->solved=="0")
                    {
                            ?>


                            <div class="col-sm-12 mt-3" id="newComment">
                                <?php
                                if($post->userId == session_data('id')){
                                    ?>
                                <a href="<?php echo base_url('forum/solved/post--').$post->id ?>" class="mx-auto btn btn-success d-block w-50" style="border-radius: 0">Marquer le sujet comme résolu!</a><?php
                                }
                                ?>
                                <h4>Votre réponse</h4>
                                <form class="w-100" action="<?php echo base_url('forum/sujet'.'/'.permalink($post->title).'--'.$post->id) ?>" method="post">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <label for="contenu" class="input-group-addon">Votre message </label>
                                    <textarea name="contenu" id="contenu" class="form-control">
                                        <?php echo set_value('contenu')?>
                                    </textarea><br>
                                            </div>
                                            <?php echo form_error('contenu') ?>
                                        </div>
                                    </div>
                                    <button type="submit" name="send" class="mt-3 float-right btn btn-primary" style="border-radius: 0">Envoyer</button>
                                </form>

                            </div>
                            <?php
                        }
                        else{
                            ?>

                            <div class="col-sm-12 text-center mt-3" id="newComment">
                                <h4>Ce sujet a été marqué comme résolu par son auteur!</h4>
                            </div>

                            <?php
                        }
                }

            }
            else{
                ?>

                <div class="col-sm-12 text-center mt-3" id="newComment">
                    <h4>Vous devez vous-connecter pour ajouter un sujet</h4>
                    <a class='btn btn-primary' href="<?php echo base_url('account/login?redirect=forum/sujet'.'/'.permalink($post->title).'--'.$post->id) ?>">Se connecter</a>
                </div>

                <?php
            }

            ?>




        </div>
    </div>

</div>
<link rel="stylesheet" href="<?php echo css_url("default")?>">
<script src="<?php echo js_url('highlight.pack')?>"></script>
<script src="<?php echo js_url('ckeditor/ckeditor')?>"></script>
<script>
    $(document).ready(function(){
        $(document).ready(function() {
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
        CKEDITOR.replace('contenu');
    });
</script>

<style>

    .cke_reset{
        width: 100% !important;
    }

</style>