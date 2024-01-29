<?php 
include("header.php");
include("pdo.php"); 






?>
<form action="create.php" method="POST">
    <div class="flex justify-center font-PE_libre_baskerville">
    
        <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
            <!--<div class="flex ">
                <p class="w-1/4  bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">ID du favori </p>
                <input type="text" class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center"></input>
            </div>-->
            <div class="flex">
                <p class="w-1/4 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Libelle du  favori </p>
                <input type="text" name="saisie_libelle" class=" w-full pl-5 border-b bg-orange-100 border-black flex  items-center" placeholder="Entrer un nom de libelle"></input>
            </div>
            <div class="flex">
                <p class="w-1/4 h-max bg-orange-200 flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Date de création du favori </p>
                <input type="text"  name="saisie_date_creation" disabled="disabled" class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center" value="<?php echo date("d F Y")?>"></input>
            </div>
            <div class="flex">
                <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between"><p >URL</p>  </div>
                <input name="saisie_url" placeholder = "Entrer ou copier votre url..." class="w-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center"> </input>
            </div>
            <div class="flex">
                <p class="w-1/4 bg-orange-200 h-max flex justify-start border-b font-PE_libre_baskerville_italique border-black p-4 font-bold">Domaine associées </p>
                <?php 
                    $table_dom = "domaine" ;
                    $result = $pdo->query(" SELECT * 
                    FROM $table_dom 
                    ;");
                    $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                ?>  
                <select name="saisie_nom_domaine" class="w-full pl-5 border-b bg-orange-100 border-black flex items-center">
                    <option value="" class="font-PE_libre_baskerville" selected>-- Ne pas assosié un domaine -- </option>
                <?php foreach($domaine as $unDomaine) { ?>
                        <option id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                        <?php $numero_dom = $numero_dom + 1 ?>
                        <?php } ?>
                </select>
            </div>
            <div class="flex ">
                <p class="w-1/4 flex bg-orange-200 justify-start font-PE_libre_baskerville_italique items-center p-4 font-bold"> Catégorie associées </p>
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
                        <div class="flex mr-5 "> 
                            <input name="<?php echo "saisie_categorie_n°".$numero_cat ?>" type="checkbox" id="<?php echo "categor".$numero_cat ?>" >
                            <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2 font-PE_libre_baskerville" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
                        </div>
                        <?php $numero_cat = $numero_cat + 1 ?>
                    <?php }; ?>
                </div>
                </div>
            <div class="flex ">
                <p class="w-1/4  bg-orange-200  flex justify-start border-b font-PE_libre_baskerville_italique p-4 font-bold">Validation </p>
                <div class="flex justify-end w-full bg-orange-100">
                    <button type="submit" class="bg-blue-950 mt-2 text-white p-6 font-PE_nunito rounded flex justify-center mr-5 mb-5" >
                        Ajouter un favori
                    </button> 
                </div>
            
            </div>
        
    </div>
    
    </div>

   
</div>

</form>






</div>
<?php include ("footer.php") ?>