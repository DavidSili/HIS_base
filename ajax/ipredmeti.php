<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;
$posebno = $mysqli->real_escape_string($posebno);

$sql="SELECT * FROM predmeti WHERE `ID`=$posebno";
$result=mysqli_query($mysqli,$sql) or die;
$row=$result->fetch_assoc();
foreach($row as $xx => $yy) {
	$$xx=$yy;
}

$passhtml['ytip']=$tip;
$passhtml['ypredmet']=$predmet;
$passhtml['ycena']=$cena;
$passhtml['yopis']=$opis;
echo json_encode($passhtml);
?>