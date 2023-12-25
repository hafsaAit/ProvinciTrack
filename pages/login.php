<?php
session_start();
if (isset($_SESSION['erreurLogin']))
    $erreurLogin = $_SESSION['erreurLogin'];
else {
    $erreurLogin = "";
}
session_destroy();
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>ProvinciTrack</title>
    <link rel="stylesheet" href="styleLogin.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-color: #C49FFF;">
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="../images/frontImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Welcome to <br> ProvinciTrack</span>
                    <span class="text-2">Let's get connected</span>
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
                <div class="login-form">
                    <div class="title">Login</div>
                    <form method="post" action="seConnecter.php" class="form">

                <?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?>
                    </div>
                <?php } ?>
                    <form action="seConnecter.php">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"><label for="login"></i></label>
                                <input type="text" name="login" placeholder=" Login" required>
                            </div>

                            <div class="input-box">
    <i class="fas fa-lock"><label for="pwd"></i></label>
    <input type="password" name="pwd" id="pwd" placeholder="mot de passe" required>
</div>

                            <div class="text"><a href="initialiserPwd.php">Mot de passe Oublié?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Login">
                            </div>
                            <div class="text sign-up-text"> Vous n'avez pas de compte ? <label for="flip"><a href="nouvelUtilisateur.php"> Créer un compte</label></div>
                        </div>
                    </form>
                </div>
                
                    <br>
                    <?php

    if (isset($validationErrors) && !empty($validationErrors)) {
        foreach ($validationErrors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    }


    if (isset($success_msg) && !empty($success_msg)) {
        echo '<div class="alert alert-success">' . $success_msg . '</div>';

        header('refresh:5;url=login.php');
    }

    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>