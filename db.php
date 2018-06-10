<?php
	//gar-connect.php
	//maakt een connectie met de 'garage'
	$servername= "localhost";
	$dbname= "garage";
	$username= "root";
	$password= "wachtwoord";
	
	try
	{
		$conn= new PDO("mysql:host=$servername;dbname=$dbname",
						$username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connectie gelukt<br />";
	}
	catch(PDOException $e)
	{
		echo "Connectie mislukt: " . $e->getMessage();
	}
?>