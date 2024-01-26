<?php 
include("header.php");
include("pdo.php"); 


$Requete_SQL = "SELECT 
favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,
GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
GROUP_CONCAT(categorie.nom_categorie SEPARATOR '|') as 'liste_categorie'  
FROM favori 
INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
INNER JOIN domaine ON domaine.id_domaine = favori.id_dom 
WHERE favori.id_favori =".$_GET['id_du_favori'].";";

$result =  $pdo->query($Requete_SQL);
$favoris = $result->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($favoris);
echo "<pre>";

?>

<div class="informations">
    <div class="flex ">
        <p class="w-1/4"> ID du favori </p>
        <p> <?php echo $favoris['id_favori'] ?></p>
    </div>
    <div class="flex">
        <p class="w-max 1/4"> Libelle du  favori </p>
        <p> <?php echo $favoris['libelle'] ?> </p>
    </div>
    <div class="flex">
        <p class="w-1/2"> Date de création favori </p>
        <p><?php echo $favoris['date_creation'] ?></p>
    </div>
    <div class="flex">
        <p class="w-1/2"> URL  </p>
        <p><?php echo $favoris['url'] ?> </p>
    </div>
    <div class="flex">
        <p class="w-1/2"> Catégorie associée </p>
        <p> <?php echo $favoris['nom_domaine'] ?></p>
    </div>
    <div class="flex">
        <p class="w-1/2"> Domaine associée </p>
          <p class="flex flex-col"><?php
         $TabCatégorie = explode("|", $favoris['liste_categorie']);
                      for ($index= 0 ; $index < count($TabCatégorie); $index++){
                            $texteEnValeur ="";
                            echo "<span>".$TabCatégorie[$index]."</span>";?>
                        <?php } ?>

    </div>







</div>