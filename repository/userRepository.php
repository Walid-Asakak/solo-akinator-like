<?php

require_once 'repository/connection.php';

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

function changeUserPassword(int $userId, string $currentPassword, string $newPassword): bool {

    $db = connectToDataBase();

    try {
        // Get the current password
        $request = $db->prepare('SELECT password FROM users WHERE id = :id');
        $request->bindParam(':id', $userId, PDO::PARAM_INT);
        $request->execute();

        $user = $request->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        // Verify the old password
        if (!password_verify($currentPassword, $user['password'])) {
            return false;
        }

        //
        $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $update = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
        $update->bindParam(':password', $newPasswordHashed, PDO::PARAM_STR);
        $update->bindParam(':id', $userId, PDO::PARAM_INT);
        $update->execute();

        return true;

    } catch (Exception $e) {
        return false;
    }
}

function deleteUserAccount(int $userId): bool {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare('DELETE FROM users WHERE id = :user_id');
        $request -> bindParam(':user_id', $userId, PDO::PARAM_INT);
        $request -> execute();
        return true;
    }
    catch (exception $e) {
        // die($e -> getMessage());
        return false;
    }
}