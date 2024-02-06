<?php 
include("header.php");
include("pdo.php"); 


if (!empty($_POST)){

    $formulaire_soumis = true;
    $formulaireValide = true;

    if (!empty($_POST['saisie_domaine'])){
        $valeur_du_domaine = htmlspecialchars($_POST['saisie_domaine']);
        if (strlen($_POST['saisie_domaine']) > 50){
            $erreur_nom_dom = "Le nom de domaine ne doit pas exéder 50 caractères";
            $formulaireValide = false;
        }
    }else{
        $valeur_du_domaine = "";
        $erreur_nom_dom = "Le nom de domaine est obligatoire";
        $formulaireValide = false;
    }

            if ($formulaireValide == true){

                    echo "hello";
        
                    $Requete_SQL_Preparation = "INSERT INTO domaine VALUES ('', :nom_domaine ) " ;
        
                    $Requete_prete = $pdo->prepare($Requete_SQL_Preparation);
        
                    $Tableau_parametre = array(
                        ':nom_domaine' =>  $_POST['saisie_domaine'],
                    );
        
        
                    $Requete_prete->execute($Tableau_parametre);

                    
                        
                    header('Location: lecture_dom_cat.php'); 

                    }
                  

                 




            
        
        
        







}else{
    $valeur_du_domaine = "";
    $formulaire_soumis = false;
}
?>

<div class="flex" ><h2 class="text-green-600 flex font-PE_libre_baskerville_italique justify-center rounded m-auto p-4 bg-white">Ajouter un domaine</h2></div>
    <form action="index.php" method="GET" class="flex justify-center">
                        <button type="submit" class=" p-2 rounded m-2 bg-blue-950" >
                        <i class="text-green-600 fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
                        </button>
                    </form>
        
                    <div class="flex justify-center font-PE_libre_baskerville m-2 md:m-8">
        
        <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black  w-3/4">
            <form action="" method="POST">
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
            <div class="md:w-1/4 w-full h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >ID du favori <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
                <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center">Générer automatiquement</p>
              
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full bg-orange-200 h-max flex border-b font-PE_libre_baskerville_italique  p-4 font-bold items-center justify-between"><p>Libelle du domaine <span class="text-red-600">*</span></p><i id="saisie_libelle_dom_icone" class="fa-solid fa-pencil"></i></div>
                <div class="flex flex-col w-full ">
                    <input onkeyup="ChangerCouleurIcone('saisie_libelle_dom')" type="text" id="saisie_libelle_dom" name="saisie_domaine"  class=" w-full pl-5 border-b h-full bg-orange-100  flex  items-center" placeholder="Entrer un nom de libelle" value="<?php echo $valeur_du_domaine ?>"></input>
                    <?php if (!empty($erreur_nom_dom) && $formulaire_soumis == true ){ ?>
                            <div class="bg-red-600 flex justify-center">
                                <?php echo $erreur_nom_dom ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:mb-0 ">
                <p class="md:w-1/4 w-full  md:flex bg-orange-200   border-b font-PE_libre_baskerville_italique p-4 font-bold flex justify-center items-center">Validation </p>
                <div class="flex justify-center item-center w-full bg-orange-100">
                    <button type="submit"  class="bg-blue-950 items-center text-green-600 mt-2 p-6 font-PE_nunito rounded flex justify-around mr-5 mb-5" >
                    <div class=" text-center mr-5">
                    <i class="fa-solid fa-plus flex text-center"></i> 
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                    Ajouter un domaine
                    </button> 
                </div>
            </div>
            
        </form>
    </div>
</div>
