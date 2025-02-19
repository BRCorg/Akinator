<?php

require_once "config/database.php";

function createUser(string $email, string $name, string $password){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO user (email, name, password) VALUES (?,?,?)");
    
    $query->execute([$email, $name, $password]);
}

function getUserByEmail(string $email){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM user WHERE email = ?");
    
    $query->execute([$email]);
    
    return $query->fetch();
}

function deleteUser(int $userId) {
    
    $pdo = getConnexion();
    
    $query = $pdo->prepare("DELETE FROM user WHERE id = ?");
    
    $query->execute([$userId]);
}