<?php

require_once 'repository/connection.php';
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

// Functions to make the game works :

function getFirstQuestion(): ?array {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare('SELECT * FROM questions WHERE is_first_question =1');
        $request -> execute();
        $firstQuestion = $request -> fetch(PDO::FETCH_ASSOC);
        return $firstQuestion ?: null;
    }
    catch (Exception $e) {
        return null;
    }
}

function getQuestionById(int $questionId): ?array {
    $db = connectToDataBase();
    
    try {
        $request = $db -> prepare('SELECT * FROM questions WHERE id = :id');
        $request -> bindParam(':id', $questionId, PDO::PARAM_INT);
        $request -> execute();
        $question = $request -> fetch(PDO::FETCH_ASSOC);
        
        return $question ?: null;
    }
    catch (Exception $e) {
        return null;
    }   
}

function getAnswerForQuestion(int $questioniD, string $answer): ?array {
    $db = connectToDataBase();

    try {
        $request = $db -> prepare('SELECT * FROM answers 
            WHERE question_id = :question_id AND
            answer = :answer'
        );
        
        $request -> bindParam(':question_id', $questionId, PDO::PARAM_INT);
        $request -> bindParam(':answer', $answer, PDO::PARAM_STR);
        
        $request -> execute();
        $answer = $request -> fetch(PDO::FETCH_ASSOC);
        
        return $answer ?: null;
    }
    catch (Exception $e) {
        return null;
    }   
}

function getResultById(int $resultId): ?array {
    $db = connectToDataBase();

    try {
        $request = $db -> prepare('SELECT * FROM results WHERE id = :id');
        
        $request -> bindParam(':id', $resultId, PDO::PARAM_INT);
        
        $request -> execute();
        $result = $request -> fetch(PDO::FETCH_ASSOC);
        
        return $result ?: null;
    }
    catch (Exception $e) {
        return null;
    }     
}