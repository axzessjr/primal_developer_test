<?php
    $db_host = "localhost";
    $db_user = "u568388955_Nudnong";
    $db_pass = "Nudnong1234";
    $db_name = "u568388955_nudnong_db";
    // $db_user = "root";
    // $db_pass = "root";
    // $db_name = "nudnong";

    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Success";
    }
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
?>