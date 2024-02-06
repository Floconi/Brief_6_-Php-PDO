<?php
  include("header.php");
  include("pdo.php"); 


  $table_dom = "domaine" ;
  $result = $pdo->query(" SELECT * 
  FROM $table_dom 
  ;");
  $domaines = $result->fetchAll(PDO::FETCH_ASSOC); 




  
$table_cat = "categorie" ;
  $result = $pdo->query(" SELECT * 
  FROM $table_cat 
  ;");
 
  $categories = $result->fetchAll(PDO::FETCH_ASSOC); 

?>  
<div class="flex" ><h2 class="text-green-600 flex font-PE_libre_baskerville_italique justify-center rounded m-auto p-4 bg-white">Gérer les favoris et catégorie</h2></div>
    <form action="index.php" method="GET" class="flex justify-center">
                        <button type="submit" class=" p-2 rounded m-2 bg-blue-950 " >
                        <i class="text-green-600 fa-solid fa-house-chimney"></i><p class="text-green-600"> Retour sur l'acceuil</p>
                        </button>
    </form>
    
  <section id="bookmarks" class = "flex justify-around ">

    <fieldset class="flex flex-col border border-black p-4 m-4 rounded mb-5 md:mb-0 h-max">
        <legend class="flex justify-center text-center border border-black rounded p-4 font-PE_libre_baskerville_italique"> Domaine</legend>
        <form action="ajouter_dom.php" method="GET" class="items-center flex justify-center pb-5">
        <button type="submit" class="bg-blue-950  text-white p-6 font-PE_nunito rounded flex justify-center flex-col " >
            <div>
                <div class=" text-center">
                    <i class="fa-solid fa-plus flex text-center"></i> 
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <p>Ajouter un domaine<p>
            </div>
            </button>
        </form>
        <table class="flex justify-center table_favori">
            <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200">
                <th class=" border justify-center items-center align-middle border-black ">
                    id domaine
                </th>
                <th class=" border justify-center items-center align-middle border-black ">
                    nom_domaine
                </th>
                <th class=" border justify-center items-center align-middle border-black ">
                    Gérer
                </th>
            </tr>
            
                <?php 
                foreach($domaines as $domaine){ ?>
                    <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200" >
                        <td class=" border  justify-center items-center align-middle border-black text-center">
                            <?php echo   $domaine['id_domaine']  ?>    
                        </td>
                        <td class=" border justify-center  align-middle border-black  text-center">
                            <?php echo   $domaine['nom_domaine']  ?>    
                        </td>
                        <td class=" border justify-center items-center align-middle border-black ">
                          <div class="flex ">
                            <form action="modifier_dom.php" method="GET">
                              <button class=" p-3 rounded mr-2 ml-2" name="id_du_domaine" value="<?php echo $domaine['id_domaine']?>">
                                <i class=" text-orange-600 fa-solid fa-pen-clip"></i>
                              </button>
                            </form>
                            <form action="suprimer_dom.php" method="GET">
                            <button type="submit" name="id_du_domaine" class=" p-3 rounded" value="<?php echo $domaine['id_domaine'] ?>">
                            <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i>
                            </button>
                            </form>
                          </div>
                        </td>
                    </tr>
                <?php } ?>
        </table>
    </fieldset>
    <fieldset class="flex flex-col border border-black p-4 m-4 justify-around rounded mb-5 md:mb-0">
        <legend class="flex justify-center text-center border border-black rounded p-4 font-PE_libre_baskerville_italique"> Catégories</legend>
        <form action="ajouter_cat.php" method="GET" class="items-center flex justify-center pb-5">
        <button type="submit" class="bg-blue-950  text-white p-6 font-PE_nunito rounded flex justify-center flex-col " >
            <div>
                <div class=" text-center">
                    <i class="fa-solid fa-plus flex text-center"></i> 
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <p>Ajouter une categorie<p>
            </div>
            </button>
        </form>
        <table class="flex justify-center table_favori">
            <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200">
                <th class=" border justify-center items-center align-middle border-black ">
                    id categorie
                </th>
                <th class=" border justify-center items-center align-middle border-black ">
                    nom_categorie
                </th>
                <th class=" border justify-center items-center align-middle border-black ">
                    Gérer
                </th>
            </tr>
            
                <?php 
                foreach($categories as $categorie){ ?>
                    <tr class="border-solid  odd:bg-orange-100 even:bg-orange-300 hover:bg-green-200" >
                        <td class=" border justify-center items-center align-middle border-black text-center">
                            <?php echo   $categorie['id_categorie']  ?>    
                        </td>
                        <td class=" border justify-center items-center align-middle border-black text-center">
                            <?php echo   $categorie['nom_categorie']  ?>    
                        </td>
                        <td class=" border justify-center items-center align-middle border-black ">
                          <div class="flex ">
                        
                            <form action="modifier_cat.php" method="GET">
                              <button class=" p-3 rounded mr-2 ml-2" name="id_du_categorie" value="<?php echo $categorie['id_categorie']?>">
                                <i class=" text-orange-600 fa-solid fa-pen-clip"></i>
                              </button>
                            </form>
                            <form action="suprimer_cat.php" method="GET">
                            <button type="submit" name="id_du_categorie" class=" p-3 rounded" value="<?php echo $categorie['id_categorie'] ?>">
                            <i class="text-rose-700 text-red fa-solid fa-file-circle-xmark"></i>
                            </button>
                            </form>
                          </div>
                        </td>
                    </tr>
                <?php } ?>
        </table>
        </fieldset>
    </section>
             
<?php include("footer.php") ?>

















?>