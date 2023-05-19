<?php
require_once('connexiondb.php');

require_once('../les_fonctions/fonctions.php');

if (isset($_POST['email']))
    $email = $_POST['email'];
else
    $email = "";

$user = rechercher_user_par_email($email);

if ($user != null) {
    $id = $user['iduser'];
    $requete = $pdo->prepare("update utilisateur set pwd=MD5('0000') where iduser=$id");
    $requete->execute();

    $to = $user['email'];

    $objet = "Initialisation de  votre mot de passe";

    $content = "Votre nouveau mot de passe est 0000, veuillez le modifier à la prochine ouverture de session";

    $entetes = "From: gestion_stag" . "\r\n" . "CC: hafsaaitelatik@gmail.com";

    mail($to, $objet, $content, $entetes);

    $erreur = "non";

    $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";

} else {
    $erreur = "oui";

    $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";

}


?>

<!DOCTYPE HTML>
<html>
<head>
    
    <title>Initialiser votre mot de passe</title>
    
    <link rel="stylesheet" href="styleLogin.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="title">Initialiser votre mot de passe</div>
            <form method="post" class="form">
                <div class="input-box">
                    <i class="fas fa-envelope"><label for="email"></i></label>
                    <input type="email"
                           required="required"
                           name="email"
                           placeholder="Veuillez saisir votre email "
                           autocomplete="off">
                </div>
                <div class="button input-box">
                    <input type="submit" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">

        <?php

        $erreur = "";
        $msg = "";

        if ($erreur == "oui") {

            echo '<div class="alert alert-danger">' . $msg . '</div>';

            header("refresh:3;url=initialiserPwd.php");

            exit();
        } else if ($erreur == "non") {

            echo '<div class="alert alert-success">' . $msg . '</div>';

            header("refresh:3;url=login.php");

            exit();
        }

        ?>

    </div>

</div>

</body>
</html>



