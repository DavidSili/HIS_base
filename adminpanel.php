<?php
	session_start();
	$uri=$_SERVER['REQUEST_URI'];
	$pos = strrpos($uri, "/");
	$url = substr($uri, $pos+1);
	if ($_SESSION['loggedin'] != 1 OR $_SESSION['level'] < 4 ) {
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
	
	if ($do=="1") {
		$odrediID=explode(',',$odrediid);
		foreach($odrediID as $ox) {
			$sql='UPDATE users SET `funkcija`="'.${'his'.$ox}.'",`zaodred`="'.${'odred'.$ox}.'" WHERE ID="'.$ox.'"';
			mysqli_query($mysqli,$sql) or die;
		}
	}
	elseif ($do=="2") {
		$xime=$_POST['ime'];
		$xusername=$_POST['username'];
		$xpass=$_POST['pass'];
		$xemail=$_POST['email'];
		$hash = hash('sha256', $xpass);
		$salt = md5(uniqid(rand(), true));
		$salt = substr($salt, 0, 11);
		$hash = hash('sha256', $salt.$hash);
		$sql = 'SELECT * FROM users WHERE `username` = "'.$xusername.'"';
		$result = mysqli_query($mysqli,$sql) or die;
		$usernejmovi=mysql_num_rows($result);
		$sql = 'SELECT * FROM users WHERE `email` = "'.$xemail.'"';
		$result = mysqli_query($mysqli,$sql) or die;
		$emailovi=mysql_num_rows($result);
		if ($usernejmovi ==0 AND $emailovi ==0) {
		
			$query='INSERT INTO users (username, name, password, salt, level, email) VALUES ("'.$xusername.'","'.$xime.'","'.$hash.'","'.$salt.'","2","'.$xemail.'")';
			mysql_query($query);
		}
	}
	
	
}

?>
<html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">HIS baza - admin panel</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<style type="text/css">
.iur select {
	width:150px;
}
#form2 .iud {
	width:200px;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<?php include 'topbar.php'; ?>

<div id="introbox" style="width:200px;top:27px;position:absolute;left:0;bottom:0;background:#fff;opacity:0.4">
</div>
<div id="introbox2" style="width:180px;top:27px;position:absolute;left:520px;bottom:0;background:#fff;opacity:0.4">
</div>
<div style="width:320px;top:27px;position:absolute;left:200;height:25px;background:#fff;opacity:0.4"></div>
<div class="wrap" style="width:300px;top:27px;position:absolute;left:205;height:18px;font-weight:bold;padding-top:7px"><span style="padding-left:5px">Zadužen za odred</span><span style="padding-left:55px">Funkcija u HISu</span></div>

<div class="wrap" style="position:absolute;top:32px;left:30px;width:480px">
	<div class="iur" style="margin-bottom:5px">
		<div class="iul" style="text-align:left"><b>Korisnici</b></div>
		<div style="clear:both;"></div>
	</div>
<form name="form1" id="form1" action="#" method="POST">
<?php
$sql='SELECT ID, ime, mesto FROM odredi';
$result=mysqli_query($mysqli,$sql) or die;
while($row=mysql_fetch_assoc($result)) {
	$ID=$row['ID'];
	$ime=$row['ime'];
	$mesto=$row['mesto'];
	$odredi[$ID]=$ime;
	if (strpos($ime,$mesto) == false) {
		$odredi[$ID].=' ('.$mesto.')';
	}
}
$odrediID="";
$sql='SELECT *, IF(funkcija="0", 2, 1) AS funk FROM users ORDER BY funk, funkcija';
$result=mysqli_query($mysqli,$sql) or die;
while($row=mysql_fetch_assoc($result)) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
	echo '<div class="iur"><div class="iul">'.$name.'</div><select id="yodred'.$ID.'" type="text" name="odred'.$ID.'" class="iud"><option></option>';
	foreach($odredi as $odrID => $odrNA) {
	echo '<option value="'.$odrID.'"';
	if ($odrID==$zaodred) echo ' selected="selected"';
	echo '>'.$odrNA.'</option>';
	}
	echo '</select><select id="yhis'.$ID.'" type="text" name="his'.$ID.'" class="iud"><option></option><option value="1"';
	if ($funkcija==1) echo ' selected="selected"';
	echo '>vođa</option><option value="2"';
	if ($funkcija==2) echo ' selected="selected"';
	echo '>zamenik</option><option value="3"';
	if ($funkcija==3) echo ' selected="selected"';
	echo '>blagajnik</option><option value="4"';
	if ($funkcija==4) echo ' selected="selected"';
	echo '>sekretar</option><option value="5"';
	if ($funkcija==5) echo ' selected="selected"';
	echo '>ekonom</option></select><div style="clear:both;"></div></div>';
	$odrediID.=$ID.',';
}
$odrediID=substr($odrediID, 0, -1);
echo '<input type="hidden" name="odrediid" value="'.$odrediID.'" />';
?>
<input type="submit" value="osveži funkcije" style="height:20px"/>
<input type="hidden" name="do" value="1" />
</form>	
<form name="form2" id="form2" action="#" method="POST">
<div class="wrap" style="position:absolute;top:0;left:500px;width:400px">
	<div class="iur" style="margin-bottom:5px">
		<div class="iul" style="text-align:center"><b>Unos novog korisnika</b></div>
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">ime</div>
		<input id="yime" type="text" name="ime" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">email</div>
		<input id="yemail" type="text" name="email" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">korisničko ime</div>
		<input id="yusername" type="text" name="username" class="iud" />
		<div style="clear:both;"></div>
	</div>
	<div class="iur">
		<div class="iul">šifra</div>
		<input id="ypass" type="text" name="pass" class="iud" autocomplete="off"/>
		<div style="clear:both;"></div>
	</div>
	<div class="iur" style="margin-bottom:5px">
		<div class="iul" style="text-align:center"><input type="submit" value="unesi" style="height:20px"/></div>
		<div style="clear:both;"></div>
	</div>
</div>
<input type="hidden" name="do" value="2" />
</form>
<script type="text/javascript">
</script>
</body>
</html>