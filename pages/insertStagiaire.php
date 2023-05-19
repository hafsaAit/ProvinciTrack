<?php
require_once('identifier.php');
require_once('connexiondb.php');

$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$TypeStage = isset($_POST['TypeStage']) ? $_POST['TypeStage'] : "";
$DebutStage = isset($_POST['DebutStage']) ? $_POST['DebutStage'] : "";
$FinStage = isset($_POST['FinStage']) ? $_POST['FinStage'] : "";
$gmail = isset($_POST['gmail']) ? $_POST['gmail'] : "";
$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "F";
$idFiliere = isset($_POST['idFiliere']) ? $_POST['idFiliere'] : 1;
$IdDivision = isset($_POST['IdDivision']) ? $_POST['IdDivision'] : 1;



$requete = "INSERT INTO stagiaire (nom, prenom, civilite, idFiliere, TypeStage, DebutStage, FinStage, gmail, idDivision) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = array($nom, $prenom, $civilite, $idFiliere, $TypeStage, $DebutStage, $FinStage, $gmail, $IdDivision);


$resultat = $pdo->prepare($requete);
$resultat->execute($params);

header('location: stagiaires.php');
?>
