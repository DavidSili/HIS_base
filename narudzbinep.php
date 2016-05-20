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
if(isset($_POST) && !empty($_POST)) {
	$datprocx="";
	$datposx="";
	$datprimx="";
	if (isset($_POST['del'])) {
		$del=$mysqli->real_escape_string($_POST['del']);
		$sql='DELETE FROM narudzbine WHERE ID="'.$del.'"';
		mysqli_query($mysqli,$sql) or die;
	}
	else {
	foreach($_POST as $xx => $yy) {
		$$xx=$mysqli->real_escape_string($yy);
	}
	$sql0='SELECT * FROM narudzbine WHERE ID="'.$idx.'"';
	$result0=mysqli_query($mysqli,$sql0);
	$row0=$result->fetch_assoc();
	foreach($row0 as $xx => $yy) {
		$$xx=$yy;
	}
	$dattime=date('G:i:s j.n.Y.');
	$sql='UPDATE narudzbine SET ';
	$rdatum=date('Y-m-d');
	
	if ($datprocx!="" OR ($datposx!="" AND $datproc==NULL) OR ($datprimx!="" AND $datproc==NULL)) $sql.='datproc="'.$rdatum.'", ';
	if ($datposx!="" OR ($datprimx!="" AND $datpos==NULL)) $sql.='datpos="'.$rdatum.'", ';
	if ($datprimx!="") $sql.='datprim="'.$rdatum.'", ';
	$sql.='menjali="'.$menjali.'; '.$user.' - '.$dattime.'" WHERE ID="'.$idx.'"';
	mysqli_query($mysqli,$sql) or die;
	}
}

	?>
