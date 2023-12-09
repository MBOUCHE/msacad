<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row" style="padding-bottom:120px;">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Niconne">Gerer un étudiant</p>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
      <div class="container-fluid" style="padding-bottom:200px;">
          <div class="row">
              <div class="col-md-4">
                <a href="#" style="text-decoration:none;">
                  <div class="card" style="width: 22rem;">
                    <div class="card-body" style="background-color:#999;font-family:Jua;font-size:20px;color:indigo;border-radius:5px 5px 5px 5px">
                      <a href="<?php echo base_url('trainner/gerer/abscence')?>" style="text-decoration:none;">
                          <p style="padding:30px;" class="card-text">&ensp;<span class="fa fa-book fa-2x" style="color:green"></span>Demande d'abscence&ensp;<span class="badge badge-info" id="2"><?php echo count($list);?></span></p>
                      </a>
                  </div>
                  </div>
                </a>
              </div>
              <div class="col-md-4">
                <a href="#" style="text-decoration:none;">
                  <div class="card" style="width: 22rem;">
                    <div class="card-body" style="background-color:#444;font-family:Jua;font-size:20px;color:white;border-radius:5px 5px 5px 5px">
                        <p style="padding:30px;" class="card-text">&ensp;<span class="fa fa-line-chart fa-2x" style="color:red"></span>Consulter son evolution</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-md-4">
                <a href="#" style="text-decoration:none;">
                  <div class="card" style="width: 22rem;">
                    <div class="card-body" style="background-color:#4169e1;font-family:Jua;font-size:20px;color:#dc143c ;border-radius:5px 5px 5px 5px">
                        <p style="padding:30px;" class="card-text">&ensp;&ensp;&ensp;&ensp;&ensp;<span class="fa fa-pencil-square-o fa-2x" style="color:yellow"></span>notification</p>
                    </div>
                  </div>
                </a>
              </div>
          </div>
      </div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#2').on('click',function(){
      $('#2').html('<span class="badge badge-info" id="2">0</span>')
    })
  })
</script>