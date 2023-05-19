<?php
require_once('identifier.php');
require_once("connexiondb.php");

if(isset($_GET['idF'])){
    $idDivision = $_GET['idF'];
    
    // Requête SQL pour récupérer les informations de la division à modifier
    $requete = "SELECT * FROM divisions WHERE IdDivision = ?";
    $params = array($idDivision);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    if($resultat->rowCount() == 0){
        header('Location: division.php');
    } else {
        $division = $resultat->fetch();
        $TypeDivision = $division['TypeDivision'];
    }
}

if(isset($_POST['modifier'])){
    $idDivision = $_POST['idDivision'];
    $TypeDivision = $_POST['TypeDivision'];
    
    // Requête SQL pour mettre à jour les informations de la division
    $requete = "UPDATE divisions SET TypeDivision = ? WHERE IdDivision = ?";
    $params = array($TypeDivision, $idDivision);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    if($resultat) {
        header('Location: division.php');
    } else {
        echo "Erreur lors de la modification de la division.";
    }
}
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Modification d'une division</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("index.php"); ?>
        <main class="main">
            <div class="container">
                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Modification d'une division</div>
                    <div class="panel-body">
                        <form method="post" action="editerDivision.php" class="form">
                            <input type="hidden" name="idDivision" value="<?php echo $idDivision; ?>">
                            <div class="form-group">
                                <label for="TypeDivision">Nom de division :</label>
                                <input type="text" name="TypeDivision" id="TypeDivision" class="form-control" value="<?php echo $TypeDivision; ?>" required>
                            </div>
                            <button type="submit" name="modifier" class="btn btn-primary">
                                Modifier
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</HTML>
