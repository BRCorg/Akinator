<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/quizRepository.php";

session_start();

// Sécurité 
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}


// Récupérer la réponse et l'ID de la question actuelle depuis l'URL
$answer = isset($_GET['answer']) ? $_GET['answer'] : null;
$questionId = isset($_GET['question_id']) ? $_GET['question_id'] : 1;

// Vérifier si une réponse a été donnée
if ($answer !== null) {
    // Obtenir toutes les réponses possibles pour cette question
    $answers = getAnswersByQuestionId($questionId);

    // Parcourir toutes les réponses possibles
    foreach ($answers as $possibleAnswer) {
        // Vérifier si la réponse de l'utilisateur correspond à "Oui" ou "Non"
        if (($answer == 1 && $possibleAnswer['answer_text'] == 'Oui') ||
            ($answer == 0 && $possibleAnswer['answer_text'] == 'Non')) {
            
            // Récupérer l'ID de la prochaine question ou de la feature associée
            $nextQuestionId = $possibleAnswer['id_next_question'];
            $featureId = $possibleAnswer['id_feature'];

            // Si une prochaine question existe, rediriger vers celle-ci
            if (!empty($nextQuestionId)) {
                header("Location: quiz.php?question_id=" . $nextQuestionId);
                exit();
            }
            // Sinon, si une feature est définie, rediriger vers la page des résultats
            elseif (!empty($featureId)) {
                header("Location: result.php?feature_id=" . $featureId);
                exit();
            }
            else {
                $error = "Nous rencontrons une erreur avec le serveur";
            }
        }
    }
}


$template = "quiz";
include "layout.phtml";