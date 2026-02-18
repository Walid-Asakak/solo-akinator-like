<?php
session_start();

require_once 'repository/quizRepository.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

$error = '';
$userId = (int) $_SESSION['user_id'];

// 1- if we have a result :
if (isset($_GET['r'])) {
    $resultId = (int) $_GET['r'];
    $result = getResultById($resultId);

    if ($result) {
        insertGameIntoDatabase($userId, $resultId);
    }

    $layoutTitle = 'Résultat | Akinator Jeu';
    $template = 'templates/result.phtml';
    include 'layout/layout.phtml';
    exit();
}

// 2- We display the question
if (isset($_GET['q'])) {
    $question = getQuestionById((int)$_GET['q']);
} else {
    $question = getFirstQuestion();
}

if (!$question) {
    die('Question introuvable.');
}

// 3- If the user answers
if (isset($_POST['answer'])) {
    $answer = $_POST['answer']; // yes or no
    $line = getAnswerForQuestion((int)$question['id'], $answer);

    if ($line && !empty($line['next_question_id'])) {
        header('Location: game.php?q=' . (int)$line['next_question_id']);
        exit();
    }

    if ($line && !empty($line['result_id'])) {
        header('Location: game.php?r=' . (int)$line['result_id']);
        exit();
    }

    $error = 'Chemin manquant';
}


// Integration of the layout & template
$layoutTitle = 'Quiz | Akinator Jeu';
$template = 'templates/game.phtml';
include 'layout/layout.phtml';