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
	$funkcije=array();
	$clanarine=array();
	foreach($_POST as $xx => $yy) {
		$$xx=$yy;
	}
	if (empty($datrod)==false) {
	$datrodx=date('Y-m-d',strtotime($datrod));
	$datrod='"'.$datrodx.'"';
	}
		else $datrod='NULL';
	if (empty($datprim)==false) {
	$datprimx=date('Y-m-d',strtotime($datprim));
	$datprim='"'.$datprimx.'"';
	}
		else $datprim='NULL';
	if (empty($datisk)==false) {
	$datiskx=date('Y-m-d',strtotime($datisk));
	$datisk='"'.$datiskx.'"';
	}
		else $datisk='NULL';
	$funkcijex="";
	foreach($funkcije as $funk) {
		$funkcijex.=$funk.',';
	}
	$funkcije=substr($funkcijex, 0, -1);
	$clanarinex="";
	foreach($clanarine as $clan) {
		$clanarinex.=$clan.',';
	}
	$clanarine=substr($clanarinex, 0, -1);
	$dattime=date('G:i:s j.n.Y.');
	
	if (isset($_POST['del'])) {
		$del=$_POST['del'];
		$nid=$del;
		$sql='DELETE FROM imenik WHERE ID="'.$del.'"';
		mysqli_query($mysqli,$sql) or die;
	}
	elseif ($nid==$nextid) {
		$sql='INSERT INTO imenik (ime, prezime, datrod, mestorod, adresa, pobroj, mestoziv, telefon, mobilni, email, krvna, plivac, vegan, alergije, hronicnebol, lekovi, ostaleinfo, datprim, datisk, odred, otime, otprezime, otteldan, ottelnoc, otadresa, otmobilni, otemail, maime, maprezime, mateldan, matelnoc, maadresa, mamobilni, maemail, nesime, nesadr, nestel, funkcije, cinovi, vestine, clanarine, komentar, uneo) VALUES ("'.$ime.'","'.$prezime.'",'.$datrod.',"'.$mestorod.'","'.$adresa.'","'.$pobroj.'","'.$mestoziv.'","'.$telefon.'","'.$mobilni.'","'.$email.'","'.$krvna.'","'.$plivac.'","'.$vegan.'","'.$alergije.'","'.$hronicnebol.'","'.$lekovi.'","'.$ostaleinfo.'",'.$datprim.','.$datisk.',"'.$odred.'","'.$otime.'","'.$otprezime.'","'.$otteldan.'","'.$ottelnoc.'","'.$otadresa.'","'.$otmobilni.'","'.$otemail.'","'.$maime.'","'.$maprezime.'","'.$mateldan.'","'.$matelnoc.'","'.$maadresa.'","'.$mamobilni.'","'.$maemail.'","'.$nesime.'","'.$nesadr.'","'.$nestel.'","'.$funkcije.'","'.$cinovi.'","'.$vestine.'","'.$clanarine.'","'.$komentar.'","'.$user.' - '.$dattime.'")';
		mysqli_query($mysqli,$sql) or die;
	}
	else {
		$sql='SELECT menjali FROM imenik WHERE ID="'.$nid.'"';
		$result=mysqli_query($mysqli,$sql) or die;
		$row=$result->fetch_assoc();
		$row=$result->fetch_assoc();
		$xmenjali=$row['menjali'];
		
		$sql='UPDATE imenik SET ime="'.$ime.'", prezime="'.$prezime.'", datrod='.$datrod.', mestorod="'.$mestorod.'", adresa="'.$adresa.'", pobroj="'.$pobroj.'", mestoziv="'.$mestoziv.'", telefon="'.$telefon.'", mobilni="'.$mobilni.'", email="'.$email.'", krvna="'.$krvna.'", plivac="'.$plivac.'", vegan="'.$vegan.'", alergije="'.$alergije.'", hronicnebol="'.$hronicnebol.'", lekovi="'.$lekovi.'", ostaleinfo="'.$ostaleinfo.'", datprim='.$datprim.', datisk='.$datisk.', odred="'.$odred.'", otime="'.$otime.'", otprezime="'.$otprezime.'", otteldan="'.$otteldan.'", ottelnoc="'.$ottelnoc.'", otadresa="'.$otadresa.'", otmobilni="'.$otmobilni.'", otemail="'.$otemail.'", maime="'.$maime.'", maprezime="'.$maprezime.'", mateldan="'.$mateldan.'", matelnoc="'.$matelnoc.'", maadresa="'.$maadresa.'", mamobilni="'.$mamobilni.'", maemail="'.$maemail.'", nesime="'.$nesime.'", nesadr="'.$nesadr.'", nestel="'.$nestel.'", funkcije="'.$funkcije.'", cinovi="'.$cinovi.'", vestine="'.$vestine.'", clanarine="'.$clanarine.'", komentar="'.$komentar.'", menjali="'.$xmenjali.'; '.$user.' - '.$dattime.'" WHERE ID="'.$nid.'"';
		mysqli_query($mysqli,$sql) or die;
	}
		
		$sql='SELECT ID FROM imenik ORDER BY ID DESC LIMIT 1';
		$result=mysqli_query($mysqli,$sql) or die;
		$row=$result->fetch_assoc();
		$cid=$row['ID'];
		
		$xid=$cid;
}
$sql='SHOW TABLE STATUS WHERE name = "imenik"';
$result=mysqli_query($mysqli,$sql) or die;
$row=$result->fetch_assoc();
$ai=$row['Auto_increment'];

