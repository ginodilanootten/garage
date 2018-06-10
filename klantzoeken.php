<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage Menu</title>
	</head>
	<body>
<?php if (!empty($_GET[error])) { ?>
	<div class="alert error">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De klant is niet gevonden!
	</div>
<?php } ?>
	<div id="witvlakmenu">
		<h2>Klant zoeken</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
	<div id="witvlakmenu">
	<?php if (empty($_GET[stap])) { ?>
		<form action="?stap=2" method="post">
			Welk klantid zoekt u?
			<input type="text" name="klantidvak"> <br />
			<input type="submit">
		</form>
	<?php } else { ?>
<?php
require_once "db.php";

$klantid = $_POST["klantidvak"];

$sql= $conn->prepare("SELECT * FROM auto WHERE klantid='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 0) { header('Location: ?error=1'); } else {
			$sql= $conn->prepare("
									select	klantid,
											klantnaam,
											klantadres,
											klantpostcode,
											klantplaats
									from	klant
									where	klantid= :klantid
								");
			$sql->execute(["klantid"=> $klantid]);
			
			//klantgegevens laten zien------------------------
			echo "<table border='1'>";
	echo "<tr><th>ID</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Plaats</th></tr>";
			foreach($sql as $rij)
			{
				echo "<tr>";
					echo "<td>" . $rij["klantid"]			. "</td>";
					echo "<td>" . $rij["klantnaam"]			. "</td>";
					echo "<td>" . $rij["klantadres"]		. "</td>";
					echo "<td>" . $rij["klantpostcode"]		. "</td>";
					echo "<td>" . $rij["klantplaats"]		. "</td>";
				echo "</tr>";
			}
		echo "</table> <br />";

 } } ?>
</div>
	</body>
</html>