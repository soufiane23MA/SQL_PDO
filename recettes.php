<?php
// connecter la base de donnée à PHP via PDO
try {
	$mysqlClient = new PDO(
		"mysql:host=localhost;dbname=recettes;charset=utf8","root","") ;
} // intérompre les erreueres avec un  message
catch (Exception $e)
{
	die('Erreur : '.$e-> getMessage());
}
/**
 *  contrôle  de la manière dont PDO gère et rapporte les erreurs qui surviennent 
 * lors des opérations avec la base de données.
 */
[PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION];
/**
 * construire la requête pour afficher les recettes presentent dans
*notre BDD.
* on demande à $recetteStatement (objet PDO STETement), de recuperer les données 
*et les affichées en format tableau avec les 2 méthodes execute() et fetchAll()[ fetch peux sibler que quelque colonne de notre table ]
*par exemple name, categorie ...etc
 */ 

	$sqlQuery =   "SELECT * FROM recette r
	INNER JOIN categorie c  ON c.id_categorie = r.id_categorie";
 $recetteStatement = $mysqlClient->prepare($sqlQuery);
 $recetteStatement->execute();

 $recettes = $recetteStatement->fetchAll();
 
 /**
	* la boucle qui permet de parcourir la BDD et affiche le contenu sous forme de tableau
	*/
	$resulte = '<table style= "border-collapse: collapse; padding:25px;">';
	$resulte .= '<tr>';
	$resulte.= '<th style ="border:1px solid black;padding:12px;">Nom de recette</th>';
	$resulte.= '<th style = "border:1px solid black;padding:12px;">Nom de Catégorie</th>';
	$resulte.='<th style ="border:1px solid black;padding:12px;">Temps de préparation</th>';
	$resulte.= '</tr>';

	foreach($recettes as $recette){
		   
		
		 $resulte .= "<tr>";
		 $resulte.= "<td style ='border:1px solid black;padding:12px;'><.$recette href='detailRecette?id=3".$recette['id_recette'].">".$recette['nom_recette']."</a></td>";
		 $resulte.= "<td style ='border:1px solid black;padding:12px;'>".$recette['nom_categorie']."</td>";
		$resulte .= "<td style ='border:1px solid black;padding:12px;'>".$recette["temps_preparation"]."</td>";
		$resulte.= "</tr>";
		
		
		 


	};
	$resulte .= "</table>";
	 echo $resulte;

	 ?>
		
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<a href="detailRecette.php">detaills</a>
</body>
</html>
			
 
	 


 
 




 