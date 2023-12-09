<div class="toto">
    <table class="carte" style="width: 100%;">
        <tr class="header">
            <td align="center">
                <img src="<?php echo base_url()."assets/img/logo/logo.png" ?>" height="50">
            </td>
            <td align="center" class="ecoleTd">
                Centre de Formation Professionnelle<br>
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <span class="titre">CARTE D'APPRENANT</span>
            </td>
        </tr>

        <tr class="content">
            <td colspan="2" align="center" style="width: 100%;">
                <b class="titre">FORMATION</b><br>
                <span class="titre"><?php echo $student[$i]->label ?></span><br>
                <small>Code :</small> <b><?php echo $student[$i]->code ?></b> &nbsp;&nbsp;&nbsp;&nbsp; <small>Vague :</small> <b><?php echo $student[$i]->promCode ?></b>
            </td>
        </tr>

        <tr class="content">
            <td>
                <img src="<?php echo base_url().$student[$i]->photo ?>" height="100" width="100">
            </td>
            <td style="width: 60%;">
                Noms et Prénoms: <br><b><?php echo $student[$i]->firstname. " " .$student[$i]->lastname ?></b><br>
                Sexe: <b><?php echo ($student[$i]->sexe == 1) ? 'Masculin' : 'FEMININ' ?></b><br>
                Né(e) le: <b><?php echo $dateBirth = date_format($dateBirth, 'd').'/'.date_format($dateBirth, 'm').'/'.
                        date_format($dateBirth, 'Y') ?> à <?php echo $student[$i]->birth_place ?></b><br>
                Nationalité: <b><?php echo $student[$i]->nationality ?></b><br>
                Matricule: <b><?php echo $student[$i]->number_id ?></b><br>
            </td>
        </tr>
        <tr class="content">
            <td colspan="2" align="right">
                <small>Durée de Validité : Juillet 2017-Septembre 2017</small>
            </td>
        </tr>

        <tr class="footer">
            <td colspan="2">
                <small><b>NB : Cette carte vous donne accès au centre</b></small>
            </td>
        </tr>
    </table>
</div>


