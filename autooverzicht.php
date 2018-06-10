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
						select	autokenteken,
								automerk,
								autotype,
								autokmstand,
								klantid
						from	auto
					");
$sql->execute();

echo "<center><table border='1'>";
	echo "<tr><th>Kenteken</th><th>Merk</th><th>Type</th><th>Km stand</th><th>klantid</th></tr>";

	foreach ($sql as $rij)
	{
		echo "<tr>";
		echo "<td>" . $rij["autokenteken"]			. "</td>";
		echo "<td>" . $rij["automerk"]			. "</td>";
		echo "<td>" . $rij["autotype"]		. "</td>";
		echo "<td>" . $rij["autokmstand"]		. "</td>";
		echo "<td>" . $rij["klantid"]		. "</td>";
		echo "</tr>";
	}
	
echo "</table></center>";
?>
</div>
</body>
</html>