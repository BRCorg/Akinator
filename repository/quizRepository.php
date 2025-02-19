<?php

require_once "config/database.php";

function getQuestions(): array {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM question");
    $query->execute();
    return $query->fetchAll();
}

function getQuestionsById(int $id) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM question WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}

function getAnswerById(int $id) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM answer WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch();
}

function getAnswersByQuestionId(int $questionId): array {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM answer WHERE id_question = ?");
    $query->execute([$questionId]);
    return $query->fetchAll();
}

function getFeature(): array|bool {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM feature");
    $query->execute();
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




