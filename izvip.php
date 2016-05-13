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
<title id="Timerhead">HIS baza - pregled izviđača</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
</style>
<meta name="robots" content="noindex">
</head>
<body style="min-width:880px">
<?php include 'topbar.php'; ?>
<div id="wrapper" style="margin-top:28px">
<?php
$sql="SELECT ID, ime FROM odredi";
$result=mysql_query($sql);
while($row=mysql_fetch_assoc($result)) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
	$odredx[$ID]=$ime;
}
$sql2="SELECT ID idv, naziv, fajl FROM vestine";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_assoc($result2)) {
	foreach($row2 as $xxx => $yyy) {
		$$xxx=$yyy;
	}
	$vestinex[$idv]=$naziv;
	$vestiney[$idv]=$fajl;
}
$sql='SELECT zaodred FROM users WHERE users.username="'.$user.'"';
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$oid=$row['zaodred'];

if ($level<3) $sql='SELECT * FROM imenik WHERE odred="'.$oid.'" ORDER BY odred, prezime, ime';
	else $sql="SELECT * FROM imenik ORDER BY odred, prezime, ime";
$result=mysql_query($sql);
while($row=mysql_fetch_assoc($result)) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
if (($datrod=="" OR $datrod==NULL)==false) $datrod=date('d.m.Y.',strtotime($datrod));
if (($datprim=="" OR $datprim==NULL)==false) $datprim=date('d.m.Y.',strtotime($datprim));
if (($datisk=="" OR $datisk==NULL)==false) $datisk=date('d.m.Y.',strtotime($datisk));
$cincnt=0;
if ($cinovi!=="") {
	$cinovi=explode(';',$cinovi);
	foreach($cinovi as $aa=>$bb) {
		$cinovib[$aa]=explode(', ',$bb);
		$cincnt++;
	}
}
$cincntt=$cincnt-1;

