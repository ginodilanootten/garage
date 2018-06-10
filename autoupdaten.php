<!doctype html>
<html lang="nl">
	<head>
		<meta name="author" content="Gino Dilano Otten">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/garage.css">
		<title>Garage</title>
	</head>
	<body>
<?php if (!empty($_GET[error])) { ?>
	<div class="alert error">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  Deze auto bestaat niet
	</div>
<?php } if (!empty($_GET[geslaagd])) { ?>
	<div class="alert success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  De auto is aangepast
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
			Welke auto wilt u wijzigen?
			<input type="text" name="klantidvak" placeholder="Kenteken" required> <br />
			<input type="submit">
		</form>
<?php // Stap 2 ?>
<?php } if ($_GET['stap'] == '2') { ?>
<?php
require_once "db.php";
$klantid = $_POST["klantidvak"];

$sql= $conn->prepare("SELECT * FROM auto WHERE autokenteken='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 0) { header('Location: ?error=1'); } else {

$klantid = $_POST["klantidvak"];

//klantgegevens uit de tabel halen--------------------------
require_once "db.php";

$klanten= $conn->prepare("
						select	klantid,
								autokenteken,
								automerk,
								autotype,
								autokmstand
						from	auto
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
		echo " value='" .$klant["klantid"] . " ' required> <br /> ";

		echo " autokenteken: <input type='text' ";
		echo " name= 'autokentekenvak' ";
		echo " value= '" .$klant["autokenteken"]. "' ";
		echo "required > <br />";
		
		echo " automerk: <input type='text' ";
		echo " name= 'automerkvak' ";
		echo " value= '" .$klant["automerk"]. "' ";
		echo "required > <br />";
		
		echo " autotype: <input type='text' ";
		echo " name= 'autotypevak' ";
		echo " value= '" .$klant["autotype"]. "' ";
		echo "required > <br />";
		
		echo " autokmstand: <input type='text' ";
		echo " name= 'autokmstandvak' ";
		echo " value= '" .$klant["autokmstand"]. "' ";
		echo "required > <br />";
	}
	echo "<input type ='submit'>";
echo "</form>"


?>
<?php } } if ($_GET['stap'] == '3') { ?>

<?php
require_once "db.php";
$klantid = $_POST["klantidvak"];

$sql= $conn->prepare("SELECT * FROM auto WHERE autokenteken='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 0) { header('Location: ?error=1'); } else {
	
$klantid			= $_POST["klantidvak"];
$autokenteken		= $_POST["autokentekenvak"];
$automerk			= $_POST["automerkvak"];
$autotype			= $_POST["autotypevak"];
$autokmstand		= $_POST["autokmstandvak"];

//updaten klantgegevens----------------------------
require_once "db.php";

$sql= $conn->prepare
("
	update auto set	autokenteken		=	:autokenteken,
						automerk			=	:automerk,
						autotype			=	:autotype,
						autokmstand			=	:autokmstand
						where	klantid		=	:klantid
");

$sql->execute
([
	"klantid"			=>	$klantid,
	"autokenteken"		=>	$autokenteken,
	"automerk"			=>	$automerk,
	"autotype"			=>	$autotype,
	"autokmstand"		=>	$autokmstand
]);

header('Location: ?geslaagd=1');
?>
<?php } } ?>
</div>
