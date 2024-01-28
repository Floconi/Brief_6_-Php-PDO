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


?>
<div class="flex justify-center font-PE_libre_baskerville">
<div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
    <div class="flex ">
        <p class="w-1/4  bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">ID du favori </p>
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $favoris['id_favori'] ?></p>
    </div>
    <div class="flex">
        <p class="w-1/4 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Libelle du  favori </p>
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex  items-center"><?php echo $favoris['libelle'] ?> </p>
    </div>
    <div class="flex">
        <p class="w-1/4 h-max bg-orange-200 flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Date de création du favori </p>
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center"><?php echo $favoris['date_creation'] ?></p>
    </div>
    <div class="flex">
        <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between"><p >URL</p> <a href="<?php echo  $favoris['url']?>"><i class=" text-[#78afd8]  fa-solid fa-arrow-up-right-from-square"></i></a> </div>
        <p class="w-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center"><?php echo $favoris['url'] ?> </p>
    </div>
    <div class="flex">
        <p class="w-1/4 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Domaine associées </p>
        <p class="w-full pl-5 border-b bg-orange-100 border-black flex items-center"><?php echo $favoris['nom_domaine'] ?></p>
    </div>
    <div class="flex ">
        <p class="w-1/4 flex bg-orange-200 justify-start font-PE_libre_baskerville_italique items-center p-4 font-bold"> Catégorie associées </p>
          <p class="w-full pl-5 flex bg-orange-100 flex-col  justify-center"><?php
         $TabCatégorie = explode("|", $favoris['liste_categorie']);
                      for ($index= 0 ; $index < count($TabCatégorie); $index++){
                            $texteEnValeur ="";
                            echo "<span>".$TabCatégorie[$index]."</span>";?>
                        <?php } ?>

    </div>
    </div>







</div>
<?php include ("footer.php") ?>