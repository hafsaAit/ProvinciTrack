<?php
require_once('identifier.php');
require_once('connexiondb.php');

$justification = isset($_POST['justification']) ? $_POST['justification'] : "";
$date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : "";
$date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";

// Requête pour trouver l'ID du stagiaire
$requeteStagiaire = "SELECT idStagiaire FROM stagiaire WHERE nom = ? AND prenom = ?";
$resultatStagiaire = $pdo->prepare($requeteStagiaire);
$resultatStagiaire->execute([$nom, $prenom]);

if ($resultatStagiaire->rowCount() > 0) {
    // Stagiaire trouvé, récupérer l'ID
    $idStagiaire = $resultatStagiaire->fetch()['idStagiaire'];

    // Requête pour insérer l'absence
    $requete = "INSERT INTO Absence (justification, date_debut, date_fin, idStagiaire) VALUES (?, ?, ?, ?)";
    $params = array($justification, $date_debut, $date_fin, $idStagiaire);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:Absence.php');
} else {
    // Stagiaire non trouvé, afficher un message d'erreur ou prendre une autre action
    echo "Stagiaire non trouvé. Veuillez vérifier le nom et le prénom saisis.";
}
?>
