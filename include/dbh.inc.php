<?php

$servername = "localhost";
$dBusername = "root";
$dBPassword = "";
$dBName = "rsvpdata";

$conn = mysqli_connect($servername, $dBusername, $dBPassword, $dBName);

if(!$conn) {
	die("Connection Failed: ".mysqli_connect_error());
}
