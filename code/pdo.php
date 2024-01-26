<?php

require ("conect.php");
/* Connection à la base de données */
try{
    $pdo = new PDO('mysql:host='.SERVEUR.';dbname='.BASE , USER , PASSWORD,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch(PDOExeption $e){
    echo "Echec de la connection :%s\n" .$e->getMessage();
    exit();
}




//echo "Bonjour je suis $employe[prenom] $employe[nom] du service $employe[service]<br>";
?>