if (empty($_POST)) $xid=$ai;

?>
<html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">HIS baza - unos izviđača</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/calendarDateInput.js">

/***********************************************************************
* Jason's Date Input Calendar- By Jason Moon http://www.jasonmoon.net/ *
* Script featured on and available at http://www.dynamicdrive.com      *
* Keep this notice intact for use.                                     *
***********************************************************************/

</script>

<style type="text/css">
#desnakolona .iur .iul {
	width:200px;
}
</style>
<meta name="robots" content="noindex">
</head>
<body<?php
if (isset($del)) echo ' onload="novo()"';
elseif (isset($cid)) echo ' onload="izmena('.$nid.')"';
?>>
<form id="forma" action="#" method="POST">
<?php include 'topbar.php'; ?>

<div style="width:200px;top:27px;position:absolute;left:0;bottom:0;background:#fff;opacity:0.6">
</div>
	<div style="position:absolute;top:32px;left:5px;width:190px">
		<input id="unosbtn" type="submit" value="Unesi" style="width:100%;height:20px" />
		<input type="button" value="Novi izviđač" style="width:100%;margin-top:5px" onclick="novo()"/>
		<input type="button" value="Obriši" style="width:100%" onclick="delform()"/>
		<div style="width:100%;border-bottom:1px solid #000;margin-bottom:5px"></div>
		<div id="blacklink" style="font-size:12;overflow:auto">
<?php
$sql='SELECT zaodred FROM users WHERE users.username="'.$user.'"';
$result=mysqli_query($mysqli,$sql) or die;
$row=$result->fetch_assoc();
$oid=$row['zaodred'];

$odredx="";
$sql='SELECT `imenik`.`ID` AS ida,  `imenik`.`ime` ,  `imenik`.`prezime` ,  `odredi`.`ime` AS odred, IF(  `clanarine` LIKE  "2014%", 1, 2 ) AS clanarina
FROM imenik
LEFT JOIN odredi ON imenik.odred = odredi.ID ';
if ($level<3) $sql.='WHERE imenik.odred = "'.$oid.'" ';
$sql.='ORDER BY  `imenik`.`odred` ,  `clanarina` ,  `imenik`.`prezime` ,  `imenik`.`ime`';
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {

foreach($row as $xx => $yy) {
	$$xx=$yy;
}
if ($odred!=$odredx) {
	echo '<div style="padding-left:10px;font-weight:bold">'.$odred.'</div>';
	$odredx=$odred;
}
echo '<a href="#" onclick="izmena('.$ida.')"';
if ($clanarina==2) echo ' style="color:#777"';
echo '>'.$prezime.' '.$ime.'</a><br/>';
}
?>
		</div>
	</div>
