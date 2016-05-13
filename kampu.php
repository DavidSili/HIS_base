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
		$$xx=$yy;
	}
	
	if (empty($datpoc)==false) {
	$datpocx=date('Y-m-d',strtotime($datpoc));
	$datpoc='"'.$datpocx.'"';
	}
		else $datpoc='NULL';
	if (empty($datkraj)==false) {
	$datkrajx=date('Y-m-d',strtotime($datkraj));
	$datkraj='"'.$datkrajx.'"';
	}
		else $datkraj='NULL';
		
	$dattime=date('G:i:s j.n.Y.');
	$funkcije="";
	if (isset($staresina)) $funkcije.=$staresina.',';
	else $funkcije.=',';
	if (isset($zamenik)) $funkcije.=$zamenik.',';
	else $funkcije.=',';
	if (isset($blagajnik)) $funkcije.=$blagajnik.',';
	else $funkcije.=',';
	if (isset($sekretar)) $funkcije.=$sekretar.',';
	else $funkcije.=',';
	if (isset($pastor)) $funkcije.=$pastor.',';
	else $funkcije.=',';
	if (isset($bezbednost)) $funkcije.=$bezbednost.',';
	else $funkcije.=',';
	if (isset($medicinska)) $funkcije.=$medicinska.',';
	else $funkcije.=',';
	if (isset($impedant)) $funkcije.=$impedant;
	
	if (isset($sorterklik1)) {if ($sorterklik2=="") $sorterklik=$sorterklik1;
	else {
		$sorterklik=$sorterklik1.';'.$sorterklik2;
	}}
	
	if (isset($_POST['del'])) {
		$del=$_POST['del'];
		$nid=$del;
		$sql='DELETE FROM kampovi WHERE ID="'.$del.'"';
		mysqli_query($mysqli,$sql) or die;
	}
	elseif ($nid==$nextid) {
		$sql='INSERT INTO kampovi (naziv, datpoc, datkraj, mesto, drzava, tip, organizator, funkcije, komentar, prisutni, uneo) VALUES ("'.$naziv.'",'.$datpoc.','.$datkraj.',"'.$mesto.'","'.$drzava.'","'.$tip.'","'.$organizator.'","'.$funkcije.'","'.$komentar.'","'.$sorterklik.'", "'.$user.' - '.$dattime.'")';
		mysqli_query($mysqli,$sql) or die;
	}
	else {
		$sql='SELECT menjali FROM kampovi WHERE ID="'.$nid.'"';
		$result=mysqli_query($mysqli,$sql) or die;
		$row=$result->fetch_assoc();
		$xmenjali=$row['menjali'];
		
		$sql='UPDATE kampovi SET `naziv`="'.$naziv.'",`datpoc`='.$datpoc.',`datkraj`='.$datkraj.',`mesto`="'.$mesto.'",`drzava`="'.$drzava.'",`tip`="'.$tip.'",`organizator`="'.$organizator.'",`funkcije`="'.$funkcije.'",`komentar`="'.$komentar.'",`prisutni`="'.$sorterklik.'",`menjali`="'.$xmenjali.'; '.$user.' - '.$dattime.'" WHERE ID="'.$nid.'"';
		mysqli_query($mysqli,$sql) or die;
	}
		
		$sql='SELECT ID FROM kampovi ORDER BY ID DESC LIMIT 1';
		$result=mysqli_query($mysqli,$sql) or die;
		$row=$result->fetch_assoc();
		$cid=$row['ID'];
		
		$xid=$cid;
}
$sql='SHOW TABLE STATUS WHERE name = "kampovi"';
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
<title id="Timerhead">HIS baza - unos kampova</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<link type='text/css' rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<style type="text/css">
#sortable1, #sortable2, #sortables {
	list-style-type: none;
	margin: 0;
	padding: 2px;
	float: left;
	margin-right: 10px;
	height:531px;
	overflow:auto;
	width:230px;
	border:2px ridge #000;
}
#sortable1 li, #sortable2 li, #sortables li{
	margin: 2px;
	padding: 0 0 0 3px;
	font-size: 1em;
}
</style>
<meta name="robots" content="noindex">
</head>
<body<?php
if (isset($del)) echo ' onload="novo()"';
elseif (isset($cid)) echo ' onload="izmena('.$nid.')"';
else echo ' onload="praznalista()"';
?>>
<form id="forma" action="#" method="POST">
<?php include 'topbar.php'; ?>

<div style="width:200px;top:27px;position:absolute;left:0;bottom:0;background:#fff;opacity:0.6">
</div>
	<div style="position:absolute;top:32px;left:5px;width:190px">
		<input id="unosbtn" type="submit" value="Unesi" style="width:100%;height:20px" />
		<input type="button" value="Novi kamp" style="width:100%;margin-top:5px" onclick="novo()"/>
		<input type="button" value="Obriši" style="width:100%" onclick="delform()"/>
		<div style="width:100%;border-bottom:1px solid #000;margin-bottom:5px"></div>
		<div id="blacklink" style="font-size:12;overflow:auto">
