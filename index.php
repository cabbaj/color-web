<?php require("db.php"); ?>
<?php
$searchTitle = "";
$searchValue = "";
if (isset($_GET["search"]) && $_GET["search"] !== "") {
    $search = $_GET["search"];
    $searchTitle = "Search \"$search\" | ";
    $searchValue = $search;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $searchTitle; ?>Color Web</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Color Web</h1>
    <div>
        <?php
        if (isset($_GET["search"]) && $_GET["search"] !== "") {
            $title = $_GET["search"];

            // :title is params 
            $stmt = $pdo->prepare(
                "SELECT * FROM color WHERE title LIKE :title ORDER BY id DESC"
            );

            $stmt->execute([
                // define params that use in sql
                "title" => "%$title%"
            ]);
        } else {
            // set query
            $stmt = $pdo->query("SELECT * FROM color");
        }

        // fetch data
        $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <Form>
            <p>
                <input type="search" name="search" value="<?php echo $searchValue; ?>">
                <button type="submit">Search</button>
            </p>
        </Form>
        <h3>Found the colors <?php echo count($colors) ?> list</h3>
        <?php foreach ($colors as $color): ?>
            <div>
                <?php echo "<h4>" . htmlspecialchars($color["title"]) . "</h4>" ?>
                <?php echo "<p>" . htmlspecialchars($color["code"]) . "</p>" ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>