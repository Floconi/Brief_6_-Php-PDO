<?php 
include("header.php");
include("pdo.php"); 


if (!empty($_POST)){

    $formulaire_soumis = true;
}else{
    $formulaire_soumis = false;
   
}
 if (!empty($_POST['saisie_libelle'])){
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
        echo "travi".$id_dom;
    }else{
        $presence_nom_domaine = false;
    }


$saisie_table_id_categorie = array();
$presence_categorie_cocher = false;

$Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
$result =  $pdo->query($Requete_SQL);
$nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);

if ($formulaire_soumis == true){

    $formulaireValide = true;

    

    $Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
    $result =  $pdo->query($Requete_SQL);
    $nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);
    
        $index_id_cat =0;
        for ($index = 1 ; $index <= $nomb_categorie['nomb_categorie']; $index++){
            if (!empty($_POST['saisie_categorie_n°'.$index])){
            $saisie_table_id_categorie[$index_id_cat] = $_POST['saisie_categorie_n°'.$index];
            $index_id_cat = $index_id_cat + 1 ;

            };
        };

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

            $Requete_SQL_Preparation = "INSERT INTO favori VALUES ('',:libelle,:date,:url,:domaine)";

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
        
            $dernier_id = $pdo -> lastInsertId();

            print_r($saisie_table_id_categorie);

            for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                $Requete_SQL_preparation = " INSERT INTO favori_categorie VALUES (:dernier_id,:id_categorie_assosier)";

                $RequetePreparer = $pdo->prepare($Requete_SQL_preparation);

                $Tableau_parametre = array(
                    ':dernier_id' => $dernier_id,
                    'id_categorie_assosier' => $saisie_table_id_categorie[$index]
                );


                $RequetePreparer -> execute($Tableau_parametre);
            }



           /**  for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
               * $Requete_SQL = " INSERT INTO favori_categorie VALUES ('".$dernier_id."','".$saisie_table_id_categorie[$index]."')";
               * $pdo->query($Requete_SQL);
            *}
            */


            header('Location: index.php');

        }else{
        }
       

}





    /**function VerificationObligatoire($nom_du_champ){
        if (!empty($_POST($nom_du_champ))){
            $nom_du_champ = $_POST($nom_du_champ
        }else{
            $erreur
        }
    }*/

   




?>

<?php// if ( 1==1 ){ ?>

<div class="flex" ><h2 class="text-green-600 flex font-PE_libre_baskerville_italique justify-center rounded m-auto p-4 bg-white">Ajouter un favori</h2></div>
<form action="index.php" method="GET" class="flex justify-center">
            <button type="submit"  class="m-2 p-2 rounded bg-blue-950" >
                <i class="text-green-600 text-red fa-solid fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
            </button>
         </form>