<html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">HIS baza - pregled narudžbi</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
#ielement {
	width:600px;
	padding:5px;
	float:none;
	margin:2px 5px;
	clear:both;
	overflow:hidden;
}
.col1 {
	width:175px;
	float:left;
	overflow:hidden;
}
.col2 {
	width:300px;
	float:left;
	border-left:1px solid #000;
	border-right:1px solid #000;
	margin:0 2px;
	padding: 0 3px;
	overflow:hidden;
}
.col3 {
	width:100px;
	float:left;
	margin:0 2px;
	padding: 0 3px;
	overflow:hidden;
}
.col3 input {
	width:100%;
	font-size:12;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<?php include 'topbar.php'; ?>
<div id="wrapper" style="margin-top:30px">
<?php
$sql0="SELECT username,name FROM users";
$result0=mysqli_query($mysqli,$sql0);
while ($row0=$result0->fetch_assoc()) {
$username=$row0['username'];
$name=$row0['name'];
	$korisnici[$username]=$name;
}
$tipx="";
$exp=date('Y-m-d',(time()-5184000));
if ($level<3) $sql='SELECT *,
		(
			CASE 
				WHEN datprim IS NOT NULL THEN 4
				WHEN datpos IS NOT NULL && datprim IS NULL THEN 3
				WHEN datproc IS NOT NULL && datpos IS NULL && datprim IS NULL THEN 2
				ELSE 1
			END) AS red

		FROM `narudzbine` WHERE ((datprim IS NOT NULL AND datprim>"'.$exp.'" ) OR (datprim IS NULL)) AND narucio="'.$user.'" ORDER BY red, datnar';
else $sql='SELECT *,
		(
			CASE 
				WHEN datprim IS NOT NULL THEN 4
				WHEN datpos IS NOT NULL && datprim IS NULL THEN 3
				WHEN datproc IS NOT NULL && datpos IS NULL && datprim IS NULL THEN 2
				ELSE 1
			END) AS red

		FROM `narudzbine` WHERE ((datprim IS NOT NULL AND datprim>"'.$exp.'" ) OR (datprim IS NULL)) ORDER BY red, datnar';

$result=mysqli_query($mysqli,$sql) or die;
$tipx="";
while($row=$result->fetch_assoc()) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
if ($datproc==NULL) $tip='Naručene stvari';
elseif ($datpos==NULL) $tip='U procesu';
elseif ($datprim==NULL) $tip='Poslate stvari';
else $tip='Primljene stvari';
$datnar=date('d.m.Y.',strtotime($datnar));
if (isset($datproc)) $datproc=date('d.m.Y.',strtotime($datproc));
if (isset($datpos)) $datpos=date('d.m.Y.',strtotime($datpos));
if (isset($datprim)) $datprim=date('d.m.Y.',strtotime($datprim));

if ($tipx!=$tip) {
	echo '<div style="color:#fff;font-weight:bold;font-size:16;margin-left:30px;text-shadow: 2px 2px #333;
">'.$tip.'</div>';
	$tipx=$tip;
}
foreach ($korisnici as $xx => $yy) {
	if ($narucio==$xx) $narucio=$yy;
}

echo '<div id="ielement" class="ielement" ';
if ($level<3) echo 'style="width:490px" ';
echo '><div class="col1"><div><b>Poručilac: </b>'.$narucio.'</div><div><b>Datum naručivanja:</b> '.$datnar.'</div>';
if (isset($datproc)) echo '<div><b>Datum procesiranja:</b> '.$datproc.'</div>';
if (isset($datpos)) echo '<div><b>Datum slanja:</b> '.$datpos.'</div>';
if (isset($datprim)) echo '<div><b>Datum primanja:</b> '.$datprim.'</div>';
if (isset($komentar))echo '<div><b>Komentar:</b> '.$komentar.'</div>';
echo '</div><div class="col2" ';
if ($level<3) echo 'style="border-right:none" ';
echo '>';
$predmeti=explode(';',$predmeti);
foreach($predmeti as $xx => $yy) {
	$item[$xx]=explode(',',$predmeti[$xx]);
}
$ida=$ID;
$ukupno=0;
$sql2='SELECT * FROM predmeti';
$result2=mysqli_query($mysqli,$sql2) or die;
while ($row2=$result2->fetch_assoc()) {
	foreach($row2 as $xx => $yy) {
		$$xx=$yy;
	}
	foreach($item as $xx => $yy) {
		if ($ID==$yy[0]) {
			$jednako=$yy[1]*$cena;
			$filename='upload_pic/T_5_'.$ID.'.jpg';
			if (file_exists($filename)) $slika='upload_pic/T_5_'.$ID.'.jpg';
				else $slika='images/nepoznato.jpg';
			echo '<div style="border-bottom:1px solid #000;float:left;"><div style="float:left;width:153px;background-image:url(\''.$slika.'\'); background-repeat:no-repeat; background-position:left center;background-size:14px 14px;padding-left:17px" title="'.$opis.'">'.$predmet.'</div><div style="width:40px;text-align:right;float:left">'.$yy[1].' x </div><div style="width:45px;float:left;text-align:right"> '.$cena.' = </div><div style="width:40px;float:left;padding-left:4px">'.$jednako.' €</div></div>';
			$ukupno=$ukupno+$jednako;
		}
	}
	
}
echo '<div style="float:right;margin-right:5px;font-size:14pt"><b>Ukupno: '.$ukupno.' €</b></div></div>';
$danas=date('Y-m-d');
if ($level>2) {
echo '<div class="col3">';
if ($datproc==NULL) echo '<form id="forma'.$ida.'" action="#" method="post"><input type="submit" value="U procesu"/><input type="hidden" name="idx" value="'.$ida.'" /><input type="hidden" name="datprocx" value="'.$danas.'" /></form>';
if ($datpos==NULL) echo '<form id="formb'.$ida.'" action="#" method="post"><input type="submit" value="Poslato"/><input type="hidden" name="idx" value="'.$ida.'" /><input type="hidden" name="datposx" value="'.$danas.'" /></form>';
if ($datprim==NULL) echo '<form id="formc'.$ida.'" action="#" method="post"><input type="submit" value="Pristiglo"/><input type="hidden" name="idx" value="'.$ida.'" /><input type="hidden" name="datprimx" value="'.$danas.'" /></form>';
echo '<form action="#" method="post" onsubmit="return confirm(\'Da li ste sigurni da želite da obrišete ovu porudžbinu?\')"><input type="submit" value="Obriši"/><input type="hidden" name="del" value="'.$ida.'" /></form></div>';
}
echo '</div>';

}

?>
</div>
<script type="text/javascript">
</script>
</body>
</html>