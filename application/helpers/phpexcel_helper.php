<?php
    require_once('PHPExcel/Classes/PHPExcel.php');

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

    if ( ! function_exists('promotionCode')) {
        function promotionCode($promoNbr, $quota=100)
        {
            $numberID = "";
            $cons="ZUDTQCSPHNXM";
            $letter=intval($promoNbr/$quota);
            $nbr=$promoNbr%$quota;
            $numberID .= date('y') ."-".$cons[$letter]. castNumberId($nbr);
            return $numberID;
        }
    }

    if ( ! function_exists('toAscii')) {
        function toAscii($str)
        {
            $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
            $str = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $str);
            $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
            $str = preg_replace('#&[^;]+;#', '', $str);
            $final=$str;
            return $final;
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

     if ( ! function_exists('export')) {
        function export($data, $type)
        {
            //var_dump($data, $type); die();
            if (!in_array($type, array('certificate', 'report', 'attestation')) or empty($data))
            {
                return false;
            }
            else
            {
                $objPHPExcel=new PHPExcel();
                $objPHPExcel->getProperties()->setCreator("MULTISOFT ACADEMY S.A.R.L");
                $objPHPExcel->setActiveSheetIndex(0);

                
                if ($type=="certificate")
                {
                    $file='Certificates-'.$data->promotion.'-'.date('YmdHis').'.csv';
                    header('Content-Encoding: UTF-8');
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Type: application/force-download');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Disposition: attachment;filename='.$file);
                    ob_clean();
                    $output=fopen("php://output", "w");

                    $header=array("SEXE", "NOMS", "DNAISS", "LNAISS","MATRICULE", "VAGUE",  "CODEF","DUREE");
                    fputcsv($output, $header, ';');

                    $row=1;

                    //var_dump($data);die();
                    foreach ($data->certs as $crt)
                    {
                        $result=array(
                            utf8_decode($crt->sexe),
                            utf8_decode($crt->lastname)." ".utf8_decode($crt->firstname),
                            utf8_decode($crt->birth_date),
                            utf8_decode($crt->birth_place),
                            utf8_decode($crt->number_id),
                            utf8_decode($data->promotion),
                            utf8_decode($crt->codeMention),
                            utf8_decode($crt->duration)
                        );
                        fputcsv($output, $result, ';');
                    }
                    fclose($output);
                    return true;

                } else if ($type=="report") {
                    $file='Reports-'.$data->promotion.'-'.date('YmdHis').'.csv';
                    header('Content-Encoding: UTF-8');
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Type: application/force-download');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Disposition: attachment;filename='.$file);
                    ob_clean();
                    $output=fopen("php://output", "w");
                    $reps=$data->reports;
                    //var_dump($reps);die();
                    $header=array("CODE_INSCRIPTION","MATRICULE",  "NOMS", "DNAISS", "LNAISS", "FILIERE" , "CODEF","VAGUE","ANNEE");
                    foreach ($reps[0]->marks as $mk)
                        array_push($header, $mk->code,"P_".$mk->code, "APP_".$mk->code);
                    array_push($header, "MOYENNE_FINALE", "APP");
                    fputcsv($output, $header, ';');
                    foreach ($reps as $std)
                    {
                        $result=array(
                            utf8_decode($std->reg_code),
                            utf8_decode($std->number_id),
                            utf8_decode($std->lastname)." ".utf8_decode($std->firstname),
                            utf8_decode($std->birth_date),
                            utf8_decode($std->birth_place),
                            utf8_decode(mb_strtoupper($std->mention)),
                            utf8_decode($std->codeMention),
                            utf8_decode($data->promotion),
                            utf8_decode($std->year)
                        );

                        foreach ($std->marks as $mk)
                            array_push($result, $mk->value,$mk->percent,utf8_decode(mb_strtoupper(appreciate($mk->value))));
                        array_push($result, $std->final, utf8_decode(mb_strtoupper($std->app)));
                        fputcsv($output, $result, ';');
                    }
                    fclose($output);
                    return true;
                   

                } else {

                    $file='Attestations--'.$data->promotion.'--'.date('YmdHis').'.csv';
                    header('Content-Encoding: UTF-8');
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Type: application/force-download');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Disposition: attachment;filename='.$file);
                    ob_clean();
                    $output=fopen("php://output", "w");

                    $header=array("SEXE", "NOMS", "DNAISS", "LNAISS","MATRICULE", "VAGUE",  "CODEF","DUREE");
                    fputcsv($output, $header, ';');

                    $row=1;

                    //var_dump($data);die();
                    foreach ($data->atts as $crt)
                    {
                        $result=array(
                            utf8_decode($crt->sexe),
                            utf8_decode($crt->lastname)." ".utf8_decode($crt->firstname),
                            utf8_decode($crt->birth_date),
                            utf8_decode($crt->birth_place),
                            utf8_decode($crt->number_id),
                            utf8_decode($data->promotion),
                            utf8_decode($crt->codeMention),
                            utf8_decode($crt->duration)
                        );
                        fputcsv($output, $result, ';');
                    }
                    fclose($output);
                    return true;
                }
            }
        }
    }

    if ( ! function_exists('appreciate')) {

    function appreciate($note)
    {
        if ($note==0) return 'Null';
        else if ($note<7) return 'Médiocre';
        else if ($note<10) return 'Faible';
        else if ($note<12) return 'Passable';
        else if ($note<14) return 'Assez bien';
        else if ($note<17) return 'Bien';
        else if ($note<20) return 'Très bien';
        else return 'Excellent';
    }
}
?>

