<?php 

if (isset($_GET['filtre_domaine'])){
  
}


?>
<?php
  include("header.php");
  include("pdo.php"); 

  // Affichage (SELECT) :
?>
  
 
  <section class=" bg-gray-400  filtre flex flex-col justify-center m-8 p-5">
    <form  method="get" action="index.php"> 
       
      <div class="flex partie-Filtre-données flex-col">
        <h2 class="flex justify-center underline">
          Filtres sur les données 
        </h2>
        <div class="flex justify-center">
          <?php 
            $table_cat = "categorie" ;
            $result = $pdo->query(" SELECT * 
            FROM $table_cat 
            ;");
            $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
          ?>
          <fieldset id="categorie_filtre" class="flex  border border-black p-4 m-4 rounded">
            <legend class="text-center border border-black rounded p-4">
              <?php 
                $table_cat = " FILTRE sur ".ucfirst($table_cat)."s "; 
                echo $table_cat;
              ?>
            </legend>
            <div class="flex flex-col">  
              <?php
                $numero_cat = 1;
                foreach($categorie as $uneCategorie) { ?>
                  <div class="flex "> 
                    <input name="<?php echo "categorie_n°".$numero_cat ?>" type="checkbox" id="<?php echo "categor".$numero_cat ?>" >
                    <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
                  </div>
                  <?php $numero_cat = $numero_cat + 1 ?>
                <?php };
                $numero_cat_max = $numero_cat;
              ?>   
              <?php 
                $numero_cat = 1;
                foreach ($categorie as $uneCategorie){ ?>
                  <!--<select id="<?php echo "categorie_n°".$numero_cat ?>" name="<?php echo "flitre_categorie_n°".$numero_cat ?>">
                  <?php
                    $numero_dom = 1;
                    foreach($categorie as $uneCategorie) { ?>
                      <option  id="<?php echo "categorie_n°".$numero_cat ?>" value="<?php echo $uneCategorie['id_categorie'] ?>" ><?php //echo $uneCategorie['nom_categorie'] ?></option>
                    <?php } 
                  ?> 
                  <?php  
                    $numero_cat = $numero_cat + 1 
                  ?>
                  </select>-->
                <?php } 
              ?>
            </div>

            <div class="">
              <h3> Conditions entre les catégories  : <h3>
              <div>
                <input type="radio" id="ou_categorie" name="condition_categorie" value="ou" checked />
                <label for="oucategorie">OU  </label>
              </div>
              <div>
                <input type="radio" id="et_categorie" name="condition_categorie" value="et" />
                <label for="etcategorie">ET</label>
              </div>
            </div>     
          </fieldset>
          <?php 
            $table_dom = "domaine" ;
            $result = $pdo->query(" SELECT * 
            FROM $table_dom 
            ;");
            $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
          ?>  
          <fieldset class="flex flex-col border border-black p-4 m-4 justify-center rounded ">
            <legend class="flex justify-center text-center border border-black rounded p-4"> 
              FILTRE sur Domaine 
            </legend>
            <select id="selection_dom" name="filtre_domaine" class="mb-4">
              <option value="aucun" selected>-- Tous les Domaines -- </option>
              <?php
                $numero_dom = 1;
                foreach($domaine as $unDomaine) { ?>
                  <option id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                  <?php $numero_dom = $numero_dom + 1 ?>
                <?php } 
              ?>
            </select>
            <p>Condition de sélection  entre le(s) catégorie(s) et le domaine:</p>
            <div>
              <input type="radio" id="ou_categorie_dom" name="condition_categorie_dom" value="ou" checked />
              <label for="ou_categorie_dom">OU </label>
            </div>
            <div>
              <input type="radio" id="et_categorie_dom" name="condition_categorie_dom" value="et" />
              <label for="et_categorie_dom">ET </label>
            </div> 
          </fieldset>
        </div>
      </div>
        
       
      
      <?php /* Partie de filtre sur l'afichage */ ?>

      <div class="Filtre_sur_l'affichage">
        <h2 class="flex justify-center underline"> 
          FILTRE sur l'affichage 
        </h2>
          
        <div class="flex justify-around">
          <fieldset class = "flex justify-center border border-black  rounded"> 
            <?php 
              $nom_table = "favori"
            ?> 
            <legend  class="bg-green-600 text-white p-2 rounded   ml-4 " >
              <?php echo $nom_table; ?>
            </legend>
            <div class = "m-8 flex flex-col w-max">
              <?php 

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone= $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                $Tab_nom_de_collone = array();
                $index_affichage = 0;
                foreach ($collone as $uneCollone){ 
                  $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?> 
                  <input type="hidden" name="<?php echo $id_du_bouton ?>"  id="btn_cacher<?php echo $id_du_bouton ?>"  class="bg-blue-950 text-white p-2 mb-5 rounded "  value ="off"></input>
                  <input type="button"  id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded " onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')"  value ="<?php echo $uneCollone['Field'] ?>"></input>
                  <?php 

                    $index = $index +1;
                    $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                    $index_affichage = $index_affichage + 1;
                }
                $nomb_col_max_favori = $index;

                
              ?>
            </div>
          </fieldset>
          <fieldset class = "flex justify-center border border-black rounded "> 
            <?php 
            $nom_table = "domaine"
            ?>
            <legend type="button" class="bg-green-600 text-white p-2 rounded ml-4">
            <?php echo $nom_table; ?>
            </legend>
            <div class = "m-8 flex flex-col w-max">
              <?php 
               

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone = $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                foreach ($collone as $uneCollone){ 
                  $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?>
                   <input type="hidden" name="<?php echo $id_du_bouton ?>"  id="btn_cacher<?php echo $id_du_bouton ?>"  class="bg-blue-950 text-white p-2 mb-5 rounded "  value ="off"></input>
                  <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')"  value ="off"><?php echo $uneCollone['Field'] ?></button>
                <?php 
                $index = $index +1;
                  
                  $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                  $index_affichage = $index_affichage + 1;
                
                }
                $nomb_col_max_domaine = $index;
              ?>
            </div>
          </fieldset>
          <fieldset class = "flex justify-center border border-black rounded"> 
            <?php 
              $nom_table = "categorie"
            ?>
            <legend  class="bg-green-600 text-white p-2  ml-4 rounded" onclick="changerEtatBoutton()">
              <?php echo $nom_table; ?>
            </legend>
            <div class = "m-8 flex flex-col w-max">
              <?php 
                

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone = $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                foreach ($collone as $uneCollone){ 
                  $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?> 
                   <input type="hidden" name="<?php echo $id_du_bouton ?>"  id="btn_cacher<?php echo $id_du_bouton ?>"  class="bg-blue-950 text-white p-2 mb-5 rounded "  value ="off"></input>
                  <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')" value ="off"><?php echo $uneCollone['Field'] ?></button>

                  <?php $index = $index +1;
            
                    $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                    $index_affichage = $index_affichage + 1;

                }
                $nomb_col_max_categorie = $index;

              ?>

            </div>
          </fieldset>
          
          <div class="flex flex-col justify-around">
            <fieldset class="flex justify-center border border-black items-center rounded p-5">
              <legend class="border border-black flex text-center rounded p-4"> 
                Limitation  
              </legend>
                <select name="Limite" class="h-5">
                  <option value = "Tout">-- Tous -- </option> 
                  <option value = "1">1</option>
                  <option value = "5">5</option>
                  <option value = "10">10</option>
                  <option value = "30">30</option>
                </select>
            </fieldset>
            <fieldset class="flex justify-around flex-col border border-black items-center rounded p-5">
              <legend class=" border border-black flex text-center rounded p-4 ">Ordonée par collone</legend>
              <select name="ordre_affichage" class="h-5">
                  <option value = "">-- Ne pas Ordonée -- </option> 
                  <option value = "id_favori">id_favori</option>
                  <option value = "libelle">libelle</option>
                  <option value = "date_creation">date_creation</option>
                  <option value = "url">url</option>
                  <option value = "nom_domaine">nom_domaine</option>
                  <option value = "liste_Categorie">liste_Categorie</option>
              </select>
              <div class="flex mt-10 justify-between">
                <input type="hidden" id="btn_cacher_ordre_ASC" name="Ordre_ASC"   class="bg-blue-950 text-white p-2 mb-5 rounded " value ="on"></input>
                <button type="button" id="ordre_ASC" class=" text-white p-2 mb-5 rounded boutton_affichage_selectionner mr-4"  onclick="changerEtatBoutton_ordre('ordre_ASC')" value ="on">A -> Z</button>
                <input type="hidden" id="btn_cacher_ordre_DESC" name="Ordre_DESC"   class="bg-blue-950 text-white p-2 mb-5 rounded " value ="off"></input>
                <button type="button" id="ordre_DESC" class="bg-blue-950 text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton_ordre('ordre_DESC')" value ="off"> Z -> A </button>
              <div>

            </fieldset>
          </div>
        </div>
      </div>   
      <div class="flex items-center justify-evenly mt-5">
        <fieldset class = "flex flex-col justify-center w-1/2 border border-black items-center p-4 rounded">
          <legend class="text-center border border-black rounded p-4"> 
            Barre de recherche 
          </legend>
          <input type="search" name="Rechercher" id="default-search" class="block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white  h-10" placeholder="Recherche par libelle..." >
        </fieldset>
        <button type="submit" class="bg-blue-950 text-white p-6  rounded flex justify-center " >
          Appliquer les filtres
        </button> 
      </div>  
    </form>
  </section>
    
      
      

          
              

                <!--<div class="flex"> 
                <input type="radio" name="domaine" id="<?php //echo "domaine_n°".$numero_dom ?>" >
                <label id="<?php// echo "Label_domaine_n°".$numero_dom ?>" class="ml-2" for="<?php //echo "domaine_n°".$numero_dom ?>"><?php// echo $unDomaine['nom_domaine'] ?></label>
                </div>
                <?php// $numero_dom = $numero_dom + 1 ?>
              <?php// } ?>-->
          

          


          


  <!-- Zone de gestion de la requete en fonction des filtres -->
  <?php 
    
  



    $index = 1;
    $index_id_cat = 0;
    $table_id_categorie = array();

    for ($index = 1 ; $index <= $numero_cat_max ; $index++){
      if (isset($_GET['categorie_n°'.$index])){
        $table_id_categorie[$index_id_cat] = $index;
        $index_id_cat = $index_id_cat + 1 ;

      };
    };
 
   
   
      $index_affichage = 0;
      $Tab_affichage = array();
      $FiltreSurAffichage = false;
    for ($index = 0; $index < $nomb_col_max_favori ; $index++){
      if (isset($_GET['favori_colonne_n°'.$index])){
          if($_GET['favori_colonne_n°'.$index] == "on"){
            $Tab_affichage[$index_affichage] = "on";
            $FiltreSurAffichage = true;
          }else{
            $Tab_affichage[$index_affichage] = "off";
          }

      }
        $index_affichage = $index_affichage +1;
    }

    for ($index = 0; $index < $nomb_col_max_domaine ; $index++){
      if (isset($_GET['domaine_colonne_n°'.$index])){
          if($_GET['domaine_colonne_n°'.$index] == "on"){
            $Tab_affichage[$index_affichage] = "on";
            $FiltreSurAffichage = true;
          }else{
            $Tab_affichage[$index_affichage] = "off";
          }

      }
        $index_affichage = $index_affichage +1;
    }


    for ($index = 0; $index < $nomb_col_max_categorie ; $index++){
      if (isset($_GET['categorie_colonne_n°'.$index])){
          if($_GET['categorie_colonne_n°'.$index] == "on"){
            $Tab_affichage[$index_affichage] = "on";
            $FiltreSurAffichage = true;
          }else{
            $Tab_affichage[$index_affichage] = "off";
          }

      }
        $index_affichage = $index_affichage +1;
    }

    if($FiltreSurAffichage == false){
      $Tab_affichage[0] = "on";
      $Tab_affichage[1] = "on";
      $Tab_affichage[2] = "on";
      $Tab_affichage[3] = "on";
      $Tab_affichage[6] = "on";
      $Tab_affichage[8] = "on";
      $FiltreSurAffichage = true;





    }

     
    


    

    $presence_limite = false;
    if (isset($_GET['Limite'])){
      if ($_GET['Limite'] != "Tout"){
        $Résultat_limite = $_GET['Limite'];
        $presence_limite = true;
      }

  }

  $filtre_ordre = false;
  $collone_filtre_ordre ="";
  if(!empty($_GET['ordre_affichage'])){
    $filtre_ordre = true;
    $collone_filtre_ordre = $_GET['ordre_affichage'];

    if ($_GET['Ordre_ASC'] == "on"){
      $Ordre_croissant_decroissant = "ASC";
      $affichage_ordre = "(A->Z)";
    }else{
      $Ordre_croissant_decroissant = "DESC";
      $affichage_ordre = "(Z->A)";
    }
  }
 



  $presence_recherche = false;
  if (!empty($_GET['Rechercher'])){
      
  
      $Résultat_recherche = $_GET['Rechercher'];

      $presence_recherche = true;
    

  }

    
    if (isset($_GET['condition_categorie'])){
        if ($_GET['condition_categorie'] == "ou"){
          $condition_categorie = "OR";
        }else{
          $condition_categorie = "AND";
        }; 

    }

    if(isset($_GET['condition_categorie_dom'])){
      if ($_GET['condition_categorie_dom'] == "ou"){
      $condition_categorie_dom = "OR";
      }else{
        $condition_categorie_dom = "AND";
      };
    }

    for ($index = 0; $index < count($Tab_nom_de_collone) ; $index++){
      if ($Tab_nom_de_collone[$index] == "id_categorie"){
        $Tab_nom_de_collone[$index] = "liste_id_cat";
      }
      if ($Tab_nom_de_collone[$index] == "nom_categorie" ){
        $Tab_nom_de_collone[$index] = "liste_categorie";
      }
    }
 
   


    $Requete_SQL = "SELECT 
      favori.id_favori, favori.libelle, favori.date_creation, favori.url, favori.id_dom,
      domaine.id_domaine, domaine.nom_domaine,
      GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
      GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as liste_categorie 
      FROM favori "; /* Début création de la requete sql */
    $filtre = false;
    $filtre_cat = false;
    $filtre_dom = false; 
    $Requete_SQL .= 
    "INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
     INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
     INNER JOIN domaine ON domaine.id_domaine = favori.id_dom ";
    
    if (count($table_id_categorie) != 0){
    
      $filtre_cat = true;
    };

    if(isset($_GET['filtre_domaine'])){
      if ($_GET['filtre_domaine'] != "aucun"){
        
        $filtre_dom = true;
      }
    }

    if($filtre_cat == true || $filtre_dom == true || $presence_recherche == true){
   
      $Requete_SQL .= "WHERE";
    }


    if ($presence_recherche == true ){

      $Requete_SQL .= " libelle LIKE '%".$Résultat_recherche."%'"; 
      
      if ( $filtre_dom  == true || $filtre_cat == true){
      $Requete_SQL .= " OR ";


    }
    }
  

    
    for ($index = 0 ; $index < count($table_id_categorie); $index++){
    if (count($table_id_categorie) >=2 && $index == 0){
          $Requete_SQL = $Requete_SQL." ( ";
      };   
      $Requete_SQL = $Requete_SQL." categorie.id_categorie = ".$table_id_categorie[$index]." ";

      if ($index != count($table_id_categorie)-1 ){
        $Requete_SQL = $Requete_SQL."OR";
        
      }

      if ( count($table_id_categorie) >=2 && $index == count($table_id_categorie)-1){
        $Requete_SQL = $Requete_SQL." ) ";

      }
    }

    if($filtre_cat == true && isset($_GET['filtre_domaine']) ){
      if ($_GET['filtre_domaine'] != "aucun"){
        $Requete_SQL = $Requete_SQL.$condition_categorie_dom;
      }
    
    }
    if (isset($_GET['filtre_domaine'])){
      if ($_GET['filtre_domaine'] != "aucun"){
        $Requete_SQL = $Requete_SQL." domaine.id_domaine = ".$_GET['filtre_domaine'];
      }
    }
    
    
    

    $Requete_SQL .= " GROUP BY favori.id_favori ORDER BY ";

    if ($filtre_ordre == true){
      $Requete_SQL .= $collone_filtre_ordre." ".$Ordre_croissant_decroissant;
    }else{
      $Requete_SQL .= "favori.id_favori ASC";
    }
    
    
    if ($presence_limite == true ){
      $Requete_SQL .= " LIMIT ". $Résultat_limite;
    }
    $Requete_SQL .= " ; "; /* FIN de l'instruction SQL */




    $Requete_SQL_defaut = "SELECT favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as 'liste_categorie' FROM favori INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie INNER JOIN domaine ON domaine.id_domaine = favori.id_dom GROUP BY favori.id_favori ORDER BY favori.id_favori ASC";

    
    $result_defaut =  $pdo->query($Requete_SQL_defaut);
    $favoris_defaut = $result_defaut->fetchAll(PDO::FETCH_ASSOC);
    
    

  /*if ((isset($_GET['filtre_domaine'])) ) {
    if ($_GET['filtre_domaine'] != "aucun"){
      $Requete_SQL = $Requete_SQL."INNER JOIN domaine ON domaine.id_domaine = favori.id_dom  WHERE domaine.id_domaine = '".$_GET['filtre_domaine']."';";
    }};*/

    $result = $pdo->query($Requete_SQL);
    $favoris = $result->fetchAll(PDO::FETCH_ASSOC);
    
    /*$Tab_nom_categorie = array();
    $index = 0;
    $index_id = 0;
    foreach ($favoris as $favori ){ 
      if( $index_id != 0){
        if($Tab_id_favori[$index-1] == $favori['id_favori']){
          $index = 0;
        }
      }
    
      $Tab_id_favori[$index_id] = $favori['id_favori'];
      $index_id = $index_id +1;
      
      $Tab_nom_categorie[$favori['id_favori']][$index] = $favori['nom_categorie'] ;
    
      $index = $index + 1;
    }
    print_r($Tab_id_favori);
    print_r($Tab_nom_categorie);*/
  ?>  
    

  </section>

    <section id="bookmarks">
        <table class="flex justify-center table_favori">
            <tr class="odd:bg-white even:bg-slate-50">
              <?php
                if ($FiltreSurAffichage == true) {
                  for ($index=0; $index < count($Tab_affichage) ; $index++){
                    if ($Tab_affichage[$index] == "on" ){ 
                      if ($collone_filtre_ordre == $Tab_nom_de_collone[$index]){ ?>
                        <th class="border border-black  hover:bg-red-900 bg-red-900 text-center text-red-500  font-bold"><?php echo $Tab_nom_de_collone[$index] ?> <span class="text-red-500 underline  font-bold"> <?php echo " ".$affichage_ordre ?> </span> </th>
                      <?php }else{ ?>
                         <th class="border border-black bg-gray-400 hover:bg-red-900 text-center"><?php echo $Tab_nom_de_collone[$index] ?></th>
                      <?php }?>
                     
                    <?php }
                  }


                }else {
                ?>
                  <th class="border border-black bg-gray-400 hover:bg-red-900 text-center">ID favori</th>
                  <th class="border border-black  bg-gray-400">Libellé</th>
                  <th class="border border-black  bg-gray-400">Date de création</th>
                  <th class="border border-black  bg-gray-400">Lien</th>
                  <th class="border border-black  bg-gray-400">Nom de domaine</th>
                  <th class="border border-black  bg-gray-400">Catégorie(s)</th>
                  
                <?php } 
              ?>
              <th class="border border-black  bg-gray-400"> Gérer </th>
              
                
            </tr>
            <?php 
                foreach($favoris as $favori) {
                  $afficherligne = true;
                  $condition_categorie = "";
                  if (isset($_GET['condition_categorie'])){
                    if ($_GET['condition_categorie'] == "ou"){
                      $condition_categorie = "OR";
                    }else{
                      $condition_categorie = "AND";
                     
                    };
                  }

                  if ($condition_categorie == "AND"){

                    foreach ($table_id_categorie as $uneCategorie){ 
                      if(stristr($favori['liste_id_cat'], $uneCategorie) === false){
                        $afficherligne = false;
                      } 
                    }
                  }

                    if ($afficherligne == true) { 
                      if ($FiltreSurAffichage == true){ ?>
                        <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200 "> 
                        <?php for ($index=0; $index < count($Tab_affichage) ; $index++){
                          if ($Tab_affichage[$index] == "on" ){
                            if ($Tab_nom_de_collone[$index] == "liste_categorie"){ ?>
                              <td class="border border-b-black"><?php 
                              $TabCatégorie_id = explode("|",$favoris_defaut[$favori['id_favori']-1]['liste_id_cat']);
                              $TabCatégorie = explode("|", $favoris_defaut[$favori['id_favori']-1]['liste_categorie']);
                             
                              for ($index2= 0 ; $index2 < count($TabCatégorie); $index2++){
                                $texteEnValeur ="";
                                for ($index3 = 0 ; $index3 < count($table_id_categorie); $index3++){
                                  if ($TabCatégorie_id[$index2] == $table_id_categorie[$index3]){
                                    $texteEnValeur ="text-red-500 underline  font-bold";
                                  }
                                }
                              
                                
                                  echo "<span class='".$texteEnValeur."'>".$TabCatégorie[$index2]."</span><br>";
                            
                      
                        
                              
                              }

                            }elseif($Tab_nom_de_collone[$index] == "url"){ ?>
                              <td class="border border-b-black h-max"><a class="flex justify-center " target="_blank" href="<?php echo  $favori['url']?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                            
                            <?php }elseif($Tab_nom_de_collone[$index] == "libelle"){ ?>
                              <td class="border border-b-black">
                                <?php 
                                if ($presence_recherche == true){
                            

                                  $Tab_libelle = explode($Résultat_recherche,$favori['libelle']);
                                  for ($index2 = 0 ; $index2 < count($Tab_libelle); $index2++){
                                    if ($index2 !=  count($Tab_libelle)-1){
                                      echo $Tab_libelle[$index2]."<span class='text-red-500 underline font-bold'> ".$Résultat_recherche."</span> ";
                                    }else{
                                      echo $Tab_libelle[$index2];
                                    }
                                  }
                                }else{
                                  echo  $favori['libelle'];
                                }
                                ?>
                              </td>
                              <?php }elseif($Tab_nom_de_collone[$index] == "nom_domaine"){ ?>
                                
                                <?php
                                  $texteEnValeur = "";


                                  if (isset($_GET['filtre_domaine'])) {
                                      if ($_GET['filtre_domaine'] != "aucun"){
                                        if($_GET['filtre_domaine'] == $favori['id_domaine']){
                                          $texteEnValeur = "  text-red-500 underline font-bold";
                                        }
                                      }

                                  } 
                                ?> 
                                <td class="border border-b-black text-center"><span class="<?php echo $texteEnValeur ?>"><?php echo  $favori['nom_domaine'] ?></span></td>


                            <?php }else{ ?>
                                <td class=" border border-b-black  h-full text-center"><?php echo $favori[$Tab_nom_de_collone[$index]] ?></th>
                            <?php } ?>
                          
                          <?php }

                      }
                      
                      }else{


                      ?>
                     
                        <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200 "> 
                        <td class=" font-bold border border-b-black  h-full text-center"><?php
                        
                        echo  $favori['id_favori'] ?></td>
                        <td class="border border-b-black">
                          <?php 
                        
                          if ($presence_recherche == true){
                      

                            $Tab_libelle = explode($Résultat_recherche,$favori['libelle']);
                            for ($index = 0 ; $index < count($Tab_libelle); $index++){
                              if ($index !=  count($Tab_libelle)-1){
                                echo $Tab_libelle[$index]."<span class='text-red-500 underline font-bold'> ".$Résultat_recherche."</span> ";
                              }else{
                                echo $Tab_libelle[$index];
                              }
                            }
                          }else{
                            echo  $favori['libelle'];
                          }
                          ?>
                        </td>
                        <td class="border border-b-black text-center"><?php echo  $favori['date_creation'] ?></td>
                        <td class="border border-b-black h-max"><a class="flex justify-center " target="_blank"  href="<?php echo  $favori['url']?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                        <?php
                        $texteEnValeur = "";


                        if (isset($_GET['filtre_domaine'])) {
                            if ($_GET['filtre_domaine'] != "aucun"){
                              if($_GET['filtre_domaine'] == $favori['id_domaine']){
                                $texteEnValeur = "  text-red-500 underline font-bold";
                              }
                            }

                        } ?> 
                        <td class="border border-b-black text-center"><span class="<?php echo $texteEnValeur ?>"><?php echo  $favori['nom_domaine'] ?></span></td>
                        <td class="border border-b-black"><?php 
                       
                        $TabCatégorie_id = explode("|",$favoris_defaut[$favori['id_favori']-1]['liste_id_cat']);
                        $TabCatégorie = explode("|", $favoris_defaut[$favori['id_favori']-1]['liste_categorie']);
                        for ($index= 0 ; $index < count($TabCatégorie); $index++){
                          $texteEnValeur ="";
                          for ($index2 = 0 ; $index2 < count($table_id_categorie); $index2++){
                            if ($TabCatégorie_id[$index] == $table_id_categorie[$index2]){
                              $texteEnValeur ="text-red-500 underline  font-bold";
                            }
                          }
                        
                          
                            echo "<span class='".$texteEnValeur."'>".$TabCatégorie[$index]."</span><br>";
                      
                        
                  
    
                        }?></td>
                        
                        
                      <?php } ?>
                    


                  


                        
                        
                        
                        
                        <td class="flex border justify-center ">
                            <form action="unfavori.php" method="GET" class="text-center ">
                              <button type="submit" name="id_du_favori" href="unfavori.php" class="bg-green-500 p-3 rounded " value= "<?php echo $favori['id_favori'] ?>">
                                <i class="fa-solid fa-book"></i>
                              </button>
                            </form>
                        
                            <form action="unfavori.php" method="GET">
                              <button class="bg-orange-500 p-3 rounded  mr-2 ml-2" >
                                <i class="fa-solid fa-pen-clip"></i>
                              </button>
                            </form>
                            <form action="unfavori.php" method="GET">
                            <button class="bg-red-500 p-3 rounded" >
                            <i class="fa-solid fa-file-circle-xmark"></i>
                            </button>
                            </form>
                        </td>
                      </tr>
                    <?php 
                    } 
                    ?>
              <?php } ?>
        </table> 

        <button>
                Télécharger le CVS
        </button>
        <button class="bg-lime-500">
                  Ajouter
        </button>
    </section>

    
</body>
</html>