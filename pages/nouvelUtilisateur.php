<?php

require_once("connexiondb.php");
require_once("../les_fonctions/fonctions.php");

//echo 'Nombre des  user1 :  '.rechercher_par_login('user1');
//echo 'Nombre des  user1@gmail.com :  '.rechercher_par_email('user1@gmail.com');
$validationErrors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login = $_POST['login'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $email = $_POST['email'];


    if (isset($login)) {
        $filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);

        if (strlen($filtredLogin) < 4) {
            $validationErrors[] = "Erreur!!! Le login doit contenir au moins 4 caratères";
        }
    }

    if (isset($pwd1) && isset($pwd2)) {

        if (empty($pwd1)) {
            $validationErrors[] = "Erreur!!! Le mot ne doit pas etre vide";
        }

        if (md5($pwd1) !== md5($pwd2)) {
            $validationErrors[] = "Erreur!!! les deux mot de passe ne sont pas identiques";

        }
    }

    if (isset($email)) {
        $filtredEmail = filter_var($login, FILTER_SANITIZE_EMAIL);

        if ($filtredEmail != true) {
            $validationErrors[] = "Erreur!!! Email  non valid";

        }
    }

    if (empty($validationErrors)) {
        if (rechercher_par_login($login) == 0 & rechercher_par_email($email) == 0) {
            $requete = $pdo->prepare("INSERT INTO utilisateur(login,email,pwd,role,etat) 
                                        VALUES(:plogin,:pemail,:ppwd,:prole,:petat)");

            $requete->execute(array('plogin' => $login,
                'pemail' => $email,
                'ppwd' => md5($pwd1),
                'prole' => 'AGENT',
                'petat' => 0));

            $success_msg = "Félicitation, votre compte est crée, mais temporairement inactif jusqu'a activation par l'admin";
        } else {
            if (rechercher_par_login($login) > 0) {
                $validationErrors[] = 'Désolé le login exsite deja';
            }
            if (rechercher_par_email($email) > 0) {
                $validationErrors[] = 'Désolé cet email exsite deja';
            }
        }

    }

}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>

    <title> Nouvel utilisateur </title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="styleLogin.css">
    
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
                <div class="signup-form">
                    <div class="title">Création de compte</div>
                    <form method="post" action="nouvelUtilisateur.php" class="form">

                    <form action="nouvelUtilisateur.php">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"><label for="login"></i></label>
                                 <input type="text"
                                required="required"
                                minlength="4"
                                title="Le login doit contenir au moins 4 caractères..."
                                name="login"
                                placeholder="Taper votre nom d'utilisateur"
                                autocomplete="off"
                                 >
                            </div>

                            <div class="input-box">
    <i class="fas fa-lock"><label for="pwd1"></i></label>
      <input type="password"
    required="required"
    minlength="3"
    title="Le Mot de passe doit contenir au moins 3 caractères..."
    name="pwd1"
    placeholder="Taper votre mot de passe"
    autocomplete="new-password" >
</div>

<div class="input-box">
    <i class="fas fa-lock"><label for="pwd2"></i></label>
    <input type="password"
    required="required"
    minlength="3"
    name="pwd2"
    placeholder="Retaper votre mot de passe "
    autocomplete="new-password" >
</div>





<div class="input-box">
<i class="fas fa-envelope"><label for="email"></i></label>
 <input type="email"
 required="required"
 name="email"
 placeholder="Taper votre email"
 autocomplete="off">
</div>


      
<div class="button input-box">
                 <input type="submit" value="Enregister">
               </div>
             <div class="text sign-up-text">Déjà un compte ? <label for="flip"><a href="login.php">Connectez-vous maintenant</label></div>
       

       
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
             </form>
         </div>
     </div>
 </div>
</div>
</body>

</html>
   





