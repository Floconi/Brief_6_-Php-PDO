<?php   include("header.php");
        include("pdo.php");

        // Affichage (SELECT) :
        $result = $pdo->query(" SELECT * 
        FROM `favori` 
        INNER JOIN domaine
        ON favori.id_dom = domaine.id_domaine
        ORDER BY favori.id_favori ASC;");
        $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
?>

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