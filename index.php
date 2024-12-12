<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Top Anime List</h1>
    </header>

    <main>
        <section id="anime-list">
            <?php
                require("db.php");

                // Fetch anime list from the database
                $sql = "SELECT * FROM topanime.topanime_table";
                $result = mysqli_query($connection, $sql);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($rows as $row): ?>
                    <div class="anime-card">
                        <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="anime-info">
                            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                            <p>Score: <?php echo htmlspecialchars($row['score']); ?></p>
                            <p>Rank: <?php echo htmlspecialchars($row['rank']); ?></p>
                            <p>Members: <?php echo htmlspecialchars($row['member']); ?></p>
                        </div>
                    </div>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <p>© 2024 Top Anime Database</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
