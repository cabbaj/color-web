<?php
require("db.php");

$sql = "INSERT INTO color (title, code) VALUES ('rainbow', '899999')";
$stmt = $pdo->prepare($sql);
$stmt->execute();
