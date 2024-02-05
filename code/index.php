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
      <button type="button" class="collapsible">Filtres</button>
      <div class="content py-5">
      <form  method="get" action="index.php"> 
        
        <div class="flex partie-Filtre-données flex-col">
          <h2 class="flex justify-center underline font-PE_libre_baskerville_gras text-xl">
            Filtres sur les données 
          </h2>
          <div class="flex flex-col md:flex-row justify-center items-center">
            <?php 
              $table_cat = "categorie" ;
              $result = $pdo->query(" SELECT * 
              FROM $table_cat 
              ;");
              $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
            ?>
            <fieldset id="categorie_filtre" class="flex  border border-black p-4 m-4 rounded mb-5 md:mb-0">
              <legend class="text-center border border-black rounded p-4 font-PE_libre_baskerville_italique text-lg">
                <?php 
                  $table_cat = " FILTRE sur les ".ucfirst($table_cat)."s "; 
                  echo $table_cat;
                ?>
              </legend>
              <div class="flex flex-col">  
                <?php
                  $numero_cat = 1;
                  foreach($categorie as $uneCategorie) { ?>
                    <div class="flex mr-5 "> 
                      <input name="<?php echo "categorie_n°".$numero_cat ?>" type="checkbox" id="<?php echo "categor".$numero_cat ?>" >
                      <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2 font-PE_libre_baskerville" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
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

              <div class=" flex justify-center flex-col items-center">
                <h3> Conditions entre les catégories  : <h3>
                <div class="flex justify-center item-center flex-col ">
                  <div class="">
                    <input type="radio" id="ou_categorie" name="condition_categorie" value="ou" checked />
                    <label for="oucategorie">OU  </label>
                  </div>
                  <div class="">
                    <input type="radio" id="et_categorie" name="condition_categorie" value="et" />
                    <label for="etcategorie">ET</label>
                  </div>
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
            <fieldset class="flex flex-col border border-black p-4 m-4 justify-around rounded mb-5 md:mb-0">
              <legend class="flex justify-center text-center border border-black rounded p-4 font-PE_libre_baskerville_italique"> 
                FILTRE sur le Domaine 
              </legend>
              <select id="selection_dom"class="font-PE_libre_baskerville" name="filtre_domaine" class="mb-4">
                <option value="aucun" class="font-PE_libre_baskerville" selected>-- Tous les Domaines -- </option>
                <?php
                  $numero_dom = 1;
                  foreach($domaine as $unDomaine) { ?>
                    <option id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                    <?php $numero_dom = $numero_dom + 1 ?>
                  <?php } 
                ?>
              </select>
              <div class="flex items-center flex-col ">
                <p>Condition de sélection  entre le(s) catégorie(s) et le domaine:</p>
                <div class="">
                  <div>
                    <input type="radio" id="ou_categorie_dom" name="condition_categorie_dom" value="ou" checked />
                    <label for="ou_categorie_dom">OU </label>
                  </div>
                  <div>
                    <input type="radio" id="et_categorie_dom" name="condition_categorie_dom" value="et" />
                    <label for="et_categorie_dom">ET </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class=" flex md:justify-center items-center mb-5 md:mb-0">
              <button type="submit" class=" bg-blue-950 mt-2 text-white p-6 font-PE_nunito rounded flex justify-center " >
                Appliquer les filtres
              </button>
            </div> 
          </div>
        </div>
          
        
        
        <?php /* Partie de filtre sur l'afichage */ ?>
        <button type="button" class="collapsible">Filtres Avancées</button>
        <div class="content pt-5 pb-5">
          <div class="Filtre_sur_l'affichage ">
            <h2 class="flex justify-center underline font-PE_libre_baskerville_gras p-4"> 
              FILTRE sur l'affichage 
            </h2>
              
            <div class="flex justify-around flex-col lg:flex-row">
              <fieldset class = "flex justify-center border border-black mb-5 md:mb-0 rounded"> 
                <?php 
                  $nom_table = "favori"
                ?> 
                <legend  class="bg-blue-950 text-white p-2 rounded font-PE_libre_baskerville_italique  ml-4 " >
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
                      <input type="button"  id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded font-PE_libre_baskerville" onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')"  value ="<?php echo $uneCollone['Field'] ?>"></input>
                      <?php 

                        $index = $index +1;
                        $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                        $index_affichage = $index_affichage + 1;
                    }
                    $nomb_col_max_favori = $index;

                    
                  ?>
                </div>
              </fieldset>
              <fieldset class = "flex justify-center border border-black rounded mb-5 md:mb-0 "> 
                <?php 
                $nom_table = "domaine"
                ?>
                <legend type="button" class="bg-blue-950 text-white p-2 rounded ml-4 font-PE_libre_baskerville_italique">
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
                      <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 text-white p-2 mb-5 rounded font-PE_libre_baskerville "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')"  value ="off"><?php echo $uneCollone['Field'] ?></button>
                    <?php 
                    $index = $index +1;
                      
                      $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                      $index_affichage = $index_affichage + 1;
                    
                    }
                    $nomb_col_max_domaine = $index;
                  ?>
                </div>
              </fieldset>
              
              <fieldset class = "flex justify-center border border-black rounded mb-5 md:mb-0"> 
                <?php 
                  $nom_table = "categorie"
                ?>
                <legend  class="bg-blue-950 text-white p-2  ml-4 rounded font-PE_libre_baskerville_italique" onclick="changerEtatBoutton()">
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
                      <button type="button" id="<?php echo $id_du_bouton ?>" class="bg-blue-950 font-PE_libre_baskerville text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton('<?php echo $id_du_bouton ?>')" value ="off"><?php echo $uneCollone['Field'] ?></button>

                      <?php $index = $index +1;
                
                        $Tab_nom_de_collone[$index_affichage] = $uneCollone['Field'];
                        $index_affichage = $index_affichage + 1;

                    }
                    $nomb_col_max_categorie = $index;

                  ?>

                </div>
              </fieldset>
              
              <div class="flex flex-col md:flex-row lg:flex-col md:mt-4 justify-around">
                <fieldset class="flex justify-center border border-black items-center rounded p-5 mb-5 md:mb-0">
                  <legend class=" border border-black flex text-center rounded p-4 font-PE_libre_baskerville_italique"> 
                    Limitation  
                  </legend>
                    <select class="font-PE_libre_baskerville" name="Limite" class="h-5">
                      <option class="font-PE_libre_baskerville" value = "Tout">-- Tous -- </option> 
                      <option class="font-PE_libre_baskerville" value = "1">1</option>
                      <option class="font-PE_libre_baskerville" value = "5">5</option>
                      <option class="font-PE_libre_baskerville" value = "10">10</option>
                      <option class="font-PE_libre_baskerville" value = "30">30</option>
                    </select>
                </fieldset>
                <fieldset class="flex justify-around flex-col border border-black items-center rounded p-5 mb-5 md:mb-0">
                  <legend class=" font-PE_libre_baskerville_italique border border-black flex text-center rounded p-4 ">Ordonée par collone</legend>
                  <select class="font-PE_libre_baskerville" name="ordre_affichage" class="h-5">
                      <option class="font-PE_libre_baskerville" value = "">-- Ne pas Ordonée -- </option> 
                      <option class="font-PE_libre_baskerville" value = "id_favori">id_favori</option>
                      <option class="font-PE_libre_baskerville" value = "libelle">libelle</option>
                      <option class="font-PE_libre_baskerville" value = "date_creation">date_creation</option>
                      <option class="font-PE_libre_baskerville" value = "url">url</option>
                      <option class="font-PE_libre_baskerville" value = "nom_domaine">nom_domaine</option>
                      <option class="font-PE_libre_baskerville" value = "liste_categorie">liste_Categorie</option>
                  </select>
                  <div class="flex mt-10 justify-between">
                    <input type="hidden" id="btn_cacher_ordre_ASC" name="Ordre_ASC"   class="bg-blue-950  text-white p-2 mb-5 rounded " value ="on"></input>
                    <button type="button" id="ordre_ASC" class=" text-white p-2 mb-5 font-PE_libre_baskerville rounded boutton_affichage_selectionner mr-4"  onclick="changerEtatBoutton_ordre('ordre_ASC')" value ="on">A -> Z</button>
                    <input type="hidden" id="btn_cacher_ordre_DESC" name="Ordre_DESC"   class="bg-blue-950 text-white p-2 mb-5 rounded " value ="off"></input>
                    <button type="button" id="ordre_DESC" class="bg-blue-950 font-PE_libre_baskerville text-white p-2 mb-5 rounded "  onclick="changerEtatBoutton_ordre('ordre_DESC')" value ="off"> Z -> A </button>
                  <div>

                </fieldset>
              </div>
            </div>
          </div>   
          <div class="flex items-center justify-evenly mt-5 md:flex-row flex-col ">
            <fieldset class = "flex flex-col justify-center md:w-1/2 w-full  border border-black items-center p-4 rounded mb-5 md:mb-0">
              <legend class="text-center border border-black rounded p-4 font-PE_libre_baskerville_italique"> 
                Barre de recherche 
              </legend>
              <input type="search" name="Rechercher" id="default-search" class="font-PE_libre_baskerville block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 h-10" placeholder="Recherche par libelle..." >
            </fieldset>
           <button type="submit" class="bg-blue-950 mt-2 text-white p-6 font-PE_nunito rounded flex justify-center " >
            Appliquer les filtres
          </button> 
        </div>
        </div>
         
        </div>  
      </form>
    </div>
    </section>
  
    
      
      

          
              

                <!--<div class="flex"> 
                <input type="radio" name="domaine" id="<?php //echo "domaine_n°".$numero_dom ?>" >
                <label id="<?php// echo "Label_domaine_n°".$numero_dom ?>" class="ml-2" for="<?php //echo "domaine_n°".$numero_dom ?>"><?php// echo $unDomaine['nom_domaine'] ?></label>
                </div>
                <?php// $numero_dom = $numero_dom + 1 ?>
              <?php// } ?>-->
          

          


          


  <!-- /**
  * ? PARTIE 2 : Zone de gestion de la requete en fonction des filtres / 
  * ? VERIFICATION que les données existe et attribution des valeurs
  -->
  <?php 
    
   /** 
     * ! Filtre sur les données
     * TODO : On défini si il y'a un filtre sélectionné sur les catégorie et le domaine à l'aide d'un booléan
     */
    $filtre = false;
    $filtre_cat = false;
    $filtre_dom = false; 
    $index = 1;
    $index_id_cat = 0;
    $table_id_categorie = array();

    

    for ($index = 1 ; $index <= $numero_cat_max ; $index++){
      if (isset($_GET['categorie_n°'.$index])){
        $table_id_categorie[$index_id_cat] = $index;
        $index_id_cat = $index_id_cat + 1 ;

      };
    };
    if (count($table_id_categorie) != 0){
    
      $filtre_cat = true;
    };
    if(isset($_GET['filtre_domaine'])){
      if ($_GET['filtre_domaine'] != "aucun"){
        
        $filtre_dom = true;
      }
    }

    /** 
     * ! Filtre Sur l'affichage
     * todo : ici on récupère les ids des catégories sélectionnées et on les affecte dans un tableau
     * */

   

 
   /**
    * TODO : ici on récupère les boutons d'afffichage coché par l'utilisateur et on affecte la valeur dans un tableau 
    * TODO : on si on veut voir la collone 
    * TODO : off si on veut la masquées
    * TODO : On fait tout d'abord pour la table favori
    * TODO : On garde le même idex_affichage et tableau pour les autres tables
    */
   
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
    /**
     * TODO : On fait la même chose avec la table domaine
     * TODO : on si on veut voir la collone 
     * TODO : off si on veut la masquées
     * 
     */

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

     /**
     * TODO : On fait la même chose avec la table catégorie
     * TODO : on si on veut voir la collone 
     * TODO : off si on veut la masquées
     * 
     */


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

    /**
     * TODO : Si l'utilisateur n'a sélectionner aucun affichage particulier (y compris au chargement de la page)
     * TODO : On affecte des valeurs par défaut pour que l'affichage s'applique dans tout les cas
     */

    if($FiltreSurAffichage == false){
      $Tab_affichage[0] = "on";
      $Tab_affichage[1] = "on";
      $Tab_affichage[2] = "on";
      $Tab_affichage[3] = "on";
      $Tab_affichage[4] = "off";
      $Tab_affichage[5] = "off";
      $Tab_affichage[6] = "on";
      $Tab_affichage[7] = "off";
      $Tab_affichage[8] = "on";
      $FiltreSurAffichage = true;





    }

   
     
    /**
     * TODO : Vérification que l'utisateur à selectionné une limite par le passage en parametre
     */


    

    $presence_limite = false;
    if (isset($_GET['Limite'])){
      if ($_GET['Limite'] != "Tout"){
        $resultat_limite = $_GET['Limite'];
        $presence_limite = true;
      }

  }
