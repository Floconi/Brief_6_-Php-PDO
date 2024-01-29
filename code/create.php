<?php 
include("header.php");
include("pdo.php"); 

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

    if (!empty($_POST['saisie_url'])){
        $url = $_POST['saisie_url'];
    }

    if (!empty($_POST['saisie_libelle'])){
        $libelle = $_POST['saisie_libelle'];
    }

    $date = date("Y-m-d");

    $domaine = "000";
    if (!empty($_POST['saisie_nom_domaine'])){
        $domaine = $_POST['saisie_nom_domaine'];
    };


    $Requete_SQL = "INSERT INTO favori VALUES ('','".$libelle."','".$date."','".$url."',".$domaine.")";
    echo $Requete_SQL;
    $pdo->query($Requete_SQL);
   
    $dernier_id = $pdo -> lastInsertId();
    echo $dernier_id;

    for ($index = 0 ; $index < count($saisie_table_id_categorie); $index++){
        $Requete_SQL = " INSERT INTO favori_categorie VALUES ('".$dernier_id."','".$saisie_table_id_categorie[$index]."')";
        $pdo->query($Requete_SQL);
    }


    












?>