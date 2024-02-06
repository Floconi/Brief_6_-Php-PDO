<?php 
include("header.php");
include("pdo.php"); 

$id_categorie = $_GET['id_du_categorie'];

$Requete_SQL = "SELECT *
FROM categorie
WHERE id_categorie = :id_categorie;";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_categorie' => htmlspecialchars($_GET['id_du_categorie'])
);

$RequetePreparer -> execute($Tableau_parametre);



$categorie = $RequetePreparer->fetch(PDO::FETCH_ASSOC);

$Requete_SQL = "SELECT *
FROM favori_categorie
WHERE id_categorie = :id_categorie;";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_categorie' => htmlspecialchars($_GET['id_du_categorie'])
);

$RequetePreparer -> execute($Tableau_parametre);



$categorie_assosier_favori = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);



$index = 0;
$supression_favori = false;
$Tab_id_supression_favori = array ();
foreach ($categorie_assosier_favori as $unIDfavori){
    $Requete_SQL = "SELECT *
        FROM favori_categorie
WHERE id_favori = :id_favori;";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_favori' => htmlspecialchars($unIDfavori['id_favori'])
);

$RequetePreparer -> execute($Tableau_parametre);



$nomb_de_cat_unID_favori = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);

    if(count($nomb_de_cat_unID_favori) == 1){
       
        $supression_favori = true;
        $Tab_id_supression_favori[$index] = $unIDfavori['id_favori'];
        $index = $index + 1 ;
    }
}
if($supression_favori == true){
    $Tableau_parametre = array();
    $Requete_SQL = "SELECT *
    FROM favori
    INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
    INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
    INNER JOIN domaine ON domaine.id_domaine = favori.id_dom
WHERE (";
    for($index =0 ; $index < count($Tab_id_supression_favori); $index++){
        $Requete_SQL .= "favori_categorie.id_favori = :id_favori".$index;
        $Tableau_parametre += array(
            ":id_favori$index" => htmlspecialchars($Tab_id_supression_favori[$index])
        );
        if ($index != (count($Tab_id_supression_favori)-1)){
            $Requete_SQL .= " OR ";
        }

    }
    $Requete_SQL .= " )";
   


    $RequetePreparer = $pdo->prepare($Requete_SQL);
    $RequetePreparer -> execute($Tableau_parametre);
    $favori_a_suprim = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);
}



if ($supression_favori== false){
    $cacher_favori_tab = "hidden";
    $afficher_message_pas_de_sup_favori ="";

}else{
    $afficher_message_pas_de_sup_favori ="hidden";
    $cacher_favori_tab = "";
}

if (!empty($_POST)){


    if($supression_favori == true){

        $Tableau_parametre = array();
        $Requete_SQL = "DELETE 
        FROM favori WHERE (";

        for($index =0 ; $index < count($Tab_id_supression_favori); $index++){
            $Requete_SQL .= "id_favori = :id_favori".$index;
            $Tableau_parametre += array(
                ":id_favori$index" => htmlspecialchars($Tab_id_supression_favori[$index])
            );
            if ($index != (count($Tab_id_supression_favori)-1)){
                $Requete_SQL .= " OR ";
            }
    
        }
        $Requete_SQL .= " )";
       
    
    
        $RequetePreparer = $pdo->prepare($Requete_SQL);
        $RequetePreparer -> execute($Tableau_parametre);
        $favori_a_suprim = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);
    
    
        } 

  
        $Requete_SQL = "DELETE 
        FROM favori_categorie
        WHERE id_categorie = :id_categorie;";

        $RequetePreparer = $pdo->prepare($Requete_SQL);

        $Tableau_parametre = array(
            ':id_categorie' => htmlspecialchars($_POST['id_categorie'])
        );

        $RequetePreparer -> execute($Tableau_parametre);
   
        
    $Requete_SQL = "DELETE
    FROM categorie
    WHERE id_categorie = :id_categorie;";

    $RequetePreparer = $pdo->prepare($Requete_SQL);

    $Tableau_parametre = array(
        ':id_categorie' => htmlspecialchars($_POST['id_categorie'])
    );

    $RequetePreparer -> execute($Tableau_parametre);

    header('Location: lecture_dom_cat.php');
    
}



?>
<div class="flex" ><h2 class="text-green-600 flex font-PE_libre_baskerville_italique justify-center rounded m-auto p-4 bg-white">Suprimer une categorie</h2></div>
<div class="flex flex-col justify-center items-center font-PE_libre_baskerville"> 
    <p> Voulez vous vraiment suprimer les données ci-dessous ?<br> <span class="flex justify-center text-red-500">Attention cette action est définitive </p>
    <div class="flex items-center">
        <form action="index.php" method="GET">
            <button type="submit"  class="m-2 p-4 h-full rounded bg-blue-950" >
                <i class="text-green-600 text-red fa-solid fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
            </button>
        </form>
        <form method="post" action="">
            <button type="submit" name="id_categorie" value="<?php echo  $id_categorie ?>" class="bg-red-950 mt-2 p-6 text-white  font-PE_nunito rounded flex justify-center " >
            SUPRIMMER
            </button>   
        </form>
    </div>
</div>
<div class="flex justify-center font-PE_libre_baskerville">
    <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
        <div class="flex ">
            <p class="w-1/4 text-red-400 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">ID du categorie</p>
            <p class=" w-full text-red-400 pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $categorie['id_categorie'] ?></p>
        </div>
        <div class="flex">
            <p class="w-1/4 text-red-400 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Libelle du  categorie </p>
            <p class=" w-full text-red-400 pl-5 border-b bg-orange-100 border-black flex  items-center"><?php echo $categorie['nom_categorie'] ?> </p>
        </div>
    </div>
</div>
<section class ="bookmark <?php echo $afficher_message_pas_de_sup_favori ?>">
    <h2 class="text-green-600 text-xl text-center bg-blue-950">Cette action n'entrainera pas de supression de favori.</h2>
</section>

<section class ="bookmark <?php echo $cacher_favori_tab ?>">
    <h2 class="text-red-600 text-xl text-center bg-blue-950 flex justify-center"> Vous allez également suprimer tout les favoris ci dessous !<br>
A cause de la règle suivante : Un favori doit posséder au minimum 1 categorie  <br>
Si vous souhaitez conservez ces favoris et supprimer cette categorie : aller sur la page d'acceuil et modifier ou ajouter des categories  pour chaque favori 
</h2>
    <table class="flex justify-center table_favori">
        <tr class="odd:bg-white even:bg-slate-50">
            <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center">
                id du favori 
            
            </th >
            <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center">
                Libelle du favori
            </th>
            <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center">
                url
            </th>
            <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center">
                Nom du categorie
            </th>
        </tr>
       
            <?php foreach ($favori_a_suprim as $unfavori){?>
             <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200 h-max">
                <td class="border border-b-black font-PE_libre_baskerville">
                    <?php echo $unfavori['id_favori'] ?>
                </td>
                <td class="border border-b-black font-PE_libre_baskerville">
                    <?php echo $unfavori['libelle'] ?>
                </td>
                <td class="border border-b-black font-PE_libre_baskerville">
                    <?php echo $unfavori['url'] ?>
                </td>
                <td class="border border-b-black font-PE_libre_baskerville">
                    <?php echo $unfavori['nom_categorie'] ?>
                </td>

            </tr>
            <?php } ?>
        



       



    </table>



</section>
<?php include ("footer.php") ?>