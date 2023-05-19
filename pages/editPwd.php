<?php
require_once('identifier.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Changement de mot de passe</title>
   
    
    <link rel="stylesheet" href="styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/monjs.js"></script>
</head>
<body style="background-color: #C49FFF;">
<div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="../images/LOGOPT.jpg" alt="">
                <div class="text">
                    
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="../images/backImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>



    <div class="forms">
            <div class="form-content">
                <div class="signup-form">
                <h2 class="title-center">Compte :<?php echo $_SESSION['user']['login'] ?></h2>
                    <form method="post" action="updatePwd.php" class="form">
        <!-- ***************** Début Ancien mot de passe  ***************** -->
       


        <div class="input-box">
    <i class="fas fa-lock"><label for="pwd"></i></label>
      <input class="form-control oldpwd"
                   type="password"
                   name="oldpwd"
                   autocomplete="new-password"
                   placeholder="Taper votre Ancien Mot de passe"
                   required> 
</div>


        <!-- ***************** Fin Ancien mot de passe ***************** -->

        <!--  *****************Début Nouveau  mot de passe  ***************** -->

        

        <div class="input-box">
    <i class="fas fa-lock"><label for="pwd"></i></label>
      <input minlength=4
                    class="form-control newpwd"
                    type="password"
                    name="newpwd"
                    autocomplete="new-password"
                    placeholder="Taper votre Nouveau Mot de passe"
                    required> 
</div>
        <!--  *****************  Fin Nouveau  mot de passe   ***************** -->

        <!--  ***************** start submit field  ***************** -->

        <div class="button input-box">
                 <input type="submit" value="Enregister">
               </div>

        <!--   ***************** end submit field  ***************** -->

    </form>
</div>

</body>
</html>



