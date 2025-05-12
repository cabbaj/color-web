    <header>
        <h1>Color Web</h1>
        <?php
        $page = basename($_SERVER['PHP_SELF']);
        ?>

        <?php if ($page == "newColor.php"): ?>
            <h3>
                <?php echo "Add new color"; ?>
            </h3>
        <?php endif; ?>

        <div>
            <a href="index.php">Home</a>
            <a href="newColor.php">Add new color</a>
        </div>
    </header>