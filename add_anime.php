<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Anime</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Add New Anime</h1>
        <nav>
            <a href="index.php">View Anime List</a>
        </nav>
    </header>

    <main>
        <section id="form-section">
            <form method="post" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="score">Score:</label>
                <input type="text" id="score" name="score" required>

                <label for="rank">Rank:</label>
                <input type="text" id="rank" name="rank" required>

                <label for="member">Members:</label>
                <input type="text" id="member" name="member" required>

                <label for="img">Image URL:</label>
                <input type="text" id="img" name="img" required>

                <button type="submit" name="submit">Add Anime</button>
            </form>

            <?php
                require("db.php");

                if (isset($_POST['submit'])) {
                    $name = mysqli_real_escape_string($connection, $_POST['name']);
                    $score = mysqli_real_escape_string($connection, $_POST['score']);
                    $rank = mysqli_real_escape_string($connection, $_POST['rank']);
                    $member = mysqli_real_escape_string($connection, $_POST['member']);
                    $img = mysqli_real_escape_string($connection, $_POST['img']);

                    $sql = "INSERT INTO topanime.topanime_table (name, score, `rank`, member, img) 
                            VALUES ('$name', '$score', '$rank', '$member', '$img')";

                    if (mysqli_query($connection, $sql)) {
                        echo "<p class='success'>Anime added successfully!</p>";
                    } else {
                        echo "<p class='error'>Error: " . mysqli_error($connection) . "</p>";
                    }
                }
            ?>
        </section>
    </main>

    <footer>
        <p>© 2024 Top Anime Database</p>
    </footer>
</body>
</html>
