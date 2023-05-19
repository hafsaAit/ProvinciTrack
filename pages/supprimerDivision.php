<?php
require_once('identifier.php');
require_once("connexiondb.php");

if(isset($_GET['idF'])){
    $idDivision = $_GET['idF'];
    
    // Requête SQL pour supprimer la division
    $requete = "DELETE FROM divisions WHERE IdDivision = ?";
    $params = array($idDivision);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    if($resultat) {
        // Redirection vers la page division.php après la suppression
        header('Location: division.php');
    } else {
        echo "Erreur lors de la suppression de la division.";
    }
}
?>
