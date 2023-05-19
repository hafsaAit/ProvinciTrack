<?php
    require_once("connexiondb.php");
    
    $idStagiaire = $_GET['idStagiaire'];
    
    $requete = "SELECT cv_path FROM stagiaire WHERE idStagiaire = :id";
    $params = array(':id' => $idStagiaire);
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    if ($resultat->rowCount() > 0) {
        $cv_path = $resultat->fetch()['cv_path'];
        $cv_path = 'chemin/vers/le/dossier/cv/' . $cv_path; // Remplacez ce chemin par le chemin réel vers le dossier contenant les CV
        
        // Afficher le fichier sans le télécharger
        header('Content-type: application/pdf'); // Remplacez le type MIME si nécessaire
        readfile($cv_path);
    } else {
        echo "CV introuvable";
    }
?>
