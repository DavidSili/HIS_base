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

	$dattime=date('G:i:s j.n.Y.');
	$naziv=$xx;
	$ID=substr($naziv, 5);
	$nalageru=$yy;
	$sql='SELECT menjali FROM predmeti WHERE ID="'.$ID.'"';
	$result=mysqli_query($mysqli,$sql);
	$row=$result->fetch_assoc();
	$xmenjali=$row['menjali'];
	
	$sql='UPDATE predmeti SET nalageru="'.$nalageru.'", menjali="'.$xmenjali.'; '.$user.' - '.$dattime.'" WHERE ID="'.$ID.'"';
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
<title id="Timerhead">HIS baza - pregled lagera</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
#ielement {
	width:600px;
	min-height:55px;
	padding:5px;
	float:none;
	margin:2px 5px;
}
.col1 {
	width:100px;
	text-align:center;
}
.col1 img {
	width:53px;
	height:53px;
	float:left;
	margin-right:6px;
	margin: 0;
}
.col2 {
	width:150px;
	float:left;
	margin:0 4px 0 2px;
}
.col2 input {
	width:90px;
	margin-left:3px;
}
.col3 {
	float:left;	
	width:388px;
	border-left:1px solid #000;
	min-height:53px;
	padding-left:2px;
}
.col3 img {
	float:left;
	height:16px;
	padding:0 1px;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<form name="forma" id="forma" method="POST" action="#"><?php include 'topbar.php'; ?>
<input type="submit" value="snimi izmene" style="position:absolute;top:1px;left:140px;width:150px;z-index:999999"/>
<div id="wrapper" style="margin-top:30px">
<?php
$tipx="";
$sql="SELECT * FROM predmeti ORDER BY tip, ID";
$result=mysqli_query($mysqli,$sql);
while($row=$result->fetch_assoc()) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
if ($tipx!=$tip) {
	echo '<div style="color:#fff;font-weight:bold;font-size:16;margin-left:30px;text-shadow: 2px 2px #333;
">'.$tip.'</div>';
	$tipx=$tip;
}

echo '<div id="ielement" class="ielement"><div class="col1">';
$filename='upload_pic/T_5_'.$ID.'.jpg';
if (file_exists($filename)) {
    echo '<a href="upload_pic/L_5_'.$ID.'.jpg" target="_blank" style="float:left"><img src="upload_pic/T_5_'.$ID.'.jpg" title="'.$opis.'"/></a>';
} else {
    echo '<img src="images/nepoznato.jpg" title="'.$opis.'" stlye="float:left;margin-right:6px"/>';
}
echo '</div><div class="col2"><div><b>Predmet:</b> '.$predmet.'</div><div><b>Na lageru:</b><input type="number" name="lager'.$ID.'" min="0" value="'.$nalageru.'" /></div>';

echo '</div><div class="col3">';
$zero=1;
if($nalageru==0) {
$zero=0;
$kol1=0;
$kol2=0;
$kol3=0;
$kol4=0;
}
elseif($nalageru<10) {
$kol1=$nalageru;
$kol2=0;
$kol3=0;
$kol4=0;
}
elseif($nalageru<100) {
$kol2=floor($nalageru/10);
$kol1=$nalageru-($kol2*10);
$kol3=0;
$kol4=0;
}
elseif($nalageru<1000) {
$kol3=floor($nalageru/100);
$kol2=floor(($nalageru-($kol3*100))/10);
$kol1=$nalageru-($kol2*10)-($kol3*100);
$kol4=0;
}
else{
$kol4=floor($nalageru/1000);
$kol3=floor(($nalageru-($kol4*1000))/100);
$kol2=floor(($nalageru-($kol4*1000)-($kol3*100))/10);
$kol1=$nalageru-($kol2*10)-($kol3*100)-($kol4*1000);
}
if ($zero==0) echo '<img src="images/no.jpg" style="width:53px;height:53px" title="nema na lageru"/>';
if ($kol4!=0) {
for ($i=1; $i<=$kol4; $i++)
	{
		echo '<img src="images/item1000.gif"/>';
	}
}
if ($kol3!=0) {
for ($i=1; $i<=$kol3; $i++)
	{
		echo '<img src="images/item100.gif"/>';
	}
}
if ($kol2!=0) {
for ($i=1; $i<=$kol2; $i++)
	{
		echo '<img src="images/item10.png"/>';
	}
}
if ($kol1!=0) {
for ($i=1; $i<=$kol1; $i++)
	{
		echo '<img src="images/item1.gif"/>';
	}
}
echo '</div></div>';

}

?>
</div>
<script type="text/javascript">
</script>
</form>
</body>
</html>