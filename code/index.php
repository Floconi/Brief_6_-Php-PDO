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
  
 
  <section class="filtre flex flex-col justify-center mb-3">

  <div class="flex justify-center" >
 


          
        
    



    



  <form class = "flex " method="get" action="">
     <?php 
    $table_cat = "categorie" ;
      $result = $pdo->query(" SELECT * 
      FROM $table_cat 
      ;");
      $categorie = $result->fetchAll(PDO::FETCH_ASSOC); 
  ?>
  
  
  <fieldset id="categorie_filtre" class="flex flex-col">
              <legend>
                <?php 
                $table_cat = ucfirst($table_cat)."s"; 
                echo $table_cat ?>
              </legend>
            <?php
            $numero_cat = 1;
            foreach($categorie as $uneCategorie) { ?>

              <div class="flex"> 
                <input name="<?php echo "categorie_n°".$numero_cat ?>" type="checkbox" id="<?php echo "categor".$numero_cat ?>" >
                <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>

              </div>
              <?php $numero_cat = $numero_cat + 1 ?>
            <?php };
             $numero_cat_max = $numero_cat?>
            
          </fieldset>

    <fieldset>
    <legend>Condition de sélection  entre les catégories uniquement:</legend>
      <div>
        <input type="radio" id="ou_categorie" name="condition_categorie_ou" checked />
        <label for="oucategorie">OU <br> (Ex : Je veux les résultats d'une catégorie ou alors les résultats d'une autre catégorie) </label>
      </div>
      <div>
        <input type="radio" id="et_categorie" name="condition_categorie_et"  />
        <label for="etcategorie">ET <br> (Ex : Je veux les résultats qui ont toutes les catégories sélectionnées)</label>
      </div>
    </fieldset>

    <fieldset>
    <legend>Condition de sélection  entre le(s) catégorie(s) et le domaine:</legend>
      <div>
        <input type="radio" id="ou_categorie_dom" name="condition_categorie_dom" checked />
        <label for="ou_categorie_dom">OU <br> (Ex : Je veux les résultats d'une catégorie ou alors les résultats d'un certain domaine) </label>
      </div>
      <div>
        <input type="radio" id="et_categorie_dom" name="condition_categorie_dom" />
        <label for="et_categorie_dom">ET <br> (Ex : Je veux les résultats d'une catégorie qui ont aussi un certain domaine)</label>
      </div>
    </fieldset>
  <?php 
    $table_dom = "domaine" ;
    $result = $pdo->query(" SELECT * 
    FROM $table_dom 
    ;");
    $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
  ?>
 <fieldset class="flex flex-col">
              <legend>
                    Domaine
              </legend>
<select id="selection_dom" name="filtre_domaine">
  <option value="aucun" selected>Aucun filtre</option>
  <?php
    $numero_dom = 1;
    foreach($domaine as $unDomaine) { ?>
      <option id="<?php echo "domaine_n°".$numero_dom ?>" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
      <?php $numero_dom = $numero_dom + 1 ?>
      <?php } ?>
    </select>


    <div class="flex justify-center w-48 items-center ">
        <button type=submit >
          Appliquer les filtres
    </button> 
    </div>
    
    

         
            

              <!--<div class="flex"> 
              <input type="radio" name="domaine" id="<?php //echo "domaine_n°".$numero_dom ?>" >
              <label id="<?php// echo "Label_domaine_n°".$numero_dom ?>" class="ml-2" for="<?php echo "domaine_n°".$numero_dom ?>"><?php echo $unDomaine['nom_domaine'] ?></label>
              </div>
              <?php// $numero_dom = $numero_dom + 1 ?>
            <?php// } ?>-->
          </fieldset>

        </div>


        


<!-- Zone de gestion de la requete en fonction des filtres -->
<?php 
  
  $Requete_SQL = "SELECT * FROM favori ";



  $index = 1;
  $index_id_cat = 0;
  $table_id_categorie = array();

  for ($index = 1 ; $index <= $numero_cat_max ; $index++){
    if (isset($_GET['categorie_n°'.$index])){
      $table_id_categorie[$index_id_cat] = $index;
      $index_id_cat = $index_id_cat + 1 ;

    };

  };
  
  print_r($table_id_categorie);

  print_r($_GET['condition_categorie_ou']);

  
  if ($_GET['condition_categorie_ou'] == "on"){
    $condition_categorie = "OR";

  }else{
    $condition_categorie = "AND";
  }

  if($_GET )

  

if ((isset($_GET['filtre_domaine'])) ) {
  if ($_GET['filtre_domaine'] != "aucun"){
    $Requete_SQL = $Requete_SQL."INNER JOIN domaine ON domaine.id_domaine = favori.id_dom  WHERE domaine.id_domaine = '".$_GET['filtre_domaine']."';";
  }
 


};
  var_dump($Requete_SQL);
  $result = $pdo->query($Requete_SQL);
  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 

?>  
    

    </section>

    <section id="bookmarks">
        <table class=" table_favori">
            <tr class="odd:bg-white even:bg-slate-50">
                <th class="border border-black bg-gray-400 hover:bg-red-900">ID favori</th>
                <th class="border border-black  bg-gray-400">Libellé</th>
                <th class="border border-black  bg-gray-400">Date de création (YYYY-MM-JJ)</th>
                <th class="border border-black  bg-gray-400">Lien</th>
                <th class="border border-black  bg-gray-400"> id_domaine sur favori </th>
                <th class="border border-black  bg-gray-400"> id domaine </th>
                <th class="border border-black  bg-gray-400">Nom de domaine</th>
                <th class="border border-black  bg-gray-400"> Gérer </th>
            </tr>
            <?php 
                foreach($favoris as $favori) {
                ?>
                <tr class="border-solid  old:bg-white even:bg-orange-200 hover:bg-green-200 ">
                <td class=" font-bold border border-b-black  h-full"><?php echo  $favori['id_favori'] ?></td>
                <td class="border border-b-black"><?php echo  $favori['libelle'] ?></td>
                <td class="border border-b-black"><?php echo  $favori['date_creation'] ?></td>
                <td class="border border-b-black"><?php echo  $favori['url'] ?></td>
                <td class="border border-b-black"><?php echo  $favori['id_dom'] ?></td>
                <td class="border border-b-black"><?php// echo  $favori['id_domaine'] ?></td>
                <td class="border border-b-black"><?php //echo  $favori['nom_domaine'] ?></td>
                <td class="flex border border-b-black">
                  <button class="bg-orange-500 p-3 rounded mr-2" >
                  <i class="fa-solid fa-pen-clip"></i>
                  </button>
                  <button class="bg-red-500 p-3 rounded" >
                  <i class="fa-solid fa-file-circle-xmark"></i>
                  </button>
            </tr>
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