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

$rank = $user['rank'];
?>
<?php if($rank > 0){?>		
		<button class="dropbtn">Klant</button>
			<div class="dropdown-content">
<?php if($rank == 2){?>	<a href="klantmaken.php">Aanmaken</a>  <?php } ?>
<?php if($rank == 2){?>	<a href="klantverwijderen.php">Verwijderen</a> <?php } ?>
<?php if($rank == 2){?>	<a href="klantupdaten.php">Update</a>  <?php } ?>
<?php if($rank == 1){?>	<a href="klantzoeken.php">Zoeken</a>  <?php } ?>
<?php if($rank > 0){?>	<a href="klantoverzicht.php">Overzicht</a>  <?php } ?>
<?php if($rank > 0){?>	<a href="autoklant.php">Auto & Klant</a> <?php } ?>
			</div>
		</div>
		<div class="dropdown">
		<button class="dropbtn">Auto</button>
			<div class="dropdown-content">
<?php if($rank == 2){?>	<a href="automaken.php">Aanmaken</a>  <?php } ?>
<?php if($rank == 2){?>	<a href="autoverwijderen.php">Verwijderen</a> <?php } ?>
<?php if($rank == 2){?>	<a href="autoupdaten.php">Update</a>  <?php } ?>
<?php if($rank == 1){?>	<a href="autozoeken.php">Zoeken</a>  <?php } ?>
<?php if($rank > 0){?>	<a href="autooverzicht.php">Overzicht</a>  <?php } ?>
<?php if($rank > 0){?>	<a href="autoklant.php">Auto & Klant</a> <?php } ?>
			</div>
		</div>

		<div class="dropdown">
			<button class="dropbtn">Administratie</button>
			<div class="dropdown-content">
				<a href="uitloggen.php">Uitloggen</a>
			</div>
<?php } else { ?>
Je hebt geen toegang tot het medewerker paneel!
<?php } ?>
