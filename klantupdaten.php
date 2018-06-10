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
  Deze klant bestaat niet
	</div>
<?php } if (!empty($_GET[geslaagd])) { ?>
	<div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De klant is aangepast
	</div>
<?php } ?>
	
	<div id="witvlakmenu">
		<h2>Klant aanpassen</h2>
	</div><br><br>	<div id="witvlakmenu">
		<div class="dropdown">
<?php include 'menulinks.php'; ?>
		</div>
	</div><br><Br>
<div id="witvlakmenu">
<?php // Stap 1 ?>
<?php if (empty($_GET[stap])) { ?>
		<form action="?stap=2" method="post">
			Welk klantid wilt u aanpassen?
			<input type="number" name="klantidvak" required> <br />
			<input type="submit" value="Ga naar stap 2">
		</form>
<?php // Stap 2 ?>
<?php } if ($_GET['stap'] == '2') { ?>
<?php
require_once "db.php";
$klantid = $_POST["klantidvak"];

$sql= $conn->prepare("SELECT * FROM klant WHERE klantid='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 0) { header('Location: ?error=1'); } else {


//klantid uit het formulier halen---------------------------
$klantid = $_POST["klantidvak"];

//klantgegevens uit de tabel halen--------------------------


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

//klantgegevens in een nieuw formulier laten zien-----------
echo "<form action='?stap=3' method='post'>";
	foreach($klanten as $klant)
	{
		//klantid mag niet gewijzigd worden
		echo " klantid:" . $klant["klantid"];
		echo " <input type='hidden' name='klantidvak' ";
		echo " value='" .$klant["klantid"] . " '> <br /> ";

		echo " klantnaam: <input type='text' ";
		echo " name= 'klantnaamvak' ";
		echo " value= '" .$klant["klantnaam"]. "' ";
		echo "> <br />";
		
		echo " klantadres: <input type='text' ";
		echo " name= 'klantadresvak' ";
		echo " value= '" .$klant["klantadres"]. "' ";
		echo "> <br />";
		
		echo " klantpostcode: <input type='text' ";
		echo " name= 'klantpostcodevak' ";
		echo " value= '" .$klant["klantpostcode"]. "' ";
		echo "> <br />";
		
		echo " klantplaats: <input type='text' ";
		echo " name= 'klantplaatsvak' ";
		echo " value= '" .$klant["klantplaats"]. "' ";
		echo "> <br />";
	}
	echo "<input type ='submit' value='Aanpassen'>";
echo "</form>"

//er moet eigenlijk nog gecontroleerd worden op een bestaand klantid

?>
<?php } } if ($_GET['stap'] == '3') { ?>

<?php
//klantgegevens uit het formulier halen------------
$klantid		= $_POST["klantidvak"];
$klantnaam		= $_POST["klantnaamvak"];
$klantadres		= $_POST["klantadresvak"];
$klantpostcode	= $_POST["klantpostcodevak"];
$klantplaats	= $_POST["klantplaatsvak"];

//updaten klantgegevens----------------------------
require_once "db.php";

$sql= $conn->prepare
("
	update klant set	klantnaam		=	:klantnaam,
						klantadres		=	:klantadres,
						klantpostcode	=	:klantpostcode,
						klantplaats		=	:klantplaats
						where	klantid	=	:klantid
");

$sql->execute
([
	"klantid"		=>	$klantid,
	"klantnaam"		=>	$klantnaam,
	"klantadres"	=>	$klantadres,
	"klantpostcode"	=>	$klantpostcode,
	"klantplaats"	=>	$klantplaats
]);

header('Location: ?geslaagd=1');
?>
<?php } ?>
</div>
