<?php
/*
Course Code & Name : DFP40193 Web Programming
Full Name          : WARDAH BINTI HASLAN
Registration Number: 18DDT23F1099
Class              : DDT7B
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit PTSS 2026</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <header>
        <h1>Visit PTSS 2026</h1>
        <p>Visitor Registration System</p>
    </header>

    <div class="menu">
        <a href="register.php" class="button">+ New Registration</a>
    </div>

    <section class="content">
        <h2>Visitor Registration List</h2>
        <?php
        $folder = "registrations/";
        if (!is_dir($folder)) {
            mkdir($folder);
        }
        $files = scandir($folder);
        $found = false;
        echo '<div class="visitor-grid">';

        foreach ($files as $file) {

            if ($file != "." && $file != "..") {

                $extension = pathinfo($file, PATHINFO_EXTENSION);

                if ($extension == "txt") {

                    $found = true;

                    $visitorName = pathinfo($file, PATHINFO_FILENAME);

                    $displayName = str_replace("_", " ", $visitorName);

                    echo '<div class="visitor-card">';

                    echo '<h3>' . htmlspecialchars($displayName) . '</h3>';

                    echo '<div class="card-buttons">';

                    echo '<a href="view.php?file=' . urlencode($file) . '" class="button view">
                            View Registration
                          </a>';

                    echo '<a href="update.php?file=' . urlencode($file) . '" class="button update">
                            Update
                          </a>';

                    echo '<a href="delete.php?file=' . urlencode($file) . '" 
                            class="button delete"
                            onclick="return confirm(\'Are you sure you want to delete this registration?\');">
                            Delete
                          </a>';

                    echo '</div>';

                    echo '</div>';
                }
            }
        }

        echo '</div>';

        if (!$found) {

            echo '<div class="empty-message">';
            echo '<p>No visitor registration found.</p>';
            echo '</div>';

        }

        ?>

    </section>

    <footer>
        <p>&copy; 2026 Visit PTSS | Politeknik Tuanku Syed Sirajuddin</p>
    </footer>

</div>
</body>
</html>