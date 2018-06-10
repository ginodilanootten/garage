<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage</title>
	</head>
	<body>
<?php if (!empty($_GET[geslaagd])) { ?>
	<div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De klant is succesvol aangemaakt!
	</div>
<?php } ?>
	<div id="witvlakmenu">
		<h2>Klant aanmaken</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
	<?php if (empty($_GET[stap])) { ?>
	<div id="witvlakmenu">
		<form action="?stap=2" method="post">
<input type="text"	name="klantnaamvak" placeholder="klantnaamvak" required><br />
<input type="text"	name="klantadresvak" placeholder="klantadresvak" required><br />
<input type="text"	name="klantpostcodevak" placeholder="klantpostcodevak" required><br />
<input type="text"	name="klantplaatsvak" placeholder="klantplaatsvak" required><br />
<input type="submit" value="Maken" name="maken">
</form>
	</div>
	<?php } else { ?>
	</body>
</html>
<?php
$klantid		= NULL; //komt niet uit het formulier (autoincrement)
$klantnaam		= $_POST["klantnaamvak"];
$klantadres		= $_POST["klantadresvak"];
$klantpostcode	= $_POST["klantpostcodevak"];
$klantplaats	= $_POST["klantplaatsvak"];

require_once "db.php";

$sql = $conn->prepare("
						insert into klant values
						(
							:klantid, :klantnaam, :klantadres,
							:klantpostcode, :klantplaats
						)
					");

$sql->execute([
				"klantid"		=> $klantid,
				"klantnaam"		=> $klantnaam,
				"klantadres"	=> $klantadres,
				"klantpostcode"	=> $klantpostcode,
				"klantplaats"	=> $klantplaats
			]);
header('Location: ?geslaagd=1');
	}
?>