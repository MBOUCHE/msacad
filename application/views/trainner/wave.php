
<div class="content-wrapper py-3">
  <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12" style="padding-top: 20px;">  
                <p style="font-family:Niconne;color: red;font-size: 35px">Choix de l'évaluation</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 15px;">
            </div>
        </div>
                <div class="row">
                    <div class="offset-4 col-md-4">
                         <div class="list-group" style="font-family: Acme;font-size: 20px;">
                          
                              <?php 

                                foreach ($liste as $key) {

                                  $name=$_GET['name'];
                                  $type_test=$key['id_type_tst'];
                                  ?>
                                        <form action="<?php echo base_url().'trainner/note/type/'.$name?>">
                                         <a href='<?php echo base_url().'trainner/note/type'.'?name='.$name.'&'.'type_test='.$key['id_type_tst']?>' class='w3-btn w3-blue w3-block w3-padding-top w3-padding-bottom w3-margin-bottom' width='100'> <?php echo $key['label_type']?> 
                                        </a>
                                        </form>
                                         
                                  <?php
                                }
                              ?>
                        </div>
                    </div>
                </div>
        </div>
  </div>
</div>
