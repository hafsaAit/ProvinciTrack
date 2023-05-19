<?php
require_once('identifier.php');
require_once('connexiondb.php');
$idAbsence = isset($_GET['idAbsence']) ? $_GET['idAbsence'] : 0;

$requeteAbs = "SELECT * FROM absence WHERE Id_Absence = $idAbsence";
$resultatAbs = $pdo->query($requeteAbs);
$absence = $resultatAbs->fetch();
if ($absence) {
    $justification = $absence['justification'];
    $date_debut = $absence['date_debut'];
    $date_fin = $absence['date_fin'];
    $idStagiaire = $absence['idStagiaire'];

    $requeteS = "SELECT * FROM stagiaire WHERE idStagiaire = $idStagiaire";
    $resultatS = $pdo->query($requeteS);
    $stagiaire = $resultatS->fetch();

    if ($stagiaire) {
        $nom = $stagiaire['nom'];
        $prenom = $stagiaire['prenom'];
    } else {
        // Traitez le cas où le stagiaire n'a pas été trouvé
        $nom = '';
        $prenom = '';
    }
} else {
    // Traitez le cas où aucune absence n'a été trouvée
    $justification = '';
    $date_debut = '';
    $date_fin = '';
    $idStagiaire = '';
    $nom = '';
    $prenom = '';
}
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <?php require("index.php"); ?>
        <main class="main">
        <div class="container">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Edition d'absence :</div>
        <div class="panel-body">
            <form method="post" action="updateAbsence.php" class="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="idAbsence">id d'absence: <?php echo $idAbsence ?></label>
                    <input type="hidden" name="idAbsence" class="form-control" value="<?php echo $idAbsence ?>"/>
                </div>
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" placeholder="Nom" class="form-control"
                           value="<?php echo $nom; ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" placeholder="Prénom" class="form-control"
                           value="<?php echo $prenom; ?>">
                </div>

                


                

                <div class="form-group">
               <label for="justification">Justification :</label>
             <input type="text" name="justification" placeholder="Justification" 
                    class="form-control" value="<?php echo $justification; ?>">
                </div>

              <div class="form-group">
            <label for="date_debut">Date début :</label>
            <input type="date" name="date_debut" placeholder="Date début" 
           class="form-control" value="<?php echo $date_debut; ?>">
            </div>

            <div class="form-group">
            <label for="date_fin">Date fin :</label>
             <input type="date" name="date_fin" placeholder="Date fin" 
           class="form-control" value="<?php echo $date_fin; ?>">
              </div>

                        

				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button> 
                      
					</form>
                </div>
            </div>   
        </div>      
       </main>   
    </body>
</HTML>