<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">  
                <p style="color:red;font-size:30px;font-family:">Choix de la vagues</p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>

         <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>code</th>
                        <th>Enseignement</th>
                        <th>Option</th>
    

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
                                    
                                        <td class="text-uppercase">
                                            <?php echo strtoupper($key['label'])?>
                                        </td>
                                    
                                        <td>
                                            <a href="<?php echo base_url('trainner/note/vague').'?name='.$key['id_wave']?>" class="btn btn-primary btn-sm ">Details</a>    
             
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
         <script type="text/javascript">
  $(document).ready(function(){
    $('#2').on('click',function(){
      $('#2').html('<span class="badge badge-info" id="2">0</span>')
    })
  })
</script>