
<?php
    //require_once('identifier.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProvinciTrack</title>
    <link rel="stylesheet" href="../pages/style.css" />
    
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <nav class="sidebar" >
    <a href="#" class="logo" style="display: inline-block; vertical-align: middle; margin-right: -8px;">
    <img src="../images/LOGOPT.jpg" alt="logo" style="border-radius: 90%; width: 60px; height: 60px;">
</a>
<a href="dashboard.php" style="display: inline-block; vertical-align: middle;font-size: 20px;">ProvinciTrack</a>


        <div class="menu-content" >
            <ul class="menu-items">
                 
                
                <div class="menu-title"><i class="fa fa-home"style="font-size: 20px;"></i> <a href="#"> 
                <span style="padding-left: 6px;">Menu</span></a>
                </div>

               


                <?php if ($_SESSION['user']['role']=='ADMIN' ) {?>
                <li class="item">
                   <a href="utilisateurs.php">
                   <i class="fa fa-cog" style="font-size: 21px;"></i> 
                  <span style="padding-left: 6px;">Admin Management</span>
                   </a>
                </li>
                <?php }?>
                
                <li class="item">
                   <a href="dashboard.php">
                   <i class="fas fa-chart-line" style="font-size: 22px;"></i> 
                  <span style="padding-left: 7px;">Dashboard</span>
                   </a>
                </li>

                

                <li class="item">
                    <div class="submenu-item">
                    <i class="fa fa-id-card-o" style="font-size: 22px;"></i> <span>Stagiaires</span>
                        <i class="fa-solid fa-chevron-right" ></i>
                    </div>

                    <ul class="menu-items submenu" >
                        <div class="menu-title" >
                            <i class="fa-solid fa-chevron-left"></i> <i class="fa fa-id-card-o" style="font-size: 20px;"></i>  Stagiaires
                        </div>
                        <li class="item" >
                            <a href="stagiaires.php">Listes des stagiaires</a>
                        </li>
                        <li class="item">
                            <a href="nouveauStagiaire.php">Noveau stagiaires</a>
                        </li>
                        
                    </ul>
                </li>

                <?php if ($_SESSION['user']['role']=='ADMIN' ) {?>
                <li class="item">
                    <div class="submenu-item">
                    <i class="fas fa-layer-group item-icon" style="font-size: 22px;"></i>
                       <span>Filières</span> 
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu" >
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i><i class="fas fa-layer-group item-icon" style="font-size: 20px;"></i> Filières
                        </div>
                        <li class="item"> 
                            <a href="filieres.php">  Listes des Filières</a>
                        </li>
                        <li class="item">
                            <a href="nouvelleFiliere.php">Nouveau filière</a>
                        </li>

                       
                    </ul>
                </li>
                <?php }?>
                <li class="item">
                    <div class="submenu-item">
                    <i class="fa fa-calendar-times-o" style="font-size: 22px;"></i> <span>Absence</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu" >
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i> <i class="fa fa-calendar-times-o" style="font-size: 20px;"></i> Absence
                        </div>
                        <li class="item">
                            <a href="absence.php">Listes des absences</a>
                        </li>
                        <li class="item">
                            <a href="MarquerAbsence.php">Marquer absence</a>
                        </li>
                       
                        
                    </ul>
                </li>
                
                <?php if ($_SESSION['user']['role']=='ADMIN' ) {?>
                <li class="item">
                
                    <div class="submenu-item">
                    
                    <i class="fa fa-users" style="font-size: 22px;"></i> <span>Utilisateurs</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu" >
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i> <i class="fa fa-users" style="font-size: 20px;"></i> Utilisateurs
                        </div>
                        <li class="item">
                            <a href="utilisateurs.php">Listes des Utilisateurs</a>
                        </li> 

                        <li class="item">
                            <a href="ActivityRecent.php">Activité récentes</a>
                        </li> 
                       
                    </ul>
                </li>
                <?php }?>
                
                <li class="item">
                   <a href="imprimerAttestation.php">
                   <i class="fas fa-print" style="font-size: 22px;"></i> 
                  <span style="padding-left: 7px;">Attestation de stage</span>
                   </a>
                </li>

                <li class="item">
                   <a href="division.php">
                   <i class="fa fa-sitemap item-icon" style="font-size: 22px;"></i> 
                  <span style="padding-left: 7px;">Divisions</span>
                   </a>
                </li>
                
            </ul>
            
        </div>
    </nav>

    <nav class="navbar"  >
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
        
        <ul class="nav navbar-nav navbar-right">
    <li>
        <a href="editerUtilisateur.php?id=<?php echo $_SESSION['user']['iduser'] ?>">
            <i class="fa fa-user-circle-o"></i>
            <?php echo ' '.$_SESSION['user']['login']?>
        </a> 
    </li>
   
    <li>
    <a href="seDeconnecter.php" class="btn-deconnexion" style="background-color: #B384A7">
        <i class="fa fa-sign-out"></i>
        &nbsp; Se déconnecter
    </a>
</li>
</ul>
    </nav>

    

    <script src="script.js"></script>
</body>

</html>