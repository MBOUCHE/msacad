<html>
<head>
    <title><?= APPNAME.(isset($titre)?$titre[1].($titre[0]?$titre[0]:'Undifined') : '') ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Pocket head of pdf">
    <meta name="author" content="The Pocket">

    <link rel='stylesheet' type='text/css' href='<?php echo css_url('dompdf/dompdf') ?>' />

    <link rel="shortcut icon" href="<?php echo img_url('favicon.ico') ?>">
</head>