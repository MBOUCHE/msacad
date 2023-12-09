<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

if ( ! function_exists('randomPassword')) {
    function randomPassword($charNbr = 12)
    {
        $pwd = "";

        $string = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
        $stringLength= strlen($string);

        for($i = 1; $i <= $charNbr; $i++)
        {
            $randomPos = mt_rand(0,($stringLength-1));
            $pwd .= $string[$randomPos];
        }

        return $pwd;
    }
}

if(!function_exists('formatMonnaie')){
    function formatMonnaie($nombre){
        return number_format($nombre,0,'',' ');
    }
}

if ( ! function_exists('generatePromoCodes')) {
    function generatePromoCodes($promoNumber)
    {
        $cons="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $stringLength= strlen($cons);
        $code="";
        $randomPos = mt_rand(0,($stringLength-1));
        $code.= $cons[$randomPos];
        $code.=castNumberId($promoNumber);
        return $code;
    }
}

if ( ! function_exists('castNumberId')) {
    function castNumberId($number, $ent=3, $dec=0)
    {
        if ($dec==0) {
            $strNbr = "";
            $strNbr .= $number;
            if (strpos($strNbr, '.')!=false) {
                $tmp=explode('.', $strNbr);
                $strNbr="".$tmp[0];
            }

            $strSize = strlen($strNbr);
            $strFinal = array();
            for ($k = 1; $k <= $ent; $k++)
                array_push($strFinal, 0);
            for ($i = 0; $i < $strSize; $i++) {
                $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
            }
            $castedNbr = "";
            for ($j = 0; $j < $ent; $j++)
                $castedNbr .= $strFinal[$j];
            return $castedNbr;
        } else if ($dec!=0 and is_integer($dec))
        {
            $nt="";
            $nt.=$number;
            $fnt="";
            if (strpos($nt, '.')==false) {
                $strNbr = $nt;
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                $fnt = $int . '.';
                for ($i = 1; $i <= $dec; $i++) $fnt .= '0';
                return $fnt;
            }
            else
            {
                $tmp=explode('.', $nt);
                //Partie entière
                $strNbr = "";
                $strNbr .= $tmp[0];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                //Partie décimale
                $strNbr = "";
                $strNbr .= $tmp[1];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $dec; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$i] = $strNbr[$i];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $flt=$castedNbr;

                return $int.'.'.$flt;
            }
        } else return $number;
    }
}

if ( ! function_exists('registrationCode')) {
    function registrationCode($lessonCode, $regNbr)
    {
        $code="";
        $code.=$lessonCode.date('ymd').'N'.castNumberId($regNbr);
        return $code;
    }
}

if ( ! function_exists('numberId')) {
    function numberId($userNbr, $role)
    {
        $numberID = "";
        if (in_array($role, array('S', 'M', 'G', 'F', 'A')))
            $numberID .= date('y') . $role . castNumberId($userNbr) . 'MA';
        else
            $numberID .= "Role non reconnu";
        return $numberID;
    }
}

if ( ! function_exists('newNumberId')) {
    function newNumberId($userNbr)
    {
        $numberID = "";

        $cons="ZUDTQCSPHNXM";
        //$stringLength= strlen($cons);
        $quota=100;
        $letter=intval($userNbr/$quota);
        $nbr=$userNbr%$quota;
        $numberID .= date('y') ."-". castNumberId($nbr) . "-".$cons[$letter];
        return $numberID;
    }
}

if ( ! function_exists('promotionCode')) {
    function promotionCode($promoNbr, $quota=100)
    {
        $numberID = "";
        $cons="ZUDTQCSPHNXM";
        $letter=intval($promoNbr/$quota);
        $nbr=$promoNbr%$quota;
        $numberID .= date('y').$cons[$letter]. castNumberId($nbr);
        return $numberID;
    }
}

if ( ! function_exists('getWeek')) {
    function getWeek($dayDate, $format='Y-m-d')
    {
        $date = explode("-", $dayDate);

        $time = strtotime($date[0].'-'.$date[1].'-'.$date[2]);
        //var_dump($time); die();

        $day = date("w", "$time");
        $jourdeb=0;
        $jourfin=0;

        switch ($day) {
            case "0":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-6,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2],$date[0]);
                break;

            case "1":
                $jourdeb = mktime(0,0,0,$date[1],$date[2],$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+6,$date[0]);
                break;

            case "2":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-1,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+5,$date[0]);
                break;

            case "3":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-2,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+4,$date[0]);
                break;

            case "4":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-3,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+3,$date[0]);
                break;

            case "5":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-4,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+2,$date[0]);
                break;

            case "6":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-5,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+1,$date[0]);
                break;
        }
        $date=date_create(date('d-m-Y', $jourfin));
        date_sub($date,date_interval_create_from_date_string("1 days"));
        $week=new stdClass();
        $week->start=date($format,$jourdeb);
        $week->end=date_format($date, $format);

        //$week=array('debut'=>date('d/m/Y',$jourdeb), 'fin'=>date_format($date, 'd/m/Y'));
        return $week;
    }
}
?>

