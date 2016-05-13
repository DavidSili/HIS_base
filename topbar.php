<nav id="topbar" style="min-width:880px;background-image:url('images/topbar.jpg');box-shadow: 0 2px 8px #000;">
    <ul>
		<li><a href="profil.php">Zdravo, <?php echo $user; ?>!<img src="images/settings.png" style="margin:3px 0 -3px 10px" height="16" width="16" /></a>
			<ul class="sub2">
				<li><a href="profil.php">Profil</a></li>
			</ul>
		</li>
	</ul>
	<ul style="float:right">
		<li><a href="index.php">Početna</a>
		</li>
		<li><a href="izvip.php">Izviđači</a>
			<ul>
				<li><a href="izvip.php">Pregled</a></li>
				<li><a href="izviu.php">Unos/izmena</a></li>
			</ul>
		</li>
		<li><a href="odredp.php">Odredi</a>
<?php if ($level>2) { ?>
			<ul>
				<li><a href="odredp.php">Pregled</a></li>
				<li><a href="odredu.php">Unos/izmena</a></li>
			</ul>
<?php } ?>
		</li>
		<li><a href="kampp.php">Kampovi</a>
<?php if ($level>2) { ?>
			<ul>
				<li><a href="kampp.php">Pregled</a></li>
				<li><a href="kampu.php">Unos/izmena</a></li>
			</ul>
<?php } ?>
		</li>
		<li><a href="obukep.php">Obuke</a>
<?php if ($level>2) { ?>
			<ul>
				<li><a href="obukep.php">Pregled</a></li>
				<li><a href="obukeu.php">Unos/izmena</a></li>
			</ul>
<?php } ?>
		</li>
		<li><a href="kupovina.php">Prodavnica</a>
<?php if ($level>2) { ?>
			<ul>
				<li><a href="kupovina.php">Kupovina</a></li>
				<li><a href="predmetil.php">Lager</a></li>
				<li><a href="predmetiu.php">Unos/izmena</a></li>
			</ul>
<?php } ?>
		</li>
		<li><a href="narudzbinep.php">Narudžbine</a>
			<ul>
				<li><a href="narudzbinep.php">Pregled</a></li>
				<li><a href="arhiva.php">Arhiva</a></li>
			</ul>
		</li>
<?php if ($level>3) echo '<li><a href="adminpanel.php">Admin panel</a></li>'; ?>
		<li><a href="logout.php">Odjava</a></li>
	</ul>
</nav>