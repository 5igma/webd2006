<?php
    define('DB_DSN','mysql:host=localhost;dbname=' . $DBName);
    define('DB_USER',$DBUser);
    define('DB_PASS',$DBPass);   
    
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }

    session_start();
?>