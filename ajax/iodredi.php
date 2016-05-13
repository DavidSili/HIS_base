<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;

$sql="SELECT * FROM odredi WHERE `ID`=$posebno";
$result=mysqli_query($mysqli,$sql) or die;
$row=$result->fetch_assoc();
foreach($row as $xx => $yy) {
	$$xx=$yy;
}
if (empty($datosn)==false) $datosn=date('d.m.Y.',strtotime($datosn));
if (empty($datrasp)==false) $datrasp=date('d.m.Y.',strtotime($datrasp));

$passhtml['yime']=$ime;
$passhtml['ymesto']=$mesto;
$passhtml['yadresa']=$adresa;
$passhtml['ydatosn']=$datosn;
$passhtml['ydatrasp']=$datrasp;
$passhtml['ystranica']=$stranica;
echo json_encode($passhtml);
?>