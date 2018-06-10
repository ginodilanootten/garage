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
  De auto is succesvol aangemaakt en is toegevoegd aan het klant id!
	</div>
<?php } ?>
<?php if (!empty($_GET[error])) { ?>
	<div class="alert error">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  Er is geen klant met dit id!
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
<input type="text"		name="autokentekenvak" 		placeholder="autokenteken"	required>			<br />
<input type="text"		name="automerkvak" 			placeholder="automerk"		required>			<br />
<input type="text"		name="autotypevak" 			placeholder="autotype"		required>			<br />
<input type="text"		name="autokmafstandvak" 	placeholder="autokmafstand"	required>			<br />
<input type="number"	name="klantidvak"			placeholder="klantid"		required>			<br />
<input type="submit">
</form>
	</div>
	<?php } else { ?>
	</body>
</html>
<?php
$autokenteken	= $_POST["autokentekenvak"];
$automerk		= $_POST["automerkvak"];
$autotype		= $_POST["autotypevak"];
$autokmafstand	= $_POST["autokmafstandvak"];
$klantid		= $_POST["klantidvak"];

require_once "db.php";

$sql= $conn->prepare("SELECT klantid FROM klant WHERE klantid='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == '1') { header('Location: ?error=1'); } else {


$sql = $conn->prepare("
						insert into auto values
						(
							:autokenteken, :automerk, :autotype,
							:autokmafstand, :klantid
						)
					");

$sql->execute([
				"autokenteken"	=> $autokenteken,
				"automerk"		=> $automerk,
				"autotype"		=> $autotype,
				"autokmafstand"	=> $autokmafstand,
				"klantid"		=> $klantid
			]);

header('Location: ?geslaagd=1');
	}
	}
?>