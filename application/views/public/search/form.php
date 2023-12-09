<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?></h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="text-justify">
                    <h4>Tapez votre recherche ici!</h4>
                    <form action="<?php echo base_url('search') ?>" method="get" class="form-inline my-2 w-100">
                        <div class="input-group w-100">
                            <input required class="form-control w3-input"  style="border-radius: 0" placeholder="Recherche ..." name="key" type="text">
                            <span class="input-group-btn ">
                                <button  style="border-radius: 0" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>