
<div class="row page-contain">
    <div class="col-sm-12">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="page-title mb-3">Personnel pédagogique</h1>
                <hr width="">
            </div>

            <div class="col-sm-12">
                <div class="text-justify">
                   Le Centre de Formation Professionnelle <b>MULTISOFT ACADEMY</b> est doté d'une équipe de formateurs dévoués à leurs tâches qui occupent différentes fonctions dans d'autres institutions allant des étudiants de <b>Master II</b> à un <b>Chargé de Cours</b> d'Université en passant par des <b>étudiants en thèse</b>, des <b>fonctionnaires du milieu professionnel et académique</b>.

                    <p>Ci-dessous la liste des formateurs permanents au centre de formation.</p>

                    <table class="table w3-table-all " width="100%" id="dataTable" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Noms et prénoms</th>
                            <th>Contacts</th>
                        </tr>
                        </thead>
                        <tbody id="table-list">
                        <?php

                        foreach($trainers as $key =>$trainer) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo ($key+1) ?></td>
                                <td><b><?php echo $trainer->lastname." ".$trainer->firstname ?></b></td>
                                <td class=""><?php echo $trainer->phone." <br>".$trainer->mail ?></td>
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