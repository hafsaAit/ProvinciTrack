<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
   
    $requeteF="select * from filiere";
 
    $resultatF=$pdo->query($requeteF);

    $requeteDivisions = "SELECT * FROM divisions";
$resultatDivisions = $pdo->query($requeteDivisions);

    

?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
   
    <body>
    <?php require("index.php"); ?>
    
    <main class="main">
        <div class="container">
        
             
        <div class="panel panel-primary"  style="margin-top: 330px;">

                <div class="panel-heading">Les infos du nouveau stagiaire :</div>
                <div class="panel-body">
                    <form method="post" action="insertStagiaire.php" class="form"  enctype="multipart/form-data">
						
                        <div class="form-group">
                             <label for="nom ">Nom  :</label>
                            <input type="text" name="nom" placeholder="Nom" class="form-control"/>
                        </div>

                        <div class="form-group">
                             <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" placeholder="Prénom" class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                            <div class="radio">
                                <label><input type="radio" name="civilite" value="F" checked/> F </label><br>
                                <label><input type="radio" name="civilite" value="M"/> M </label>
                                </div>
                                <div class="form-group">
                             <label for="gmail"> Gmail:</label>
                            <input type="text" name="gmail" placeholder="Gmail" class="form-control"/>
                        </div>
                        </div>
                            <div class="form-group">
                             <label for="TypeStage"> Type de stage:</label>
                            <input type="text" name="TypeStage" placeholder="Type de stage" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="DebutStage">Date début :</label>
                            <input type="date" name="DebutStage" placeholder="Date début" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="FinStage">Date fin :</label>
                            <input type="date" name="FinStage" placeholder="Date fin" class="form-control"/>
                        </div>

                       

                        
                        <div class="form-group">
                            <label for="idFiliere">Filière:</label>
				            <select name="idFiliere" class="form-control" id="idFiliere">
                              <?php while($filiere=$resultatF->fetch()) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>"> 
                                    <?php echo $filiere['nomFiliere'] ?>
                                </option>
                              <?php }?>
				            </select>
                        </div>

                        <div class="form-group">
    <label for="idDivision">Division :</label>
    <select name="idDivision" class="form-control" id="idDivision">
        <?php while ($division = $resultatDivisions->fetch()) { ?>
            <option value="<?php echo $division['idDivision'] ?>">
                <?php echo $division['TypeDivision'] ?>
            </option>
        <?php } ?>
    </select>
</div>

                       
                        
                              

				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button> 
                              </div>
					</form>
                </div>
            </div>   
        </div>   
        </main>   
    </body>
                             
</HTML>