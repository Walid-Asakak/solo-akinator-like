<?php

session_start();

include 'repository/userRepository.php';

$error = '';

if(!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = getUserByEmail($email);
    // We verify if the password is not wrong : 
    if($user && password_verify($password, $user['password'])) {
        // Redirection to index -> the login worked
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    }
    else {
        $error = 'Identifiants incorrects, veuillez réessayer.';
    }
}
// Integration of the layout & template : 
$layoutTitle = 'Connexion | Akinator Jeu';
$template = 'templates/login.phtml';
include 'layout/layout.phtml';