<?php
$odredx="";
$sql="SELECT ID,naziv FROM kampovi ORDER BY datpoc";
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {

foreach($row as $xx => $yy) {
	$$xx=$yy;
}
echo '<a href="#" onclick="izmena('.$ID.')">'.$naziv.'</a><br/>';
}
?>
		</div>
	</div>
<div style="width:180px;top:27px;left:210px;position:absolute;bottom:0;background:#fff;opacity:0.5">
</div>
<div id="desnapoz" style="width:504px;top:27px;left:560px;position:absolute;bottom:0;background:#fff;opacity:0.5">
</div>
<div class="wrap" style="position:absolute;top:32px;left:220px;width:800px">
	<div class="iur">
		<div class="iul">naziv</div>
		<input id="ynaziv" type="text" name="naziv" class="iud" autofocus/>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum početka</div>
		<input id="ydatpoc" type="text" name="datpoc" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">datum završetka</div>
		<input id="ydatkraj" type="text" name="datkraj" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">mesto</div>
		<input id="ymesto" type="text" name="mesto" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">država</div>
		<input id="ydrzava" type="text" name="drzava" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">tip</div>
		<input id="ytip" type="text" name="tip" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">organizator</div>
		<input id="yorganizator" type="text" name="organizator" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="text-align:left"><b>Funkcije</b></div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">starešina kampa</div>
		<input id="ystaresina" type="text" name="staresina" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">zamenik starešine</div>
		<input id="yzamenik" type="text" name="zamenik" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">blagajnik</div>
		<input id="yblagajnik" type="text" name="blagajnik" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">sekretar</div>
		<input id="sekretar" type="text" name="sekretar" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">pastor</div>
		<input id="ypastor" type="text" name="pastor" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">bezbednost</div>
		<input id="ybezbednost" type="text" name="bezbednost" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">medicinska sestra</div>
		<input id="ymedicinska" type="text" name="medicinska" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul" style="border-bottom:solid thin #000">impedant</div>
		<input id="yimpedant" type="text" name="impedant" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">komentar</div>
		<textarea id="ykomentar" style="width:153px" rows="6" name="komentar" class="iud"></textarea>
		<div style="clear:both;"></div>
	</div>
	<div>
		<div class="iul" style="text-align:center;border-bottom:solid thin #000;border-top:solid thin #000;padding-bottom:8px">
			<input type="hidden" name="nextid" id="nextid" value="<?php echo $ai; ?>" />
			<input type="hidden" name="nid" id="nid" value="<?php echo $xid; ?>" />
			<div ID="blacklink"><a href="#" onclick="change_pic()" title="Ukoliko ste promenili sliku, da bi videli novu, pritisnite 'CTRL+F5' ili 'SHIFT+F5'"><b>- Osveži sliku -</b></a></div>
			<a id="linkzasliku" href="uploader.php?tip=3&ID=<?php echo $xid; ?>" target="_blank"><img ID="imager" src="<?php
$timestamp=time();
$filename = 'upload_pic/T_3_'.$ai.'.jpg?timestamp='.$timestamp;
if (file_exists($filename)) {
    echo 'upload_pic/T_3_'.$ai.'.jpg?timestamp='.$timestamp;
} else {
    echo "images/nepoznato.jpg";
}
			
			?>" style="margin-top:5px;border:4px ridge #fff;width:100px;height:100px" title="Klikni na sliku da je uneseš ili promeniš"/></a>
		</div>
	</div>
</div>
<div id="swapwrap" class="wrap" style="position:absolute;top:33px;left:565px;width:496px">
	<div id="naslovl" style="width:226px;float:left;font-weight:bold">Prisutni</div><div id="naslovs" style="width:226px;text-align:left;float:left;display:none;font-weight:bold">Očekivani</div><div style="width:226px;float:left;font-weight:bold">Ostali izviđači</div><br/>
	<div id="swapwrap2" style="width:496px;height:536px;padding-bottom:10px;border-bottom:solid thin #000" onmouseup="sorter1()" onmouseout="sorter1()">

		<ul id="sortable1" class="connectedSortable">
		</ul>
		 
		<ul id="sortables" class="connectedSortable" style="display:none">
		</ul>
		 
		<ul id="sortable2" class="connectedSortable" style="margin-right:0">
		</ul>

		<input type="hidden" name="sorterklik1" id="sorterklik1" />
		<input type="hidden" name="sorterklik2" id="sorterklik2" />
	</div>
	<div style="height:26px;width:100%;border-bottom:solid thin #000">
		<div id="ukbox1" style="float:left;padding:5px;width:215px;font-weight:bold;font-size:14">
			<span id="ukupno1">Prisustvovalo: </span><span id="ukupno1b">0</span>
		</div>
		<div id="ukbox2" style="float:left;padding:5px;width:215px;font-weight:bold;font-size:14;display:none">
			<span id="ukupno2">Nije platilo: </span><span id="ukupno2b">0</span>
		</div>
	</div>
