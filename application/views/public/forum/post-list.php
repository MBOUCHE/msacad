<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">

                <div class="col-sm-12 text-right mb-3">
                    <a class="top-link orange-bg-color btn w3-text-white" href="#newPost">Ajouter un sujet</a>
                </div>
                <table class="table w3-table-all " width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="hidden">#</th>
                        <th>Sujets</th>
                        <th>Détails</th>
                    </tr>
                    </thead>
                    <tbody id="table-list">
                    <?php

                    foreach($posts as $key=>$post) {
                        ?>
                        <tr id="<?php echo $post->id ?>">
                            <td class="hidden"><?php echo $key ?></td>
                            <td>
                                <b><?php echo $post->title ?><br></b>
                                <p class="w3-text-grey small">
                                    Posté par : <b><?php echo $post->lastname." ".$post->firstname ?></b> <br>
                                    <b><?php  echo fromNow($post->post_date) ?></b>
                                    <?php
                                    if($post->solved=='1'){
                                        ?>
                                        <br><button disabled class="btn btn-sm btn-secondary green-color"> <i class="fa fa-trophy"></i> Sujet résolu!</button>
                                        <?php
                                    }
                                    ?>
                                </p>
                            </td>
                            <td class="">
                                <b><?php echo $post->comment_nbr ?></b> messages<br>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('forum/sujet'.'/'.permalink                                    ($post->title).'--'.$post->id) ?>">Ouvrir</a>

                            </td>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>
                </table>


            </div>

            <?php

            if(session_data_isset('connect') and session_data('connect'))
            {
                if (!session_data_isset('sudo') and !session_data('sudo')){
                    ?>
                    <div class="col-sm-12 mt-3" id="newPost">

                        <h4>Créer un sujet</h4>
                        <form action="<?php echo base_url('forum/categorie'.'/'.permalink($category->name)) ?>" method="post">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="titre" class="input-group-addon">Titre * </label>
                                        <input type="text" name="titre" max="150" id="titre" required value="<?php echo set_value('titre') ?>" class="form-control" autocomplete="off"><br>
                                    </div>
                                    <?php echo form_error('titre') ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="contenu" class="input-group-addon">Votre message </label>
                                <textarea name="contenu" id="contenu" class="form-control" cols="100">
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

            }else{
                ?>

                <div class="col-sm-12 text-center mt-2" id="newPost">
                    <h4>Vous devez vous-connecter pour ajouter un sujet</h4>
                    <a  class='btn btn-primary' href="<?php echo base_url('account/login?redirect=forum/categorie'.'/'.permalink($category->name)) ?>">Se connecter</a>
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