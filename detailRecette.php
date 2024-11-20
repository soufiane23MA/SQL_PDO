
<?php

// connecter la base de donnée à PHP via PDO
try {
	$mysqlClient = new PDO(
		"mysql:host=localhost;dbname=recettes;charset=utf8","root","") ;
} // intérompre les erreueres avec message
catch (Exception $e)
{
	die('Erreur : '.$e-> getMessage());
}
$sqlQuery =   "SELECT nom_recette,nom_categorie,temps_preparation FROM recette r
	INNER JOIN categorie c  ON c.id_categorie = r.id_categorie";
 $recetteStatement = $mysqlClient->prepare($sqlQuery);
 $recetteStatement->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>affichage</title>
</head>
<body>
	
</body>
</html>

