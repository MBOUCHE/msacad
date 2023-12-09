<?php
//include('../models/admin/availability_model.php');
function showAvMatrix($av){

$nbrPromo=$av->getPromotionsNumber();
$max=($nbrPromo>10?10:$nbrPromo);
$periodNbr=$av->getPeriodNumber();
$i=0;
$av_matrix=array();
while ($i<$periodNbr*6)
{
    $j=0;
    while ($j<$max)
    {
        $av_matrix[$i][$j]=0;
    }
}
var_dump($av_matrix);
}