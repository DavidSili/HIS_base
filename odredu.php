<?php
	session_start();
	$uri=$_SERVER['REQUEST_URI'];
	$pos = strrpos($uri, "/");
	$url = substr($uri, $pos+1);
	if ($_SESSION['loggedin'] != 1 OR $_SESSION['level'] < 3 ) {
		header("Location: login.php?url=$url");
		exit;
	}
	else {
	include 'config.php';
	$level=$_SESSION['level'];
	$user=$_SESSION['user'];
	}

	
if(isset($_POST) && !empty($_POST)) {
	foreach($_POST as $xx => $yy) {
		$$xx=$mysqli->real_escape_string($yy);
	}
	if (empty($datosn)==false) {
	$datosnx=date('Y-m-d',strtotime($datosn));
	$datosn='"'.$datosnx.'"';
	}
		else $datosn='NULL';
	if (empty($datrasp)==false) {
	$datraspx=date('Y-m-d',strtotime($datrasp));
	$datrasp='"'.$datraspx.'"';
	}
		else $datrasp='NULL';
	$dattime=date('G:i:s j.n.Y.');
	
	if (isset($_POST['del'])) {
		$del=$mysqli->real_escape_string($_POST['del']);
		$nid=$del;
		$sql='DELETE FROM odredi WHERE ID="'.$del.'"';
		mysqli_query($mysqli,$sql) or die;
	}
	elseif ($nid==$nextid) {
		$sql='INSERT INTO odredi (ime, mesto, adresa, datosn, datrasp, stranica, uneo) VALUES ("'.$ime.'","'.$mesto.'","'.$adresa.'",'.$datosn.','.$datrasp.',"'.$stranica.'","'.$user.' - '.$dattime.'")';
		mysqli_query($mysqli,$sql) or die;
	}
	else {
		$sql='SELECT menjali FROM odredi WHERE ID="'.$nid.'"';
		$result=mysqli_query($mysqli,$sql);
		$row=$result->fetch_assoc();
		$xmenjali=$row['menjali'];
		
		$sql='UPDATE odredi SET ime="'.$ime.'", mesto="'.$mesto.'", adresa="'.$adresa.'", datosn='.$datosn.', datrasp='.$datrasp.', stranica="'.$stranica.'", menjali="'.$xmenjali.'; '.$user.' - '.$dattime.'" WHERE ID="'.$nid.'"';
		mysqli_query($mysqli,$sql) or die;
	}
		
		$sql='SELECT ID FROM odredi ORDER BY ID DESC LIMIT 1';
		$result=mysqli_query($mysqli,$sql) or die;
		$row=$result->fetch_assoc();
		$cid=$row['ID'];
		
		$xid=$cid;
}
$sql='SHOW TABLE STATUS WHERE name = "odredi"';
$result=mysqli_query($mysqli,$sql);
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
<title id="Timerhead">HIS baza - unos odreda</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<style type="text/css">
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
		<input type="button" value="Novi odred" style="width:100%;margin-top:5px" onclick="novo()"/>
		<input type="button" value="Obriši" style="width:100%" onclick="delform()"/>
		<div style="width:100%;border-bottom:1px solid #000;margin-bottom:5px"></div>
		<div id="blacklink" style="font-size:12;overflow:auto">
<?php
$sql="SELECT `ID`,`ime`,`datosn`, IF (`datrasp` IS NULL,1,2) AS rasp FROM odredi ORDER BY `rasp`,`datosn` ASC";
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {

foreach($row as $xx => $yy) {
	$$xx=$yy;
}
echo '<a href="#" onclick="izmena('.$ID.')">'.$ime.'</a><br/>';
}
?>
		</div>
	</div>
<div style="width:180px;top:27px;left:210px;position:absolute;bottom:0;background:#fff;opacity:0.5">
</div>
<div class="wrap" style="position:absolute;top:32px;left:220px;width:100%">
	<div class="iur">
		<div class="iul">ime odreda</div>
		<input id="yime" type="text" name="ime" class="iud" autofocus/>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mesto</div>
		<input id="ymesto" type="text" name="mesto" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">adresa</div>
		<input id="yadresa" type="text" name="adresa" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum osnivanja</div>
		<input id="ydatosn" type="text" name="datosn" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum raspuštanja</div>
		<input id="ydatrasp" type="text" name="datrasp" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">internet prezentacija</div>
		<input id="ystranica" type="text" name="stranica" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div>
		<div class="iul" style="text-align:center;border-bottom:solid thin #000;padding-bottom:8px">
			<input type="hidden" name="nextid" id="nextid" value="<?php echo $ai; ?>" />
			<input type="hidden" name="nid" id="nid" value="<?php echo $xid; ?>" />
			<div ID="blacklink"><a href="#" onclick="change_pic()" title="Ukoliko ste promenili sliku, da bi videli novu, pritisnite 'CTRL+F5' ili 'SHIFT+F5'"><b>- Osveži sliku -</b></a></div>
			<a id="linkzasliku" href="uploader.php?tip=2&ID=<?php echo $xid; ?>" target="_blank"><img ID="imager" src="<?php
$timestamp=time();
$filename = 'upload_pic/T_2_'.$ai.'.jpg?timestamp='.$timestamp;

if (file_exists($filename)) {
    echo 'upload_pic/T_2_'.$ai.'.jpg?timestamp='.$timestamp;
} else {
    echo "images/nepoznato.jpg";
}
			
			?>" style="margin-top:5px;border:4px ridge #fff;width:100px;height:100px" title="Klikni na sliku da je uneseš ili promeniš"/></a>
		</div>
	</div>
</div>
<script type="text/javascript">
function delform()
{
var r=confirm("Da li sigurno želite da obrišete odred iz baze?");
if (r==true)
  {
	document.getElementById("delform").submit();
  }
}
function change_pic()
	{
		var newsrc=document.getElementById("nid").value;
		document.getElementById("imager").src="upload_pic/T_2_"+newsrc+".jpg?timestamp=" + new Date().getTime();
	}
function novo()
	{
		document.getElementById("forma").reset();
		$("#unosbtn").prop('value', 'Unesi');
		var ai=document.getElementById("nextid").value
		document.getElementById("nid").value=ai;
		document.getElementById("linkzasliku").href="uploader.php?tip=2&ID="+ai;
		document.getElementById("imager").src="images/nepoznato.jpg";
		selObject=document.getElementById("yfunkcije"); 
	}
function izmena(posebno)
	{
		d = new Date();
		$("#unosbtn").prop('value', 'Promeni');
		document.getElementById("forma").reset();
		document.getElementById("nid").value=posebno;
		document.getElementById("del").value=posebno;
		$.ajax({
			url:'upload_pic/T_2_'+posebno+'.jpg?timestamp='+d.getTime(),
			type:'HEAD',
			error: function()
			{
				$("#imager").attr("src","images/nepoznato.jpg");
			},
			success: function()
			{
				$("#imager").attr("src","upload_pic/T_2_"+posebno+".jpg?timestamp="+d.getTime());
			}
		});
		document.getElementById("linkzasliku").href="uploader.php?tip=2&ID="+posebno;
		$.getJSON('ajax/iodredi.php', {posebno: posebno}, function(data) {
			$('#yime').val(data.yime);
			$('#ymesto').val(data.ymesto);
			$('#yadresa').val(data.yadresa);
			$('#ydatosn').val(data.ydatosn);
			$('#ydatrasp').val(data.ydatrasp);
			$('#ystranica').val(data.ystranica);
		});
	}
</script>
</form>
<form id="delform" action="#" method="post">
<input type="hidden" id="del" name="del" />
</form>
</body>
</html>