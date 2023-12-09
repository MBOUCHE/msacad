<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12" style="color:red;">
                <?php echo mb_strtoupper('LISTE DES APPRENANTS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px;margin-bottom:50px;">
                      <p id="2">bonjour</p>

            </div>
        </div>
   
                <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Noms et Prénoms</th>
                        <th>mail</th>
                        <th>&ensp;&ensp;&ensp;&ensp;Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                        foreach ($list as $key) {
                            ?>
                                <tr>
                                <td><?php echo $i++;?></td>
                                <td>&ensp;&ensp;&ensp;<img src="<?php echo base_url('assets/img/img_avatar.png')?>" alt="img_profil" height="50"></td>
                                <td><?php echo $key['number_id']?></td>
                                <td><?php echo $key['firstname'].' '.$key['lastname']?></td>
                                <td><?php echo $key['mail']?></td>
                                <td><a style="text-decoration:none" href="<?php echo base_url().'trainner/gerer'.'?name='.$key['id']?>">&ensp;&ensp;&ensp;&ensp;<button class="btn btn-danger btn-md">Gerer</button>&ensp;</a><button class="btn btn-info btn-md" id="1">Desactiver</button>
                    </td>

                                </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

<!-- /.content-wrapper -->
<style>
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
    $(document).ready(function(){
        alm('collapseStudent', 0);
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
        $('#lesson').change(function(){
            var data = 'lesson='+$(this).val();
            $.loader({className: 'blue-with-image-2', content: ''});
            $.ajax({
                type : "POST",
                url : "<?php echo base_url("trainner/student/printCards"); ?>",
                data : data,
                success : function(server_response){
                    $('tbody').html(server_response).show();
                    $.loader('close');
                },
                error: function(){
                    $.loader('close');
                }
            });
        });
        $('#2').hide()
        $('#1').each(function(){
            $(this).on('click',function(){
            $(this).html('<buttom>active</buttom>')
            $('#2').slideToggle(1000)
            $('#2').html('<span class="alert alert-danger" style="padding-left:260px;padding-right:260px;color:green">vous avez desactiver mr ....</span>')
                    $('#2').css('font-size','15px')

        })
        })
    })
</script>
