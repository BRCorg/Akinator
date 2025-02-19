<?php

require_once "config/database.php";

function getQuestions(): array {
    
   $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM question");
    
    $query->execute();
    
    $questions = $query->fetchAll();
    
    return $questions;
}

function getQuestionsById(int $id) 
{
    
   $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM question WHERE id = ?");
    
    $query->execute([$id]);
    
    $question = $query->fetch();
    
    return $question;
}

function getFeature(): array|bool  {
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM feature");
    
    $feature = $query->fetchAll();
    
    return $feature;
    
}

function getGamelogById(int $id): array|bool {
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM gamelog WHERE id = ?");
    
    $query->execute([$id]);
    
    $gamelog = $query->fetch();
    
    return $gamelog;
}

function getAnswerById(int $id) 
{
    
   $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id = ?");
    
    $query->execute([$id]);
    
    $answer = $query->fetch();
    
    return $answer;
}


