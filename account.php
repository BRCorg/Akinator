<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/quizRepository.php";

session_start();

// Sécurité
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$id_user = $_SESSION['user_id'];

$infos = displayUserGame($id_user);

// var_dump($id_user);
// var_dump($infos);





//si le form a été soumis ($_POST n'est pas vide)
if (!empty($_POST)) {
    $ancienMotDePasse = $_POST['motDePasseActuel'] ?? '';
    $nouveauMotDePasse = $_POST['passwordChange'] ?? '';
    
    var_dump($ancienMotDePasse);
    var_dump($nouveauMotDePasse);
    
    $email = $_SESSION['user_email'];
    $id_user = $_SESSION['user_id'];
    
    $user = getUserByEmail($email);
    
    // var_dump($user);    
        
    if (password_verify($ancienMotDePasse, $user['password'])) {

        if (!empty($nouveauMotDePasse)) {

            $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).{12,}$/';

            if (preg_match($regex, $nouveauMotDePasse)) {

                $passwordHash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

                if (updatePassword($id_user, $passwordHash)) {
                    echo "✅ Mot de passe modifié avec succès.";
                } else {
                    echo "❌ Une erreur est survenue lors de la mise à jour du mot de passe.";
                }

            } else {
                echo "❌ Votre mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            }

        } else {
            echo "❌ Veuillez entrer un nouveau mot de passe.";
        }

    } else {
        echo "❌ L'ancien mot de passe est incorrect.";
    }
}

if (isset($_POST['delete_account'])) {
    deleteAccount($_SESSION['user_id']);
    session_destroy();
    header("Location: index.php");
exit;
}




$template = "account";
include "layout.phtml";