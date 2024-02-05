<?php 
include("header.php");
include("pdo.php"); 


if (!empty($_POST)){

    $formulaire_soumis = true;
    $formulaireValide = true;

    if (!empty($_POST['saisie_categorie'])){
        $valeur_du_categorie = htmlspecialchars($_POST['saisie_categorie']);
        if (strlen($_POST['saisie_categorie']) > 50){
            $erreur_nom_dom = "Le nom de categorie ne doit pas exéder 50 caractères";
            $formulaireValide = false;
        }
    }else{
        $valeur_du_categorie = htmlspecialchars($categories['saisie_categorie']);
        $erreur_nom_dom = "Le nom de categorie est obligatoire";
        $formulaireValide = false;
    }

            if ($formulaireValide == true){

                    echo "hello";
        
                    $Requete_SQL_Preparation = "INSERT INTO categorie VALUES ('', :nom_categorie ) " ;
        
                    $Requete_prete = $pdo->prepare($Requete_SQL_Preparation);
        
                    $Tableau_parametre = array(
                        ':nom_categorie' =>  $_POST['saisie_categorie'],
                    );
        
        
                    $Requete_prete->execute($Tableau_parametre);

                    
                        
                    header('Location: lecture_dom_cat.php'); 

                    }
                  

                 




            
        
        
        







}else{
    $valeur_du_categorie = htmlspecialchars($categorie['nom_categorie']);
    $formulaire_soumis = false;
}
?>

    <div class="flex justify-center font-PE_libre_baskerville m-2 md:m-8">
        
        <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black  w-3/4">
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full  bg-orange-200 h-full flex  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Gérer ce favori </p><i class="fa-solid fa-gear"></i></i></div>
                <div class="flex flex-col md:flex-row justify-around items-center bg-orange-100 w-full border border-b-black">
                <form action="index.php" method="GET">
                        <button type="submit" class=" p-2 rounded m-2 bg-blue-950" >
                        <i class="text-green-600 fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
                        </button>
                    </form>
                    <form action="lecture_dom_cat.php" method="GET">
                        <button type="submit" class=" p-2 rounded m-2 bg-blue-950"  value="">
                        <i class=" text-orange-600 fa-solid fa-reply"></i><p class="text-orange-600">Annuler la modification</p>
                        </button>
                    </form>
                    <form action="supprimer.php" method="GET">
                        <button type="submit" name="id_du_favori" class="m-2 p-2 rounded bg-blue-950" value="<?php echo $categorie['id_categorie'] ?>">
                            <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i><p class="text-rose-700"> Effacer</p>
                        </button>
                    </form>
                </div>
            </div>
            <form action="" method="POST">
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
            <div class="md:w-1/4 w-full h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >ID du favori <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
                <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center">Générer automatiquement</p>
              
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full bg-orange-200 h-max flex border-b font-PE_libre_baskerville_italique  p-4 font-bold items-center justify-between"><p>Libelle du categorie <span class="text-red-600">*</span></p><i id="saisie_libelle_icone" class="fa-solid fa-pencil"></i></div>
                <div class="flex flex-col w-full ">
                    <input onkeyup="ChangerCouleurIcone_edit('saisie_libelle')" type="text" id="saisie_libelle" name="saisie_categorie" onkeyup="changercouleur_categorie_edit()" class=" w-full pl-5 border-b h-full bg-orange-100  flex  items-center" placeholder="Entrer un nom de libelle" value="<?php echo $valeur_du_categorie ?>"></input>
                    <?php if (!empty($erreur_nom_dom) && $formulaire_soumis == true ){ ?>
                            <div class="bg-red-600 flex justify-center">
                                <?php echo $erreur_nom_dom ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:mb-0 ">
                <p class="md:w-1/4 w-full hidden md:flex bg-orange-200   justify-start border-b font-PE_libre_baskerville_italique p-4 font-bold">Validation </p>
                <div class="flex justify-center item-center w-full bg-orange-100">
                    <button type="submit"  class="bg-blue-950 items-center text-orange-600 mt-2 p-6 font-PE_nunito rounded flex justify-around mr-5 mb-5" >
                        <i class="mr-4 text-orange-600 fa-solid fa-pen-clip"></i>Editer le favori 
                    </button> 
                </div>
            </div>
            
        </form>
    </div>
</div>
