<?php 
include("header.php");
include("pdo.php"); 

$id_domaine = $_GET['id_du_domaine'];

$Requete_SQL = "SELECT *
FROM domaine
WHERE id_domaine = :id_domaine;";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_domaine' => htmlspecialchars($_GET['id_du_domaine'])
);

$RequetePreparer -> execute($Tableau_parametre);



$domaine = $RequetePreparer->fetch(PDO::FETCH_ASSOC);

$Requete_SQL = "SELECT *
FROM favori
WHERE id_dom = :id_domaine;";

$RequetePreparer = $pdo->prepare($Requete_SQL);

$Tableau_parametre = array(
    ':id_domaine' => htmlspecialchars($_GET['id_du_domaine'])
);

$RequetePreparer -> execute($Tableau_parametre);



$domaine_fav = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);

$suppresion_favori = 0;
if (count($domaine_fav) == 0){
    $cacher_favori_tab = "hidden";
    $afficher_message_pas_de_sup_favori ="";

}else{
    $suppresion_favori = 1;
    $afficher_message_pas_de_sup_favori ="hidden";
    $cacher_favori_tab = "";
}

if (!empty($_POST)){
    if ($suppresion_favori == 1 ){
        echo "vrai";
        $Requete_SQL = "DELETE 
        FROM favori
        WHERE id_dom = :id_domaine;";

        $RequetePreparer = $pdo->prepare($Requete_SQL);

        $Tableau_parametre = array(
            ':id_domaine' => htmlspecialchars($_POST['id_domaine'])
        );

        $RequetePreparer -> execute($Tableau_parametre);
    }
        
    $Requete_SQL = "DELETE
    FROM domaine
    WHERE id_domaine = :id_domaine;";

    $RequetePreparer = $pdo->prepare($Requete_SQL);

    $Tableau_parametre = array(
        ':id_domaine' => htmlspecialchars($_POST['id_domaine'])
    );

    $RequetePreparer -> execute($Tableau_parametre);

    header('Location: lecture_dom_cat.php');

}


?>
<div class="flex flex-col justify-center items-center font-PE_libre_baskerville"> 
    <p> Voulez vous vraiment suprimer les données ci-dessous ?<br> <span class="flex justify-center text-red-500">Attention cette action est définitive </p>
    <div class="flex items-center">
        <form action="index.php" method="GET">
            <button type="submit"  class="m-2 p-4 h-full rounded bg-blue-950" >
                <i class="text-green-600 text-red fa-solid fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
            </button>
        </form>
        <form method="post" action="">
            <button type="submit" name="id_domaine" value="<?php echo  $id_domaine ?>" class="bg-red-950 mt-2 p-6 text-white  font-PE_nunito rounded flex justify-center " >
            SUPRIMMER
            </button>   
        </form>
    </div>
</div>
<div class="flex justify-center font-PE_libre_baskerville">
    <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
        <div class="flex ">
            <p class="w-1/4 text-red-400 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">ID du domaine</p>
            <p class=" w-full text-red-400 pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $domaine['id_domaine'] ?></p>
        </div>
        <div class="flex">
            <p class="w-1/4 text-red-400 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Libelle du  domaine </p>
            <p class=" w-full text-red-400 pl-5 border-b bg-orange-100 border-black flex  items-center"><?php echo $domaine['nom_domaine'] ?> </p>
        </div>
    </div>
</div>
<section class ="bookmark <?php echo $afficher_message_pas_de_sup_favori ?>">
    <h2 class="text-green-600 text-xl text-center bg-blue-950">Cette action n'entrainera pas de supression de favori.</h2>
</section>

<section class ="bookmark <?php echo $cacher_favori_tab ?>">
    <h2 class="text-red-600 text-xl text-center bg-blue-950 flex justify-center"> Vous allez également suprimer tout les favoris ci dessous !<br>
A cause de la règle suivante : Un favori doit posséder au minimum 1 domaine <br>
Si vous souhaitez conservez ces favoris et supprimer ce domaine : aller sur la page d'acceuil et modifier le domaine de chaque favori 
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
                Nom du domaine
            </th>
        </tr>
       
            <?php foreach ($domaine_fav as $unfavori){?>
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
                    <?php echo $domaine['nom_domaine'] ?>
                </td>

            </tr>
            <?php } ?>
        



       



    </table>



</section>
<?php include ("footer.php") ?>