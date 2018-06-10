<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: menu.php");
} ?>
<?php 
require_once "db.php";
$klantid = $_POST["naam"];

$sql= $conn->prepare("SELECT * FROM users WHERE naam='$klantid'");
$sql->execute();
$result= $sql->query;
if ($sql->rowCount() == 1) { header('Location: ?error=1'); } else { ?>
<?php

require 'db.php';

$message = '';

if(!empty($_POST['naam']) && !empty($_POST['password'])) {

	
	// Enter the new user in the database
	$sql = "INSERT INTO users (naam, password) VALUES (:naam, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':naam', $_POST['naam']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
			header("Location: /?geslaagd=1");
	else:
			header("Location: ?error=1");
	endif;

}

?><?php } ?>
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
Er is al een account met deze gebruikersnaam!
	</div>
<?php } ?>
	<div id="witvlakmenu">
		<h2>Garage inloggen</h2>
	</div>
	<br><br>
	<div id="witvlakmenu">
		<div class="dropdown">
	<form action="" method="POST">
		
		<input type="text" placeholder="Gebruikersnaam" name="naam">
		<input type="password" placeholder="Wachtwoord" name="password">
		<input type="password" placeholder="Wachtwoord" name="confirm_password">
		<input type="submit" value="Aanmelden">

	</form>
	<a href="index.php"> Al een account?</a>
			
			</div>
		</div>
	</div>
	</body>
</html>