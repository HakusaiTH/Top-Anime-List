<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Anime Management</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel - Manage Anime</h1>
    </header>

    <main>
        <section id="anime-management" class="anime-management">
            <h2>Anime List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                        <th>Rank</th>
                        <th>Members</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <div class="anime-grid">
                <div class="anime-grid">
                <?php
                    require("db.php");

                    // Fetch anime list from the database
                    $sql = "SELECT * FROM topanime.topanime_table";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    foreach ($rows as $row): ?>
                        <div class="anime-item">
                        <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px; border-radius: 5px;">
                            <p>Name: <?php echo htmlspecialchars($row['name']); ?></p>
                            <p>Score: <?php echo htmlspecialchars($row['score']); ?></p>
                            <p>Rank: <?php echo htmlspecialchars($row['rank']); ?></p>
                            <p>Members: <?php echo htmlspecialchars($row['member']); ?></p>
                            <form method="post" action="">
                                <button type="submit" name="edit" value="<?php echo $row['id']; ?>">Edit</button>
                                <button type="submit" name="delete" value="<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this anime?');">Delete</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </table>
        </section>

        <section id="add-anime">
            <h2>Add New Anime</h2>
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

                <button type="submit" name="add">Add Anime</button>
            </form>
        </section>

        <?php
        // Add new anime
        if (isset($_POST['add'])) {
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $score = mysqli_real_escape_string($connection, $_POST['score']);
            $rank = mysqli_real_escape_string($connection, $_POST['rank']);
            $member = mysqli_real_escape_string($connection, $_POST['member']);
            $img = mysqli_real_escape_string($connection, $_POST['img']);

            $sql = "INSERT INTO topanime.topanime_table (name, score, `rank`, member, img) VALUES ('$name', '$score', '$rank', '$member', '$img')";

            if (mysqli_query($connection, $sql)) {
                echo "<p class='success'>Anime added successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . mysqli_error($connection) . "</p>";
            }
        }

        // Delete anime
        if (isset($_POST['delete'])) {
            $id = mysqli_real_escape_string($connection, $_POST['delete']);

            $sql = "DELETE FROM topanime.topanime_table WHERE id='$id'";

            if (mysqli_query($connection, $sql)) {
                echo "<p class='success'>Anime deleted successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . mysqli_error($connection) . "</p>";
            }
        }

        // Edit anime
        if (isset($_POST['edit'])) {
            $id = mysqli_real_escape_string($connection, $_POST['edit']);
            $sql = "SELECT * FROM topanime.topanime_table WHERE id='$id'";
            $result = mysqli_query($connection, $sql);
            $anime = mysqli_fetch_assoc($result);

            echo "<section id='edit-anime'>
                <h2>Edit Anime</h2>
                <form method='post' action=''>
                    <input type='hidden' name='id' value='{$anime['id']}'>
                    <label for='name'>Name:</label>
                    <input type='text' id='name' name='name' value='{$anime['name']}' required>

                    <label for='score'>Score:</label>
                    <input type='text' id='score' name='score' value='{$anime['score']}' required>

                    <label for='rank'>Rank:</label>
                    <input type='text' id='rank' name='rank' value='{$anime['rank']}' required>

                    <label for='member'>Members:</label>
                    <input type='text' id='member' name='member' value='{$anime['member']}' required>

                    <label for='img'>Image URL:</label>
                    <input type='text' id='img' name='img' value='{$anime['img']}' required>

                    <button type='submit' name='update'>Update Anime</button>
                </form>
            </section>";
        }

        // Update anime
        if (isset($_POST['update'])) {
            $id = mysqli_real_escape_string($connection, $_POST['id']);
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $score = mysqli_real_escape_string($connection, $_POST['score']);
            $rank = mysqli_real_escape_string($connection, $_POST['rank']);
            $member = mysqli_real_escape_string($connection, $_POST['member']);
            $img = mysqli_real_escape_string($connection, $_POST['img']);

            $sql = "UPDATE topanime.topanime_table SET name='$name', score='$score', `rank`='$rank', member='$member', img='$img' WHERE id='$id'";

            if (mysqli_query($connection, $sql)) {
                echo "<p class='success'>Anime updated successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . mysqli_error($connection) . "</p>";
            }
        }
        ?>
    </main>

    <footer>
        <p>© 2024 Top Anime Database</p>
    </footer>
</body>
</html>
