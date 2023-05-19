<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $idS = isset($_POST['idS']) ? $_POST['idS'] : 0;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $gmail = isset($_POST['gmail']) ? $_POST['gmail'] : "";
    $DebutStage = isset($_POST['DebutStage']) ? $_POST['DebutStage'] : "";
    $FinStage = isset($_POST['FinStage']) ? $_POST['FinStage'] : "";
    $TypeStage = isset($_POST['TypeStage']) ? $_POST['TypeStage'] : "";
    $civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "F";
    $idFiliere = isset($_POST['idFiliere']) ? $_POST['idFiliere'] : 1;
    $IdDivision = isset($_POST['IdDivision']) ? $_POST['IdDivision'] : 1;

    // Préparation de la requête
    $requete = "UPDATE stagiaire SET nom = ?, prenom = ?, civilite = ?, idFiliere = ?, TypeStage = ?, DebutStage = ?, FinStage = ?, gmail = ?, IdDivision = ? WHERE idStagiaire = ?";
$params = array($nom, $prenom, $civilite, $idFiliere, $TypeStage, $DebutStage, $FinStage, $gmail, $IdDivision, $idS);

    // Exécution de la requête
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:stagiaires.php');
?>
