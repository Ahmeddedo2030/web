<?php

include_once 'dbConfig.php';

$Device_ID = $_POST["device_id"];
$Date = $_POST["Datecalendar"]." 00:00:00";
$sp1 = explode("-",$Date);
$sp2 = explode(" ",$sp1[2]);
$newDay = $sp2[0]+1;
$newDate = $sp1[0]."-".$sp1[1]."-".$newDay." 00:00:00";
$sql = mysqli_query($verbindung,"SELECT Ort,Datum,Value FROM co2_values WHERE Datum >= '".$Date."' and Datum < '".$newDate."' and Gereat_ID = '".$Device_ID."'");

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
		 </div>
		 
		 <div id ="main3">
		
		<?php
		
		if($Device_ID == "---Device_ID---"){

echo "You did not choose any Device.";
	
}
elseif(mysqli_num_rows($sql)==0){
	
	echo "There are no Informations about this Device.";
	
}
else{
	
while ($row = mysqli_fetch_assoc($sql)){
	
	?>

		<table>
	<tr>
  <td style="width: 10%"><?php echo 'Place : '.$row['Ort'];?></td>
  <td style="width: 10%"><?php echo 'Date : '.$row['Datum'];?></td>
  <td style="width: 10%"><?php echo 'CO2 Value : '.$row['Value'].' ppm';?></td><br>
  
  </tr>
   </table>
	
<?php } ?>
	
<?php } ?>
				
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

