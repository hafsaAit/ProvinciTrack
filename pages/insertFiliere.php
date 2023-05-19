<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";
    $Université=isset($_POST['Université'])?$_POST['Université']:"";

    
    $requete="insert into filiere(Université,nomFiliere,niveau) values(?,?,?)";
    $params=array($Université,$nomf,$niveau);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:filieres.php');
?>