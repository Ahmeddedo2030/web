
<?php

include_once 'dbConfig.php';
$sql = mysqli_query($verbindung,"SELECT DISTINCT Gereat_ID FROM co2_values");
$sql2 = mysqli_query($verbindung,"SELECT DISTINCT Gereat_ID FROM co2_values");

?>

<html>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400'
	rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat'
	rel='stylesheet' type='text/css'>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');
?>

<title>Luftqualittsmessung</title>

</head>

<body>

	<div id="zeit">

		<!-- Fr Zeitanzeige in der Menleiste -->
<?php
$jetzt = time();
?>

</div>

	<div id="header">

		<table>
			<tr>

				<th align="left"><img src="Allgemeines_Logo.jpg" width="190"
					height="190" align="middle" alt="Hochschullogo" /></th>
				<th></th>

				<td style="width: 10%">Projektgruppe WS 19/20</td>

			</tr>

		</table>

	</div>


	<!-- MENBAR-->
	<div id="menubar">

		<table>
			<tr>
				<td style="width: 10%"> <?php echo date("d.m.Y", $jetzt) . "<br />";    ?>       </td>
				<td style="width: 10%"> <?php echo date("H:i", $jetzt) ." Uhr". " <br />";    ?>       </td>
				<td style="width: 10%"><a href="indexTest2.php">Zurck zur Hauptseite</a></td>
						<td style="width: 10%"><a href="Alle_Sensoren_anzeigen.php">Alle Sensoren anzeigen</a></td>

			</tr>
		</table>
		
<form action="result.php" method="post" style = "margin-left:350px;">
<label><br><br>
<b>Choose the Date:<b> <input type = "date" name = "Datecalendar" id="date-input" required />
<label style = "margin-left:50px;">Please select Device ID :
<select name = "device_id">
<option>---Device_ID---</option> 

<?php
while ($row = mysqli_fetch_assoc($sql)){
	$ID = $row['Gereat_ID'];
    echo "<option value='$ID' style='background:lightblue;'>$ID</option>";
}
?>

</select></label><br><br>
<span class="validity"></span>
<input style="cursor: pointer; border-radius:30px; box-shadow: 1px 1px 2px 1px rgba(0,0,0,0.3);width: 10%; float:center; margin-left:240px;" type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="button"/>
</label>

</form>

<form action="data.php" method="post" style = "margin-top:100px;">
<label style = "margin-left:200px;">Show Statistic Diagramm</label>
<label><br><br>
<b>From:<b> <input type = "date" name = "Datecalendar1" id="date-input" required />
<b>To:<b> <input type = "date" name = "Datecalendar2" id="date-input" required />
<label style = "margin-left:30px;">Please select Device ID :
<select name = "device_id">
<option>---Device_ID---</option> 

<?php
while ($row = mysqli_fetch_assoc($sql2)){
	$ID = $row['Gereat_ID'];
    echo "<option value='$ID' style='background:lightblue;'>$ID</option>";
}
?>

</select></label><br><br>
<span class="validity"></span>
<input style="cursor: pointer; border-radius:30px; box-shadow: 1px 1px 2px 1px rgba(0,0,0,0.3);width: 10%; float:center; margin-left:240px;" type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="button"/>
</label>

</form>
		
	</div>

	<div id="footer">

		<table>


			<tr>

				<td style="width: 10%">Betreuer Prof. Dirk Kutscher</td>
				<td style="width: 10%">Team Luftqualittsmessung</td>
				<td style="width: 10%">Hochschule Emden-Leer</td>




			</tr>

		</table>




	</div>



</body>


</html>
