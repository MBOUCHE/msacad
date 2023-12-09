<div class="content-wrapper py-3">

    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('Liste des modérateurs') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('admin/moderator/addModerator')?>" class="w3-btn w3-blue w3-round">Ajouter un modérateur</a>
            </div>
        </div>

        <div class="row w3-margin-top">
            <div class="row">
                <p style="margin-left: 25px;">L&eacute;gende : </p>
                <ul style="padding-bottom: 30px">
                    <li class="legend"><span class="w3-red">#</span> Suspendue</li>
                    <li class="legend"><span class="w3-white">#</span> En Fonction</li>
                </ul>
            </div>

            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered table-hover small" width="100%" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">N&#176;</th>
                        <th>Photo</th>
                        <th>Matricule</th>
                        <th>Nom et Prénom</th>
                        <th>Contacts</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($query) And is_array($query) and !empty($query))
                    {
                        $i=0;
                        //var_dump($query);
                        $k = 0;
                        for($i = 1; $i <= count($query); $i++)
                        {
                            //echo '<tr><td class="text-center">' . ++$k . '</td>';
                            switch ($query[$i-1]->locked)
                            {
                                case '0': echo "<td><span class='w3-red' style='padding: 7px;'>".++$k."</span></td>";  break;
                                case '1': echo "<td><span class='w3-white' style='padding: 7px'>".++$k."</span></td>"; break;
                                default: echo "<td>".++$k."</td>"; break;
                            }
                            echo isset($query[$i-1]->photo) ? '<td class="text-center"><img src="' . base_url().$query[$i-1]->photo . '" class="responsive-img" height="50"></td>' :
                                '<td class="text-center"><img src="' . img_url('/logo/logo.png') . '" class="responsive-img" height="50"></td>';
                            echo '<td>' . $query[$i-1]->number_id . '</td>';
                            echo '<td id="nameG">' . $query[$i-1]->firstname . ' ' . $query[$i-1]->lastname . '</td>';
                            echo '<td>' . $query[$i-1]->phone .'<br>'. $query[$i-1]->mail .'</td>';
                            echo '<td><a href="'.base_url('admin/moderator/log').'/'.$query[$i-1]->id.'"><i class="w3-btn fa fa-2x fa-bookmark red-tooltip" aria-hidden="true" style="cursor: pointer;" title="Log"></i></a>';

                            switch ($query[$i-1]->locked)
                            {
                                case '0':
                                    echo '<a title="Activer" class="shelve" value='.$query[$i-1]->urId.' onclick="shelve(this)"><i class="w3-btn w3-text-green fa fa-2x fa-check text-info" aria-hidden="true"></i></a>';
                                    break;
                                case '1':
                                    echo '<a title="Suspendre" class="unshelve" value='.$query[$i-1]->urId.' onclick="unshelve(this)"><i class="w3-btn w3-text-red fa fa-2x fa-pause text-info" aria-hidden="true"></i></a>';
                                    break;
                                default:
                                    echo ++$k;
                                    break;
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="6"  class="h3 text-center"><a href="'.base_url('admin/moderator/save').'" class="w3-text-amber">Aucun modérateur enregistré pour le moment ...</a><td></tr>';
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


<script type="application/javascript">
    function unshelve($this){
        var idLa = $($this).attr('value'),
            $tr = $($this).parent().parent();
        alertify.confirm(
            '<p style="text-align: center;">Voulez vous vraiment suspendre le modérateur <br>'
            + '<b>'+$tr.find('td').eq(3).text()+'</b> de matricule : <br>'
            + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
            + '</p>',
            function(){
                $(location).attr('href', '<?php echo base_url('admin/moderator/motivation') ?>'+'/shelve/'+idLa);
            }
        ).setHeader('Confirmation de suspension').set({reverseButtons: true});
    }

    function shelve($this){
        var idLa = $($this).attr('value'),
            $tr = $($this).parent().parent();
        alertify.confirm(
            '<p style="text-align: center;">Voulez vous vraiment activer le modérateur <br>'
            + '<b>'+$tr.find('td').eq(3).text()+'</b> de matricule : <br>'
            + '<b>'+$tr.find('td').eq(2).text()+'</b> ?'
            + '</p>',
            function(){
                $(location).attr('href', '<?php echo base_url('admin/moderator/motivation') ?>'+'/unshelve/'+idLa);
            }
        ).setHeader('Confirmation d\'activation ').set({reverseButtons: true});
    }
    $(document).ready(function(){
        alm('collapseMod', 0);
        <?php
            if(isset($message)){
                echo "alertify.success(\"$message\");";
            }
        ?>
        <?php if($val = get_flash_data()){
                echo 'setTimeout(function(){
                    alertify.'.$val[0].'("'.$val[1].'");
                }, 750);';
            } ?>
    });
</script>