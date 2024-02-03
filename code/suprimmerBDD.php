<?php 
include("pdo.php");
$Requete_SQL = "DELETE  FROM favori WHERE favori.id_favori = :id_favori ";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_favori' => htmlspecialchars($_GET['id_favori'])
);

$RequetePreparer -> execute($Tableau_parametre);



/* header('Location: index.php');*/


?>