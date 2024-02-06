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
WHERE favori.id_favori = :id_favori";


$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_favori' => htmlspecialchars($_GET['id_du_favori'])
);

$RequetePreparer -> execute($Tableau_parametre);

$favoris = $RequetePreparer ->fetch(PDO::FETCH_ASSOC);


?>

<div class="flex justify-center font-PE_libre_baskerville">
    
<div class="flex" ><h2 class="text-green-600 flex font-PE_libre_baskerville_italique justify-center rounded m-auto p-4 bg-white">affichage un favori</h2></div>
<div class="informations  bg-orange-200  flex flex-col justify-center align-middle border border-black m-2 md:m-8  w-3/4">
<div class="flex flex-col md:flex-row  md:mb-0 ">
    <div class="md:w-1/4 w-full bg-orange-200 h-full flex  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Gérer ce favori </p><i class="fa-solid fa-gear"></i></i></div>
    <div class="flex md:flex-row flex-col justify-around bg-orange-100 w-full border border-b-black items-center">
        <form action="index.php" method="GET">
            <button type="submit"  class="m-2 p-2 rounded bg-blue-950" >
                <i class="text-green-600 text-red fa-solid fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
            </button>
         </form>
        <form action="modifier.php" method="GET">
                                <button class=" p-2 rounded m-2 bg-blue-950" name="id_du_favori" value="<?php echo $favoris['id_favori']?>">
                                    <i class=" text-orange-600 fa-solid fa-pen-clip"></i><p class="text-orange-600"> Modifier</p>
                                </button>
        </form>
        <form action="supprimer.php" method="GET">
            <button type="submit" name="id_du_favori" class="m-2 p-2 rounded bg-blue-950" value="<?php echo $favoris['id_favori'] ?>">
                <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i><p class="text-rose-700"> Effacer</p>
            </button>
         </form>
    </div>
</div>
    <div class="flex flex-col md:flex-row md:mb-0 ">
        <div class="md:w-1/4 w-full  bg-orange-200 h-max flex  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>ID du favori </p><i class="text-green-600 fa-brands fa-readme"></i></div>
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $favoris['id_favori'] ?></p>
    </div>
    <div class="flex flex-col md:flex-row md:mb-0 ">
        <div class="md:w-1/4 w-full bg-orange-200 h-max flex  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Libelle du  favori </p><i class=" text-green-600 fa-brands fa-readme"></i> </div>
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex  items-center"><?php echo $favoris['libelle'] ?> </p>
    </div>
    <div class="flex flex-col md:flex-row  md:mb-0 ">
        <div class="md:w-1/4 w-full h-max bg-orange-200 flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center">Date de création du favori </p><i class="text-green-600 fa-brands fa-readme"></i> </div>
        
        <p class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center"><?php echo $favoris['date_creation'] ?></p>
    </div>
    <div class="flex flex-col md:flex-row  md:mb-0 ">
        <div class="md:w-1/4 w-full  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >URL</p><div class="flex items-center justify-center"> <a class="mr-5" href="<?php echo  $favoris['url']?>"><i class=" text-[#78afd8]  fa-solid fa-arrow-up-right-from-square"></i></a><i class=" text-green-600  fa-brands fa-readme"></i> </div></div>
        <p class="w-full pl-5 border-b bg-orange-100 border-black flex  md:text-clip justify-start  items-center truncate text-clip "><?php echo $favoris['url'] ?> </p>
    </div>
    <div class="flex flex-col md:flex-row md:mb-0 ">
        <div class="md:w-1/4 w-full bg-orange-200 h-max flex  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Domaine associées </p><i class="text-green-600 fa-brands fa-readme"></i></div>
        <p class="w-full pl-5 border-b bg-orange-100 border-black flex items-center"><?php echo $favoris['nom_domaine'] ?></p>
    </div>
    <div class="flex flex-col md:flex-row  md:mb-0  ">
        <div class="md:w-1/4 w-full flex bg-orange-200 font-PE_libre_baskerville_italique items-center p-4 font-bold justify-between"><p> Catégorie associées </p><i class="text-green-600 fa-brands fa-readme"></i></div>
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