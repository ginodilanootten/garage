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
  De auto is niet gevonden!
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
			Welk auto zoekt u?
			<input type="text" name="autokenteken" placeholder="Kenteken"> <br />
			<input type="submit">
		</form>
	<?php } else { ?>

		<?php
			$autokenteken= $_POST["autokenteken"];
require_once "db.php";

$sql= $conn->prepare("SELECT * FROM auto WHERE autokenteken='$autokenteken'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 0) { header('Location: ?error=1'); } else {
			require_once "db.php";

			$sql= $conn->prepare("
									select	autokenteken,
											automerk,
											autotype,
											autokmstand,
											klantid
									from	auto
									where	autokenteken= :autokenteken
								");
			$sql->execute(["autokenteken"=> $autokenteken]);
			
			//klantgegevens laten zien------------------------
			echo "<table border='1'>";
			echo "<tr><th>Kenteken</th><th>Merk</th><th>Type</th><th>Km stand</th><th>Klant ID</th></tr>";
			foreach($sql as $rij)
			{
				echo "<tr>";
					echo "<td>" . $rij["autokenteken"]			. "</td>";
					echo "<td>" . $rij["automerk"]				. "</td>";
					echo "<td>" . $rij["autotype"]				. "</td>";
					echo "<td>" . $rij["autokmstand"]			. "</td>";
					echo "<td>" . $rij["klantid"]				. "</td>";
				echo "</tr>";
			}
		echo "</table>";				
	} } ?>

</div>
	</body>
</html>