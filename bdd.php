<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=l\'instant', 'root', "");
}catch(PDOException $e){
    die('Erreur connexion : '.$e->getMessage());
}
?>
