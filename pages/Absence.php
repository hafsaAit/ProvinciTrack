<?php
     require_once('identifier.php');
    require_once("connexiondb.php");

    $justification=isset($_GET['justification'])?$_GET['justification']:"";
    $date_debut=isset($_GET['date_debut'])?$_GET['date_debut']:"";
    $date_fin=isset($_GET['date_fin'])?$_GET['date_fin']:"";
    
    $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    
    $idStagiaire=isset($_GET['idStagiaire'])?$_GET['idStagiaire']:0;
   
    
    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

    $requeteStagiaire="select * from stagiaire";
    

    if($idStagiaire==0){
        $requeteAbsence="select Id_Absence,justification,date_debut,date_fin,nom,prenom
                from Absence as A ,stagiaire as s
                where A.idStagiaire=s.idStagiaire
                and (justification like '%$justification%' ) and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
               
                order by Id_Absence
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from Absence
                where justification like '%$justification%' ";
            }else{
                $requeteAbsence="select Id_Absence,justification,date_debut,date_fin,nom,prenom
                from Absence as A ,stagiaire as s
                where A.idStagiaire=s.idStagiaire
                       and (justification like '%$justification%' )
                       and A.idStagiaire=$idStagiaire
                        order by Id_Absence
                       limit $size
                       offset $offset";
               
               $requeteCount="select count(*) countS from absence
               where (justification like '%$justification%' )
               and idStagiaire =$idStagiaire";
                    }

                    $resultatStagiaire=$pdo->query($requeteStagiaire);
                    $resultatAbsence=$pdo->query($requeteAbsence);
                    $resultatCount=$pdo->query($requeteCount);
                
                    
                    $tabCount=$resultatCount->fetch();
                    $nbrAbsence=$tabCount['countS'];
                    $reste=$nbrAbsence % $size;   
                    if($reste===0) 
                        $nbrPage=$nbrAbsence/$size;   
                    else
                        $nbrPage=floor($nbrAbsence/$size)+1;  
                ?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Listes des absences</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <?php include("index.php"); ?>
        
        <main class="main">
        
        
        <div class="container">
            <div class="panel panel-success margetop60">
            
				<div class="panel-heading">Marquer L'Absence</div>
				
				<div class="panel-body">
					<form method="get" action="Absence.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomPrenom" 
                                   placeholder="Nom et prénom"
                                   class="form-control"
                                   value="<?php echo $nomPrenom ?>"/>

                        
                        </div>
                            
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         
                         
                            <a href="MarquerAbsence.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                              Marquer Absence
                                
                            </a>
                            
                         
					</form>
				</div>
			</div>
        
        <div class="panel panel-primary">
                <div class="panel-heading">Listes d'absence (<?php echo $nbrAbsence ?> Absence)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                 <th>Nom</th> <th>Prénom</th> <th>Justification</th> 
                                <th>Date début</th><th>Date fin</th>  <th>Actions</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($Absence=$resultatAbsence->fetch()){ ?>
                                <tr>
                                   
                                    <td><?php echo $Absence['nom'] ?> </td>
                                    <td><?php echo $Absence['prenom'] ?> </td> 
                                    <td><?php echo $Absence['justification'] ?> </td>
                                    <td><?php echo $Absence['date_debut'] ?> </td>
                                    <td><?php echo $Absence['date_fin'] ?> </td>

                                    <td>
                                    <a href="editerAbsence.php?idAbsence=<?php echo $Absence['Id_Absence'] ?>">

                                           <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                            &nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer cette absence?')"
                                           href="supprimerAbsence.php?Id_Absence=<?php echo $Absence['Id_Absence'] ?>">
                                           <span class="glyphicon glyphicon-trash"></span>
                                           </a>
                                        </td>

                                    </tr>
                             <?php } ?>
                             </tbody>
                    </table>
                <div>
                <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="Absence.php?page=<?php echo $i;?>&justification=<?php echo $justification ?>&idStagiaire=<?php echo $idStagiaire?>">
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
                                                  