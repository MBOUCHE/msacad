<?php

require_once dirname(__FILE__).'/../../../views/e_views/public/html2pdf-5.1.0/vendor/autoload.php';


	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
		
	$html2pdf = new Html2Pdf();
	$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');


	$html2pdf->output();

?>