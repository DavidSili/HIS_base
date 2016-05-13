<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;

$sql="SELECT * FROM predmeti WHERE `ID`=$posebno";
$result=mysql_query($sql) or die;
$row=mysql_fetch_assoc($result);
foreach($row as $xx => $yy) {
	$$xx=$yy;
}

$passhtml['ytip']=$tip;
$passhtml['ypredmet']=$predmet;
$passhtml['ycena']=$cena;
$passhtml['yopis']=$opis;
echo json_encode($passhtml);
?>