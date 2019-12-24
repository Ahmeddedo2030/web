<?php
include_once 'dbConfig.php';

$Device_ID = $_POST["device_id"];
$Date1 = $_POST["Datecalendar1"]." 00:00:00";
$Date2 = $_POST["Datecalendar2"]." 00:00:00";
$sp1 = explode("-",$Date2);
if($sp1[2] == 31){
	
  $sp1[2] = "01";
  
  if($sp1[1] == 12){
	  
	  $sp1[1] = "01";
	  $newYear = $sp1[0]+1;
	  $newDate = $newYear."-".$sp1[1]."-".$sp1[2]." 00:00:00";
  }
  else{
  $newMonth = $sp1[1]+1;
  $newDate = $sp1[0]."-".$newMonth."-".$sp1[2]." 00:00:00";
  }

}else{
$sp2 = explode(" ",$sp1[2]);
$newDay = $sp2[0]+1;
$newDate = $sp1[0]."-".$sp1[1]."-".$newDay." 00:00:00";
}

$sql = mysqli_query($verbindung,"SELECT Ort,Datum,Value FROM co2_values WHERE Datum >= '".$Date1."' and Datum <= '".$newDate."' and Gereat_ID = '".$Device_ID."'");

$valuedata = array();
$datedata  = array();
$ortdata   =   array();

foreach($sql as $row){
	
	$valuedata[] =  $row['Value'];
	$datumdata[] =  $row['Datum'];
	$ortdata[]   =  $row['Ort'];
	
}

$sql->close();

$jsonvaluedata = json_encode($valuedata);

$datumortdata = array();

for($i = 0;$i<sizeof($ortdata);$i++){
	
	$datumortdata[] = $datumdata[$i].' '.$ortdata[$i];
}

$jsondatumortdata = json_encode($datumortdata);


?>

<!DOCTYPE html>
<html lang="en">
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <title>My Chart.js Chart</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400'
	rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat'
	rel='stylesheet' type='text/css'>
	<?php
header('Content-Type: text/html; charset=ISO-8859-1');
?>
</head>
<body>

  <div class="container">

    <canvas id="myChart"></canvas>

  </div>

  <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';
	

    let massPopChart = new Chart(myChart, {
      type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php
		  
		  echo $jsondatumortdata;
		  
		  ?>,
        datasets:[{
          label:'Co2 Values in PPM',
          data:<?php
		  
		  echo $jsonvaluedata;
		  
		  ?>,
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Statistic Diagramm',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:100
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
  </script>
   
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