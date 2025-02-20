<?php

require_once "config/database.php";


//Récupérer les questions selon leurs ID

function getQuestionsById(int $id) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM question WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}

// recevoir la suite des questions en fonction de leurs ID

function getAnswersByQuestionId(int $questionId): array {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM answer WHERE id_question = ?");
    $query->execute([$questionId]);
    return $query->fetchAll();
}

// Recupère les features

function getFeatureById(int $id): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM feature WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}


//Enregistre les parties dans la BDD

function saveUserGame( $result, $id_feature, $id_user): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("INSERT INTO `gamelog`(`date`, `result`, `id_feature`, `id_user`) VALUES (NOW(),?,?,?)");
    $query->execute([ $result, $id_feature, $id_user]);
    return $query->fetch();
}


//Affiche l'historique du joueur

function displayUserGame($id_user) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT
    `id`,
    `date`,
    `result`,
    `id_feature`,
    `id_user`
FROM
    `gamelog`
WHERE
    id_user = ? 
    ORDER BY date DESC LIMIT 3");
    $query->execute([$id_user]);
    return $query->fetchAll();
}

