<?php

require_once "config/database.php";


// Création de l'utilisateur

function createUser(string $email, string $name, string $password){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO user (email, name, password) VALUES (?,?,?)");
    
    $query->execute([$email, $name, $password]);
}



// Prendre l'email de l'utilisateur
function getUserByEmail(string $email){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM user WHERE email = ?");
    
    $query->execute([$email]);
    
    return $query->fetch();
}

//Supprimer le compte
function deleteAccount(int $userId) {
    
    $pdo = getConnexion();
    
    $query = $pdo->prepare("DELETE FROM user WHERE id = ?");
    
    $query->execute([$userId]);
}

    // Pour changer le mot de passe
    
function updatePassword (int $id_user,string $nouveauMotDePasse) {
    
     $pdo = getConnexion();
    
    $query = $pdo->prepare("UPDATE `user` SET `password`= ? WHERE `id` = ?");
    
    $test = $query->execute([$nouveauMotDePasse, $id_user]);
    
    return $test;
}



