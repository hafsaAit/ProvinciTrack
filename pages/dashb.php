<?php
require_once('identifier.php');
require_once("connexiondb.php");

// Compter le nombre d'utilisateurs
$countUtilisateursQuery = "SELECT COUNT(*) AS count FROM utilisateur";
$countUtilisateursResult = $pdo->query($countUtilisateursQuery);
$countUtilisateurs = $countUtilisateursResult->fetchColumn();

// Compter le nombre de stagiaires
$countStagiairesQuery = "SELECT COUNT(*) AS count FROM stagiaire";
$countStagiairesResult = $pdo->query($countStagiairesQuery);
$countStagiaires = $countStagiairesResult->fetchColumn();

// Compter le nombre de filières
$countFilieresQuery = "SELECT COUNT(*) AS count FROM filiere";
$countFilieresResult = $pdo->query($countFilieresQuery);
$countFilieres = $countFilieresResult->fetchColumn();

$activiteQuery = "SELECT login, email,  role, etat FROM utilisateur";
$activiteResult = $pdo->query($activiteQuery);
$activiteData = $activiteResult->fetchAll(PDO::FETCH_ASSOC);

$countStagiairesQuery = "SELECT COUNT(*) AS count, IdDivision FROM stagiaire GROUP BY IdDivision";
$countStagiairesResult = $pdo->query($countStagiairesQuery);
$countStagiairesData = $countStagiairesResult->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre de divisions
$countDivisionsQuery = "SELECT COUNT(*) AS count FROM divisions";
$countDivisionsResult = $pdo->query($countDivisionsQuery);
$countDivisions = $countDivisionsResult->fetchColumn();

$activiteQuery = "SELECT login, email, role, etat FROM utilisateur";
$activiteResult = $pdo->query($activiteQuery);
$activiteData = $activiteResult->fetchAll(PDO::FETCH_ASSOC);

$countStagiairesQuery = "SELECT COUNT(*) AS count, IdDivision FROM stagiaire GROUP BY IdDivision";
$countStagiairesResult = $pdo->query($countStagiairesQuery);
$countStagiairesData = $countStagiairesResult->fetchAll(PDO::FETCH_ASSOC);


$totalStagiaires = 0;
$labels = [];
$percentages = [];

foreach ($countStagiairesData as $stagiaireData) {
    $count = $stagiaireData['count'];
    $totalStagiaires += $count;

    $divisionQuery = "SELECT TypeDivision FROM divisions WHERE IdDivision = :idDivision";
    $divisionStatement = $pdo->prepare($divisionQuery);
    $divisionStatement->bindParam(':idDivision', $stagiaireData['IdDivision']);
    $divisionStatement->execute();
    $division = $divisionStatement->fetchColumn();

    $labels[] = $division;
    $percentages[] = ($count / $countStagiaires) * 100;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-pdjojwPY2QIftO4ZH9hqEwc8i0G/g6Uzpm6UooJ6Uc8dKjQtl/4f60+C4AC9PZjKkxvj+dq3FqzrvbH1vE8WwQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Styling for the dashboard */
        body {
            font-family: sans-serif;
            margin: 0;
        }

        .dashboard {
            padding: 20px;
            position:fixed;
        }

        .overview {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: -90px;
            margin-left:-100px;

        }

        .overview-item {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: -12px;
    
            width: 230px;
            margin: 0.5rem;
            
            
        }

        .item-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .item-count {
            font-size: 24px;
        }

        .activity {
            margin-top: 65px;
            font-size: 19px;
        }

        .activity .title {
            font-weight: bold;
            font-size: 17px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .table-header {
            background-color: #f5f5f5;
        }

        .table-header th {
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .table-row td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-row:hover {
            background-color: #f1f1f1;
        }

        #pieChart {
            max-width: 350px;
            margin-left: auto;
            margin-right: -200px;
            margin-top:65px;
        }
        .dashboard-row {
    display: flex;
    flex-wrap: wrap;
    margin-top: 40px;
    margin-left:-200px;
}

.activity {
    flex-basis: 70%;
    margin-right: -160px;
    margin-left: 90px;
}

.chart-container {
    flex-basis: 30%;
    display: flex;
    justify-content: flex-end;
}

.chart-container canvas {
    max-width: 100%;
}

h1.dashboard-title {
  text-align: left;
  margin-left: -800px;
}
/* Autres styles restants */

    </style>
</head>

<body>
    <?php require("index.php"); ?>
    <main class="main">
    <section class="dashboard">
        <div class="dash-content">
            <header>
                <h1 class=dashboard-title> 
                    <i class="fas fa-chart-line" style="font-size: 30px" ;></i>
                    Dashboard
                </h1>
            </header>

            <div class="overview">
                <div class="overview-item" style="background-color: #c8979c;">
                    <i class="fas fa-users item-icon" style="font-size: 21px; color: black;"></i>
                    <div class="item-title">UTILISATEURS</div>
                    <div class="item-count"><strong><?php echo $countUtilisateurs; ?></strong></div>
                </div>

                <div class="overview-item" style="background-color: #eed7c5;">
                    <i class="fa fa-id-card-o" style="font-size: 21px; color: black;"></i>
                    <div class="item-title">STAGIAIRES</div>
                    <div class="item-count"><strong><?php echo $countStagiaires; ?></strong></div>
                </div>

                <div class="overview-item" style="background-color: #eee2df;">
                    <i class="fas fa-layer-group item-icon" style="font-size: 21px; color: black;"></i>
                    <div class="item-title">FILIÈRES</div>
                    <div class="item-count"><strong><?php echo $countFilieres; ?></strong></div>
                </div>

                <div class="overview-item" style="background-color:  #FBF0E9;">
                    <i class="fa fa-sitemap item-icon" style="font-size: 21px; color: black;"></i>
                    <div class="item-title">DIVISIONS</div>
                    <div class="item-count"><strong><?php echo $countDivisions; ?></strong></div>
                </div>
            </div>

            <div class="dashboard-row">
            <div class="activity">
    <div class="title">
        <i class="fas fa-clock"></i>
        <span class="text" style="font-weight: bold  " >Activité Récente & Circle Chart "Répartition des stagiaires par chaque division"</span>
    </div>
    
    <table class="table">
                        <thead class="table-header">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activiteData as $activite) : ?>
                                <tr class="table-row">
                                    <td><?php echo $activite['login']; ?></td>
                                    <td><?php echo $activite['email']; ?></td>
                                    <td><?php echo $activite['role']; ?></td>
                                    <td><?php echo ($activite['etat'] == 1) ? 'Activé' : 'Désactivé'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="chart-container">
                
                    <canvas id="pieChart" ></canvas>
                </div>
            </div>
        </div>
    </section>
</main>

</body>

<script>
    var labels = <?php echo json_encode($labels); ?>;
    var percentages = <?php echo json_encode($percentages); ?>;
    
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
    
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: percentages,
                backgroundColor: ['#c8979c', '#eed7c5', '#eee2df' , '#FBF0E9' ,'#7C4C53',
               '#CCAEA4' , '#CE6A6B' , '#EBACA2' ] // Mettez à jour les couleurs si nécessaire
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

</html>
