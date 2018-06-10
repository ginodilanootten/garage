<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: menu.php");
}

require 'db.php';

if(!empty($_POST['naam']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,naam,password FROM users WHERE naam = :naam');
	$records->bindParam(':naam', $_POST['naam']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: /");

	} else {
			header("Location: ?error=1");
	}

endif;

?>
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
Woehoe, je account is aangemaakt je kan nu hier onder inloggen!
	</div>
<?php } ?>
<?php if (!empty($_GET[error])) { ?>
	<div class="alert succes">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
Inloggen is niet helemaal gelukt! Controleer of je gegevens kloppen!
	</div>
<?php } ?>
	<div id="witvlakmenu">
		<h2>Garage inloggen</h2>
	</div>
	<br><br>
	<div id="witvlakmenu">
		<div class="dropdown">
				<form action="index.php" method="POST">
		
		<input type="text" placeholder="Gebruikersnaam" name="naam">
		<input type="password" placeholder="wachtwoord" name="password">

		<input type="submit">

	</form>
	<a href="wordlid.php"> Account aanmaken</a>
			
			</div>
		</div>
	</div>
	</body>
</html>