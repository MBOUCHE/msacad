 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>COMPTE A REBOURS </title>
	<script LANGUAGE="JavaScript"> <!-- 
		function getTime() { 
			now = new Date();
			y2k = new Date("Mar 31 2019 15:00:00");
			//ICI LA DATE CIBLE 
			days = (y2k - now) / 1000 / 60 / 60 / 24;
			daysRound = Math.floor(days);

			hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
			hoursRound = Math.floor(hours);

			minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
			minutesRound = Math.floor(minutes);

			seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
			secondsRound = Math.round(seconds);

			sec = (secondsRound == 1) ? " seconde" : " secondes";
			min = (minutesRound == 1) ? " minute" : " minutes, ";
			hr = (hoursRound == 1) ? " heure" : " heures, ";
			dy = (daysRound == 1) ? " jour" : " jours, ";

			document.timeForm.input1.value = "Encore " + daysRound + dy + hoursRound + hr + minutesRound + min + secondsRound + sec  + "--- avant le 31 Mars 2019 15 H 00 !";
			newtime = window.setTimeout("getTime();", 1000);
			} 		
	</script>
</head>
<body onLoad="getTime()">
	<?php
/*		$actualTime = strtotime('now');

		$endTime = $actualTime+(30*60);
		$TotalTime = ($actualTime+(30*60))-$actualTime;
		while ($TotalTime > 0) {
			echo $TotalTime;
			$TotalTime--;
			sleep(1);
		}
		echo $actualTime.'<br>';
		echo $endTime;*/
	?>
	<form name="timeForm">
		<input type="text" name="input1" size=210 border-style="none" style="border-bottom: 0px solid; border-left: 0px solid; border-right: 0px solid; border-top: 0px solid; font:12px arial, helvetica,sans-serif";>
	</form>
</body>
</html> 