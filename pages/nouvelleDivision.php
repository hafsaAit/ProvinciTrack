<?php
require_once('identifier.php');
require_once("connexiondb.php");

if(isset($_POST['ajouter'])){
    $TypeDivision = $_POST['TypeDivision'];
    
    // Requête SQL pour insérer la nouvelle division
    $requete = "INSERT INTO divisions (TypeDivision) VALUES (?)";
    $params = array($TypeDivision);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    if($resultat) {
        // Redirection vers la page division.php après l'ajout
        header('Location: division.php');
    } else {
        echo "Erreur lors de l'ajout de la division.";
    }
}
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Ajouter une division</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("index.php"); ?>
        <main class="main">
            <div class="container">
                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Ajouter une division</div>
                    <div class="panel-body">
                        <form method="post" action="nouvelleDivision.php" class="form">
                            <div class="form-group">
                                <label for="TypeDivision">Nom de division :</label>
                                <input type="text" name="TypeDivision" id="TypeDivision" class="form-control" required>
                            </div>
                            <button type="submit" name="ajouter" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span>
                                Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</HTML>
