<?php
include '../config.php';
$posebno = isset($_GET["posebno"]) ? $_GET["posebno"] : 0;
$prisutni2="";
$sql2="SELECT imenik.ID idi, imenik.ime ime, imenik.prezime prezime, imenik.datrod datum, imenik.odred oid, odredi.ime odred FROM imenik, odredi WHERE imenik.odred=odredi.ID ORDER BY prezime,ime ASC";
$result2=mysql_query($sql2) or die;
while ($row2=mysql_fetch_assoc($result2)) {
	$idi=$row2['idi'];
	$prezime=$row2['prezime'];
	$ime=$row2['ime'];
	$odred=$row2['odred'];
	$oid=$row2['oid'];

	$datum=strtotime($row2['datum']);
	$danas=time();
	$razlika=$danas-$datum;
	$godina=floor($razlika/31556926);
	$prisutni2.='<li class="ui-state-default" id="'.$idi.'">'.$prezime.' '.$ime.' ('.$godina.', '.$odred.')<img src="upload_pic/T_2_'.$oid.'.jpg" style="float:right;height:15px;opacity:0.6" /></li>';
}
$passhtml['yprisutni2']=$prisutni2;
echo json_encode($passhtml);
?>