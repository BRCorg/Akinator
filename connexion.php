<?php


include "config/database.php";
include "repository/userRepository.php";


//démarrage du système de session
session_start();

// Si l'utilisateur est déjà connecté, rediriger vers quiz.php
if (isset($_SESSION['user']) && isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

//si le form a été soumis ($_POST n'est pas vide)
if (!empty($_POST)) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $user = getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            // Stockage des informations utilisateur dans la session
            $_SESSION['user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            
            header('Location: account.php');
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    }
}

// if(isset($_SESSION["user"]) && $_SESSION["user"] === "admin"){
//       header("Location:secret.php");
//         exit;
// }


$template = "connexion";
include "layout.phtml";