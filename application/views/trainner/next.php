
<div class="content-wrapper py-3">
  <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12" style="padding-top: 20px;">  
                <p style="font-family:Niconne;color: red;font-size: 45px">Enregistrement des notes</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom:5px;">
            </div>
        </div>
        <div class="offset-4" style="color:#20b2aa;margin-left: 250px;">
          <p style="font-family:Jua;font-size:23px;margin-bottom:-1px;">vague :<?php foreach ($lisa as $key) {
            echo $key['code_wave'];
          } ?></p>
          <p style="font-family:Jua;font-size:23px;margin-bottom:-1px">Enseignement :<?php foreach ($lisa as $key) {
            echo $key['label'];
          } ?></p>
           <p style="font-family:Jua;font-size:23px;margin-bottom:25px;">Evaluation :<?php foreach ($lista as $key) {
            echo $key['label_type'];
          } ?></p>
        </div>
        <div class="offset-2">
           <table class="w3-table w3-striped w3-border w3-bordered w3-hoverable col-md-9">
                        <thead class="w3-blue">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom(s) et prénom(s)</th>
                            <th>Note</th>                        </tr>
                        </thead>
                        <?php
                          foreach ($lister as $key) {
                            ?>
                            <tr>
                              <td><?php echo $key['number_id']; ?></td>
                              <td><?php echo $key['lastname'].' '.$key['firstname']; ?></td>
                              <td><input type="number" step="0.01" class="form-control" min='00.00' max='20.00'></td>
                            </tr>
                            <?php
                          }
                        ?>  
             </table>  
          </div>    
        </div>
    </div>
 
  </div>
</div>
