<?php
try {

        $pdo = new PDO("mysql:host=127.0.0.1:3325   ; dbname=gestion_stag", 
        "root", "");

}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());

    //die('Erreur : impossible de se connecter à la base de donnée');
}
?>

