<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3"><?php echo $titre ?> (depuis octobre 2017)</h1>
                <hr width="">
            </div>

            <div class="col-sm-12 ">
                <div class="row">


                    <div class="col-sm-12 table-responsive">
                        <h4>Par ordre alphabétique</h4>
                        <table class="table w3-table-all " width="100%" id="dataTable" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Apprenant</th>
                                <th>Contacts</th>
                                <th>Enseignement</th>
                                <th>Etat de formation</th>
                            </tr>
                            </thead>
                            <tbody id="table-list">
                            <?php

                            foreach($students as $key =>$stu) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo ($key+1) ?></td>
                                    <td>
                                        <b><?php echo mb_strtoupper($stu->lastname)." ".$stu->firstname ?></b>
                                        <br>
                                        Matricule : <b><?php echo $stu->number_id ?></b>
                                    </td>
                                    <td class="">
                                        <?php echo $stu->phone."<br>".$stu->mail ?>
                                    </td>
                                    <td>
                                        <b><?php echo mb_strtoupper($stu->label)." (".mb_strtoupper($stu->lcode).")" ?></b><br>
                                        Vague : <b><?php echo $stu->pcode ?></b>
                                        
                                    </td>
                                    <td>
                                         <?php if($stu->state=='2'){
                                            ?>
                                            <a href="#" class="small btn btn-default disabled"><i class="fa fa-trophy blue-color"></i>Terminée</a>
                                            <?php
                                        }elseif($stu->state=='1'){
                                            ?>
                                            <a href="#" class="small btn btn-default disabled"><i class="fa fa-play-circle green-color"></i>En cours</a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }

                            ?>


                            <?php


                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

</script>