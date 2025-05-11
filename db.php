<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "color_web";

// Data Source Name
$dsn = "mysql:host=$hostname;dbname=$database;charset=utf8mb4";

try {
    // create PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // set error mode 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // PDOException is class of PDO error, $e is variable to store the exception object
    echo "connected failed: " . $e->getMessage();
}
