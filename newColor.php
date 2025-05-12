<?php
require("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new Color | Color Web</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="new-color-form">
        <?php
        $errorMsg = "";

        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["colorCode"]) && isset($_POST["colorName"])) {
                    
                    // check Is empty string
                    if ($_POST["colorName"] !== "") {
                        $colorCode = $_POST["colorCode"];
                        $colorName = $_POST["colorName"];

                        $sql = "INSERT INTO color (title, code) VALUES (:colorName, :colorCode)";
                        $stmt = $pdo->prepare($sql);
                        $result = $stmt->execute([
                            "colorName" => "$colorName",
                            "colorCode" => "$colorCode"
                        ]);
                    } else {
                        $errorMsg = "Color Name cannot be empty.";
                    }
                }
            }
        } catch (PDOException $e) {
            $errorMsg = "Can not add new color: " . $e->getMessage();
        }
        ?>

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
            <?php if (isset($result)): ?>
                <?php echo "New color Added"; ?>
            <?php else: ?>
                <?php echo $errorMsg; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>