<?php
    if(count($document)==1 And $roles){
        $document = json_encode($document[0]);
?>
<div class="container"><div class="row">
        <form id="formPublish" action="<?php echo base_url('admin/document/publish') ?>" method="post">
            <div class="w3-hide" id="hide">
                <input type="hidden" value="js" name="mode">
                <input type="hidden" value='<?php echo $document ?>' name="doc">
            </div>
            <div class="row h5">Publier ce document à:</div>
            <div class="container w3-margin-left">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <select class="form-control custom-select" name="pub_role" id="roles" onchange="rolesChange(this)">
                                <option value="0">Tous le monde</option>
                                <?php
                                    foreach($roles as $value){
                                        if(session_data('role')!=ADMIN Or $value->id != ADMIN){
                                ?>
                                    <option class="" value="<?php echo $value->id ?>">Tous les <?php echo mb_strtoupper($value->label.'s') ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <select class="form-control custom-select w3-hide" name="pub_vague" id="vague">
                                <?php foreach($vague as $value){ ?>
                                    <option value="<?php echo $value->promo_id ?>"><?php echo strtoupper($value->code) ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } else { ?>
<div class="container">
    <div class="row text-center">
        <div class="h4 center-block">Erreur!!!</div>
    </div>
</div>
<?php }
