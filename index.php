<?php require("db.php");

// TITLE
$searchTitle = "Color Web";
$searchValue = "";

// query
try {
    if (isset($_GET["search"]) && !empty($_GET["search"])) {
        // change the title
        $search = $_GET["search"];
        $searchTitle = "Search \"" . htmlspecialchars($search) . "\" | Color Web";
        $searchValue = $search;

        // :title is params 
        $stmt = $pdo->prepare("SELECT * FROM color WHERE title LIKE :title ORDER BY id DESC");
        // define params that use in sql
        $stmt->execute(["title" => "%$search%"]);
        $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // fetch all colors
        $stmt = $pdo->query("SELECT * FROM color ORDER BY id DESC");
        $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Something went wrong";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $searchTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("component/header.php"); ?>

    <div class="color-container">
        <Form id="search-form" method="get">
            <p>
                <input type="search" name="search" value="<?php echo $searchValue; ?>" placeholder="Search colors...">
                <button type="submit">Search</button>
            </p>
        </Form>

        <?php if (empty($colors)): ?>
            <h3>Color not found</h3>
        <?php else: ?>
            <h3>Found <?php echo count($colors); ?> color<?php echo (count($colors) !== 1) ? 's' : ''; ?></h3>
        <?php endif; ?>

        <?php if (empty($colors)): ?>
            <p>No colors found<?php if (!empty($searchValue)): ?> matching your search term.<?php endif; ?></p>
        <?php else: ?>
            <?php foreach ($colors as $color): ?>
                <div class="color-list" style="border-color:<?php echo htmlspecialchars($color['code']); ?>">
                    <h4><?php echo htmlspecialchars($color["title"]); ?></h4>
                    <p><?php echo htmlspecialchars($color["code"]); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
</body>

</html>