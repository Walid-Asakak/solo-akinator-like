<?php

session_start();

include 'repository/quizRepository.php';
include 'repository/userRepository.php';

// Security : If the user is not connected
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: index.php');
    exit();
}

$userId = $_SESSION['user_id'];
$historyGames = getHistoryByUser($userId);

if (isset($_POST['change-password'])) {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    
    $db = connectToDataBase();
}

// Integration of the template & layout :
$layoutTitle = 'Mon compte | Akinator Jeu';
$template = 'templates/myAccount.phtml';
include 'layout/layout.phtml';