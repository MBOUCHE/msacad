<html>
<head>
    <title><?= APPNAME.(isset($titre)?$titre[1].($titre[0]?$titre[0]:'Undifined') : '') ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel='stylesheet' type='text/css' href='<?php echo css_url('dompdf/dompdf') ?>' />

    <link rel="shortcut icon" href="<?php echo img_url('favicon.ico') ?>">
</head>
<table style='vertical-align: top; line-height: 4mm;'>
    <tr class="col-pk-10">
        <td class='text-center col-pk-4'>
            REPUBLIQUE DU CAMEROUN <br>
            ********** <br>
            Paix - Travail - Patrie <br>
            ********** <br>
            UNIVERSITE DE NGAOUNDERE <br>
            ********** <br>
            B.P: 454
        </td>
        <td class='text-center col-pk-2'>
            <img src="./logo40.png" style="width: 100px;">
        </td>
        <td class='text-center col-pk-4'>
            REPUBLIC OF CAMEROON <br>
            ********** <br>
            Peace - Word - Fatherland <br>
            ********** <br>
            THE UNIVERSITY OF NGAOUNDERE <br>
            ********** <br>
            P.0.Box 454
        </td>
    </tr>
</table>
