<?php
	session_start();
	$uri=$_SERVER['REQUEST_URI'];
	$pos = strrpos($uri, "/");
	$url = substr($uri, $pos+1);
	if ($_SESSION['loggedin'] != 1 OR $_SESSION['level'] == 0 ) {
		header("Location: login.php?url=index.php");
		exit;
	}
	else {
	include 'config.php';
	$level=$_SESSION['level'];
	$user=$_SESSION['user'];
	}
?>
<html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">HIS baza</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<style type="text/css">
</style>
<meta name="robots" content="noindex">
</head>
<body>
<?php include 'topbar.php'; ?>

<div id="introbox" style="width:200px;top:27px;position:absolute;left:0;bottom:0;background:#fff;opacity:0.4">
</div>
<div class="wrap" style="position:absolute;top:32px;left:10px;width:200px">
	<div class="iur">
		<div class="iul" style="text-align:left;width:185px"><b>Predstojeći rođendani u odredu <?php
$sql='SELECT odredi.ime oime, odredi.ID oid FROM odredi,users WHERE odredi.ID = users.zaodred AND users.username="'.$user.'"';
$result=mysqli_query($mysqli,$sql);
$row=mysql_fetch_assoc($result);
$oime=$row['oime'];
$oid=$row['oid'];
echo $oime.':</b><br/>';

$sql='SELECT
ID, ime, prezime,
datrod,
datrod + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(datrod)) + 0 YEAR AS currbirthday,
datrod + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(datrod)) + 1 YEAR AS nextbirthday
FROM imenik
WHERE odred ="'.$oid.'"
ORDER BY CASE WHEN currbirthday < CURRENT_TIMESTAMP
THEN nextbirthday
ELSE currbirthday
END
LIMIT 10';
$result=mysqli_query($mysqli,$sql);
while($row=mysql_fetch_assoc($result)) {
$ime=$row['ime'];
$prezime=$row['prezime'];
$rodj=$row['currbirthday'];
$srodj=$row['nextbirthday'];
$datrod=$row['datrod'];

$datum=strtotime($datrod);
$danas=time();
$razlika=$danas-$datum;
$godina=floor($razlika/31556926);
$sgodina=$godina+1;

$rodj=date('d.m.',strtotime($rodj));

echo '<div>'.$prezime.' '.$ime.' ('.$sgodina.')<div style="float:right">'.$rodj.'</div></div>';
}
echo '<div><br/><b>Izviđači po uzrastu</b></div>';
$sql='SELECT ime, prezime, datrod FROM imenik WHERE odred="'.$oid.'" ORDER BY datrod DESC';
$result=mysqli_query($mysqli,$sql);
$danas=time();
$uzrast=0;
while($row=mysql_fetch_assoc($result)) {
$ime=$row['ime'];
$prezime=$row['prezime'];
$datrod=$row['datrod'];
$datrodv=strtotime($datrod);
$razlika=$danas-$datrodv;
$godina=floor($razlika/31556926); 
if ($godina<10 AND $uzrast<1) {
echo '<div style="padding-left:20px"><b>Poletarci</b></div>';
$uzrast=1;
}
elseif ($godina>9 AND $godina<15 AND $uzrast<2) {
echo '<div style="padding-left:20px"><b>Izviđači</b></div>';
$uzrast=2;
}
elseif ($godina>14 AND $uzrast<3) {
echo '<div style="padding-left:20px"><b>Skauti</b></div>';
$uzrast=3;
}
echo '<div>'.$prezime.' '.$ime.' ('.$godina.')';
if ($godina<6) {
	if ($razlika>181479156) {
		$preostalo=floor((189341556-$razlika)/86400)*(-1);
		echo ' <span style="color:#555" title="preostalo vremena do sledeće starosne grupe">('.$preostalo.')</span>';
	}
}
if ($godina>5 AND $godina<10) {
	if ($razlika>307706860) {
		$preostalo=floor((315569260-$razlika)/86400)*(-1);
		echo ' <span style="color:#555" title="preostalo vremena do sledeće starosne grupe">('.$preostalo.')</span>';
	}
	if ($razlika<197203956) {
		$proslo=floor(($razlika-189341556)/86400);
		echo ' <span style="color:#555" title="vreme koje je prošlo od prelaska u starosnu grupu">(+'.$proslo.')</span>';
	}
}
if ($godina>9 AND $godina<15) {
	if ($razlika>465512416) {
		$preostalo=floor((473374816-$razlika)/86400)*(-1);
		echo ' <span style="color:#555" title="preostalo vremena do sledeće starosne grupe">('.$preostalo.')</span>';
	}
	if ($razlika<323431660) {
		$proslo=floor(($razlika-315569260)/86400);
		echo ' <span style="color:#555" title="vreme koje je prošlo od prelaska u starosnu grupu">(+'.$proslo.')</span>';
	}
}
if ($godina>14) {
	if ($razlika<481237216) {
		$proslo=floor(($razlika-473374816)/86400);
		echo ' <span style="color:#555" title="vreme koje je prošlo od prelaska u starosnu grupu">(+'.$proslo.')</span>';
	}
}
echo '</div>';

}

?>
</div>
		<div style="clear:both;"></div>
	</div>
</div>
<script type="text/javascript">
</script>
</body>
</html>