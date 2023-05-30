<?php
   require_once('identifier.php');
    require_once('connexiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;
    $requete="select * from filiere where idFiliere=$idf";
    $resultat=$pdo->query($requete);
    $filiere=$resultat->fetch();
    $nomf=$filiere['nomFiliere'];
    $niveau=strtolower($filiere['niveau']);
    $Université=($filiere['Université']);
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'une filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <?php require("index.php"); ?>
        <main class="main">
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition de la filière :</div>
                <div class="panel-body">
                    <form method="post" action="updateFiliere.php" class="form">
						<div class="form-group">
                             
                            <input type="hidden" name="idF" 
                                   class="form-control"
                                    value="<?php echo $idf ?>"/>
                        </div>

                        <div class="form-group">
                             <label for="niveau">Université:</label>
                            <input type="text" name="Université" 
                                   placeholder="Université"
                                   class="form-control"
                                   value="<?php echo $Université ?>"/>
                        </div>
                        
                        <div class="form-group">
                             <label for="niveau">Nom de la filière:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"
                                   value="<?php echo $nomf ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
				            <select name="niveau" class="form-control" id="niveau">
                                <option value="Qualification" <?php if($niveau=="Qualification") echo "selected" ?>>Qualification</option>
                                <option value="Technicien" <?php if($niveau=="Technicien") echo "selected" ?>>Technicien</option>
                                <option value="Technicien Spécialisé"<?php if($niveau=="Technicien Spécialisé") echo "selected" ?>>Technicien Spécialisé</option>
                                <option value="Licence" <?php if($niveau=="Licence") echo "selected" ?>>Licence</option>
                                <option value="Master" <?php if($niveau=="Master") echo "selected" ?>>Master</option> 
				            </select>
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