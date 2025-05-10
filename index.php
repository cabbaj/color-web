<?php
require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <?php
        $sql = "SELECT * FROM color";
        $result = mysqli_query($conn, $sql);
        // MYSQLI_ASSOC is define type of array
        $colors = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <h3>Found the colors <?php echo count($colors) ?> list</h3>
        <?php foreach ($colors as $color): ?>
            <div>
                <?php echo "<h4>{$color["title"]}</h4>" ?>
                <?php echo "<p>{$color["code"]}</p>" ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>

<?php mysqli_close($conn); ?>