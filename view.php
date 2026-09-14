<?php
/*
Course Code & Name : DFP40193 Web Programming
Full Name          : Your Name
Registration Number: Your Registration Number
Class              : Your Class
*/

if (!isset($_GET["file"])) {

    header("Location: index.php");
    exit;
}

$fileName = basename($_GET["file"]);

$filePath = "registrations/" . $fileName;

if (!file_exists($filePath)) {

    die("Registration file not found.");

}

/*
Read file using fopen() mode r
*/

$file = fopen($filePath, "r");

$data = [];

if ($file) {

    while (($line = fgets($file)) !== false) {

        $parts = explode(": ", $line, 2);

        if (count($parts) == 2) {

            $data[$parts[0]] = trim($parts[1]);

        }
    }

    fclose($file);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registration Details</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <header>

        <h1>Visit PTSS 2026</h1>

        <p>Registration Information</p>

    </header>

    <section class="details-section">

        <h2>Visitor Details</h2>

        <div class="details-card">

            <?php

            foreach ($data as $field => $value) {

                echo '<div class="detail-row">';

                echo '<strong>' .
                     htmlspecialchars($field) .
                     '</strong>';

                echo '<span>' .
                     htmlspecialchars($value) .
                     '</span>';

                echo '</div>';

            }

            ?>

        </div>

        <div class="form-buttons">

            <a href="index.php" class="button">
                Back
            </a>

            <a href="update.php?file=<?php echo urlencode($fileName); ?>"
               class="button update">

                Update

            </a>

            <a href="delete.php?file=<?php echo urlencode($fileName); ?>"
               class="button delete"
               onclick="return confirm('Are you sure you want to delete this registration?');">

                Delete

            </a>

        </div>

    </section>

    <footer>

        <p>
            &copy; 2026 Visit PTSS |
            Politeknik Tuanku Syed Sirajuddin
        </p>

    </footer>

</div>

</body>

</html>