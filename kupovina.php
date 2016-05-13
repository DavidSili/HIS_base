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

	$sorterklik=$_POST['sorterklik'];
	$komentar=$_POST['komentar'];
	$sorterklik=substr($sorterklik, 0, -2);
	$sorter=explode(',y,',$sorterklik);
	$sorted="";
	foreach($sorter as $xx => $yy) {
		$el=explode(',x,',$yy);
		$el[0]=substr($el[0],1);
		$sorted.=$el[0].','.$el[1].';';
	}
	$sorted=substr($sorted,0,-1);
	
	$dattime=date('G:i:s j.n.Y.');
	$datnar=date('Y-m-d');
	
	$sql='INSERT INTO narudzbine (narucio, datnar, predmeti, komentar, uneo) VALUES ("'.$user.'","'.$datnar.'","'.$sorted.'","'.$komentar.'", "'.$user.' - '.$dattime.'")';
	mysqli_query($mysqli,$sql) or die;
	
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
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-uiD.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<style type="text/css">
ul {font-family:arial}
#sortable1, #sortable2 {
    background: rgba(255, 255, 255, .5);
	list-style-type: none;
	margin: 0;
	float: left;
	margin-right: 10px;
	overflow-y:auto;
	overflow-x:hidden;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
#sortable1 li, #sortable2 li {
	margin: 3px;
	padding: 5px;
	font-size: 12pt;
	width: 100px;
	height: 167px;
	border:2px solid #000;
	background:#fff;
	-moz-border-radius: 7px;
	border-radius: 7px;
	float:left;
}
</style>
<meta name="robots" content="noindex">
</head>
<body>
<form name="forma" id="forma" method="POST" action="#"><?php include 'topbar.php'; ?>
<div id="wrapper" style="margin-top:30px">
<div style="margin-top:34px;overflow:hidden"><input type="submit" value="Poruči" style="width:100px;height:56px;float:left;margin-right:5px"/><textarea name="komentar" style="width:352px;height:52px;margin-top:2px;float:left;font-family:arial" rows="3" placeholder="komentar..."></textarea></div>
<ul id="sortable1" class="connectedSortable" style="position:absolute;top:100px;bottom:5px;left:5px;width:450px;padding:5px" onmouseup="sorter1()" onmouseout="sorter1()"></ul>
<ul id="sortable2" class="connectedSortable" style="position:absolute;top:35px;bottom:5px;left:475px;right:5px;padding:5px" onmouseup="sorter1()" onmouseout="sorter1()">
<?php
$sql='SELECT * FROM predmeti WHERE nalageru!="0" ORDER BY tip, predmet';
$result=mysqli_query($mysqli,$sql) or die;
while($row=$result->fetch_assoc()) {
	foreach($row as $xx => $yy) {
		$$xx=$yy;
	}
echo '<li class="dugme2" id="b'.$ID.'" title="bb'.$ID.'"><b>'.$predmet.'</b><br/><div style="width:100px;height:100px">';
$filename='upload_pic/T_5_'.$ID.'.jpg';
if (file_exists($filename)) {
    echo '<a href="upload_pic/L_5_'.$ID.'.jpg" target="_blank" style="float:left;margin-right:6px"><img src="upload_pic/T_5_'.$ID.'.jpg" title="'.$opis.'"/></a>';
} else {
    echo '<img src="images/nepoznato.jpg" title="'.$opis.'" />';
}
echo '</div>Na lageru: '.$nalageru.'<br/><div><div style="padding-top:5px;float:left">Kupi: </div><input type="number" value="1" min="1" max="'.$nalageru.'" id="bbb1" style="width:70px;float:right" /></div></li>';
}
echo '</ul><input type="hidden" name="sorterklik" id="sorterklik" value=""/>';
?>
</div>
<script type="text/javascript">
$(function()
	{
		$( "#sortable1, #sortable2" ).sortable({
		  connectWith: ".connectedSortable"
		});
	});
function sorter1()
	{
		var sortedIDs = $( "#sortable1" ).sortable( "toArrayS" );
		document.getElementById("sorterklik").value=sortedIDs;
	}
</script>
</form>
</body>
</html>