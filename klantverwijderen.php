<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage verwijderen</title>
	</head>
	<body>
<?php if (!empty($_GET[error])) { ?>
	<div class="alert error">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <?php echo $_GET[melding]; ?>
	</div>
<?php } if (!empty($_GET[geslaagd])) { ?>
	<div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De klant is succesvol verwijderd!
	</div>
<?php } ?>
	
	<div id="witvlakmenu">
		<h2>Klant verwijderen</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
<div id="witvlakmenu">
<?php // Stap 1 ?>
<?php if (empty($_GET[stap])) { ?>
		<form action="?stap=2" method="post">
			Welk klantid wilt u verwijderen?
			<input type="number" name="klantidvak" required> <br />
			<input type="submit" value="Ga naar stap 2">
		</form>
<?php // Stap 2 ?>
<?php } if ($_GET['stap'] == '2') { ?>
<?php 
require_once "db.php";
$klantid = $_POST["klantidvak"];

$sql= $conn->prepare("SELECT klantid FROM auto WHERE klantid='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() > 0) { header('Location: ?error=1&melding=Je kunt geen klanten verwijderen waar een auto van is geregisteerd!'); } else {
//klantid uit het formulier halen---------------------------
$klantid = $_POST["klantidvak"];

//klantgegevens uit de tabel halen--------------------------
require_once "db.php";


$klanten= $conn->prepare("
						select	klantid,
								klantnaam,
								klantadres,
								klantpostcode,
								klantplaats
						from	klant
						where	klantid= :klantid
						");
					
$klanten->execute(["klantid"=> $klantid]);
$count = $klanten->rowCount();

if($count != 0)
{
//klantgegevens laten zien----------------------------------
	echo "<center><table border='1'>";
	echo "<tr><th>ID</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Plaats</th></tr>";
			foreach($klanten as $klant)
			
			 {
				echo "<tr>";
					echo "<td>" . $klant["klantid"]			. "</td>";
					echo "<td>" . $klant["klantnaam"]		. "</td>";
					echo "<td>" . $klant["klantadres"]		. "</td>";
					echo "<td>" . $klant["klantpostcode"]	. "</td>";
					echo "<td>" . $klant["klantplaats"]		. "</td>";
				echo "</tr>";
			}
			
			
	echo "</table></center><br />";
	
	echo "<form action='?stap=3' method='post'>";
		echo "<input type='hidden' name='klantidvak' value=$klantid>";
		echo "<input type='hidden' name='verwijdervak' value='0'>";
		echo "<input type='checkbox' name='verwijdervak' value='1'>";
		echo "Verwijder deze klant. <br />";
		echo "<input type='submit'>";
	echo "</form>";
}else
{
	header('Location: ?error=1&melding=Er is geen klant met dit ID!');
}
?>

<?php // Stap 3 ?>
<?php } } if ($_GET['stap'] == '3') { ?>
<?php
//gegevens uit het formulier halen-------------
$klantid		= $_POST["klantidvak"];
$verwijderen	= $_POST["verwijdervak"];

//klantgegevens verwijderen--------------------
if ($verwijderen)
{
	require_once "db.php";
	
	$sql= $conn->prepare("
							delete from klant
							where	klantid= :klantid
						");
	$sql->execute(["klantid" => $klantid]);
	
	header('Location: ?geslaagd=1');
}
else
{
	header('Location: ?error=1&melding=De klant is niet verwijderd!');
}

?>
<?php } ?>
</div>