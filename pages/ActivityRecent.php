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
            font-size: 15px;
            
        }

        .activity .title {
            font-weight: bold;
            font-size: 28px;
        }

        .table {
            width: 980px;
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


.activity {
    flex-basis: 90%;
    margin-right: 360px;
    margin-left: -360px;
    position: fixed;
    margin-top:-160px;
   
}


/* Autres styles restants */

    </style>
</head>

<body>
    <?php require("index.php"); ?>
    <main class="main">
 
        <div class="dash-content">

            <div class="dashboard-row">
            <div class="activity">
    <div class="title">
        <i class="fas fa-clock"></i>
        <span class="text" style="font-weight: bold  " >Activité Récente </span>
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



</html>
