<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "color_web";
$port = null;

// mysqli_report_strict for throw the error
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to db
try {
    $conn = mysqli_connect($hostname, $username, $password, $database, $port);
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
}
