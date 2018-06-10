<?php

session_start();

require 'db.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

} else {
				header("Location: index.php");
}

?>

			<button class="dropbtn">Klant</button>
			<div class="dropdown-content">
				<a href="klantmaken.php">Aanmaken</a>
				<a href="klantverwijderen.php">Verwijderen</a>
				<a href="klantupdaten.php">Update</a>
				<a href="klantzoeken.php">Zoeken</a>
				<a href="klantoverzicht.php">Overzicht</a>
				<a href="autoklant.php">Auto & Klant</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Auto</button>
			<div class="dropdown-content">
				<a href="automaken.php">Aanmaken</a>
				<a href="autoverwijderen.php">Verwijderen</a>
				<a href="autoupdaten.php">Update</a>
				<a href="autozoeken.php">Zoeken</a>
				<a href="autooverzicht.php">Overzicht</a>
				<a href="autoklant.php">Auto & Klant</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn">Administratie</button>
			<div class="dropdown-content">
				<a href="uitloggen.php">Uitloggen</a>
			</div>