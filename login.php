<?php 
 
session_start();
include 'config.php';
if (isset($_GET["url"])) $url=$mysqli->real_escape_string($_GET["url"]);
else $url="index.php";

if (isset($_GET['login'])) {

	$usersent=$_POST['username'];
	$passsent=$_POST['password'];
	$pass_url=$_POST['pass_url'];
	$usersent=stripslashes($usersent);
	$passsent=stripslashes($passsent);
	$pass_url=stripslashes($pass_url);
	$usersent=mysqli_real_escape_string($mysqli,$usersent);
	$passsent=mysqli_real_escape_string($mysqli,$passsent);
	$pass_url=mysqli_real_escape_string($mysqli,$pass_url);
	$sql = 'SELECT * FROM users WHERE `username`="'.$usersent.'"';
	$result = mysqli_query($mysqli,$sql) or die;
	
	if (mysqli_num_rows($result)==1) {
	
		$row=$result->fetch_assoc();
		$passsql=$row['password'];
		$saltsql=$row['salt'];
		$level=$row['level'];
		
		$xhash = hash ('sha256', $passsent);
		$hash = hash('sha256', $saltsql . $xhash);
		
		if ($level>1 && $hash==$passsql) {
		
			$_SESSION['loggedin'] = 1;
			$_SESSION['user'] = $usersent;
			$_SESSION['level'] = $level;
			header("Location: $pass_url");
			exit;
		
		}
		elseif ($level>0 && $hash==$passsql) {
		
			echo '<div style="background:#fff;-moz-border-radius: 7px;border-radius: 7px;border: 2px #333 solid;padding:5px;text-align:center">Molimo vas za strpljenje dok vas administrator ne kontaktira i odobri vaš nalog</div>';
			
		}
		else echo '<div style="background:#fff;-moz-border-radius: 7px;border-radius: 7px;border: 2px #333 solid;padding:5px;text-align:center">Pogrešno korisničko ime/šifra</div>';
		
	}
	else echo '<div style="background:#fff;-moz-border-radius: 7px;border-radius: 7px;border: 2px #333 solid;padding:5px;text-align:center">Pogrešno korisničko ime/šifra</div>';
 
}
 
?><html>
<head profile="http://www.w3.org/2005/20/profile">
<link rel="icon"
	  type="image/png"
	  href="images/favicon.gif">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title id="Timerhead">HIS Base - prijava</title>
<link type='text/css' rel='stylesheet' href='style.css' />
<script src="js/jquery.min.js"></script>
<meta name="robots" content="noindex">
</head>
<body>

<div id="logbgnd"></div>
<div id="logform">
<div style="text-align:center;margin:10px 0 20px;font-size:16px"><b>Prijava</b></div>
	<form name="form1" method="post" action="?login=1">
		<div style="height:34px">
			<div style="width:120px;float:left;text-align:right;margin:4px 3px 0 0">korisničko ime: </div>
			<input name="username" type="text" id="username" /><br/>
		</div>
		<div>
			<div style="width:120px;float:left;text-align:right;margin:4px 3px 0 0">šifra: </div>
			<input name="password" type="password" id="password" /><br/>
		</div>
		<div style="margin-top:10px;text-align:center">
			<input type="submit" name="Submit" value="Login" />
		</div>
		<div id="blacklink" style="line-height:20px">
			<a href="register.php">Registracija</a><br/>
			<a href="forgot.php">Zaboravljeno korisničko ime/šifra</a>
		</div>
		<input type="hidden" name="pass_url" value="<?php echo $url; ?>"/>
	</form>
</div>

</body>
</html>
