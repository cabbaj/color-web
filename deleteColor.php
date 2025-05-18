<?php
require ("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM color WHERE id = :id");
    $stmt->execute([
        "id" => $id
    ]);

    header("location: index.php");
    exit();
}