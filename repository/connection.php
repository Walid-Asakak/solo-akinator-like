<?php

function connectToDataBase() {
    try {
        $db = new PDO (
            'mysql:host=db.3wa.io;port=3306;dbname=walidasakak_akinator_like;charset=utf8',
            'walidasakak',
            '11069fbca0a4e3afa84c127a191507e0'
        );
        
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $db;
    }
    
    catch (Exception $e) {
        die($e -> getMessage());
    }
}

// Test the function -> no errors so it works
// connectToDataBase();