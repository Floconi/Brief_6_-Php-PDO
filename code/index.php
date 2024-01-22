<?php   
  include("header.php");
  include("pdo.php");

  // Affichage (SELECT) :
  $result = $pdo->query(" SELECT * 
    FROM `favori` 
    INNER JOIN domaine
    ON favori.id_dom = domaine.id_domaine
    ORDER BY favori.id_favori ASC;");
  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 

?>  
  <section class="filtre flex flex-col justify-center mb-3">

  <div class="flex justify-center" >
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
                <input type="checkbox" id="<?php echo "categorie_n°".$numero_cat ?>" >
                <label id="<?php echo "Label_categorie_n°".$numero_cat ?>" class="ml-2" for="<?php echo "categorie_n°".$numero_cat ?>"><?php echo $uneCategorie['nom_categorie'] ?></label>
              </div>
              <?php $numero_cat = $numero_cat + 1 ?>
            <?php } ?>
          </fieldset>
        
    


    <fieldset>
    <legend>Condition de sélection  entre les catégories uniquement:</legend>
      <div>
        <input type="radio" id="ou_categorie" name="condition_categorie" checked />
        <label for="oucategorie">OU <br> (Ex : Je veux les résultats d'une catégorie ou alors les résultats d'une autre catégorie) </label>
      </div>
      <div>
        <input type="radio" id="et_categorie" name="condition_categorie"  />
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
            <?php
            $numero_dom = 1;
            foreach($domaine as $unDomaine) { ?>

              <div class="flex"> 
              <input type="radio" name="domaine" id="<?php echo "domaine_n°".$numero_dom ?>" >
              <label id="<?php echo "Label_domaine_n°".$numero_dom ?>" class="ml-2" for="<?php echo "domaine_n°".$numero_dom ?>"><?php echo $unDomaine['nom_domaine'] ?></label>
              </div>
              <?php $numero_dom = $numero_dom + 1 ?>
            <?php } ?>
          </fieldset>

        </div>


        <div class="flex justify-center w-48 items-center ">
        <button class="bg-orange-400 p-3 rounded " onclick="AppliquerFiltre()">
          Appliquer les filtres
        </button> 
        </div>



        
    

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
                <td class="border border-b-black"><?php echo  $favori['id_domaine'] ?></td>
                <td class="border border-b-black"><?php echo  $favori['nom_domaine'] ?></td>
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