/**
 * TODO : Vérification si l'utilisateur à choisi un filtre 
 * TODO : Puis on créer des variables à inclure dans la requete SQL 
 * TODO : Création de variable d'affichage qui sera vu par l'utilisateur (A->Z PLUS Compréhensible que ASC)
 */
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
 

  /**
   * TODO  : Vériication du paramêtre de recherche
   * todo : Si oui on affecte le mot recherché dans une variable
   */

  $presence_recherche = false;
  if (!empty($_GET['Rechercher'])){
      
  
      $resultat_recherche = $_GET['Rechercher'];

      $presence_recherche = true;
    

  }

  /**
   * TODO : Récupération de l'élément de liéson qui servira si l'utilisateur veut plusieurs catégorie
   * TODO : ET -  Je veux que le résultat possède uniquement toutes les catégorie sélectionnées
   * TODO : OU -  Le résultat doit avoir au moins l'une des catégorie sélectionnées
   */
    
    if (isset($_GET['condition_categorie'])){
        if ($_GET['condition_categorie'] == "ou"){
          $condition_categorie = "OR";
        }else{
          $condition_categorie = "AND";
        }; 

    }

    /**
     * TODO : Comme il n'y a que un seul et unique domaine pas de condition entre domaine 
     * TODO : Cependant, il nous faut la liéson entre la(les) catégorie(s) et le domaine
     * TODO : ET - Je veux les résultat des catégorie sélectionnée qui ont le domaine sélectionné
     * TODO : OU - Je veux les résultat des caégorie sélectionnées ou bien du domaine sélectionné
     */

    if(isset($_GET['condition_categorie_dom'])){
      if ($_GET['condition_categorie_dom'] == "ou"){
      $condition_categorie_dom = "OR";
      }else{
        $condition_categorie_dom = "AND";
      };
    }

    /**
     * TODO : Comme on fait des allias dans la requete on va venir modifier les noms de collone 
     * TODO : Ainsi il corresponde à la requete et on va pouvoir les utiliser 
     */

    for ($index = 0; $index < count($Tab_nom_de_collone) ; $index++){
      if ($Tab_nom_de_collone[$index] == "id_categorie"){
        $Tab_nom_de_collone[$index] = "liste_id_cat";
      }
      if ($Tab_nom_de_collone[$index] == "nom_categorie" ){
        $Tab_nom_de_collone[$index] = "liste_categorie";
      }
    }

    
      
   
 
   /**
    * ? PARTIE 3 : Création de la requete SQL 
    */

    /**
     * todo : ICI , on créer la requete de base en fonction des filtres Pour l'instant, on décide de prendre à afficher toute les collonne
     ** Version future : Créer les collone à afficher en fonction des filtres d'affichage sélectionnées
     * 
     */

    $Requete_SQL = "SELECT 
      favori.id_favori, favori.libelle, favori.date_creation, favori.url, favori.id_dom,
      domaine.id_domaine, domaine.nom_domaine,
      GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,
      GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as liste_categorie 
      FROM favori "; /* Début création de la requete sql */
    
    /**
     * TODO : Je créer toutes les jointures des tables
     */
    $Requete_SQL .= 
    "INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori 
     INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie 
     INNER JOIN domaine ON domaine.id_domaine = favori.id_dom ";

     $Tableau_parametre_filtre = array();
    
    /**
     * TODO : On ne met le where que si il y'a un filtre sur les catégorie ou le domaine ou la recherche
     */

    if($filtre_cat == true || $filtre_dom == true || $presence_recherche == true){
   
      $Requete_SQL .= "WHERE";
    }

    /**
     * TODO : Je commence par la recherche 
     * TODO : LIKE permet de repérer un motif particulier 
     * TODO : LE % remplace n'importe quel caractère
     * 
     ** Version future : Permettre un AND pour filtre sur recherche et le faire sur différente collone
     */

    if ($presence_recherche == true ){

      $Requete_SQL .= " libelle LIKE '%:recherche%'"; 
      $Tableau_parametre_filtre += [
        ':recherche' => $resultat_recherche
      ];
      
      if ( $filtre_dom  == true || $filtre_cat == true){
      $Requete_SQL .= " OR ";


    }
    }
  
    /**
     * TODO : On créer la requete sql pour les filtres
     * TODO : On fait attention au ordre de priorité donc on ajoute les parenthèse
     * TODO : Petite subtilité ne pas mettre de liéson sur le dernier catégorie donc  count($table_id_categorie)-1 
     * TODO : 2eme subtilité Le mot de liéson est le OR meme dans le cas de Et On va juste filtrer les résultat au moment de l'affichage
     */

    
    for ($index = 0 ; $index < count($table_id_categorie); $index++){
    if (count($table_id_categorie) >=2 && $index == 0){
          $Requete_SQL .= " ( ";
      }; 
      $Requete_SQL .= " categorie.id_categorie = :categorie".$index." ";
      $Tableau_parametre_filtre += [
        ":categorie$index" => $table_id_categorie[$index]
      ];
      if ($index != count($table_id_categorie)-1 ){
        $Requete_SQL .= " OR ";
        
      }

      if ( count($table_id_categorie) >=2 && $index == count($table_id_categorie)-1){
        $Requete_SQL .= " ) ";

      }
    }


    /**
     * TODO : On ajoute la condition entre le domaine et les catégorie uniquement si on a un filtre sur les catégorie et le dom
     ** Version Future : Enlever les get et les remplacer par les variable de la partie 2 (fait)
     */

    if(($filtre_cat == true && $filtre_dom == true) ){
       /**if ($_GET['filtre_domaine'] != "aucun"){*/
        $Requete_SQL .= $condition_categorie_dom;
        $Requete_SQL .= " domaine.id_domaine = :domaine ";
        $Tableau_parametre_filtre += [
          ":domaine" => htmlspecialchars($_GET['filtre_domaine'])
        ];
      /** }*/
 
    }

    if($filtre_dom == true &&  $filtre_cat == false){
      $Requete_SQL .= " domaine.id_domaine = :domaine " ;
      $Tableau_parametre_filtre += [
        ":domaine" => htmlspecialchars($_GET['filtre_domaine'])
      ];
    }
    /** 
    
    *if (isset($_GET['filtre_domaine'])){
    *  if ($_GET['filtre_domaine'] != "aucun"){
        
    *  }
    *}
    */

    /**
     * TODO : On rajoute un group by pour ne pas avoir plusieurs fois la même ligne
     * TODO : Comme la clé primaire est unique on le groupe par cette collone
     * TODO : Puis on ordre par le nombre de collone et ordre croissant ou décroissant
     */
    
    

    $Requete_SQL .= " GROUP BY favori.id_favori ORDER BY ";

    if ($filtre_ordre == true){
      $Requete_SQL .=" :collone_filtre_ordre :Ordre_croissant_decroissant";
      $Tableau_parametre_filtre += [
        ":collone_filtre_ordre" => $collone_filtre_ordre,
        ":Ordre_croissant_decroissant" => $Ordre_croissant_decroissant,

      ];
      
    }else{
      $Requete_SQL .= "favori.id_favori ASC";
    }
    
    
    if ($presence_limite == true ){
      /* La requete préparé que j'ai utilisé comporte un souci, je n'arrive pas faire à faire passer un parametre qui soit lu sous forme d'entier */
      /* il aurait fallu faire comme ceci */
      /*$stmt->bind_param("is", $id, $label); // "is" means that $id is bound as an integer and $label as a string*/
      $resultat_limite = intval($resultat_limite); // comme je vais utilisé cette variable directement je protège(un peu) par un intval()
      $Requete_SQL .= " LIMIT   ".$resultat_limite;
      /*$Tableau_parametre_filtre += [
        ":abc" => $resultat_limite
      ];*/
    }
    $Requete_SQL .= " ; "; /* FIN de l'instruction SQL */

    /**
     * TODO : J'ai besoin de la requete par défaut consernant les catégorie pour les voir toute afficher 
     * TODO: Sans cela si on fait une recherhce API, on obtiendera qu'une api
     */


    $Requete_SQL_defaut = "SELECT favori.id_favori,favori.libelle,favori.date_creation,favori.url, domaine.id_domaine, domaine.nom_domaine,GROUP_CONCAT(categorie.id_categorie SEPARATOR '|') as liste_id_cat ,GROUP_CONCAT(categorie.nom_categorie SEPARATOR ' | ') as 'liste_categorie' FROM favori INNER JOIN favori_categorie ON favori.id_favori = favori_categorie.id_favori INNER JOIN categorie ON categorie.id_categorie = favori_categorie.id_categorie INNER JOIN domaine ON domaine.id_domaine = favori.id_dom GROUP BY favori.id_favori ORDER BY favori.id_favori ASC";

    
    $result_defaut =  $pdo->query($Requete_SQL_defaut);
    $favoris_defaut = $result_defaut->fetchAll(PDO::FETCH_ASSOC);
    
    

  /*if ((isset($_GET['filtre_domaine'])) ) {
    if ($_GET['filtre_domaine'] != "aucun"){
      $Requete_SQL = $Requete_SQL."INNER JOIN domaine ON domaine.id_domaine = favori.id_dom  WHERE domaine.id_domaine = '".$_GET['filtre_domaine']."';";
    }};*/

    /**
     * TODO : Interogation de la base de données avec la requete SQL pour obtenir les résultats
     */
    echo $Requete_SQL;
    $RequetePreparer = $pdo->prepare($Requete_SQL);

    echo "<pre>";
    print_r($Tableau_parametre_filtre);
    echo "</pre>";
    $RequetePreparer -> execute($Tableau_parametre_filtre);
    $favoris = $RequetePreparer->fetchAll(PDO::FETCH_ASSOC);
    /*$result = $pdo->query($Requete_SQL);
    $favoris = $result->fetchAll(PDO::FETCH_ASSOC);*/
    
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
    
    <?php $index4 = 0  ?>
  </section>
  

    <section id="bookmarks">
        <table class="flex justify-center table_favori">
            <tr class="odd:bg-white even:bg-slate-50">
              <?php
                if ($FiltreSurAffichage == true) {
                  for ($index=0; $index < count($Tab_affichage) ; $index++){
                    if ($Tab_affichage[$index] == "on" ){ 
                      if ($collone_filtre_ordre == $Tab_nom_de_collone[$index]){ ?>
                        <th class="border border-black font-PE_nunito_italique hover:bg-red-900 bg-red-900 text-center text-red-500  font-bold"><?php echo $Tab_nom_de_collone[$index] ?> <span class="text-red-500 underline  font-bold"> <?php echo " ".$affichage_ordre ?> </span> </th>
                      <?php }else{ ?>
                         <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center"><?php echo $Tab_nom_de_collone[$index] ?></th>
                      <?php }?>
                     
                    <?php }
                  }


                }else {
                ?>
                  <!--<th class="border border-black bg-gray-400 hover:bg-red-900 text-center">ID favori</th>
                  <th class="border border-black  bg-gray-400">Libellé</th>
                  <th class="border border-black  bg-gray-400">Date de création</th>
                  <th class="border border-black  bg-gray-400">Lien</th>
                  <th class="border border-black  bg-gray-400">Nom de domaine</th>
                  <th class="border border-black  bg-gray-400">Catégorie(s)</th> -->
                  
                <?php } 
              ?>
              <th class="border border-black font-PE_libre_baskerville_italique  bg-gray-400 hover:bg-red-900 text-center"> Gérer </th>
              
                
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
                        <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200 h-max"> 
                        <?php for ($index=0; $index < count($Tab_affichage) ; $index++){
                          if ($Tab_affichage[$index] == "on" ){
                            if ($Tab_nom_de_collone[$index] == "liste_categorie"){ ?>
                              <td class="border border-b-black font-PE_libre_baskerville"><?php 
                              
                              for ($index5 = 0; $index5 <  count($favoris_defaut); $index5++){
                                if ($favoris_defaut[$index5]['id_favori'] == $favori['id_favori'] ){
                                  $numero_ligne = $index5;
                                }
                               
                              } 
                            
                              $TabCatégorie_id = explode("|",$favoris_defaut[$numero_ligne]['liste_id_cat']);
                              $TabCatégorie = explode("|", $favoris_defaut[$numero_ligne]['liste_categorie']);
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
                              <td class="border border-b-black h-max min-w-20 font-PE_libre_baskerville"><a class="flex justify-center " target="_blank" href="<?php echo  $favori['url']?>"><i class=" text-[#78afd8]  fa-solid fa-arrow-up-right-from-square"></i></a></td>
                            
                            <?php }elseif($Tab_nom_de_collone[$index] == "libelle"){ ?>
                              <td class="border border-b-black font-PE_libre_baskerville">
                                <?php 
                                if ($presence_recherche == true){
                                  $resultat_recherche_initial = $resultat_recherche;

                                  
                                  $Tab_libelle = explode($resultat_recherche,$favori['libelle']);
                                  for ($index2 = 0 ; $index2 < count($Tab_libelle); $index2++){
                                    if ($index2 !=  count($Tab_libelle)-1){
                                      echo $Tab_libelle[$index2]."<span class='text-red-500 underline font-bold'> ".$resultat_recherche."</span> ";
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
                                <td class="border min-w-[150px] font-PE_libre_baskerville border-b-black text-center"><span class="<?php echo $texteEnValeur ?>"><?php echo  $favori['nom_domaine'] ?></span></td>
                              <?php }elseif($Tab_nom_de_collone[$index] == "date_creation"){
                                 ?>
                                 
                                <td class=" border min-w-[120px] border-b-black font-PE_libre_baskerville  h-full text-center"><?php echo $favori[$Tab_nom_de_collone[$index]] ?></th>
                                <?php }elseif($Tab_nom_de_collone[$index] == "id_favori"){ ?>
                                  <td class=" border border-b-black font-PE_libre_baskerville_gras  h-full text-center"><?php echo $favori[$Tab_nom_de_collone[$index]] ?></th>

                                
                              <?php }else{ ?>
                                <td class=" border border-b-black  font-PE_libre_baskerville h-full text-center"><?php echo $favori[$Tab_nom_de_collone[$index]] ?></th>
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
                      

                            $Tab_libelle = explode($resultat_recherche,$favori['libelle']);
                            for ($index = 0 ; $index < count($Tab_libelle); $index++){
                              if ($index !=  count($Tab_libelle)-1){
                                echo $Tab_libelle[$index]."<span class='text-red-500 underline font-bold'> ".$resultat_recherche."</span> ";
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
                    


                  


                        
                        
                        
                        
                        <td class=" border justify-center items-center align-middle border-black ">
                          <div class="flex ">
                            <form action="unfavori.php" method="GET" class="text-center ">
                              <button type="submit" name="id_du_favori" href="unfavori.php" class=" p-3    rounded " value= "<?php echo $favori['id_favori'] ?>">
                                <i class=" text-green-600 fa-solid fa-book"></i>
                              </button>
                            </form>
                        
                            <form action="modifier.php" method="GET">
                              <button class=" p-3 rounded mr-2 ml-2" name="id_du_favori" value="<?php echo $favori['id_favori']?>">
                                <i class=" text-orange-600 fa-solid fa-pen-clip"></i>
                              </button>
                            </form>
                            <form action="supprimer.php" method="GET">
                            <button type="submit" name="id_du_favori" class=" p-3 rounded" value="<?php echo $favori['id_favori'] ?>">
                            <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i>
                            </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    <?php 
                    } 
                    ?>
              <?php } ?>
        </table> 

        <!--<button>
                Télécharger le CVS
        </button>
        <button class="bg-lime-500">
                  Ajouter
        </button>
    </section>-->
  </div>
    
<?php include("footer.php") ?>















































<!-- 1000 LIGNES FIN -->