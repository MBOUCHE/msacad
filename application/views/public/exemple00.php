<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */

// include '../../controlClasse/ConnexionDB&Classes.php';

require_once dirname(__FILE__).'/html2pdf-5.1.0/vendor/autoload.php'; 

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    include dirname(__FILE__).'/bill_payment.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A5', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output(session_data('firstname').'_'.$inscription['num_slice'].'-'.$inscription['total_slice'].'_bill_payment.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
