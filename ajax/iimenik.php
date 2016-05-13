<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;

$sql="SELECT * FROM imenik WHERE `ID`=$posebno";
$result=mysql_query($sql) or die;
$row=mysql_fetch_assoc($result);
foreach($row as $xx => $yy) {
	$$xx=$yy;
}
if (empty($datrod)==false) $datrod=date('d.m.Y.',strtotime($datrod));
if (empty($datprim)==false) $datprim=date('d.m.Y.',strtotime($datprim));
if (empty($datisk)==false) $datisk=date('d.m.Y.',strtotime($datisk));

$passhtml['yime']=$ime;
$passhtml['yprezime']=$prezime;
$passhtml['ydatrod']=$datrod;
$passhtml['ymestorod']=$mestorod;
$passhtml['yadresa']=$adresa;
if ($pobroj==0 OR $pobroj==NULL) $passhtml['ypobroj']="";
else $passhtml['ypobroj']=$pobroj;
$passhtml['ymestoziv']=$mestoziv;
$passhtml['ytelefon']=$telefon;
$passhtml['ymobilni']=$mobilni;
$passhtml['yemail']=$email;
$passhtml['ykrvna']=$krvna;
$passhtml['yplivac']=$plivac;
$passhtml['yvegan']=$vegan;
$passhtml['yalergije']=$alergije;
$passhtml['yhronicnebol']=$hronicnebol;
$passhtml['ylekovi']=$lekovi;
$passhtml['yostaleinfo']=$ostaleinfo;
$passhtml['ydatprim']=$datprim;
$passhtml['ydatisk']=$datisk;
$passhtml['yodred']=$odred;
$passhtml['yotime']=$otime;
$passhtml['yotprezime']=$otprezime;
$passhtml['yotteldan']=$otteldan;
$passhtml['yottelnoc']=$ottelnoc;
$passhtml['yotadresa']=$otadresa;
$passhtml['yotmobilni']=$otmobilni;
$passhtml['yotemail']=$otemail;
$passhtml['ymaime']=$maime;
$passhtml['ymaprezime']=$maprezime;
$passhtml['ymateldan']=$mateldan;
$passhtml['ymatelnoc']=$matelnoc;
$passhtml['ymaadresa']=$maadresa;
$passhtml['ymamobilni']=$mamobilni;
$passhtml['ymaemail']=$maemail;
$passhtml['ynesime']=$nesime;
$passhtml['ynesadr']=$nesadr;
$passhtml['ynestel']=$nestel;
$passhtml['yfunkcije']=explode(',',$funkcije);
$passhtml['ycinovi']=$cinovi;
$passhtml['yvestine']=$vestine;
$passhtml['yclanarine']=explode(',',$clanarine);
$passhtml['ykomentar']=$komentar;
echo json_encode($passhtml);
?>