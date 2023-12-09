<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">


                <div class="card float-left mr-3 mb-3 panel-lesson">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-uppercase">
                            <?php
                            if($lesson->type=="cours")
                                echo "Formation Accélérée";
                            elseif($lesson->type=='filière')
                                echo "Formation Longue";
                            else
                                echo "Formation Promotionnelle";
                            ?>
                        </h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-hashtag green-color"></i>&nbsp;
                            Code : &nbsp;<b><?php echo $lesson->code; ?></b></li>
                        <li class="list-group-item">
                            <i class="fa fa-clock-o green-color"></i>&nbsp;
                            Nombre d'heures :&nbsp; <b><?php echo $lesson->duration; ?> H</b>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-money green-color"></i>&nbsp;
                            Frais de formation :&nbsp; <b><?php echo number_format($lesson->fees,0,'',' ') ; ?> CFA</b>
                        </li>
                        <li class="list-group-item text-uppercase text-primary">
                            <i class="fa fa-trophy green-color"></i> &nbsp;
                            <b class="text-primary" style="font-size: 90%">
                            <?php
                                if($lesson->type=='filière')
                                    echo "Attesttation de Fin de Formation";
                                else
                                    echo "Certificat de Fin de Formation";

                                ?>
                            </b>
                        </li>
                    </ul>
                </div>
                <div class="text-justify panel-lesson-content">
                    Le dossier d'inscription comprend :
                    <ul>
                        <li>Une fiche d'inscription remplie par le candidat;</li>
                        <li>Une photocopie de la carte d'identité Nationale;</li>
                        <li>2 photos 4*4.</li>
                    </ul>
                    L'inscription à un enseignement vous donne les avantages suivants :
                    <ul>
                        <li>Accès au centre pour des recherches sur internet;</li>
                        <li>Accès aux <b>interfaces des apprenants</b> dans le site actuel;</li>
                        <li>Accès accès à <b>MOBISOFT</b> (Application Mobile de MULTISOFT ACADEMY);</li>
                        <li>Une carte d'apprenant pour les enseignements de la formation longue.</li>
                    </ul>

                    <b>NB:</b>
                    <ul>
                        <li>
                            Lorsque vous faites une demande d'inscription en ligne vous devez vous rendre au centre de formation
                            au plus tard <b class="w3-text-red">02 jours après la demande</b> pour valider votre inscription; sans cela <b>elle sera annulée</b>.
                        </li>
                    </ul>

                    <?php
                    if(session_data_isset('connect') and session_data('connect')){
                        if (!session_data_isset('sudo') and !session_data('sudo')){
                            ?>
                            <form action="" method="post">
                            
	                    <div class="g-recaptcha" data-sitekey="6LfFLjAUAAAAAOHjNRE0b9n4LILDJkb8OvGCkjdi"></div>
                                <input type="hidden" value="<?php echo $lesson->code ?>" name="lesson">
                                <button type="submit" name="register" class=" btn btn-primary">Envoyer ma demande d'inscription <i class="fa fa-send-o"></i></button>
                            </form>

                            <?php
                            if(isset($status) )
                            {
                                if(!$status){
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <?php echo $message ?>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <?php echo $message ?>
                                    </div>
                                    <?php
                                }

                            }

                        }
                    }
                    else{
                        ?>

                        <a href="<?php echo base_url('account/login?redirect=enseignements/register/'.permalink($lesson->label).'--'.permalink($lesson->code)) ?>" class="btn btn-primary">Connectez-vous</a> pour vous inscrire à cet enseignement.

                        <?php
                    }

                    ?>

                </div>
            </div>



        </div>
    </div>

</div>