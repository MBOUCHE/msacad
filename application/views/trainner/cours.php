<?php  //var_dump($ch1, $ch2, $ch3); die() ?>
<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12">
                <p style="color:red;font-size:30px;font-family:Cookie"><?php echo $liste?></p>
                <hr width="60%" style="margin: auto; margin-top: 10px;padding-bottom: 25px;">
            </div>
        </div>

  <div class="row">
           <script src="<?php echo js_url('ckeditor-full/ckeditor')?>"></script>
            <div class="col-md-12 col-md-6">
                <form action="cours"></form>
                        <div class="col-md-12">
                            <label for="desc" style="font-family:Cookie;font-size:30px;color:indigo;">Entrer le cours</label>
                            <textarea name="syllabus" id="desc"></textarea>
                        </div>
            </div>
            <div style="padding-top: 70px;padding-bottom: 40px;">
            <button style=" margin-left: 950px;margin-right: 100px;" class="btn btn-success"><span class="fa fa-share">&ensp;</span>televerser</button>
            </div>
            <script>
        $(document).ready(function(){
            alm('collapseEns',4);
            CKEDITOR.replace('syllabus');
        });
    </script>
    
    
</div>
