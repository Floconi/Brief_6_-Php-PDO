<?php 

if (isset($_GET['filtre_domaine'])){
  print_r($_GET['filtre_domaine']);
  
}


?>
<?php
  include("header.php");
  include("pdo.php"); 

  // Affichage (SELECT) :
?>
  
 
  <section class=" bg-red-500   filtre flex flex-col justify-center m-8">
    <div class="flex justify-center" >
      <form  method="get" action="index.php"> 
        <h2 class="flex justify-center"> Filtres sur les données </h2>
        <div class="flex ">
            <?php 
              $table_cat = "categorie" ;
              $result = $pdo->query(" SELECT * 
              FROM $table_cat 
              ;");
              $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
            ?>
            <fieldset id="categorie_filtre" class="flex  border border-black p-4 m-4">
              <legend class="text-center">
                <?php 
                  $table_cat = " FILTRE sur ".ucfirst($table_cat)."s "; 
                  echo $table_cat 
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
                
                <?php $numero_cat = 1;
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
            
            <fieldset class="flex flex-col border border-black p-4 m-4 justify-center">
              <legend class="flex justify-center text-center"> Domaine </legend>
              <select id="selection_dom" name="filtre_domaine " class="mb-4">
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
       
      
      
        <div>
          <h2 class="flex justify-center"> Filtre sur l'affichage Affichage  </h2>
          <fieldset class = "flex justify-center border border-black"> 
            <?php 
              $nom_table = "favori"
            ?> 
            <legend  class="bg-green-600 text-white p-2 rounded border  " ><?php echo $nom_table ?></legend>
            <div class = " flex flex-col w-max">
             
            </div>
            <div class = "m-8 flex flex-col w-max">
              <?php 

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone= $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                foreach ($collone as $uneCollone){ 
                  $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?> 
                  <button type="button" name="<?php echo $id_du_bouton ?>"  id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded " onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')" name="<?php echo $id_du_bouton ?>" value ="off"><?php echo $uneCollone['Field'] ?></button>
                  
                <?php $index = $index +1;
                }

              ?>
            </filedset>
            <?php 
              $nom_table = "categorie"
            ?>
            <div class = " flex flex-col w-max">
              <button type="button" class="bg-green-600 text-white p-2  rounded" onclick="changerEtatBoutton()"><?php echo $nom_table ?></button>
            </div> 
            <div class = "m-8 flex flex-col w-max">
            
              <?php 

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone = $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                foreach ($collone as $uneCollone){ 
                $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?> 
                  <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')" name="<?php echo $nom_table.'_'.'colonne_n°'.$index ?>" value ="off"><?php echo $uneCollone['Field'] ?></button>

                  <?php $index = $index +1;

                }

              ?>
            </div>
            <?php 
            $nom_table = "domaine"
            ?>
            <div class = " flex flex-col w-max">
              <button type="button" class="bg-green-600 text-white p-2 rounded"><?php echo $nom_table ?></button>
            </div> 
            <div class = "m-8 flex flex-col w-max">
            
              <?php 

                $result = $pdo->query("SHOW COLUMNS FROM ".$nom_table);
                $collone = $result->fetchAll(PDO::FETCH_ASSOC);

                $index = 0;
                foreach ($collone as $uneCollone){ 
                  $id_du_bouton =  $nom_table."_"."colonne_n°".$index ?>
                  <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')" id="<?php echo $nom_table."_"."colonne_n°".$index ?>" name="<?php echo $nom_table."_"."colonne_n°".$index ?>" value ="off"><?php echo $uneCollone['Field'] ?></button>



                <?php 
                 $index = $index +1;
                }

              ?>
            </div>
          </div>
          <div>
            <h2> Limitation des résultat </h2>
                <select name="Limite">
                <option value = "Tout">-- Tous -- </option> 
                  <option value = "1">1</option>
                  <option value = "5">5</option>
                  <option value = "10">10</option>
                  <option value = "30">30</option>
                </select>
          </div>
          

          <div class = "flex flex-col justify-center ">
            <h2> Barre de recherche </h2>
            <input type="search" name="Rechercher" id="default-search" class="block w-1/2 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white  h-10" placeholder="Recherche par libelle..." >


          </div>



      
        <button type="submit" >
              Appliquer les filtres
        </button> 
                
      </form>
    </div>  


      

    
      
      

          
              

                <!--<div class="flex"> 
                <input type="radio" name="domaine" id="<?php //echo "domaine_n°".$numero_dom ?>" >
                <label id="<?php// echo "Label_domaine_n°".$numero_dom ?>" class="ml-2" for="<?php echo "domaine_n°".$numero_dom ?>"><?php echo $unDomaine['nom_domaine'] ?></label>
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
    $presence_limite = false;
    if (isset($_GET['Limite'])){
      if ($_GET['Limite'] != "Tout"){
        $Résultat_limite = $_GET['Limite'];
        $presence_limite = true;
      }

  }
  $presence_recherche = false;
  if (!empty($_GET['Rechercher'])){
      
  
      $Résultat_recherche = $_GET['Rechercher'];
      echo $Résultat_recherche;
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


    $Requete_SQL = "SELECT favori.id_favori,
      favori.libelle,
      favori.date_creation,
      favori.url, 
      domaine.id_domaine, 
      domaine.nom_domaine,
      GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
      GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as 'liste_categorie'  
      FROM favori "; /* Début création de la requete sql */
    $filtre = false;
    $filtre_cat = false;
    $filtre_dom = false; 
    $Requete_SQL = $Requete_SQL." 
    INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
    INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie  ";
    $Requete_SQL = $Requete_SQL." INNER JOIN domaine ON domaine.id_domaine = favori.id_dom ";
    
    if (count($table_id_categorie) != 0){
    
      $filtre_cat = true;
    };

    if(isset($_GET['filtre_domaine'])){
      if ($_GET['filtre_domaine'] != "aucun"){
        
        $filtre_dom = true;
      }
    }

    if($filtre_cat == true || $filtre_dom == true || $presence_recherche == true){
      echo "hello";
      $Requete_SQL .= "WHERE";
    }


    if ($presence_recherche == true ){

      $Requete_SQL .= " libelle LIKE '%".$Résultat_recherche."%'"; 
      
      if ( $filtre_dom  == true || $filtre_cat == true){
      $Requete_SQL .= " OR ";


    }
    }
  
    echo "<br>".$Requete_SQL."<br>";

    
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
    
    
    
    echo "<br>".$Requete_SQL."<br>";

    $Requete_SQL = $Requete_SQL." GROUP BY favori.id_favori ORDER BY favori.id_favori ASC";
    if ($presence_limite == true ){
      $Requete_SQL .= " LIMIT ". $Résultat_limite;
    }
    $Requete_SQL .= " ; "; /* FIN de l'instruction SQL */


    $Requete_SQL_defaut = "SELECT favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as 'liste_categorie' FROM favori INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie INNER JOIN domaine ON domaine.id_domaine = favori.id_dom GROUP BY favori.id_favori ORDER BY favori.id_favori ASC";

    

    $result_defaut =  $pdo->query($Requete_SQL_defaut);
    $favoris_defaut = $result_defaut->fetchAll(PDO::FETCH_ASSOC);
    
    var_dump($favoris_defaut);
    

  /*if ((isset($_GET['filtre_domaine'])) ) {
    if ($_GET['filtre_domaine'] != "aucun"){
      $Requete_SQL = $Requete_SQL."INNER JOIN domaine ON domaine.id_domaine = favori.id_dom  WHERE domaine.id_domaine = '".$_GET['filtre_domaine']."';";
    }};*/
  echo "<br> Requete sql : ".$Requete_SQL;

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
                <th class="border border-black bg-gray-400 hover:bg-red-900">ID favori</th>
                <th class="border border-black  bg-gray-400">Libellé</th>
                <th class="border border-black  bg-gray-400">Date de création</th>
                <th class="border border-black  bg-gray-400">Lien</th>
                <th class="border border-black  bg-gray-400">Nom de domaine</th>
                <th class="border border-black  bg-gray-400">Catégorie(s)</th>
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
                      echo $uneCategorie;

                      echo stristr($favori['liste_id_cat'], $uneCategorie);
                      echo "<br>";
                      if(stristr($favori['liste_id_cat'], $uneCategorie) === false){
                        echo "false";
                        $afficherligne = false;
                      } 
                    }
                  }

                    if ($afficherligne == true) { 
                    
                    


                  


                      ?>
                      <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200 ">
                      <td class=" font-bold border border-b-black  h-full"><?php echo  $favori['id_favori'] ?></td>
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
                      <td class="border border-b-black"><?php echo  $favori['date_creation'] ?></td>
                      <td class="border border-b-black"><a href="<?php echo  $favori['url']?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                      <?php
                      $texteEnValeur = "";


                      if (isset($_GET['filtre_domaine'])) {
                          if ($_GET['filtre_domaine'] != "aucun"){
                            if($_GET['filtre_domaine'] == $favori['id_domaine']){
                              $texteEnValeur = "  text-red-500 underline font-bold";
                            }
                          }

                      } ?> 
                      <td class="border border-b-black "><span class="<?php echo $texteEnValeur ?>"><?php echo  $favori['nom_domaine'] ?></span></td>
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
                    
                      
                
  
                      }?></td class="h-full">
                      
                      <td class="flex border border-b-black">
                      <form action="unfavori.php" method="GET">
                      <button type="submit" name="id_du_favori" href="unfavori.php" class="bg-green-500 p-3 rounded mr-2 h-max" value= "<?php echo $favori['id_favori'] ?>">
                        <i class="fa-solid fa-book"></i>
                      </button>
                      </form>
                    

                        <button class="bg-orange-500 p-3 rounded mr-2" >
                        <i class="fa-solid fa-pen-clip"></i>
                        </button>
                        <button class="bg-red-500 p-3 rounded" >
                        <i class="fa-solid fa-file-circle-xmark"></i>
                        </button>
                      
                      
                      
                      
                      
                    </td>
                      </tr>

                    <?php } ?>
                  
                  
                 
                    
    

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