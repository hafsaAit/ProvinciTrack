<?php
require_once('identifier.php');
require_once("connexiondb.php");

$nomPrenom = isset($_GET['nomPrenom']) ? $_GET['nomPrenom'] : "";
$requeteStagiaire = "SELECT idStagiaire, nom, prenom, nomFiliere, civilite, TypeStage, DebutStage, FinStage, gmail 
                    FROM filiere AS f, stagiaire AS s
                    WHERE f.idFiliere = s.idFiliere
                    AND (nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%')
                    ORDER BY idStagiaire";

$resultatStagiaire = $pdo->query($requeteStagiaire);


$delimiter = ";";
$filename = "export_stagiaires.csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Créer le fichier CSV et écrire l'en-tête
$output = fopen('php://output', 'w');
fputcsv($output, array('Id Stagiaire', 'Nom', 'Prenom', 'Filiere', 'Civilite', 'Type de stage', 'Debut de stage', 'Fin de stage', 'Gmail'), $delimiter);

// Écrire les données des stagiaires dans le fichier CSV
while ($stagiaire = $resultatStagiaire->fetch()) {
    // Extraire les valeurs individuelles de chaque colonne du tableau $stagiaire
    $idStagiaire = $stagiaire['idStagiaire'];
    $nom = $stagiaire['nom'];
    $prenom = $stagiaire['prenom'];
    $nomFiliere = $stagiaire['nomFiliere'];
    $civilite = $stagiaire['civilite'];
    $typeStage = $stagiaire['TypeStage'];
    $debutStage = $stagiaire['DebutStage'];
    $finStage = $stagiaire['FinStage'];
    $gmail = $stagiaire['gmail'];

    // Convertir les valeurs en encodage UTF-8
    $idStagiaire = utf8_decode($idStagiaire);
    $nom = utf8_decode($nom);
    $prenom = utf8_decode($prenom);
    $nomFiliere = utf8_decode($nomFiliere);
    $civilite = utf8_decode($civilite);
    $typeStage = utf8_decode($typeStage);
    $debutStage = utf8_decode($debutStage);
    $finStage = utf8_decode($finStage);
    $gmail = utf8_decode($gmail);

    // Écrire les valeurs dans le fichier CSV
    fputcsv($output, array($idStagiaire, $nom, $prenom, $nomFiliere, $civilite, $typeStage, $debutStage, $finStage, $gmail), $delimiter);
}

fclose($output);
exit();
?>
