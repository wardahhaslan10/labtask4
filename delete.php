<?php
/*
Course Code & Name : DFP40193 Web Programming
Full Name          : WARDAH BINTI HASLAN
Registration Number: 18DDT23F1099
Class              : DD7B
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
Delete the selected file
*/

if (isset($_GET["confirm"]) && $_GET["confirm"] == "yes") {

    if (unlink($filePath)) {

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Successful</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>

        <div class="container">
            <div class="success-box">
                <h2>Registration Deleted</h2>
                <p>
                    The selected registration has been permanently deleted.
                </p>

                <a href="index.php" class="button">
                    Back to Registration List
                </a>
            </div>
        </div>
        </body>
        </html>

        <?php

        exit;

    } else {

        die("Unable to delete the file.");

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="warning-box">
        <h2>⚠️ Confirm Delete</h2>
        <p>
            Are you sure you want to permanently delete this registration?
        </p>

        <p>
            <strong>
                <?php echo htmlspecialchars(
                    pathinfo($fileName, PATHINFO_FILENAME)
                ); ?>
            </strong>
        </p>

        <div class="form-buttons">
            <a href="delete.php?file=<?php echo urlencode($fileName); ?>&confirm=yes"
               class="button delete">
                Yes, Delete
            </a>

            <a href="index.php"
               class="button cancel">
                No, Cancel
            </a>
        </div>
    </div>
</div>
</body>
</html>