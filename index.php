<?php
session_start();
include "config/database.php";
include "repository/userRepository.php";

if (!empty($_POST)) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $user = getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            header('Location: quiz.php');
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    }
}

$template = "index";
include "layout.phtml";