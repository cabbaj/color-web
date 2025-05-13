    <header>
        <h1>Color Web</h1>
        <?php
        $path = basename($_SERVER['PHP_SELF']);
        ?>

        <?php if ($path == "newColor.php"): ?>
            <h3>
                <?php echo "Add new color"; ?>
            </h3>
        <?php endif; ?>

        <div>
            <a href="index.php">Home</a>
            <a href="newColor.php">Add New color</a>
        </div>
    </header>