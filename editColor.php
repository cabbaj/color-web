<?php
require("db.php");

// fetch color data from param
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM color WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $color = $stmt->fetch(PDO::FETCH_ASSOC);
}

$errorMsg = "";
$succesMsg = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["colorCode"], $_POST["colorName"], $_POST['id'])) {
            // trim for remove space front and back
            $colorCode = trim($_POST["colorCode"]);
            $colorName = trim($_POST["colorName"]);
            $id = $_POST["id"];

            // check Is empty string
            if (empty($colorName)) {
                $errorMsg = "Color Name cannot be empty.";
            } else {
                $colorName = htmlspecialchars($colorName);

                $sql = "UPDATE color SET title = :colorName, code = :colorCode WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                    "colorName" => $colorName,
                    "colorCode" => $colorCode,
                    "id" => $id
                ]);

                if ($result) {
                    $succesMsg = "Updated Color!";
                } else {
                    $errorMsg = "Fail to Update New Color.";
                }
            }
        }
    }
} catch (PDOException $e) {
    $errorMsg = "Can not update new color: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Color | Color Web</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("component/header.php"); ?>

    <div class="color-form">
        <form action="editColor.php?id=<?php echo $_GET['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($color['id']); ?>">
            <p>
                <label for="colorCode">Color</label>
                <input type="color" name="colorCode" id="colorCode" value="<?php echo htmlspecialchars($color['code']) ?>">
            </p>
            <p>
                <label for="colorName">Color Name</label>
                <input type="text" name="colorName" id="colorName" value="<?php echo htmlspecialchars($color['title']) ?>">
            </p>
            <button type="submit">Save</button>
        </form>
        <?php echo $_SERVER["REQUEST_URI"] ?>

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