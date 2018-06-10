<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage Menu</title>
	</head>
	<body>
<?php if (!empty($_GET[geslaagd])) { ?>
	<div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De klant is succesvol aangemaakt!
	</div>
<?php } ?>
	<div id="witvlakmenu">
		<h2>Klant overzicht</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
<div id="witvlak">
<?php
//tabel uitlezen en netjes afdrukken---------------------------
require_once "db.php";

$sql= $conn->prepare("
						select	klantid,
								klantnaam,
								klantadres,
								klantpostcode,
								klantplaats
						from	klant
					");
$sql->execute();

echo "<center><table border='1'>";
	echo "<tr><th>ID</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Plaats</th></tr>";

	foreach ($sql as $rij)
	{
		echo "<tr>";
		echo "<td>" . $rij["klantid"]			. "</td>";
		echo "<td>" . $rij["klantnaam"]			. "</td>";
		echo "<td>" . $rij["klantadres"]		. "</td>";
		echo "<td>" . $rij["klantpostcode"]		. "</td>";
		echo "<td>" . $rij["klantplaats"]		. "</td>";
		echo "</tr>";
	}
	
echo "</table></center>";
?>
</div>
</body>
</html>