<div style="width:180px;top:27px;left:210px;position:absolute;bottom:0;background:#fff;opacity:0.5">
</div>
<div style="width:215px;top:27px;left:560px;position:absolute;bottom:0;background:#fff;opacity:0.5">
</div>
<div class="wrap" style="position:absolute;top:32px;left:220px;width:800px">
	<div class="iur">
		<div class="iul">ime</div>
		<input id="yime" type="text" name="ime" class="iud" autofocus/>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">prezime</div>
		<input id="yprezime" type="text" name="prezime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum rođenja</div>
		<input id="ydatrod" type="text" name="datrod" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mesto rođenja</div>
		<input id="ymestorod" type="text" name="mestorod" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">adresa</div>
		<input id="yadresa" type="text" name="adresa" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">poštanski broj</div>
		<input id="ypobroj" type="text" name="pobroj" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mesto prebivanja</div>
		<input id="ymestoziv" type="text" name="mestoziv" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">fiksni telefon</div>
		<input id="ytelefon" type="text" name="telefon" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mobilni telefon</div>
		<input id="ymobilni" type="text" name="mobilni" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">e-mail</div>
		<input id="yemail" type="text" name="email" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">krvna grupa</div>
		<input id="ykrvna" type="text" name="krvna" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">plivač</div>
		<div class="iud">
			<input type="radio" name="plivac" value="da" style="width:20px;margin-left:30px"> da / ne
			<input type="radio" name="plivac" value="ne" style="width:20px" checked="checked">
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">vegan</div>
		<div class="iud">
			<input type="radio" name="vegan" value="da" style="width:20px;margin-left:30px"> da / ne
			<input type="radio" name="vegan" value="ne" style="width:20px" checked="checked">
		</div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">alergije</div>
		<textarea id="yalergije" style="width:153px" name="alergije" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">hronične bolesti</div>
		<textarea id="yhronicnebol" style="width:153px" name="hronicnebol" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">lekovi</div>
		<textarea id="ylekovi" style="width:153px" name="lekovi" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">ostale informacije</div>
		<textarea id="yostaleinfo" style="width:153px" name="ostaleinfo" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur" style="margin-top:1px">
		<div class="iul">datum primanja</div>
		<input id="ydatprim" type="text" name="datprim" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum isključenja</div>
		<input id="ydatisk" type="text" name="datisk" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">odred</div>
		<select id="yodred" name="odred" class="iud" style="width:153px">
<?php
if ($level<3) $sql='SELECT ID, ime FROM odredi WHERE ID="'.$oid.'" ORDER BY ime';
	else {
		echo '<option></option>';
		$sql='SELECT ID, ime FROM odredi ORDER BY ime';
	}
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {
$ID=$row['ID'];
$ime=$row['ime'];
			echo '<option value="'.$ID.'">'.$ime.'</option>';
}
?>
		</select>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="text-align:left"><b>Informacije o ocu</b></div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">ime</div>
		<input id="yotime" type="text" name="otime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">prezime</div>
		<input id="yotprezime" type="text" name="otprezime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">telefon u toku dana</div>
		<input id="yotteldan" type="text" name="otteldan" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">telefon u toku noći</div>
		<input id="yottelnoc" type="text" name="ottelnoc" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">adresa</div>
		<input id="yotadresa" type="text" name="otadresa" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mobilni telefon</div>
		<input id="yotmobilni" type="text" name="otmobilni" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">e-mail</div>
		<input id="yotemail" type="text" name="otemail" class="iud" />
		<div style="clear:both;"></div>
	</div>
</div>
<div class="wrap" id="desnakolona" style="position:absolute;top:32px;left:570px;width:400px">
	<div class="iur">
		<div class="iul" style="text-align:left"><b>Informacije o majci</b></div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">ime</div>
		<input id="ymaime" type="text" name="maime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">prezime</div>
		<input id="ymaprezime" type="text" name="maprezime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">telefon u toku dana</div>
		<input id="ymateldan" type="text" name="mateldan" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">telefon u toku noći</div>
		<input id="ymatelnoc" type="text" name="matelnoc" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">adresa</div>
		<input id="ymaadresa" type="text" name="maadresa" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mobilni telefon</div>
		<input id="ymamobilni" type="text" name="mamobilni" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">e-mail</div>
		<input id="ymaemail" type="text" name="maemail" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="text-align:left"><b>Kontakt u slučaju nesreće</b></div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">ime i prezime</div>
		<input id="ynesime" type="text" name="nesime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">adresa</div>
		<input id="ynesadr" type="text" name="nesadr" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">telefon</div>
		<input id="ynestel" type="text" name="nestel" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">funkcije u odredu</div>
		<select id="yfunkcije" multiple="multiple" name="funkcije[]" class="iud" style="width:153px;height:50px" title="Da bi izabrali više funkcija, držite SHIFT ili CTRL, a ukoliko želite da obrišete nešto, držite CTRL i kliknite na polje koje želite da obrišete" >
			<option value="1">vođa</option>
			<option value="2">zamenik</option>
			<option value="3">blagajnik</option>
			<option value="4">sekretar</option>
			<option value="5">ekonom</option>
		</select>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul"><b>činovi:</b>
			<select name="cinovis" id="cinovis" style="width:152px;margin-left:3px">
				<option>Prijatelj</option>
				<option>Pratilac</option>
				<option>Istraživač</option>
				<option>Vodič</option>
				<option>Vodnik</option>
				<option>Stariji vodnik</option>
			</select><br/>
			<script>DateInput('cinovidat', true, 'DD/MM/YYYY')</script>
			<input type="button" value=">>" id="sendc" onclick="sendcx()" style="float:left;width:32px;margin-top:3px"/>
		</div>
		<textarea id="ycinovi" style="width:153px" rows="3" name="cinovi" class="iud" title="Spisak činova sa datumima"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul"><b>veštine:</b><select name="vestines" id="vestines" style="width:152px;margin-left:3px"><?php
