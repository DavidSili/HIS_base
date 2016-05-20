<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;
$posebno = $mysqli->real_escape_string($posebno);

$sql="SELECT * FROM obuke WHERE `ID`=$posebno";
$result=mysqli_query($mysqli,$sql) or die;
$row=$result->fetch_assoc();
foreach($row as $xx => $yy) {
	$$xx=$yy;
}
if (empty($datpoc)==false) $datpoc=date('d.m.Y.',strtotime($datpoc));
if (empty($datkraj)==false) $datkraj=date('d.m.Y.',strtotime($datkraj));
$prisutnix=explode(';',$prisutni);
$prisutniy=explode(',',$prisutnix[0]);
if (array_key_exists('1',$prisutnix)) $neplatili=explode(',',$prisutnix[1]);
else $neplatili=array();

$prisutni1="";
$prisutni2="";
$prisutnis="";

$sql2="SELECT imenik.ID idi, imenik.ime ime, imenik.prezime prezime, imenik.datrod datum, imenik.odred oid, odredi.ime odred FROM imenik, odredi WHERE imenik.odred=odredi.ID ORDER BY prezime,ime ASC";
$result2=mysqli_query($mysqli,$sql2) or die;
while ($row2=$result2->fetch_assoc()) {
	$idi=$row2['idi'];
	$prezime=$row2['prezime'];
	$ime=$row2['ime'];
	$odred=$row2['odred'];
	$oid=$row2['oid'];

	$datum=strtotime($row2['datum']);
	$danas=time();
	$razlika=$danas-$datum;
	$godina=floor($razlika/31556926);
	if (in_array($idi, $prisutniy)) {
		$prisutni1.='<li class="ui-state-highlight" id="'.$idi.'">'.$prezime.' '.$ime.' ('.$godina.', '.$odred.')<img src="upload_pic/T_2_'.$oid.'.jpg" style="float:right;height:15px;opacity:0.6" /></li>';
	}
	elseif (in_array($idi,$neplatili)) {
		$prisutnis.='<li class="ui-state-neplatise" id="'.$idi.'">'.$prezime.' '.$ime.' ('.$godina.', '.$odred.')<img src="upload_pic/T_2_'.$oid.'.jpg" style="float:right;height:15px;opacity:0.6" /></li>';
	}
	else {
		$prisutni2.='<li class="ui-state-default" id="'.$idi.'">'.$prezime.' '.$ime.' ('.$godina.', '.$odred.')<img src="upload_pic/T_2_'.$oid.'.jpg" style="float:right;height:15px;opacity:0.6" /></li>';
	}
}
if (strtotime($datkraj)>time()) $spec=2;
	else $spec=1;
$passhtml['ydatpoc']=$datpoc;
$passhtml['ydatkraj']=$datkraj;
$passhtml['ymesto']=$mesto;
$passhtml['ydrzava']=$drzava;
$passhtml['ytip']=$tip;
$passhtml['yinstruktori']=$instruktori;
$passhtml['ykomentar']=$komentar;
$passhtml['yprisutni1']=$prisutni1;
$passhtml['yprisutni2']=$prisutni2;
$passhtml['yprisutnis']=$prisutnis;
$passhtml['spec']=$spec;
echo json_encode($passhtml);
?>