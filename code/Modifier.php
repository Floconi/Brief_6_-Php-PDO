<?php 
include("header.php");
include("pdo.php"); 


$Requete_SQL_preparation = "SELECT 
favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,
GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
GROUP_CONCAT(categorie.nom_categorie SEPARATOR '|') as 'liste_categorie'  
FROM favori 
INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
INNER JOIN domaine ON domaine.id_domaine = favori.id_dom 
WHERE favori.id_favori = :id_favori ;";

$Requete_preparer = $pdo->prepare($Requete_SQL_preparation)

$Tableau

$result =  $pdo->query($Requete_SQL);
$favoris = $result->fetch(PDO::FETCH_ASSOC);


?>


<form action="update.php" method="POST">
    <div class="flex justify-center font-PE_libre_baskerville">
        <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
            <div class="flex ">
            <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >ID du favori <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
                <p class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center"><?php echo $favoris['id_favori'] ?></p>
            </div>
            <div class="flex">
                <div class="w-1/4 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center justify-between"><p>Libelle du  favori <span class="text-red-600">*</span></p><i id="champ_libelle_icone" class="fa-solid fa-pencil"></i></div>
                <input type="text" name="saisie_libelle" class=" w-full pl-5 border-b bg-orange-100 border-black flex  items-center" placeholder="Entrer un nom de libelle" value="<?php echo $favoris['libelle'] ?>"></input>
            </div>
            <div class="flex">
            <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >Date de création <span class="text-red-600">*</span></p> <i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i> </div>
                <?php
                    setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
                    $date_fr = strftime('%d %B %Y',strtotime($favoris['date_creation']));

                 ?>
                <p type="text"  name="saisie_date_creation" disabled="disabled" class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center" value=""><?php echo $date_fr ?></p>
            </div>
            <div class="flex">
                <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >URL <span class="text-red-600">*</span></p><i id="champ_url_icone" class="fa-solid fa-pencil"></i>  </div>
                <input name="saisie_url" placeholder = "Entrer ou copier votre url..." class="w-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center" value="<?php echo $favoris['url'] ?>"> </input>
            </div>
            <div class="flex">
                <div class="w-1/4 bg-orange-200 h-max flex justify-between border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center"><p>Domaine associées <span class="text-red-600"> *</span></p> <i id="champ_libelle_icone" class="fa-solid fa-pencil"></i></div>
                <?php 
                    $table_dom = "domaine" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_dom 
                    ;");
                    $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>  
                <select name="saisie_nom_domaine" class="w-full pl-5 border-b bg-orange-100 border-black flex items-center">
                    <!-- /**
                    * ! Le domaine est obligatoire (voir le MCD)
                    */
                    <!--<option value="" class="font-PE_libre_baskerville" selected>-- Ne pas assosié un domaine -- </option>-->
                    <?php $numero_dom = 1; ?>
                    <?php foreach($domaine as $unDomaine) { ?>

                        <?php
                            if($unDomaine['id_domaine'] == $favoris['id_domaine']){
                                $selection_active = "selected='selected'";
                            }else{
                                $selection_active = "" ;
                            }
                         ?>
                        <option class="" <?php echo $selection_active ?> id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                        <?php $numero_dom = $numero_dom + 1 ?>
                        <?php } ?>
                </select>
            </div>
            <div class="flex ">
                <div class="w-1/4 flex bg-orange-200 justify-between font-PE_libre_baskerville_italique items-center p-4 font-bold "><p> Catégorie associées <span class="text-red-600">*</span> </p> <i id="champ_libelle_icone" class="fa-solid fa-pencil"></i></div>
                <?php 
                    $table_cat = "categorie" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_cat 
                    ;");
                    $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>
                <div class="flex flex-col w-full pl-5 border-b bg-orange-100  items-start">  
                    <?php  $numero_cat = 0;
                        foreach($categorie as $uneCategorie) { ?>
                        <?php
                            if (stristr($favoris['liste_categorie'],$uneCategorie['nom_categorie']) === false){
                                $selection_cat = "";
                            }else{
                                $selection_cat = "checked='checked'";
                            }
                        
                        ?>
                        <div class="flex mr-5 "> 
                            <input <?php echo $selection_cat ?> name="<?php echo "saisie_categorie_n°".$numero_cat ?>" type="checkbox" id="<?php echo "categorie".$numero_cat ?>" >
                            <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2 font-PE_libre_baskerville" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
                        </div>
                        <?php $numero_cat = $numero_cat + 1 ?>
                    <?php }; ?>
                </div>
            </div>
            <div class="flex ">
                <p class="w-1/4  bg-orange-200  flex justify-start border-b font-PE_libre_baskerville_italique p-4 font-bold">Validation </p>
                <div class="flex justify-center item-center w-full bg-orange-100">
                    <button type="submit"  class="bg-blue-950 items-center text-orange-600 mt-2 p-6 font-PE_nunito rounded flex justify-around mr-5 mb-5" >
                        <i class="mr-4 text-orange-600 fa-solid fa-pen-clip"></i>Editer le favori 
                    </button> 
                </div>
            </div>
        </div>
    </div>
</form>