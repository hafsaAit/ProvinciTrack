<?php
    require_once('identifier.php');
    require_once("connexiondb.php");
  
    $nomPrenom = isset($_GET['nomPrenom']) ? $_GET['nomPrenom'] : "";
    $idfiliere = isset($_GET['idfiliere']) ? $_GET['idfiliere'] : 0;
    $IdDivision = isset($_GET['IdDivision']) ? $_GET['IdDivision'] : 0;

    $size = isset($_GET['size']) ? $_GET['size'] : 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $size;
    
    $requeteFiliere = "SELECT * FROM filiere";
    $requeteDivision = "SELECT * FROM divisions";
    
    if ($idfiliere == 0) {
        $requeteStagiaire = "SELECT s.idStagiaire, s.nom, s.prenom, f.nomFiliere, s.civilite, s.TypeStage, s.gmail, s.DebutStage, s.FinStage, d.TypeDivision
        FROM stagiaire AS s
        INNER JOIN filiere AS f ON f.idFiliere = s.idFiliere
        INNER JOIN divisions AS d ON d.IdDivision = s.IdDivision
        WHERE s.nom LIKE '%$nomPrenom%' OR s.prenom LIKE '%$nomPrenom%'
        ORDER BY s.idStagiaire
        LIMIT $size
        OFFSET $offset";
        
        $requeteCount = "SELECT COUNT(*) AS countS FROM stagiaire
                         WHERE nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%'";
    } else {
        $requeteStagiaire = "SELECT s.idStagiaire, s.nom, s.prenom, f.nomFiliere, s.civilite, s.TypeStage, s.gmail, s.DebutStage, s.FinStage, d.TypeDivision
               FROM stagiaire AS s
               INNER JOIN filiere AS f ON f.idFiliere = s.idFiliere
               INNER JOIN divisions AS d ON d.IdDivision = s.IdDivision
               WHERE (s.nom LIKE '%$nomPrenom%' OR s.prenom LIKE '%$nomPrenom%')
               AND s.idFiliere = $idfiliere
               ORDER BY s.idStagiaire
               LIMIT $size
               OFFSET $offset";
        
        $requeteCount = "SELECT COUNT(*) AS countS FROM stagiaire
                         WHERE (nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%')
                         AND idFiliere = $idfiliere";
    }

    $resultatDivision = $pdo->query($requeteDivision);
    $resultatFiliere = $pdo->query($requeteFiliere);
    $resultatStagiaire = $pdo->query($requeteStagiaire);
    $resultatCount = $pdo->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbrStagiaire = $tabCount['countS'];
    $reste = $nbrStagiaire % $size;
if ($reste === 0) {
    $nbrPage = $nbrStagiaire / $size;
}else{
    $nbrPage=floor($nbrStagiaire/$size)+1;
}
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des stagiaires</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php require("index.php"); ?>
        <main class="main">

     
        <div class="container">
        <div class="panel panel-success" style="margin-top: 345px;">


            
				<div class="panel-heading" >Rechercher des stagiaires
                <a href="exporterStagiaire.php" class="btn btn-primary btn-sm pull-right">
        <span class="glyphicon glyphicon-export"></span> Exporter
    </a>
                </div>
				
				<div class="panel-body" >
					<form method="get" action="stagiaires.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomPrenom" 
                                   placeholder="Nom et prénom"
                                   class="form-control"
                                   value="<?php echo $nomPrenom ?>"/>

                        
                        </div>
                            <label for="idfiliere">Filière:</label>
                            
				            <select name="idfiliere" class="form-control" id="idfiliere"
                                    onchange="this.form.submit()">
                                    
                                    <option value=0>Toutes les filières</option>
                                    
                                <?php while ($filiere=$resultatFiliere->fetch()) { ?>
                                
                                    <option value="<?php echo $filiere['idFiliere'] ?>"
                                    
                                        <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                                        
                                        <?php echo $filiere['nomFiliere'] ?> 
                                        
                                    </option>
                                    
                                <?php } ?>
                                
				            </select>
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouveauStagiaire.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Stagiaire
                                
                            </a>
                            
                         <?php }?>
					</form>
				</div>
			</div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des Stagiaires (<?php echo $nbrStagiaire ?> Stagiaires)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                 <th>Nom</th> <th>Prénom</th> 
                                <th>Filière</th> <th>E-mail</th><th>Type  stage</th> <th>Date début</th><th>Date fin</th><th>Division</th> <th>Attestation</th>
                                <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                	  <th>Actions</th>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($stagiaire=$resultatStagiaire->fetch()){ ?>
                                <tr>
                                    
                                    <td><?php echo $stagiaire['nom'] ?> </td>
                                    <td><?php echo $stagiaire['prenom'] ?> </td> 
                                    <td><?php echo $stagiaire['nomFiliere'] ?> </td>
                                    <td><?php echo $stagiaire['gmail'] ?> </td>
                                    <td><?php echo $stagiaire['TypeStage'] ?> </td> 
                                    
                                    <td><?php echo $stagiaire['DebutStage'] ?> </td>
                                    <td><?php echo $stagiaire['FinStage'] ?> </td>
                                    <td><?php echo $stagiaire['TypeDivision'] ?></td>

                                    
                                
           
                                    <td>
    <a href="imprimerAttestation.php?idStagiaire=<?php echo $stagiaire['idStagiaire'] ?>" target="_blank" class="btn btn-primary" style="background-color: #6495ED; width: 100px;">
        <i class="fas fa-print"></i> Imprimer
    </a>
    <style>
        .btn-primary:hover, .btn-primary:focus {
            background-color: #87CEEB; /* Couleur de fond lors du survol (bleu ciel) */
            color: #FFFFFF; /* Couleur du texte lors du survol */
            outline: none; /* Supprimer l'effet de focus lors du survol */
        }
    </style>
</td>



  

                                    
                                    
<?php if ($_SESSION['user']['role'] == 'ADMIN') {?>
    <td>
        <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
            <i class="fas fa-pencil-alt" style="color: blue;"></i>
        </a>
        &nbsp;
        <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le stagiaire !')"
           href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
            <i class="fas fa-trash-alt" style="color: red;"></i>
        </a>
    </td>
<?php }?>


                                    
                                    
                                 </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="stagiaires.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
                                    <?php echo $i; ?>
                                </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        </main>
    </body>
</HTML>