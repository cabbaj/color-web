<?php
require("db.php");

$errorMsg = "";
$succesMsg = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["colorCode"], $_POST["colorName"])) {
            // trim for remove space front and back
            $colorCode = trim($_POST["colorCode"]);
            $colorName = trim($_POST["colorName"]);

            // check Is empty string
            if (empty($colorName)) {
                $errorMsg = "Color Name cannot be empty.";
            } else {
                $colorName = htmlspecialchars($colorName);

                $sql = "INSERT INTO color (title, code) VALUES (:colorName, :colorCode)";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                    "colorName" => "$colorName",
                    "colorCode" => "$colorCode"
                ]);

                if ($result) {
                    $succesMsg = "New color Added!";
                } else {
                    $errorMsg = "Fail to add new color.";
                }
            }
        }
    }
} catch (PDOException $e) {
    $errorMsg = "Can not add new color: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Color | Color Web</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("component/header.php"); ?>

    <div class="new-color-form">
        <form action="newColor.php" method="post">
            <p>
                <label for="colorCode">Color</label>
                <input type="color" name="colorCode" id="colorCode">
            </p>
            <p>
                <label for="colorName">Color Name</label>
                <input type="text" name="colorName" id="colorName">
            </p>
            <button type="submit">Save</button>
        </form>

        <div id="msg">
            <?php if (!empty($succesMsg)): ?>
                <p class="success-msg"><?php echo $succesMsg; ?></p>
            <?php elseif (!empty($errorMsg)): ?>
                <p class="error-msg"><?php echo $errorMsg; ?></p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>