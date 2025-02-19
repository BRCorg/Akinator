<?php

include "config/database.php";
include "repository/userRepository.php";

if (!empty($_POST)) {

    // Vérifier que le mot de passe est défini
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).{12,}$/';
        
        if (preg_match($regex, $password)) {
            
        
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $email = isset($_POST["email"]) ? $_POST["email"] : null;
            $name = isset($_POST["name"]) ? $_POST["name"] : null;
            
            if ($email && $name) {

                createUser($email, $name, $passwordHash);
                
                
                header("location:connexion.php");
                exit;
            } else {
                $error = "L'email ou le pseudo n'est pas valide.";
            }
        } else {
            $error  ="Le mot de passe ne répond pas aux critères de sécurité.";
        }
    } else {
        $error = "Le mot de passe est requis.";
    }
} else {
    $error = "Aucune donnée reçue.";
}


$template = "signup";
include "layout.phtml";