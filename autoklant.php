<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage Menu</title>
	</head>
	<body>
	<div id="witvlakmenu">
		<h2>Klant met auto overzicht</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
<div id="witvlak"><center>
		<table border='1'>
  <tr>
    <th>Kenteken</th>
    <th>Automerk</th>
    <th>Autotype</th>
    <th>Klantid</th>
    <th>Klantnaam</th>
  </tr>
<?php
//tabel uitlezen en netjes afdrukken---------------------------
require_once "db.php";

$sql= $conn->prepare("
						select	*
						from auto,klant
						where auto.klantid = klant.klantid
						ORDER BY auto.klantid, klant.klantid 
					");
$sql->execute();

echo "";
	foreach ($sql as $rij)
	{
		echo "<tr>";
		echo "<td>" . $rij["autokenteken"]		. "</td>";
		echo "<td>" . $rij["automerk"]			. "</td>";
		echo "<td>" . $rij["autotype"]			. "</td>";
		echo "<td>" . $rij["klantid"]			. "</td>";
		echo "<td>" . $rij["klantnaam"]			. "</td>";
		echo "</tr>";
	}
	
echo "</table>";
?>
</div>
</body>
</html>