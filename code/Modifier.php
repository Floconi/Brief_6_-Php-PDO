<?php 
include("header.php");
include("pdo.php"); 

$id_favori = intval($_GET['id_du_favori']);

$Requete_SQL_preparation = "SELECT 
favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,
GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
GROUP_CONCAT(categorie.nom_categorie SEPARATOR '|') as 'liste_categorie'  
FROM favori 
INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
INNER JOIN domaine ON domaine.id_domaine = favori.id_dom 
WHERE favori.id_favori = :id_favori ;";

$Requete_preparer = $pdo->prepare($Requete_SQL_preparation);

$Tableau_parametre = array(
    'id_favori' => $id_favori
);

$Requete_preparer->execute($Tableau_parametre);

// $result =  $pdo->query($Requete_SQL);
$favoris = $Requete_preparer->fetch(PDO::FETCH_ASSOC);


$Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
$result =  $pdo->query($Requete_SQL);
$nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);


if (!empty($_POST)){


    $formulaire_soumis = true;

    
    if (!empty($_POST['saisie_libelle'])){
        $valeur_du_libelle = htmlspecialchars($_POST['saisie_libelle']);
    }else{
        $valeur_du_libelle = "";
    }
    if (!empty($_POST['saisie_url'])){
        $valeur_de_url = htmlspecialchars($_POST['saisie_url']);
    }else{
        $valeur_de_url = "";
    }
    if (!empty($_POST['saisie_nom_domaine'])){
        $presence_nom_domaine = true;
        $id_dom =  htmlspecialchars($_POST['saisie_nom_domaine']);
    }else{
        $presence_nom_domaine = false;
    }


    $Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
    $result =  $pdo->query($Requete_SQL);
    $nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);

    $saisie_table_id_categorie = array();
        $index_id_cat = 0;
        for ($index = 0 ; $index < $nomb_categorie['nomb_categorie']; $index++){
            if (!empty($_POST['saisie_categorie_n°'.$index])){
                $saisie_table_id_categorie[$index_id_cat] = $_POST['saisie_categorie_n°'.$index];
                $index_id_cat = $index_id_cat + 1 ;
            };
        };

        if ($formulaire_soumis == true){

                $formulaireValide = true;
        
                if (count($saisie_table_id_categorie) == 0 ){
                    $formulaireValide = false;
                    $erreur_categorie = "Il faut sélectionner au moins une catégorie. Ceci est obligatoire";
                   
                }else{
                  $erreur_categorie = "";
                  $presence_categorie_cocher = true ;
                }
        
                
                if (!empty($_POST['saisie_libelle'])){
                    if (strlen($_POST['saisie_libelle']) > 100){
                        $erreur_libelle = "Le libelle ne doit pas exéder 100 caractères";
                        $formulaireValide = false;
                    }else{
                         $libelle =  htmlspecialchars($_POST['saisie_libelle']);
                    }
                }else{
                    $erreur_libelle = "Veuillez écrire un libéllé , ce champs est obligatoire";
                    $formulaireValide = false;
                };
        
        
               
        
        
                if (!empty($_POST['saisie_url'])){
                    $erreur_url = "";
                    if (strlen($_POST['saisie_url']) > 1000){
                        $erreur_url = "L' URL ne doit pas exéder 1000 caractères";
                        $formulaireValide = false;
                    }else{
                       
                        $url =  htmlspecialchars($_POST['saisie_url']);
                    }
                }else{
                    $erreur_url = "L'url est un champs obligatoire Veuillez saisir un lien";
                    $formulaireValide = false;
                }
        
                $domaine="";
                if (!empty($_POST['saisie_nom_domaine'])){
                    $domaine = intval($_POST['saisie_nom_domaine']);
                    $erreur_nom_dom ="";
                }/*else{
                    $erreur_nom_dom = "Veuillez choisir un domaine dans la liste déroulante ce champs est obligatoire";
                    $formulaireValide = false;
                };*/

                if ($formulaireValide == true){

                    
        
                    $Requete_SQL_Preparation = "UPDATE favori SET libelle = :libelle , url = :url , id_dom = :id_domaine WHERE id_favori = :id_favori";
        
                    $Requete_prete = $pdo->prepare($Requete_SQL_Preparation);
        
                    $Tableau_parametre = array(
                        ':libelle' => $libelle,
                        ':url' => $url,
                        ':id_domaine' => $domaine,
                        ':id_favori' => $favoris['id_favori']
                    );
        
        
                    $Requete_prete->execute($Tableau_parametre);

                    $Requete_SQL = "SELECT id_categorie   FROM categorie";
    
                    $result =  $pdo->query($Requete_SQL);
                    $categorie_base_tout = $result->fetchall(PDO::FETCH_ASSOC);

                    $tab_id_categorie_en_base = explode("|",$favoris['liste_id_cat']);

                    //print_r($tab_id_categorie_en_base);
                    //print_r($saisie_table_id_categorie);
                    
                    for($index = 0 ; $index < count($categorie_base_tout) ; $index++){
                        $Requete_SQL_Preparation ="non";
                        $Requete_SQL_Prep ="";
                        if(in_array($categorie_base_tout[$index]['id_categorie'],$saisie_table_id_categorie) == true){ // je veux cette cat
                            if(in_array($categorie_base_tout[$index]['id_categorie'],$tab_id_categorie_en_base) == true){ // possède deja en bdd
                                // ne fait rien car existe déja
                            }else{
                                $Requete_SQL_Prep = " INSERT INTO favori_categorie VALUES (:dernier_id,:id_categorie_assosier) ";
                            }
                        }else{ /** je ne veut pas cette cat */
                            if(in_array($categorie_base_tout[$index]['id_categorie'],$tab_id_categorie_en_base) == true){ // posede en bdd
                                 $Requete_SQL_Prep = "DELETE FROM favori_categorie WHERE id_favori = :dernier_id AND id_categorie = :id_categorie_assosier";
                            }else{
                               // ne fait rien car pas de ligne et non voulu
                            }
                        }
                        if ($Requete_SQL_Prep != ""){

                            $RequetePreparer = $pdo->prepare($Requete_SQL_Prep);
                        
                           
                            $Tableau_parametre = array(
                                ':dernier_id' => $favoris['id_favori'],
                                'id_categorie_assosier' => $categorie_base_tout[$index]['id_categorie']
                            );
                            
                            $RequetePreparer -> execute($Tableau_parametre);




                        }
                        
                        
                    }
                    header('Location: unfavori.php?id_du_favori='.$favoris['id_favori']);

                    /**for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                        $Requete_SQL_preparation = " UPDATE favori_categorie SET  id_categorie = :id_categorie WHERE id_favori = :id_favori" ;
        
                        $RequetePreparer = $pdo->prepare($Requete_SQL_preparation);
        
                        $Tableau_parametre = array(
                            ':id_categorie' => $saisie_table_id_categorie[$index],
                            ':id_favori' => $favoris['id_favori']
                        );
        
        
                        $RequetePreparer -> execute($Tableau_parametre);
                    }*/
                    /**$Requete_SQL = "INSERT INTO favori VALUES ('','".$libelle."','".$date."','".$url."',".$domaine.")";
                    echo $Requete_SQL;
                    $pdo->query($Requete_SQL);*/
                
                    /**$dernier_id = $pdo -> lastInsertId();
        
                    for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                        $Requete_SQL_preparation = " INSERT INTO favori_categorie VALUES (:dernier_id,:id_categorie_assosier)";
        
                        $RequetePreparer = $pdo->prepare($Requete_SQL_preparation);
        
                        $Tableau_parametre = array(
                            ':dernier_id' => $dernier_id,
                            'id_categorie_assosier' => $saisie_table_id_categorie[$index]
                        );
        
        
                        $RequetePreparer -> execute($Tableau_parametre);
                    }*/
        
        
        
                   /**  for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                       * $Requete_SQL = " INSERT INTO favori_categorie VALUES ('".$dernier_id."','".$saisie_table_id_categorie[$index]."')";
                       * $pdo->query($Requete_SQL);
                    *}
                    */
        
        
                    /**header('Location: index.php');
        
                }else{
                    echo "faux";
                }*/









            }
        }
        
        







}else{
    $formulaire_soumis = false;
    $valeur_du_libelle = $favoris['libelle'];
    $valeur_de_url = $favoris['url'];
}






 /*if (!empty($_POST['saisie_libelle'])){
        $valeur_du_libelle = htmlspecialchars($_POST['saisie_libelle']);
    }else{
        $valeur_du_libelle = "";
    }
    if (!empty($_POST['saisie_url'])){
        $valeur_du_url = htmlspecialchars($_POST['saisie_url']);
    }else{
        $valeur_du_url = "";
    }
    if (!empty($_POST['saisie_nom_domaine'])){
        $presence_nom_domaine = true;
        $id_dom =  htmlspecialchars($_POST['saisie_nom_domaine']);
    }else{
        $presence_nom_domaine = false;
    }*/


$Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
$result =  $pdo->query($Requete_SQL);
$nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);

var_dump($nomb_categorie['nomb_categorie'])
/*if ($formulaire_soumis == true){

    $formulaireValide = true;

    

    $Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
    $result =  $pdo->query($Requete_SQL);
    $nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);
    
        $index_id_cat =0;
        for ($index = 1 ; $index <= $nomb_categorie['nomb_categorie']; $index++){
            if (!empty($_POST['saisie_categorie_n°'.$index])){
            $saisie_table_id_categorie[$index_id_cat] = $index;
            $index_id_cat = $index_id_cat + 1 ;

            };
        };


        print_r( $saisie_table_id_categorie);
        if (count($saisie_table_id_categorie) == 0 ){
            $formulaireValide = false;
            $erreur_categorie = "Il faut sélectionner au moins une catégorie. Ceci est obligatoire";
           
        }else{
          $erreur_categorie = "";
          $presence_categorie_cocher = true ;
        }

        
        if (!empty($_POST['saisie_libelle'])){
            if (strlen($_POST['saisie_libelle']) > 100){
                $erreur_libelle = "Le libelle ne doit pas exéder 100 caractères";
                $formulaireValide = false;
            }else{
                 $libelle =  htmlspecialchars($_POST['saisie_libelle']);
            }
        }else{
            $erreur_libelle = "Veuillez écrire un libéllé , ce champs est obligatoire";
            $formulaireValide = false;
        };


       


        if (!empty($_POST['saisie_url'])){
            $erreur_url = "";
            if (strlen($_POST['saisie_url']) > 1000){
                $erreur_url = "L' URL ne doit pas exéder 1000 caractères";
                $formulaireValide = false;
            }else{
               
                $url =  htmlspecialchars($_POST['saisie_url']);
            }
        }else{
            $erreur_url = "L'url est un champs obligatoire Veuillez saisir un lien";
            $formulaireValide = false;
        }

        $date = date("Y-m-d");

        $domaine="";
        if (!empty($_POST['saisie_nom_domaine'])){
            $domaine = intval($_POST['saisie_nom_domaine']);
            echo gettype($domaine);
            $erreur_nom_dom ="";
        }else{
            $erreur_nom_dom = "Veuillez choisir un domaine dans la liste déroulante ce champs est obligatoire";
            $formulaireValide = false;
        };




        if ($formulaireValide == true){

            echo "VRAI §§§";

            /**$Requete_SQL_Preparation = "INSERT INTO favori VALUES ('',:libelle,:date,:url,:domaine)";

            $Requete_prete = $pdo->prepare($Requete_SQL_Preparation);

            $Tableau_parametre = array(
                ':libelle' => $libelle,
                ':date' => $date,
                ':url' => $url,
                ':domaine' => $domaine );


            $Requete_prete->execute($Tableau_parametre);
            /**$Requete_SQL = "INSERT INTO favori VALUES ('','".$libelle."','".$date."','".$url."',".$domaine.")";
            echo $Requete_SQL;
            $pdo->query($Requete_SQL);*/
        
            /**$dernier_id = $pdo -> lastInsertId();

            for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                $Requete_SQL_preparation = " INSERT INTO favori_categorie VALUES (:dernier_id,:id_categorie_assosier)";

                $RequetePreparer = $pdo->prepare($Requete_SQL_preparation);

                $Tableau_parametre = array(
                    ':dernier_id' => $dernier_id,
                    'id_categorie_assosier' => $saisie_table_id_categorie[$index]
                );


                $RequetePreparer -> execute($Tableau_parametre);
            }*/



           /**  for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
               * $Requete_SQL = " INSERT INTO favori_categorie VALUES ('".$dernier_id."','".$saisie_table_id_categorie[$index]."')";
               * $pdo->query($Requete_SQL);
            *}
            */


            /**header('Location: index.php');

        }else{
            echo "faux";
        }
       

}*/


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
                    <form action="unfavori.php" method="GET">
                        <button type="submit" class=" p-2 rounded m-2 bg-blue-950" name="id_du_favori" value="<?php echo $favoris['id_favori']?>">
                        <i class=" text-orange-600 fa-solid fa-reply"></i><p class="text-orange-600">Annuler la modification</p>
                        </button>
                    </form>
                    <form action="supprimer.php" method="GET">
                        <button type="submit" name="id_du_favori" class="m-2 p-2 rounded bg-blue-950" value="<?php echo $favoris['id_favori'] ?>">
                            <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i><p class="text-rose-700"> Effacer</p>
                        </button>
                    </form>
                </div>
            </div>
            <form action="" method="POST">
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
            <div class="md:w-1/4 w-full h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >ID du favori <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
                <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $favoris['id_favori'] ?></p>
              
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full bg-orange-200 h-max flex border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Libelle du  favori <span class="text-red-600">*</span></p><i id="saisie_libelle_icone" class="fa-solid fa-pencil"></i></div>
                <div class="flex flex-col w-full ">
                    <input onkeyup="ChangerCouleurIcone_edit('saisie_libelle')" type="text" id="saisie_libelle" name="saisie_libelle" onkeyup="changercouleur_categorie_edit()" class=" w-full pl-5 border-b h-full bg-orange-100 border-black flex  items-center" placeholder="Entrer un nom de libelle" value="<?php echo $valeur_du_libelle ?>"></input>
                    <?php if (!empty($erreur_libelle) && $formulaire_soumis == true ){ ?>
                            <div class="bg-red-600 flex justify-center">
                                <?php echo $erreur_libelle ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
            <div class="md:w-1/4 w-full  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >Date de création <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
            <?php
                    setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
                    $date = date("d-F-Y");
                    $date_fr = strftime('%d %B %Y',strtotime($date));
                    $mois = str_split(strftime('%B',strtotime($date)));
                    $tab_lettre =  ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
                    for ($index = 0 ; $index < count($mois) ; $index++){
                        if(in_array($mois[$index], $tab_lettre) == false){
                            $mois[$index] = "é";
                        }
                    }
                    $date_fr = strftime('%d',strtotime($date));
                    $date_fr .= " ";
                    $date_fr .= implode($mois);
                    $date_fr .= " ";
                    $date_fr .= strftime('%Y',strtotime($date));



                   
                 ?>
                <p type="text"  name="saisie_date_creation" disabled="disabled" class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center" value=""><?php echo $date_fr ?></p>
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >URL <span class="text-red-600">*</span></p><i id="saisie_url_icone" class="fa-solid fa-pencil"></i>  </div>
                <div class="flex flex-col w-full ">
                    <input onkeyup="ChangerCouleurIcone_edit('saisie_url')" id="saisie_url" name="saisie_url" placeholder = "Entrer ou copier votre url..." class="w-full h-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center" value="<?php echo $valeur_de_url ?>"> </input>
                    <?php if (!empty($erreur_url) && $formulaire_soumis == true ){ ?>
                            <div class="bg-red-600 flex justify-center">
                                <?php echo $erreur_url ?>
                            </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0">
                <div class="md:w-1/4 w-full bg-orange-200 h-max flex justify-between border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center"><p>Domaine associé <span class="text-red-600"> *</span></p> <i id="saisie_nom_domaine_icone" class="fa-solid fa-pencil"></i></div>
                <?php 
                    $table_dom = "domaine" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_dom 
                    ;");
                    $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>  
                <select  id="saisie_nom_domaine" name="saisie_nom_domaine" class="w-full pl-5 border-b bg-orange-100 border-black flex items-center " onchange="ChangerCouleurIcone_edit('saisie_nom_domaine')">
                    <!-- /**
                    * ! Le domaine est obligatoire (voir le MCD)
                    */
                    <!--<option value="" class="font-PE_libre_baskerville" selected>-- Ne pas assosié un domaine -- </option>-->
                    <?php $numero_dom = 1; ?>
                    <?php foreach($domaine as $unDomaine) { ?>

                        <?php
                        $selection_active ="";
                        if ($formulaire_soumis == true){
                            echo "<p>".$unDomaine['id_domaine']."</p>";
                                if($unDomaine['id_domaine'] == $id_dom ){
                                    $selection_active = "selected='selected'";
                                }else{
                                    $selection_active = "" ;
                                } 
                        }else{
                                if($unDomaine['id_domaine'] == $favoris['id_domaine'] ){
                                    $selection_active = "selected='selected'";
                                }
                        }
                           
                        
                               
                        ?>
                        <option class="" <?php echo $selection_active ?> id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                        <?php $numero_dom = $numero_dom + 1 ?>
                        <?php } ?>
                </select>
            </div>
            <div class="flex flex-col md:flex-row md:mb-0">
                <div class="md:w-1/4 w-full flex bg-orange-200 justify-between font-PE_libre_baskerville_italique items-center p-4 font-bold "><p> Catégorie associés <span class="text-red-600">*</span> </p> <i id="categorie_icone" class="fa-solid fa-pencil"></i></div>
                <?php 
                    $table_cat = "categorie" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_cat 
                    ;");
                    $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>
                <div class="flex flex-col w-full pl-5 border-b bg-orange-100  items-start">  
                    <?php  $numero_cat = 1;
                        foreach($categorie as $uneCategorie) { ?>
                        <?php
                            if($formulaire_soumis == false){
                                if (stristr($favoris['liste_categorie'],$uneCategorie['nom_categorie']) === false){
                                    $selection_cat = "";
                                }else{
                                    $selection_cat = "checked='checked'";
                                }
                            }else{
                                $selection_cat ="";
                                for($index = 0; $index < count($saisie_table_id_categorie); $index++){
                                    
                                    if ($uneCategorie['id_categorie'] == $saisie_table_id_categorie[$index]){
                            
                                        $selection_cat = "checked='checked'";
                                    }
                                }  
                            }


                        ?>
                        <div class="flex mr-5 "> 
                            <?php $nombre_de_categorie = $nomb_categorie['nomb_categorie'] ?>
                            <input <?php echo $selection_cat ?> name="<?php echo "saisie_categorie_n°".$numero_cat?>" type="checkbox"  onchange="changercouleur_categorie_edit(<?php echo $nombre_de_categorie ?>)" id="<?php echo "categorie".$numero_cat ?>"  value="<?php echo $uneCategorie['id_categorie'] ?>" >
                            <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2 font-PE_libre_baskerville" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
                        </div>
                        <?php $selection_cat = "";
                        $numero_cat = $numero_cat + 1 ?>
                    <?php }; ?>
                    <?php if (!empty($erreur_categorie) && $formulaire_soumis == true ){ ?>
                            <div class="bg-red-600 flex justify-center">
                                <?php echo $erreur_categorie ?>
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