$sql='SELECT naziv FROM vestine';
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {
	echo '<option>'.$row['naziv'].'</option>';
}

		?></select><br/><script>DateInput('vestinedat', true, 'DD/MM/YYYY')</script><input type="button" value=">>" id="sendv" onclick="sendvx()" style="float:left;width:32px;margin-top:3px"/></div>
		<textarea id="yvestine" style="width:153px" rows="3" name="vestine" class="iud" title="Spisak veština sa datumima"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">članarine</div>
		<select id="yclanarine" multiple="multiple" name="clanarine[]" class="iud" style="width:153px;height:50px" title="Da bi izabrali više funkcija, držite SHIFT ili CTRL, a ukoliko želite da obrišete nešto, držite CTRL i kliknite na polje koje želite da obrišete">
<?php
$godina=date('Y');
for ($i = $godina; $i >= 2010; $i--) {
    		echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
		</select>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000;padding-bottom:34px">komentar</div>
		<textarea id="ykomentar" style="width:153px" rows="3" name="komentar" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div>
		<div class="iul" style="text-align:center;border-bottom:solid thin #000;padding-bottom:8px">
			<input type="hidden" name="nextid" id="nextid" value="<?php echo $ai; ?>" />
			<input type="hidden" name="nid" id="nid" value="<?php echo $xid; ?>" />
			<div ID="blacklink"><a href="#" onclick="change_pic()" title="Ukoliko ste promenili sliku, da bi videli novu, pritisnite 'CTRL+F5' ili 'SHIFT+F5'"><b>- Osveži sliku -</b></a></div>
			<a id="linkzasliku" href="uploader.php?tip=1&ID=<?php echo $xid; ?>" target="_blank"><img ID="imager" src="<?php
$timestamp=time();
$filename = 'upload_pic/T_1_'.$ai.'.jpg?timestamp='.$timestamp;

if (file_exists($filename)) {
    echo 'upload_pic/T_1_'.$ai.'.jpg?timestamp='.$timestamp;
} else {
    echo "images/nepoznat.gif";
}
			
			?>" style="margin-top:5px;border:4px ridge #fff;width:100px;height:100px" title="Klikni na sliku da je uneseš ili promeniš"/></a>
		</div>
	</div>
</div>
<script type="text/javascript">
var vwidth;
var vheight;
if (typeof window.innerWidth != 'undefined')
{
	vwidth = window.innerWidth,
	vheight = window.innerHeight
}
if (vheight < 400)
{
document.getElementById("blacklink").style.height=400;
} 
else
{
document.getElementById("blacklink").style.height=vheight-118;
}
function delform()
{
var r=confirm("Da li sigurno želite da obrišete izviđača iz baze?");
if (r==true)
  {
	document.getElementById("delform").submit();
  }
}
function sendvx()
	{
		var vestinedat=document.getElementById("vestinedat").value;
		vestinedat=vestinedat.replace("/",".");
		vestinedat=vestinedat.replace("/",".");
		var vestines=document.getElementById("vestines").value;
		var yvestine=document.getElementById("yvestine").value;
		if (yvestine=="") document.getElementById("yvestine").value=vestines+', '+vestinedat+'.';
			else document.getElementById("yvestine").value=yvestine+'; '+vestines+', '+vestinedat+'.';
		
	}
function sendcx()
	{
		var cinovidat=document.getElementById("cinovidat").value;
		cinovidat=cinovidat.replace("/",".");
		cinovidat=cinovidat.replace("/",".");
		var cinovis=document.getElementById("cinovis").value;
		var ycinovi=document.getElementById("ycinovi").value;
		if (ycinovi=="") document.getElementById("ycinovi").value=cinovis+', '+cinovidat+'.';
			else document.getElementById("ycinovi").value=ycinovi+'; '+cinovis+', '+cinovidat+'.';
		
	}
function change_pic()
	{
		var newsrc=document.getElementById("nid").value;
		document.getElementById("imager").src="upload_pic/T_1_"+newsrc+".jpg?timestamp=" + new Date().getTime();
	}
function novo()
	{
		document.getElementById("forma").reset();
		$("#unosbtn").prop('value', 'Unesi');
		var ai=document.getElementById("nextid").value
		document.getElementById("nid").value=ai;
		document.getElementById("linkzasliku").href="uploader.php?tip=1&ID="+ai;
		document.getElementById("imager").src="images/nepoznat.gif";
		selObject=document.getElementById("yfunkcije"); 
		$('#yfunkcije').val([0]);
		$('#yclanarine').val([0]);
	}
function izmena(posebno)
	{
		d = new Date();
		$('#yfunkcije').val([0]);
		$('#yclanarine').val([0]);
		$("#unosbtn").prop('value', 'Promeni');
		document.getElementById("forma").reset();
		document.getElementById("nid").value=posebno;
		document.getElementById("del").value=posebno;
		$.ajax({
			url:'upload_pic/T_1_'+posebno+'.jpg?timestamp='+d.getTime(),
			type:'HEAD',
			error: function()
			{
				$("#imager").attr("src","images/nepoznat.gif");
			},
			success: function()
			{
				$("#imager").attr("src","upload_pic/T_1_"+posebno+".jpg?timestamp="+d.getTime());
			}
		});
		document.getElementById("linkzasliku").href="uploader.php?tip=1&ID="+posebno;
		$.getJSON('ajax/iimenik.php', {posebno: posebno}, function(data) {
			$('#yime').val(data.yime);
			$('#yprezime').val(data.yprezime);
			$('#ydatrod').val(data.ydatrod);
			$('#ymestorod').val(data.ymestorod);
			$('#yadresa').val(data.yadresa);
			$('#ypobroj').val(data.ypobroj);
			$('#ymestoziv').val(data.ymestoziv);
			$('#ytelefon').val(data.ytelefon);
			$('#ymobilni').val(data.ymobilni);
			$('#yemail').val(data.yemail);
			$('#ykrvna').val(data.ykrvna);
			var yplivac=(data.yplivac);
			var yvegan=(data.yvegan);
			$(':radio[name="plivac"][value='+yplivac+']').prop('checked', true);
			$(':radio[name="vegan"][value='+yvegan+']').prop('checked', true);
			$('#yalergije').val(data.yalergije);
			$('#yhronicnebol').val(data.yhronicnebol);
			$('#ylekovi').val(data.ylekovi);
			$('#yostaleinfo').val(data.yostaleinfo);
			$('#ydatprim').val(data.ydatprim);
			$('#ydatisk').val(data.ydatisk);
			$('#yodred').val(data.yodred);
			$('#yotime').val(data.yotime);
			$('#yotprezime').val(data.yotprezime);
			$('#yotteldan').val(data.yotteldan);
			$('#yottelnoc').val(data.yottelnoc);
			$('#yotadresa').val(data.yotadresa);
			$('#yotmobilni').val(data.yotmobilni);
			$('#yotemail').val(data.yotemail);
			$('#ymaime').val(data.ymaime);
			$('#ymaprezime').val(data.ymaprezime);
			$('#ymateldan').val(data.ymateldan);
			$('#ymatelnoc').val(data.ymatelnoc);
			$('#ymaadresa').val(data.ymaadresa);
			$('#ymamobilni').val(data.ymamobilni);
			$('#ymaemail').val(data.ymaemail);
			$('#ynesime').val(data.ynesime);
			$('#ynesadr').val(data.ynesadr);
			$('#ynestel').val(data.ynestel);
			$('#yfunkcije').val(data.yfunkcije);
			$('#ycinovi').val(data.ycinovi);
			$('#yvestine').val(data.yvestine);
			$('#yclanarine').val(data.yclanarine);
			$('#ykomentar').val(data.ykomentar);
		});
	}
</script>
</form>
<form id="delform" action="#" method="post">
<input type="hidden" id="del" name="del" />
</form>
</body>
</html>