<form action="" method="POST">

    <div class="flex  md:justify-center font-PE_libre_baskerville ">
    
        <div class="informations flex flex-col  md:justify-center w-full align-middle border border-black m-2 md:m-8 md:w-3/4">
            <div class="flex flex-col md:flex-row mb-5 md:mb-0 ">
                <div class="md:w-1/4 w-full  bg-orange-200 h-max flex justify-between border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center"><p>ID du favori <span class="text-red-600">*</span></p><i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i></div>
                <p type="text" class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-center md:justify-start items-center ">Générer automatiquement</p>
            </div>
            <div class="flex flex-col mb-5 md:mb-0">
                <div class="flex flex-col md:flex-row  ">
                    <div class="md:w-1/4 w-full bg-orange-200 h-max flex border-b font-PE_libre_baskerville_italique border-black p-4 font-bold justify-between items-center"><p>Libelle du  favori <span class="text-red-600">*</span></p><i id="champ_libelle_icone" class="fa-solid fa-pencil"></i> </div>
                    <input type="text" name="saisie_libelle" class=" w-full pl-5 pr-5 border-b bg-orange-100 border-black flex  items-center h-10 md:h-auto" onkeyup="ChangerCouleurIcone('champ_libelle')" placeholder="Entrer un nom de libelle" id="champ_libelle" value="<?php echo $valeur_du_libelle ?>"></input>
                </div>
                    <?php if (!empty($erreur_libelle) && $formulaire_soumis == true ){ ?>
                    <div class="bg-red-600 flex justify-center">
                        <?php echo $erreur_libelle ?>
                    </div>
                <?php } ?>
            </div>
            <div class="flex flex-col md:flex-row mb-5 md:mb-0 ">
                <div class="md:w-1/4 w-full h-max bg-orange-200 flex justify-between border-b font-PE_libre_baskerville_italique items-center border-black p-4 font-bold"><p>Date de création du favori <span class="text-red-600">*</span></p><i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i></div>
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
                <input type="text"  name="saisie_date_creation" disabled="disabled" class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center font-sans text-center md:text-start " value="<?php echo $date_fr ?>"></input>
            </div>
            <div class="flex flex-col mb-5 md:mb-0">
                <div class="flex flex-col md:flex-row  ">
                    <div class="md:w-1/4 w-full  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >URL <span class="text-red-600">*</span></p><i id="champ_url_icone" class="fa-solid fa-pencil"></i></div>
                    <input id="champ_url" name="saisie_url" placeholder = "Entrer ou copier votre url..." class="w-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center h-10 pr-5 md:h-auto"  onkeyup="ChangerCouleurIcone('champ_url')" value ="<?php echo $valeur_du_url ?>"> </input>
                </div>
                    <?php if (!empty($erreur_url) && $formulaire_soumis == true ){ ?>
                        <div class="bg-red-600 flex justify-center">
                            <?php echo $erreur_url ?>
                        </div>
                <?php } ?>
            </div>
            <div class="flex flex-col  mb-5 md:mb-0 ">
                <div class=" flex flex-col md:flex-row ">
                    <div class="md:w-1/4 w-full bg-orange-200 h-max flex fle  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold justify-between items-center"><p>Domaine associé <span class="text-red-600">*</span></p><i id="saisie_nom_domaine_icone" class="fa-solid fa-pencil"></i></div>
                        <?php 
                            $table_dom = "domaine" ;
                            $result = $pdo->query(" SELECT * 
                            FROM $table_dom 
                            ;");
                            $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                            $numero_dom =1;
                            if ($presence_nom_domaine == true){
                                $couleur_selection = "couleur-noir-custom";
                            }else{
                                $couleur_selection = "";
                            }
                        ?> 
                        <select id="saisie_nom_domaine" name="saisie_nom_domaine" class="w-full pl-0 md:pl-5 border-b bg-orange-100 border-black flex items-center text-[#9caabc] <?php echo $couleur_selection ?> h-10  md:h-auto md:text-base text-sm" onchange="changercouleurtexteselect(),ChangerCouleurIcone('saisie_nom_domaine')">
                            <option value="" class="font-PE_libre_baskerville text-[#9caabc]" selected>--choisisez un domaine--</option>
                            <?php $selection_nom_dom ="" ?>
                            <?php foreach($domaine as $unDomaine) { ?>
                                <?php if ($presence_nom_domaine == true){
                                    if ($id_dom == $unDomaine['id_domaine'] ){
                                        $selection_nom_dom = "selected=selected";
                                    }else{
                                        $selection_nom_dom = "";
                                    }
                                }
                                ?>
                            
                                <option <?php echo $selection_nom_dom ?>  id="<?php echo "domaine_n°".$numero_dom ?>" class="text-black" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                                <?php $numero_dom = $numero_dom + 1 ?>
                                <?php } ?>
                        </select>
                </div>
                        <?php if ( !empty($erreur_nom_dom) && $formulaire_soumis == true ){ ?>
                        <div class="bg-red-600 flex justify-center">
                            <?php echo $erreur_nom_dom ?>
                        </div>
                    <?php } ?>
                    </div>
                    
            <div class="flex flex-col md:flex-row ">
                <div class="md:w-1/4 w-full flex bg-orange-200  font-PE_libre_baskerville_italique items-center p-4 font-bold justify-between"><p> Catégorie associées <span class="text-red-600">*</span></p><i id="categorie_icone" class="fa-solid fa-pencil"></i></div>
                <?php 
                    $table_cat = "categorie" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_cat 
                    ;");
                    $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>
                <div class="flex flex-col w-full pl-5  bg-orange-100  items-start">  
                    <?php  $numero_cat = 1;
                        foreach($categorie as $uneCategorie) { 
                            $case_cocher = "";
                            if ($presence_categorie_cocher == true){
                                $case_cocher = "";
                                for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                                    if ($uneCategorie['id_categorie'] == $saisie_table_id_categorie[$index]){
                                        $case_cocher = "checked=checked";
                                    }
                                }
                            }
                            
                            
                            ?>
                        <div class="flex mr-5 "> 
                            <input <?php echo  $case_cocher ?> name="<?php echo "saisie_categorie_n°".$numero_cat ?>" value="<?php echo  $uneCategorie['id_categorie']?>" type="checkbox" id="<?php echo "categorie".$numero_cat ?>" onchange="changercouleur_categorie(<?php echo $nomb_categorie['nomb_categorie']?>)" >
                            <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2 font-PE_libre_baskerville" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
                        </div>
                        <?php $numero_cat = $numero_cat + 1 ?>
                    <?php }; ?>
                    <?php if ( !empty($erreur_categorie) && $formulaire_soumis == true ){ ?>
                        <div class="bg-red-600 flex justify-center">
                            <?php echo $erreur_categorie ?>
                        </div>
                    <?php } ?>
                </div>
                </div>
            <div class="flex flex-col md:flex-row ">
                <p class="w-1/4 hidden md:flex  bg-orange-200   justify-center border-b font-PE_libre_baskerville_italique p-4 font-bold items-center">Validation </p>
                <div class="flex  justify-center w-full bg-orange-100 ">
                    <button type="submit" class="bg-blue-950 md:mt-2  text-white p-6 font-PE_nunito rounded flex justify-center mx-5 my-5  items-center" >
                    <i class="fa-solid fa-plus flex text-center m-1 text-green-600"></i> 
                    <i class="fa-solid fa-book-bookmark m-1 font text-green-600"></i><p class="m-1 font-PE_libre_baskerville_gras  text-green-600">Ajouter un favori<p>
                    </button> 
                </div>
            
            </div>
        
    </div>
    
    </div>

   
</div>

</form>


<?php // }


 ?>






</div>
<?php include ("footer.php") ?>