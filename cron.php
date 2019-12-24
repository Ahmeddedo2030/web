<?php
include_once 'dbConfig.php';

$sql = mysqli_query($verbindung,"SELECT Ort,Datum,Value FROM co2_values ");



while ($row = mysqli_fetch_assoc($sql)){
	
	if($row['Value'] >= 300){
		
		echo 'Danger';
		
	}
}


$sql->close();

?>