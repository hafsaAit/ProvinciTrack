<?php
require_once('identifier.php');
require_once("connexiondb.php");

$TypeDivision = isset($_GET['TypeDivision']) ? $_GET['TypeDivision'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête SQL pour récupérer les divisions avec filtres
$requete = "SELECT * FROM divisions";

// Ajout des filtres
if (!empty($TypeDivision)) {
    $requete .= " WHERE TypeDivision LIKE '%$TypeDivision%'";
}

$requete .= " LIMIT $size OFFSET $offset";

// Exécution de la requête
$resultatDivision = $pdo->query($requete);

// Requête SQL pour compter le nombre total de divisions (sans les filtres)
$requeteCount = "SELECT COUNT(*) AS countD FROM divisions";
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrDivision = $tabCount['countD'];

$reste = $nbrDivision % $size;
if ($reste === 0)
    $nbrPage = $nbrDivision / $size;
else
    $nbrPage = floor($nbrDivision / $size) + 1;
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des divisions</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("index.php"); ?>
        <main class="main">
            <div class="container">
                <div class="panel panel-success margetop60">
                    <div class="panel-heading">Rechercher des divisions</div>
                    <div class="panel-body">
                        <form method="get" action="division.php" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="TypeDivision" 
                                       placeholder="Nom de division"
                                       class="form-control"
                                       value="<?php echo $TypeDivision?>"/>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-search"></span>
                                Chercher...
                            </button> 
                            &nbsp;&nbsp;
                            <?php if ($_SESSION['user']['role']=='ADMIN') {?>
                                <a href="nouvelleDivision.php">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    Nouvelle division
                                </a>
                            <?php } ?>                 
                        </form>
                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Liste des divisions (<?php echo $nbrDivision ?> Divisions)</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id Division</th>
                                    <th>Nom de division</th>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') {?>
                                        <th>Actions</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            
                            <tbody>
    <?php while($Division = $resultatDivision->fetch()) { ?>
        <tr>
            <td><?php echo $Division['IdDivision'] ?></td>
            <td><?php echo $Division['TypeDivision'] ?></td>

            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                <td>
                    <a href="editerDivision.php?idF=<?php echo $Division['IdDivision'] ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    &nbsp;
                    <a onclick="return confirm('Etes vous sur de vouloir supprimer la division')"
                       href="supprimerDivision.php?idF=<?php echo $Division['IdDivision'] ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody>
</table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="division.php?page=<?php echo $i;?>&TypeDivision=<?php echo $TypeDivision ?>&IdDivision=<?php echo $IdDivision ?>">
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