</div>
<script type="text/javascript">
function delform()
{
var r=confirm("Da li sigurno želite da obrišete kamp iz baze?");
if (r==true)
  {
	document.getElementById("delform").submit();
  }
}
$(function()
	{
		$( "#sortable1, #sortable2, #sortables" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
	});
function sorter1()
	{
		var sortedIDs = $( "#sortable1" ).sortable( "toArray" );
		document.getElementById("sorterklik1").value=sortedIDs;
		var sortedIDs = $( "#sortables" ).sortable( "toArray" );
		document.getElementById("sorterklik2").value=sortedIDs;
		var asize=$("#sortable1 li").size();
		$("#ukupno1b").html(asize);
		var asize=$("#sortables li").size();
		$("#ukupno2b").html(asize);
	}
function change_pic()
	{
		var newsrc=document.getElementById("nid").value;
		document.getElementById("imager").src="upload_pic/T_3_"+newsrc+".jpg?timestamp=" + new Date().getTime();
	}
function novo()
	{
		document.getElementById("forma").reset();
		$("#unosbtn").prop('value', 'Unesi');
		var ai=document.getElementById("nextid").value
		document.getElementById("nid").value=ai;
		document.getElementById("linkzasliku").href="uploader.php?tip=3&ID="+ai;
		document.getElementById("imager").src="images/nepoznato.jpg";
		selObject=document.getElementById("yfunkcije"); 
		praznalista();
		document.getElementById("sortable1").innerHTML="";
		document.getElementById("sortables").innerHTML="";
		$('#desnapoz').css('width','504px');
		$('#swapwrap').css('width','496px');
		$('#swapwrap2').css('width','496px');
		$('#naslovl').html('Prisutni');
		$('#naslovs').css('display','none');
		$('#sortables').css('display','none');
		$('#ukupno1').html('Prisustvovalo: ');
		$('#ukbox2').css('display','none');
	}
function praznalista()
	{
		$.getJSON('ajax/isvi.php', {posebno: "1"}, function(data) {
			$('#sortable2').html(data.yprisutni2);
		});
	}
function izmena(posebno)
	{
		d = new Date();
		$("#unosbtn").prop('value', 'Promeni');
		document.getElementById("forma").reset();
		document.getElementById("nid").value=posebno;
		document.getElementById("del").value=posebno;
		$.ajax({
			url:'upload_pic/T_3_'+posebno+'.jpg?timestamp='+d.getTime(),
			type:'HEAD',
			error: function()
			{
				$("#imager").attr("src","images/nepoznato.jpg");
			},
			success: function()
			{
				$("#imager").attr("src","upload_pic/T_3_"+posebno+".jpg?timestamp="+d.getTime());
			}
		});
		document.getElementById("linkzasliku").href="uploader.php?tip=3&ID="+posebno;
		$.getJSON('ajax/ikampovi.php', {posebno: posebno}, function(data) {
			$('#ynaziv').val(data.ynaziv);
			$('#ydatpoc').val(data.ydatpoc);
			$('#ydatkraj').val(data.ydatkraj);
			$('#ymesto').val(data.ymesto);
			$('#ydrzava').val(data.ydrzava);
			$('#ytip').val(data.ytip);
			$('#yorganizator').val(data.yorganizator);
			$('#ystaresina').val(data.ystaresina);
			$('#yzamenik').val(data.yzamenik);
			$('#yblagajnik').val(data.yblagajnik);
			$('#ysekretar').val(data.ysekretar);
			$('#ypastor').val(data.ypastor);
			$('#ybezbednost').val(data.ybezbednost);
			$('#ymedicinska').val(data.ymedicinska);
			$('#yimpedant').val(data.yimpedant);
			$('#ykomentar').val(data.ykomentar);
			$('#sortable1').html(data.yprisutni1);
			$('#sortable2').html(data.yprisutni2);
			$('#sortables').html(data.yprisutnis);
			$("#ukupno1b").html('0');
			$("#ukupno2b").html('0');
			if (data.spec==1)
			{
				$('#desnapoz').css('width','504px');
				$('#swapwrap').css('width','496px');
				$('#swapwrap2').css('width','496px');
				$('#naslovl').html('Prisutni');
				$('#naslovs').css('display','none');
				$('#sortables').css('display','none');
				$('#ukupno1').html('Prisustvovalo: ');
				$('#ukbox2').css('display','none');
			}
			else
			{
				$('#desnapoz').css('width','750px');
				$('#swapwrap').css('width','744px');
				$('#swapwrap2').css('width','744px');
				$('#naslovl').html('Platili');
				$('#naslovs').css('display','inline');
				$('#sortables').css('display','inline');
				$('#ukupno1').html('Platilo: ');
				$('#ukbox2').css('display','inline');
			}
			var asize=$("#sortable1 li").size();
			$("#ukupno1b").html(asize);
			var asize=$("#sortables li").size();
			$("#ukupno2b").html(asize);
		});
	}
</script>
</form>
<form id="delform" action="#" method="post">
<input type="hidden" id="del" name="del" />
</form>
</body>
</html>