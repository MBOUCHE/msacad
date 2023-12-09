<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('LISTE DES APPRENANTS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <form action="<?php echo base_url("admin/student/printCards") ?>" method="post" class="" style="width: 100%">
                <div class="row">
                    <div class="offset-md-2 col-md-8 input-group">
                        <label for="" class="input-group-addon">Selectionner l'enseignement :</label>
                        <?php
                        echo "<select name='lesson' id='lesson' value='' class='form-control'>";
                        echo "<option value='-1'>Tous les enseignements</option>";
                        if(isset($listL) And is_array($listL) and !empty($listL)){
                                for($i = 1; $i <= count($listL); $i++){
                                    echo "<option value=".$listL[$i-1]->id.">".$listL[$i-1]->label."</option>";
                                }
                            }

                        echo "</select>";
                        ?>
                        <button type="submit" name="send" class="w3-btn w3-blue input-group-addon"><i class="fa fa-id-card-o"></i> Générer les cartes</button>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                        <?php
                        if(isset($message) And $message)
                        {
                            ?>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" onclick="$(this).parrent().hide()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <?php echo $message ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </form>

            <p style="margin-left: 25px;">L&eacute;gende : </p>
            <ul style="padding-bottom: 30px">
                <li class="legend"><span class="w3-green">#</span> En attente</li>
                <li class="legend"><span class="w3-white">#</span> Actif</li>
                <li class="legend"><span class="w3-red">#</span> Bloqué</li>
            </ul>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Noms et Prénoms</th>
                        <th>Contacts</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($query) And is_array($query) and !empty($query))
                    {
                        //var_dump(count($query));
                        //var_dump($query);
                        $k = 0;
                        //var_dump($query);
                        for($i = 1; $i <= count($query); $i++)
                        {
                            $state = $query[$i-1]->state;
                            $bgcolor = ($state == -1)? 'red':($state == 0)? 'green':'white';
                            echo '<tr><td><span class="text-center '.$bgcolor.' text-white" style="padding: 7px">' . ++$k . '</span></td>';
                            echo isset($query[$i-1]->photo) ? '<td class="text-center"><img src="' . base_url().$query[$i-1]->photo . '" class="responsive-img" height="50"></td>' :
                                '<td class="text-center"><img src="' . img_url('img_avatar.png') . '" class="responsive-img" height="50"></td>';
                            echo '<td>' . $query[$i-1]->number_id . '</td>';
                            echo '<td>' . strtoupper($query[$i-1]->lastname) . ' ' . ucfirst($query[$i-1]->firstname) . '</td>';
                            echo '<td>' . $query[$i-1]->phone .'<br>'. $query[$i-1]->mail . '</td>';
                            echo '<td>
                                    <a href="'.base_url('admin/student/profile').'/'.$query[$i-1]->id.'" title="Profil"><i class="w3-btn fa fa-2x fa-user text-info" aria-hidden="true"></i></a>
                                    <a href="'.base_url('admin/student/log').'/'.$query[$i-1]->id.'"><i class="w3-btn fa fa-2x fa-bookmark text-info red-tooltip" aria-hidden="true" style="cursor: pointer;" title="Log"></i></td></tr></a>

                                    </td></tr>';
                        }
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

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
                url : "<?php echo base_url("admin/student/printCards"); ?>",
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
    })
</script>