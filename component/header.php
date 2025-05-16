    <header>
        <h1>Color Web</h1>
        <?php
        $path = basename($_SERVER['PHP_SELF']);
        ?>

        <?php if ($path == "newColor.php"): ?>
            <h3>
                <?php echo "Add New Color"; ?>
            </h3>
        <?php elseif ($path == "editColor.php"): ?>
            <h3>
                <?php echo "Edit Color"; ?>
            </h3>
        <?php endif; ?>

        <div>
            <a href="index.php">Home</a>
            <a href="newColor.php">Add New color</a>
        </div>
    </header>