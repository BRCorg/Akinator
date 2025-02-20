<?php

require_once "config/database.php";



function getQuestionsById(int $id) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM question WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}



function getAnswersByQuestionId(int $questionId): array {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM answer WHERE id_question = ?");
    $query->execute([$questionId]);
    return $query->fetchAll();
}



function getFeatureById(int $id): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM feature WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}

function getGamelogById(int $id): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM gamelog WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}

function saveUserGame( $result, $id_feature, $id_user): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("INSERT INTO `gamelog`(`date`, `result`, `id_feature`, `id_user`) VALUES (NOW(),?,?,?)");
    $query->execute([ $result, $id_feature, $id_user]);
    return $query->fetch();
}


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
    id_user = ? ORDER BY date DESC LIMIT 5");
    $query->execute([$id_user]);
    return $query->fetchAll();
}

