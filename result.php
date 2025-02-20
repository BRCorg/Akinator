<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/quizRepository.php";

session_start();

// Sécurité, l'utilisateur n'est pas connecté, il sera rediriger vers connexion.php
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer l'ID de la feature
$featureId = isset($_GET['feature_id']) ? $_GET['feature_id'] : null;


$feature = getFeatureById($featureId); 

//on va insérer l'historique pour l'utilisateur
    $result = $feature['name'];
    $id_feature = $featureId;
    $id_user = $_SESSION['user_id'];
    
    saveUserGame( $result, $id_feature, $id_user);

$template = "result";
include "layout.phtml";
