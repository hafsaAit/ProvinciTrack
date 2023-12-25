<?php
// Récupérer les informations du stagiaire depuis la base de données
require_once('identifier.php');
require_once('connexiondb.php');

$idStagiaire = isset($_GET['idStagiaire']) ? $_GET['idStagiaire'] : 0;

// Requête pour récupérer les informations du stagiaire
$requeteStagiaire = "SELECT * FROM stagiaire WHERE idStagiaire = ?";
$resultatStagiaire = $pdo->prepare($requeteStagiaire);
$resultatStagiaire->execute([$idStagiaire]);

if ($stagiaire = $resultatStagiaire->fetch()) {
    $nomStagiaire = $stagiaire['nom'];
    $prenomStagiaire = $stagiaire['prenom'];
    $typeStage = $stagiaire['TypeStage'];
  
    $DebutStage = $stagiaire['DebutStage'];
    $FinStage = $stagiaire['FinStage'];
} else {
    // Si le stagiaire n'existe pas, rediriger vers la page des stagiaires
    header('Location: stagiaires.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attestation de stage</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: left;
            margin-bottom: 60px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature .name {
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <div>ROYAUME DU MAROC</div>
        <div> MINISTERE DE L'INTERIEUR</div>
        <div> PROVINCE DE TAROUDANNT</div>
        <div> DIVISION DE RESSOURCES HUMAINES</div>
        <div>N°----/PT/D.R.H</div>
    </div>
    <div class="title">Attestation de Stage</div>
    <div class="content">
    <p>Le Gouverneur de la province de Taroudant, atteste que</p>
<p><strong>Mr/Mlle <?php echo $nomStagiaire; ?> <?php echo $prenomStagiaire; ?></strong> a effectué(e) un stage "<strong><?php echo $typeStage; ?></strong>"</p>
<p>durant la période du "<strong><?php echo $DebutStage; ?></strong>" au "<strong><?php echo $FinStage; ?></strong>"</p>
<p>Cette attestation est délivrée à l'intéressé(e) pour servir et valoir ce que de droit.</p>

    </div>
    <div>&nbsp;</div>
    

    <div class="footer">
        <p>Fait le : <?php echo date('d/m/Y'); ?></p>
       
        <p>Nom du responsable : </p>
        <p>Signature : _________</p>
    </div>
</body>
</html>

