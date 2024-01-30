<?php 
include("header.php");
include("pdo.php"); 

var_dump($_POST);

if (!empty($_POST)){
    echo "yes";
    $formulaire_soumis = true;
}else{
    echo "no";
    $formulaire_soumis = false;
}
$formulaireValide = true;

if ($formulaire_soumis == true){

    $formulaireValide = true;

    $saisie_table_id_categorie = array();

    $Requete_SQL = "SELECT count(id_categorie) as nomb_categorie FROM categorie";
    
    $result =  $pdo->query($Requete_SQL);
    $nomb_categorie = $result->fetch(PDO::FETCH_ASSOC);
    
        $index_id_cat =0;
        for ($index = 1 ; $index <= $nomb_categorie['nomb_categorie']; $index++){
            if (!empty($_POST['saisie_categorie_n°'.$index])){
            $saisie_table_id_categorie[$index_id_cat] = $index;
            $index_id_cat = $index_id_cat + 1 ;

            };
        };


        print_r( $saisie_table_id_categorie);
        if (count($saisie_table_id_categorie) == 0 ){
            $formulaireValide == false;
            $erreur_categorie = "Il faut sélectionner au moins une catégorie. Ceci est obligatoire";
           
        }else{
          $erreur_categorie = ""; 
        }

        
        if (!empty($_POST['saisie_libelle'])){
            if (strlen($_POST['saisie_libelle']) > 100){
                $erreur_libelle = "Le libelle ne doit pas exéder 100 caractères";
                $formulaireValide = false;
            }else{
                 $libelle = $_POST['saisie_libelle'];
            }
        }else{
            $erreur_libelle = "Veuillez écrire un libéllé , ce champs est obligatoire";
            $formulaireValide = false;
        };


       


        $libelle = "";
        if (!empty($_POST['saisie_url'])){
            $libelle = $_POST['saisie_url'];
            $erreur_url = "";
            if (strlen($_POST['saisie_url']) > 1000){
                $erreur_url = "Le libelle ne doit pas exéder 1000 caractères";
                $formulaireValide = false;
            }else{
                $url = $_POST['saisie_url'];
            }
        }else{
            $erreur_url = "L'url est un champs obligatoire Veuillez saisir un lien";
            $formulaireValide = false;
        }

        $date = date("Y-m-d");

        $domaine="";
        if (!empty($_POST['saisie_nom_domaine'])){
            $domaine = $_POST['saisie_nom_domaine'];
            $erreur_nom_dom ="";
        }else{
            $erreur_nom_dom = "Veuillez choisir un domaine dans la liste déroulante ce champs est obligatoire";
            $formulaireValide = false;
        };




        if ($formulaireValide == true){

            echo "VRAI §§§";
            $Requete_SQL = "INSERT INTO favori VALUES ('','".$libelle."','".$date."','".$url."',".$domaine.")";
            echo $Requete_SQL;
            //$pdo->query($Requete_SQL);
        
            $dernier_id = $pdo -> lastInsertId();

            for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
                $Requete_SQL = " INSERT INTO favori_categorie VALUES ('".$dernier_id."','".$saisie_table_id_categorie[$index]."')";
                // $pdo->query($Requete_SQL);
            }


        }else{
            echo "faux";
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


<form action="" method="POST">
    <div class="flex justify-center font-PE_libre_baskerville">
    
        <div class="informations  bg-orange-200border flex flex-col justify-center align-middle border border-black m-8 w-3/4">
            <div class="flex ">
                <div class="w-1/4  bg-orange-200 h-max flex justify-between border-b font-PE_libre_baskerville_italique border-black p-4 font-bold items-center"><p>ID du favori <span class="text-red-600">*</span></p><i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i></div>
                <p type="text" class=" w-full pl-5 border-b bg-orange-100 border-black flex justify-start items-center">Générer autaumatiquement</p>
            </div>
            <div class="flex flex-col">
                <div class="flex">
                    <div class="w-1/4 bg-orange-200 h-max flex border-b font-PE_libre_baskerville_italique border-black p-4 font-bold justify-between items-center"><p>Libelle du  favori <span class="text-red-600">*</span></p><i id="champ_libelle_icone" class="fa-solid fa-pencil"></i> </div>
                    <input type="text" name="saisie_libelle" class=" w-full pl-5 border-b bg-orange-100 border-black flex  items-center" onchange="ChangerCouleurIcone()" placeholder="Entrer un nom de libelle" id="champ_libelle"></input>
                </div>
                    <?php if (!empty($erreur_libelle) && $formulaire_soumis == true ){ ?>
                    <div class="bg-red-600 flex justify-center">
                        <?php echo $erreur_libelle ?>
                    </div>
                <?php } ?>
            </div>
            <div class="flex">
                <div class="w-1/4 h-max bg-orange-200 flex justify-between border-b font-PE_libre_baskerville_italique items-center border-black p-4 font-bold"><p>Date de création du favori <span class="text-red-600">*</span></p><i class="flex justify-center items-center text-red-600  fa-solid fa-lock"></i></div>
                 <?php
                    setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
                    $date = date("d-F-Y");
                    $date_fr = strftime('%d %B %Y',strtotime($date));

                 ?>
                <input type="text"  name="saisie_date_creation" disabled="disabled" class=" w-full pl-5 border-b bg-orange-100 border-black flex items-center" value="<?php echo $date_fr ?>"></input>
            </div>
            <div class="flex flex-col">
                <div class="flex">
                    <div class="w-1/4  h-max bg-orange-200  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold flex justify-between items-center"><p >URL <span class="text-red-600">*</span></p><i class="fa-solid fa-pencil"></i></div>
                    <input name="saisie_url" placeholder = "Entrer ou copier votre url..." class="w-full pl-5 border-b bg-orange-100 border-black flex justify-start  items-center"> </input>
                </div>
                    <?php if (!empty($erreur_url) && $formulaire_soumis == true ){ ?>
                        <div class="bg-red-600 flex justify-center">
                            <?php echo $erreur_url ?>
                        </div>
                <?php } ?>
            </div>
            <div class="flex ">
                    <div class="w-1/4  bg-orange-200 h-max flex fle  border-b font-PE_libre_baskerville_italique border-black p-4 font-bold justify-between items-center"><p>Domaine associé <span class="text-red-600">*</span></p><i class="fa-solid fa-pencil"></i></div>
                        <?php 
                            $table_dom = "domaine" ;
                            $result = $pdo->query(" SELECT * 
                            FROM $table_dom 
                            ;");
                            $domaine = $result->fetchAll(PDO::FETCH_ASSOC); 
                        ?>  
                        <select id="saisie_nom_domaine" name="saisie_nom_domaine" class="w-full pl-5 border-b bg-orange-100 border-black flex items-center text-[#9caabc]" onchange="changercouleurtexteselect()">
                            <option value="" class="font-PE_libre_baskerville text-[#9caabc]" selected>-- Veillez sélectionner un domaine (obligatoire) --</option>
                        <?php foreach($domaine as $unDomaine) { ?>
                                <option id="<?php echo "domaine_n°".$numero_dom ?>" class="text-black" value="<?php echo $unDomaine['id_domaine'] ?>" ><?php echo $unDomaine['nom_domaine'] ?></option>
                                <?php $numero_dom = $numero_dom + 1 ?>
                                <?php } ?>
                        </select>
                    </div>
                    <?php if ( !empty($erreur_nom_dom) && $formulaire_soumis == true ){ ?>
                        <div class="bg-red-600 flex justify-center">
                            <?php echo $erreur_nom_dom ?>
                        </div>
                    <?php } ?>
            <div class="flex ">
                <div class="w-1/4 flex bg-orange-200  font-PE_libre_baskerville_italique items-center p-4 font-bold justify-between"><p> Catégorie associées <span class="text-red-600">*</span></p><i class="fa-solid fa-pencil"></i></div>
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
                            <input name="<?php echo "saisie_categorie_n°".$numero_cat ?>" value="<?php echo  $uneCategorie['id_categorie']?>" type="checkbox" id="<?php echo "categorie".$numero_cat ?>" >
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
            <div class="flex ">
                <p class="w-1/4  bg-orange-200  flex justify-start border-b font-PE_libre_baskerville_italique p-4 font-bold">Validation </p>
                <div class="flex  justify-center w-full bg-orange-100 ">
                    <button type="submit" class="bg-blue-950 mt-2  text-white p-6 font-PE_nunito rounded flex justify-center mr-5 mb-5 items-center" >
                    <i class="fa-solid fa-plus flex text-center m-1 text-green-600"></i> 
                    <i class="fa-solid fa-book-bookmark m-1 text-green-600"></i><p class="m-1 text-green-600">Ajouter un favori<p>
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