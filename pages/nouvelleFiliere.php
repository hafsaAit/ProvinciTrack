<?php 
    require_once('identifier.php');
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <?php require("index.php"); ?>
        <main class="main">
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Veuillez saisir les données de la nouvelle filère</div>
                <div class="panel-body">
                    <form method="post" action="insertFiliere.php" class="form">

                    <div class="form-group">
                             <label for="niveau">Université:</label>
                            <input type="text" name="Université" 
                                   placeholder="Université"
                                   class="form-control"/>
                        </div>
						
                        <div class="form-group">
                             <label for="niveau">Nom de la filière:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
				            <select name="niveau" class="form-control" id="niveau">
                                <option value="Qualification">Qualification</option>
                                <option value="Technicien">Technicien</option>
                                <option value="Technicien Spécialisé" selected>Technicien Spécialisé</option>
                                <option value="Licence">Licence</option>
                                <option value="Master">Master</option> 
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