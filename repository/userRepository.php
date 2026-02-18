<?php

include 'repository/connection.php';

function insertUserIntoDb(array $user, string $passwordHashed): ?int {
    $db = connectToDataBase();
    
    // We don"t insert the user if the adress email already exists in the DB
    if (getUserByEmail($user['email'])) {
        return null;
    }
    
    try {
        $request = $db -> prepare(
            'INSERT INTO users (username, email, password)
            VALUES(:username, :email, :password)'
        );
        
        $request -> bindParam(':username', $user['username'], PDO::PARAM_STR);
        $request -> bindParam(':email', $user['email'], PDO::PARAM_STR);
        $request -> bindParam(':password', $passwordHashed, PDO::PARAM_STR);
        
        $request -> execute();
        
        // We get the ID of the last registered user
        $id = $db -> lastInsertId();
        return $id;
    }
    catch (Exception $e) {
        // die($e -> getMessage());
        return null;
    }
}

function getUserByEmail(string $email): ?array {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare('SELECT * from users WHERE email = :email');
        $request -> bindParam(':email', $email, PDO::PARAM_STR);
        $request -> execute();
        $user = $request -> fetch();
        
        return $user?: null; // simplified writing
    }
    catch(Exception $e) {
        // The error can be used -> we hide it :
        // die($e -> getMessage());
        return null;
    }
}