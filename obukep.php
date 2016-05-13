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
<title id="Timerhead">HIS baza - pregled obuka</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
#ielement {
	width:400px;
}
.fotoalbum img {
	float:left;
	width:50px;
	height:50px;
	padding:1px;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<?php include 'topbar.php'; ?>
<div id="wrapper" style="margin-top:28px">
<?php
$sql="SELECT * FROM obuke ORDER BY datpoc";
$result=mysqli_query($mysqli,$sql);
while($row=$result->fetch_assoc()) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
$sgod=date('y',strtotime($datpoc));
$datpoc=date('d.m.Y.',strtotime($datpoc));
$datkraj=date('d.m.Y.',strtotime($datkraj));


echo '<div id="ielement" class="ielement"><div style="overflow:hidden;padding-bottom:3px;margin-bottom:2px;border-bottom:1px solid #000"><div class="cols" style="width:100px;text-align:center"><span style="font-size:12;font-weight:bold">'.$mesto.' \''.$sgod.'</span>';
$filename='upload_pic/T_4_'.$ID.'.jpg';
if (file_exists($filename)) {
    echo '<a href="upload_pic/L_4_'.$ID.'.jpg" target="_blank" style="float:left;margin-right:6px;margin:2px 0"><img src="upload_pic/T_4_'.$ID.'.jpg" width="100" height="100" /></a>';
} else {
    echo '<img src="images/nepoznato.jpg" width="100" height="100" style="float:left;margin-right:6px;margin:2px 0" />';
}
echo '</div><div class="cols" style="width:135px"><div><b>Počeo:</b> '.$datpoc.'</div><div><b>Završio:</b> '.$datkraj.'</div><div><b>Mesto:</b> '.$mesto.'</div><div><b>Država:</b> '.$drzava.'</div>';
echo '<div><b>Tip obuke:</b> '.$tip.'</div>';
echo '</div><div class="cols" style="width:150px;margin-right:0">';
echo '<div><b>Instruktori:</b> '.$instruktori.'</div>';
if ($komentar!=="") echo '<div><b>Komentar:</b> '.$komentar.'</div>';
echo '</div></div><div style="width:400px"><div style="float:left;width:120px;max-height:300px;overflow-y:auto"><b>';
if (strtotime($datpoc)>time()) echo 'Očekivani';
else echo 'Prisutni';
echo ':<br/></b>';
$prisutni=explode(';',$prisutni);
$prisutni[0]=explode(',',$prisutni[0]);
if (isset($prisutni[1])) $prisutni[1]=explode(',',$prisutni[1]);
$sql2="SELECT imenik.ID idi, imenik.ime ime, imenik.prezime prezime, imenik.datrod datum, odredi.ime odred FROM imenik, odredi WHERE imenik.odred=odredi.ID ORDER BY prezime,ime ASC";
$result2=mysqli_query($mysqli,$sql2) or die;
while ($row2=$result->fetch_assoc()) {
	$idi=$row2['idi'];
	$prezime=$row2['prezime'];
	$ime=$row2['ime'];
	if (in_array($idi, $prisutni[0])) echo $prezime.' '.$ime.'<br/>';
	if (isset($prisutni[1]) AND in_array($idi, $prisutni[1])) echo $prezime.' '.$ime.'<br/>';
	
}
$prisutni1="";
$prisutni2="";
$sql3="SELECT imenik.ID idi, imenik.ime ime, imenik.prezime prezime, imenik.datrod datum, odredi.ime odred FROM imenik, odredi WHERE imenik.odred=odredi.ID ORDER BY RAND()";
$result3=mysqli_query($mysqli,$sql3) or die;
while ($row3=$result->fetch_assoc()) {
	$idi=$row3['idi'];
	$prezime=$row3['prezime'];
	$ime=$row3['ime'];

	$filebname='upload_pic/T_1_'.$idi.'.jpg';
	if (in_array($idi, $prisutni[0]) AND file_exists($filebname)) $prisutni1.='<img src="upload_pic/T_1_'.$idi.'.jpg" title="'.$prezime.' '.$ime.'" />';
	if(isset($prisutni[1]) AND in_array($idi, $prisutni[1]) AND file_exists($filebname)) $prisutni2.='<img src="upload_pic/T_1_'.$idi.'.jpg" title="'.$prezime.' '.$ime.'" />';
	
}
echo '</div><div class="fotoalbum" style="float:left;width:280px;max-height:300px;overflow-y:auto">'.$prisutni1.'</div>';
echo '<div class="fotoalbum" style="float:left;width:280px;max-height:300px;overflow-y:auto;background:#bcf">'.$prisutni2.'</div>';
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