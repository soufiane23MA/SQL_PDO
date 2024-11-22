

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>affichage</title>
</head>
<body>

<?php
 // pour afficher les donnée de notre BDD , on établie une connexion à travers la creation
 //d'un PDO( PHP data object )
try {
$mysqlClient = new PDO(
"mysql:host=localhost;dbname=recettes;charset=utf8","root","") ;

/**
 * ici la super Global GET , va récuperer les données transmisent par
 * la page recette.php.  
 */

if(isset($_GET["id"])) {

// assignier l'id récuperer par GET à une variable 
$id = $_GET["id"];

			 
// Le PDO demande les donnés de la BDD via la requêtte Query(), 
// la méthode de récupération utilisée est la requête préparée, 

$sqlQuery = "SELECT nom_recette, nom_categorie, temps_preparation FROM recette r
INNER JOIN categorie c  ON c.id_categorie = r.id_categorie WHERE r.id_recette = :id_recette";
//l'utilisation des deux méthodes PDO prepar() et execute(), sécurise notre BDD et évite les risque des injections SQL


$recetteStatement = $mysqlClient->prepare($sqlQuery);
$recetteStatement->execute(["id_recette" => $id]);
$recette = $recetteStatement->fetch();

$sqlquery2 = " SELECT nom_ingredient, prix_ingredient , quantite_ingredient FROM ingredient i
INNER JOIN contenir co ON co.id_ingredient = i.id_ingredient
WHERE co.id_recette = :id_recette" ;
$recetteStatement2 = $mysqlClient->prepare($sqlquery2);
$recetteStatement2->execute(["id_recette"=>$id]);

$ingredients = $recetteStatement2->fetchAll();
//var_dump($recette);die;


	} else { header("Location:recettes.php"); }

}
catch (Exception $e)
{
	die('Erreur : '.$e-> getMessage());
}
//var_dump($ingredients)
/**
 * on utlise une boucle pour affichers les élements récupérés
 */
?>

<h1><?= $recette["nom_recette"] ?></h1>
<p> Catérorie de la recette :<?= $recette["nom_categorie"]?></p>
<p> Temps de preparation :<?= $recette["temps_preparation"]?>minutes</p>
<br>
<br>
<?php


$resulte = "<table style='border-collapse:collapse;border:1px solid rgb(128,128,128)'>";
$resulte.= "<tr>";
$resulte .= "<th style='border:1px solid black;padding:12px'>Ingrédient</th>";
$resulte .="<th style='border:1px solid black;padding:12px'>Quantitée</th>";
$resulte.= "<th style='border:1px solid black;padding:12px'>Prix</th>";
$resulte.= "</tr>";
foreach($ingredients as $ingredient){

$resulte.=	"<td style='border:1px solid black;padding:12px'>".$ingredient['nom_ingredient']."</td>";
$resulte.=		"<td style='border:1px solid black;padding:12px'>". $ingredient['quantite_ingredient']."</td>";
$resulte.=	"<td style='border:1px solid black;padding:12px'>". $ingredient['prix_ingredient']."</td>";
$resulte.="</tr>";

}  

$resulte.="</table>";
echo($resulte)




?>







 


 

 
 
	
</body>
</html>