$vestinez="";
if ($vestine!=="") {
	$vestine=explode('; ',$vestine);
	foreach($vestine as $aaa=>$bbb) {
		$vestineb[$aaa]=explode(', ',$bbb);
		$lokfajl = str_replace($vestinex, $vestiney, $vestineb[$aaa][0]);
		$vestinez.='<img src="images/cinoviivestine/'.$lokfajl.'" title="'.$vestineb[$aaa][0].' ('.$vestineb[$aaa][1].')" style="float:left;padding-top:2px" width="40"/>';
	}
}
echo '<div id="ielement" class="ielement"';
$ovagodina=date('Y',time());
if ((strpos($clanarine,$ovagodina) !== false)==false) {
    echo ' style="background:#ccc"';
}
echo '><div class="cols"><span style="font-size:12;font-weight:bold">'.$prezime.' '.$ime.'</span>';
$filename='upload_pic/T_1_'.$ID.'.jpg';
if (file_exists($filename)) {
    echo '<a href="upload_pic/L_1_'.$ID.'.jpg" target="_blank" style="float:left;margin-right:6px;margin:2px 0"><img src="upload_pic/T_1_'.$ID.'.jpg" width="100" height="100" /></a>';
} else {
    echo '<img src="images/nepoznat.gif" width="100" height="100" style="float:left;margin-right:6px;margin:2px 0" />';
}
if ($cincnt!==0) echo '<img src="images/cinoviivestine/c'.$cincnt.'.jpg" style="float:left;margin:2px 0 0 2px" title="'.$cinovib[$cincntt][0].' ('.$cinovib[$cincntt][1].')" width="28"/>';
if ($datrod!=="") echo '<div><b>Datum rođenja:</b> '.$datrod.'</div>';
if ($mestorod!=="") echo '<div ><b>Mesto rođenja:</b> '.$mestorod.'</div>';
echo '<div><b>Adresa:</b> '.$adresa.'</div><div>'.$pobroj.' '.$mestoziv.'</div>';
if ($nesime!=="" OR $nesadr!=="" OR $nestel!=="") {
echo '<div style="background:#ddd"><b>Kontakt u slučaju nesreće:</b> '.$nesime.'<br/>';
if ($nesadr!=="") echo '<b>Adresa:</b> '.$nesadr.'<br/>';
if ($nestel!=="") echo '<b>Telefon:</b> '.$nestel;
echo '</div>';
}
echo '</div><div class="cols">';
if ($telefon!=="") echo '<div class="cols"><b>Telefon:</b> '.$telefon.'</div>';
if ($mobilni!=="") echo '<div class="cols"><b>Mobilni:</b> '.$mobilni.'</div>';
if ($email!=="") echo '<div class="cols"><b>e-mail:</b> '.$email.'</div>';
if ($krvna!=="") echo '<div class="cols"><b>Krvna grupa:</b> '.$krvna.'</div>';
echo '<div class="cols"><b>Plivač:</b> '.$plivac.'</div><div class="cols"><b>Vegan:</b> '.$vegan.'</div>';
if (($datprim=="" OR $datprim==NULL)==false) echo '<div class="cols"><b>Datum primanja:</b> '.$datprim.'</div>';
if (($datisk=="" OR $datisk==NULL)==false) echo '<div class="cols"><b>Datum isključenja:</b> '.$datisk.'</div>';
if ($otime!=="" OR $otprezime!=="" OR $otteldan!=="" OR $ottelnoc!=="" OR $otadresa!=="" OR $otmobilni!=="" OR $otemail!=="") {
echo '<div class="cols" style="background:#ddf"><b>Informacije o ocu:</b><br/>';
if ($otime!=="" OR $otprezime!=="") echo '<b>Ime:</b> '.$otime.' '.$otprezime.'<br/>';
if ($otteldan!=="") echo '<b>Telefon u toku dana:</b> '.$otteldan.'<br/>';
if ($ottelnoc!=="") echo '<b>Telefon u toku noći:</b> '.$ottelnoc.'<br/>';
if ($otadresa!=="") echo '<b>Adresa:</b> '.$otadresa.'<br/>';
if ($otmobilni!=="") echo '<b>Mobilni:</b> '.$otmobilni.'<br/>';
if ($otemail!=="") echo '<b>e-mail:</b> '.$otemail.'<br/>';
echo '</div>';
}
echo '</div><div class="cols">';
if ($alergije!=="") echo '<div class="cols"><b>Alergije:</b> '.$alergije.'</div>';
if ($hronicnebol!=="") echo '<div class="cols"><b>Hronične bolesti:</b> '.$hronicnebol.'</div>';
if ($lekovi!=="") echo '<div class="cols"><b>Lekovi:</b> '.$lekovi.'</div>';
if ($ostaleinfo!=="") echo '<div class="cols"><b>Ostale informacije:</b> '.$ostaleinfo.'</div>';
if ($odred!=="") echo '<div class="cols"><b>Odred:</b> '.$odredx[$odred].'</div>';
$funk[1]='vođa';
$funk[2]='zamenik';
$funk[3]='blagajnik';
$funk[4]='sekretar';
$funk[5]='ekonom';
$funkx = strtr($funkcije, $funk);
if ($funkcije!=="") {
echo '<div class="cols"><b>Funkcije:</b> '.$funkx.'</div>';
}
if ($clanarine!=="") echo '<div class="cols"><b>Članarine:</b> '.$clanarine.'</div>';
if ($komentar!=="") echo '<div class="cols"><b>Komentar:</b> '.$komentar.'</div>';
if ($maime!=="" OR $maprezime!=="" OR $mateldan!=="" OR $matelnoc!=="" OR $maadresa!=="" OR $mamobilni!=="" OR $maemail!=="") {
echo '<div class="cols" style="background:#fdd"><b>Informacije o majci:</b><br/>';
if ($maime!=="" OR $maprezime!=="") echo '<b>Ime:</b> '.$maime.' '.$maprezime.'<br/>';
if ($mateldan!=="") echo '<b>Telefon u toku dana:</b> '.$mateldan.'<br/>';
if ($matelnoc!=="") echo '<b>Telefon u toku noći:</b> '.$matelnoc.'<br/>';
if ($maadresa!=="") echo '<b>Adresa:</b> '.$maadresa.'<br/>';
if ($mamobilni!=="") echo '<b>Mobilni:</b> '.$mamobilni.'<br/>';
if ($maemail!=="") echo '<b>e-mail:</b> '.$maemail.'<br/>';
echo '</div>';
}
echo '</div>';
echo $vestinez;
echo '</div>';
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