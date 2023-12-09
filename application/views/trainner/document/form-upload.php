<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <?php echo mb_strtoupper('UPLOADER DES DOCMENTS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-3 w3-margin-bottom">
                <a href="<?php echo base_url('trainner/document/all')?>" class="w3-btn w3-blue w3-round">Tous les documnets</a>
            </div>
            <div class="container">
                <form action="<?php echo base_url('trainner/document/formUpload') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <i class="fa fa-plus close" aria-hidden="true" id="add_tof"></i>
                    <div class="upload row">
                    </div>
                    <button name="send" class="col-sm-12 col-md-4 col-lg-2 w3-btn w3-round w3-blue" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Uploader</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-wrapper -->
<script>

    function bytesToSize(bytes) {
        if (bytes == 0) return '0 Byte';
        var k = 1000,
            sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
            i = Math.floor(Math.log(bytes) / Math.log(k));

        return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
    }

    var tof_id= 0;

    function add_file (click=false) {
        click=false;
        if(tof_id == 10)
        {
            alertify.alert('Vous ne pouvez pas <strong>Uploader</strong> plus de 10 fichiers');
        }
        else
        {
            tof_id++;
            if(tof_id==10) $('#add_tof').hide(750);
            var faIcon = $('<i></i>').attr({'id': 'img_' + tof_id, 'class': 'fa fa-5x fa-file', 'aria-hidden': true}),
                faIconChange = $('<span id="imgCh_'+tof_id+'" class="w3-display-topleft w3-circle w3-btn w3-blue w3-text-dark-grey w3-padding-small" style="cursor: pointer; top: -10px; left: -10px;" onclick="$(\'#file_'+tof_id+'\').trigger(\'click\')"></span>')
                    .append($('<i></i>').attr({
                    'class': 'fa fa-file-pdf-o',
                    'aria-hidden': true
                })),
                closeBtn = '<button type="button" class="close w3-display-topright" onclick="deleteImgCard('+tof_id+')"><span aria-hidden="true">&times;</span></button>',
                inputFile = $('<input>').attr({
                    'id': 'file_' + tof_id,
                    'name': 'file_' + tof_id,
                    'class': 'custom-file-input',
                    'type': 'file',
                    'accept': '.pdf, .doc, .docx',
                    'onchange': 'file_change(this)',
                    'hidden': true
                }),
                imgCardFooter = $('<div></div>').attr({
                    //'class': 'img-info container-fluid w3-center w3-grey w3-text-dark-grey w3-margin-0 w3-block'
                    'class': 'img-info w3-responsive w3-center w3-grey w3-text-dark-grey w3-margin-0 w3-block w3-padding-4'
                }).text('Pas de fichier'),
                imgCardBlock = $('<div></div>').attr({
                    'id': 'imgCardBlock_' + tof_id,
                    'class': 'card-block'
                }).append(faIconChange).append(closeBtn).append(inputFile).append(faIcon),
                imgCard = $('<div class="w3-margin-top imgContS"></div>').append(
                    $('<div></div>').attr({'class': 'w3-card-2 text-center w3-display-container'})
                        .append(imgCardBlock).append(imgCardFooter)
                );

            imgCard = $('<div id="imgCard_'+tof_id+'" class="col-xs-6 col-md-3 col-lg-2"></div>').append(imgCard);
            $('.upload').append(imgCard);
            if(click==true) {
                $('#file_'+tof_id).trigger('click');
            }
        }
    }

    function file_change($this) {
        var files = $this.files, fileType, file, id = $this.id[$this.id.length - 1];
        file = files[0];
        fileType = file.name.split('.');
        fileType = fileType[fileType.length - 1].toLowerCase();

        if(['pdf', 'doc', 'docx'].indexOf(fileType) !== -1)
        {
            var icon = (['doc', 'docx'].indexOf(fileType) !== -1)?'fa fa-5x w3-text-indigo fa-file-word-o':'fa fa-5x w3-text-red fa-file-pdf-o';
            $('#img_'+id).attr({'class': icon});
            $('#imgCard_'+id+' .img-info').html('<p class="w3-slim" style="margin-bottom: 3px;">'+file.name+'</p><p class="small" style="margin: 0;">'+bytesToSize(file.size)+'</p>');
        }else{
            $($this).val("");
            $('#img_'+id).attr({'class': 'fa fa-5x fa-file'});
            alertify.alert('Le fichier choisie n\'est pas un fichier pdf ou word ');
        }
    }

    function deleteImgCard($this) {

        var identity = parseInt($this);

        if(tof_id == 1)
        {
            alertify.alert('Imposible de suprimer ceci!');
        }
        else
        {
            if (tof_id == 10) $('#add_tof').show(750);
            $this = $('#imgCard_' + identity);
            $this.replaceWith('');

            if(identity<tof_id)
            {
                for(var i=identity+1; i<=tof_id; i++)
                {
                    var $replace = $('#imgCard_'+i), id = i-1;
                    $replace.find('button[type="button"].close').attr({'onclick' : 'deleteImgCard('+id+')'});
                    $replace.find('input[type="file"].custom-file-input').attr({
                        'id'    : 'file_' + id,
                        'name'  : 'file_' + id
                    });
                    $replace.find('#imgCh_'+i).attr({'onclick' : '$(\'#file_'+id+'\').trigger(\'click\')'});
                    $replace.find('#imgCardBlock_'+i).attr({'id' : 'imgCardBlock_'+id});
                    $replace.find('#img_'+i).attr({'id' : 'img_'+id});
                    $replace.attr({'id' : 'imgCard_'+id});
                }
            }
            tof_id--;
        }

    }

    $(document).ready(function(){
        if(tof_id == 0) {add_file();}
        alm('collapseDoc', 1);
        $('#add_tof').on('click', function(){add_file(true)});

        <?php if(isset($set_error) And count($set_error) > 0){
            echo "setTimeout(function(){\n\t\t\talertify.alert(\"";
                    $end = count($set_error);
                    foreach($set_error as $item)
                    {
                        echo $item;
                    }
                echo "\")\n\t\t\t\t.setHeader(\"Erreur d'upload(s)\");";
            echo "\n\t\t}, 750);\n";
        } ?>
        <?php if($val = get_flash_data()){
            echo 'setTimeout(function(){
                alertify.'.$val[0].'("'.$val[1].'");
            }, 750);';
        } ?>
    })
</script>