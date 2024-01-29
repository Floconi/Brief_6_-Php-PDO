<?php 
include("pdo.php");
$Requete_SQL = "DELETE  FROM favori WHERE favori.id_favori =".$_GET['id_favori'] ;

$pdo->query($Requete_SQL);

header('Location: index.php');


?>