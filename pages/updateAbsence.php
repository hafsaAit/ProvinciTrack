<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idAbsence=isset($_POST['idAbsence'])?$_POST['idAbsence']:0;
    
    $justification = isset($_POST['justification']) ? $_POST['justification'] : "";

    $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : "";
    $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : "";

    $idStagiaire=isset($_POST['idStagiaire'])?$_POST['idStagiaire']:1;

    

   
    $requete = "UPDATE absence SET justification=?, idStagiaire=?, date_debut=?, date_fin=? WHERE Id_Absence=?";

    $params = array($justification, $idStagiaire, $date_debut, $date_fin, $idAbsence);

   

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:Absence.php');

?>
