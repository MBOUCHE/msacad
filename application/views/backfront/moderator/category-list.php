<!--PAGE CONTENT -->
<div id="content">

    <div class="inner" style="min-height: 700px;">
        <div class="container-fluid">
            <div class="row">
                <div class="h4 text-center col-sm-12 w3-margin-top">
                    <?php echo mb_strtoupper('Liste des catégories') ?>
                    <hr width="60%" style="margin: auto; margin-top: 10px">
                </div>
            </div>

            <div class="row">
                <div class="w3-margin-top">
                    <div class="w3-row">
                        <div class="col-sm-12 w3-margin-bottom">
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/forums') ?>">Liste des forums</a>
                            <a class="w3-btn w3-blue" href="<?php echo base_url('moderatorGate/forums/categoryFormAdd/'.get_instance()->uri->rsegment(3)) ?>">Ajouter une catégorie</a>
                        </div>
                    </div>
                    <div class="col-sm-12 w3-responsive">
                        <?php
                        if(isset($category) And count($category)>0)
                        {
                            $i=0;
                            ?>
                            <table class="table w3-table-all small" width="100%" id="dataTable" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Categorie</th>
                                    <th class="w3-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="table-list">
                                <?php foreach($category as $liste)
                                {
                                    echo '<tr id="'.$liste->id.'"><td class="text-center" style="vertical-align: middle">' . ++$i . '</td> ';
                                    echo '<td style="vertical-align: middle"><b>'.$liste->name.'</b></td>';
                                    echo '<td class="w3-center"><a href="'.current_url().'/category/'.$liste->id.'" title="Liste des posts" class="w3-white w3-btn"><i class="fa fa-list fa-2x text-info" aria-hidden="true"></i></a>';
                                    echo '<span href="'.base_url('moderatorGate/forums/categoryFormEdit/'.$liste->id).'" title="Modifier" class="w3-white w3-btn w3-margin-left" onclick="edit(this)"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></span></td></tr>';
                                } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                            <div class="h3 text-center w3-text-orange">Aucune categorie enregistrée pour ce forum ...</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">

                function edit($this){
                    var $this_tr = $($this).parent().parent(),
                        $this_tds = $this_tr.find('td'),
                        data = {};
                    alertify.prompt('Nouveau nom', ''
                        , function(evt, value) {
                            $.loader({className: 'blue-with-image-2', content: ''});
                            data = {mode: 'js', category: value};
                            $.post('<?php echo base_url('moderatorGate/forums/categoryFormEdit') ?>'+'/'+$this_tr.prop('id'), data
                                , function(){
                                    $(location).prop('href', '');
                                }).fail(function() {
                                    $.loader('close');
                                });
                        }
                    ).set('reverseButtons', true)
                        .setHeader('Modifier la catégorie: <b>'+$this_tds.eq(1).text()+'</b>');
                    return false;
                }

                $(document).ready(function(){
                    <?php if($val = get_flash_data()){
                        echo 'setTimeout(function(){
                            alertify.'.$val[0].'("'.$val[1].'");
                        }, 750);';
                    } ?>

                    leftM(0, '#panel-forum');
                })
            </script>
        </div>
    </div>

</div>
<!--END PAGE CONTENT -->