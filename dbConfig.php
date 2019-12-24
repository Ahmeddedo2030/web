<?php

$dbHost ="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="luftquality";

$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
$verbindung = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

if(!$verbindung){
	die("Connection failed:".mysqli.error);
}

?>