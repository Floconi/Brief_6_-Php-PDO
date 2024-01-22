<?php
/* Connection à la base de données */
$pdo = new PDO('mysql:host=localhost;dbname=favoris', 'root', '', 
array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));



//echo "Bonjour je suis $employe[prenom] $employe[nom] du service $employe[service]<br>";
?>