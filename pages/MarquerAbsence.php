<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');

    $requeteStagiaire="select * from stagiaire";
    $resultatStagiaire=$pdo->query($requeteStagiaire);
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Marquer l'absence</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <?php require("index.php"); ?>
        <main class="main">
        
        
        <div class="container">
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Marquer Absence</div>
                <div class="panel-body">
                    <form method="post" action="insertAbsence.php" class="form">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" placeholder="Nom" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" placeholder="Prénom" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="justification">Justification:</label>
                            <input type="text" name="justification" placeholder="Justification" class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="date_debut">Date début :</label>
                            <input type="date" name="date_debut" placeholder="Date début" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date fin :</label>
                            <input type="date" name="date_fin" placeholder="Date fin" class="form-control"/>
                        </div>
                        
       

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok"></span>
                            Marquer
                        </button> 
                    </form>
                </div>
            </div>
        </div>      
</main>     
    </body>
</HTML>