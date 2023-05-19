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

    // Compter le nombre filières
    $countFilieresQuery = "SELECT COUNT(*) AS count FROM filiere";
    $countFilieresResult = $pdo->query($countFilieresQuery);
    $countFilieres = $countFilieresResult->fetchColumn();

    $activiteQuery = "SELECT login, email,  role, etat FROM utilisateur";
    $activiteResult = $pdo->query($activiteQuery);
    $activiteData = $activiteResult->fetchAll(PDO::FETCH_ASSOC);

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .overview {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.box {
    
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 0.25rem;
   
    margin: 1rem;
    min-width: 100px; /* réduire la taille des boîtes */
    text-align: center;
    color: BLACK;
    font-weight: bold;
    border-radius: 12px;
    flex-grow: 1; /* étendre la largeur des boîtes pour remplir l'espace disponible */
}

.overview-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 8px;
    margin-bottom: 4px;
}


        
        .box h2 {
            margin-top: -20;
            
    color: BLACK;
        }
        
        /* Styling for the colors */
        .box1 {
            background-color: #c8979c;
           
     
        }
        
        .box2 {
            background-color: #eed7c5;
        }
        
        .box3 {
            background-color: #eee2df;
        }


    
.title-wrapper {

    display: flex;
    align-items: center;
    flex-direction: column;
    margin-bottom: -30px;
    margin-left: -780px;
}


.title {
  font-size: 23px;
  font-weight: bold;
  margin-left: 20px;
  color: #444;
}

.title i {
  font-size: 25px;
  color: #2196f3;
  margin-right: 10px;
}



        .dashboard {
            position: fixed;
    display: flex;
    flex-direction: column; /* pour afficher les sections l'une en dessous de l'autre */
    align-items: center;
}




.activity {
    width: 100%; /* pour que le tableau occupe toute la largeur disponible */
    margin-top: -4px;
}

.table {
    width: 100%;
    border-collapse: collapse;
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




    </style>
</head>
<body>
<?php require("index.php"); ?>
<main class="main">
    

    <section class="dashboard">
        

        <div class="dash-content">
        
        <div class="overview-wrapper">
    <div class="title-wrapper">
    <header>
    <h1 class="title text-center">
        <i class="fas fa-chart-line" style="font-size: 30px;"></i> Dashboard
    </h1>
</header>


    </div>
    <div class="overview">

    <div class="box box1" style="margin-top: 40px;">
    <i class="fas fa-users" style="font-size: 30px;"></i>
    <h2>Nombres des utilisateurs</h2>
    <p><?php echo $countUtilisateurs; ?></p>
</div>

                        <div class="box box2" style="margin-top: 40px;">
                            <i class="fa fa-id-card-o" style="font-size: 30px;"></i>
                            <h2>Nombres des stagiaires</h2>
                            <p><?php echo $countStagiaires; ?></p>
                        </div>
                        <div class="box box3" style="margin-top: 40px;">
                            <i class="fa fa-tags" style="font-size: 30px;"></i>
                            <h2>Nombres des filières</h2>
                            <p><?php echo $countFilieres; ?></p>
                        </div>
                    </div>
</div>



    

    
<div class="activity">
    <div class="title">
        <i class="fas fa-clock"></i>
        <span class="text" style="font-weight: bold">Activité Récente</span>
    </div>
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
</section>
</main>
</body>
</html>
