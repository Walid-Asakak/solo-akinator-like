<?php

include 'repository/connection.php';
function insertGameIntoDatabase(int $userId, int $resultId): ?int {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare(
            'INSERT INTO games (played_date, user_id, result_id)
            VALUES(NOW(), :user_id, :result_id)'
        );
        
        $request -> bindParam(':user_id', $userId, PDO::PARAM_INT);
        $request -> bindParam(':result_id', $resultId, PDO::PARAM_INT);
        
        $request -> execute();
        
        // We get the last game ID of the game
        $gameId = $db -> lastInsertId();
        return $gameId;
    }
    catch (Exception $e) {
        // die($e -> getMessage());
        return null;
    }
}

function getHistoryByUser(int $userId): array {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare(
            "SELECT games.played_date, results.name 
            FROM games 
            INNER JOIN results ON games.result_id = results.id 
            WHERE games.user_id = :user_id 
            ORDER BY games.played_date DESC"
        );
        
        $request -> bindParam(':user_id', $userId, PDO::PARAM_INT);
        
        $request -> execute();
        return $history = $request -> fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        // die($e -> getMessage());
        return [];
    }
}