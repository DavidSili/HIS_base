<?php
	session_start();
	$uri=$_SERVER['REQUEST_URI'];
	$pos = strrpos($uri, "/");
	$url = substr($uri, $pos+1);
	if ($_SESSION['loggedin'] != 1 OR $_SESSION['level'] < 2 ) {
		header("Location: login.php?url=$url");
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
<title id="Timerhead">HIS baza - pregled odreda</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
#ielement {
	width:265px;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<?php include 'topbar.php'; ?>
<div id="wrapper" style="margin-top:28px">
<?php
$sql="SELECT * FROM odredi ORDER BY datosn";
$result=mysql_query($sql);
while($row=mysql_fetch_assoc($result)) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
if (($datosn=="" OR $datosn==NULL)==false) $datosn=date('d.m.Y.',strtotime($datosn));
if (($datrasp=="" OR $datrasp==NULL)==false) $datrasp=date('d.m.Y.',strtotime($datrasp));

if (strlen($stranica) > 50) $stranicax=substr(($stranica), 0, 50). "...";
	else $stranicax=$stranica;
	
echo '<div id="ielement" class="ielement"><div class="cols" style="width:100px;text-align:center"><span style="font-size:14;font-weight:bold">'.$ime.'</span>';
$filename='upload_pic/T_2_'.$ID.'.jpg';
if (file_exists($filename)) {
    echo '<a href="upload_pic/L_2_'.$ID.'.jpg" target="_blank" style="float:left;margin-right:6px;margin:2px 0"><img src="upload_pic/T_2_'.$ID.'.jpg" width="100" height="100" /></a>';
} else {
    echo '<img src="images/nepoznato.jpg" width="100" height="100" style="float:left;margin-right:6px;margin:2px 0" />';
}
echo '</div><div class="cols" style="width:150px"><div><b>Mesto:</b> '.$mesto.'</div>';
if ($adresa!=="") echo '<div><b>Adresa:</b> '.$adresa.'</div>';
if ($datosn!==NULL) echo '<div><b>Datum osnivanja:</b> '.$datosn.'</div>';
if ($datrasp!==NULL) echo '<div><b>Datum raspuštanja:</b> '.$datrasp.'</div>';
if ($stranica!=="") echo '<div><b>Internet prezentacija:</b><br/><a href="'.$stranica.'" target="_BLANK" style="word-wrap: break-word">'.$stranicax.'</a></div>';
echo '</div><div style="width:265px;clear:both">';
$IDa=$ID;
$sql2='SELECT ime, prezime, funkcije FROM imenik WHERE funkcije!="" AND odred="'.$IDa.'"';
$result2=mysql_query($sql2);
while($row2=mysql_fetch_assoc($result2)) {

	foreach($row2 as $xx => $yy) {
		$$xx=$yy;
	}
	
	if (strpos($funkcije,'1') !== false) {
	echo '<div style="width:125px;margin-right:7px;float:left"><b>Vođa:</b> '.$ime.' '.$prezime.'</div>';
	}
	if (strpos($funkcije,'2') !== false) {
	echo '<div style="width:125px;margin-right:7px;float:left"><b>Zamenik:</b> '.$ime.' '.$prezime.'</div>';
	}
	if (strpos($funkcije,'3') !== false) {
	echo '<div style="width:125px;margin-right:7px;float:left"><b>Blagajnik:</b> '.$ime.' '.$prezime.'</div>';
	}
	if (strpos($funkcije,'4') !== false) {
	echo '<div style="width:125px;margin-right:7px;float:left"><b>Sekretar:</b> '.$ime.' '.$prezime.'</div>';
	}
	if (strpos($funkcije,'5') !== false) {
	echo '<div style="width:125px;margin-right:7px;float:left"><b>Ekonom:</b> '.$ime.' '.$prezime.'</div>';
	}
	
}

echo '</div></div>';

	
}

?>
</div>
<script type="text/javascript">
$('#wrapper').masonry({
	itemSelector: '.ielement'
});
</script>
</body>
</html>