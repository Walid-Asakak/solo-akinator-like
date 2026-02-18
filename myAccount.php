<?php

session_start();

require_once 'repository/quizRepository.php';
require_once 'repository/userRepository.php';

// Security : If the user is not connected
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: index.php');
    exit();
}

$userId = $_SESSION['user_id'];
$historyGames = getHistoryByUser($userId);

$successUpdatePassword = '';
$error = '';

if (isset($_POST['change-password'])) {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    
    if (changeUserPassword($userId, $currentPassword, $newPassword)) {
        $successUpdatePassword = 'Votre mot de passe a bien été changé';
    }
    else {
        $error = 'Mot de passe incorrect';
    }
}

// Delete the user account :
if (isset($_POST['delete-account'])) {
    deleteUserAccount($userId);
}

// Integration of the template & layout :
$layoutTitle = 'Mon compte | Akinator Jeu';
$template = 'templates/myAccount.phtml';
include 'layout/layout.phtml';