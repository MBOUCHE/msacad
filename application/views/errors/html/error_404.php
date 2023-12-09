<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}



#container {
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}


table th{
	font-size: 2rem;
	text-transform: uppercase;
	background: red;
	color: white;
	font-weight: bold;
	text-align: center;
	font-family: arial, sans-serif;
	letter-spacing: 2px;
	height: 100px;


}
</style>
</head>
<body>
<table width="100%" id="container" class="container">
	<tr>
		<th class="" colspan="3" align="center">
			<?php echo $heading; ?>
		</th>
	</tr>
	<tr>
		<td  colspan="3" style="color: #343434; font-weight: 500; height: 75px" align="center">
			<h2><?php echo $message; ?></h2>
		</td>
	</tr>
</table>
</body>
</html>