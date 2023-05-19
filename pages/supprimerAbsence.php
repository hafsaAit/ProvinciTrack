<?php
session_start();
if (isset($_SESSION['user'])) {

    require_once('connexiondb.php');
    $idStagiaire = isset($_GET['idStagiaire']) ? $_GET['idStagiaire'] : 0;
    $Id_Absence = isset($_GET['Id_Absence']) ? $_GET['Id_Absence'] : 0;

    $requeteAbsence = "select count(*) countAbs from absence where idStagiaire=$idStagiaire";
    $resultatAbsence = $pdo->query($requeteAbsence);
    $nbrAbs=$resultatAbsence->fetch()['countAbs'];
// Modification ici

    if ($nbrAbs == 0) {
        $requete = "delete from absence where Id_Absence=?";
        $params = array($Id_Absence);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:Absence.php');
    } else {
        $msg = "Suppression impossible: Vous devez supprimer tous les stagiaires qui sont absents ";
        header("location:alerte.php?message=$msg");
    }
} else {
    header('location:login.php');
}


?>