<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Niconne">Liste des demandes</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
                <div style="padding-left: 400px">
                 <i style="font-size: 17px;margin-bottom: 150px;">legende:</i><span style="padding-left:42px;font-family: Comic Sans MS;color: indigo;font-size: 15px; "><span>1:valider</span>&ensp;&ensp;&ensp;<span>-1:regetter</span></span>
        
                </div>
            </div>
        </div>
     <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>vague</th>
                        <th>nom et prenom</th>
                        <th>raison demande</th>
                        <th>justifacation</th>
                        <th>&ensp;&ensp;&ensp;&ensp;reponse</th>

                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach ($list as $key) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++?>
                                                
                                        </td>
                                
                                        <td>
                                            <?php echo $key['code_wave']?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $key['lastname'].' '.$key['firstname']?>
                                        </td> 
                                    
                                        <td>
                                            <?php echo $key['reason']?>
                                        </td>

                                        <td>
                                            <?php echo $key['justification'].'&ensp;&ensp;<span class="fa fa-cloud-download" style="color:red"></span>'?>
                                        </td>
                                    
                                        <td>
                                            <label class="radio-inline" style="padding-left: 20px;">
                                              <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked=""> 1
                                            </label>&ensp;&ensp;&ensp;
                                            <label class="radio-inline">
                                              <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> -1
                                            </label>&ensp;&ensp;&ensp;
                                            <a href="<?php echo base_url().'trainner/gerer/abscence'.'?name='.$key['id_rqst']?>" class="btn btn-primary btn-sm">ok</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>

            </div>

