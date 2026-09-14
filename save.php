<?php
/*
Course Code & Name : DFP40193 Web Programming
Full Name          : Your Name
Registration Number: Your Registration Number
Class              : Your Class
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fields = [
        "Name" => $_POST["name"] ?? "",
        "IC / Passport" => $_POST["ic_passport"] ?? "",
        "Institution" => $_POST["institution"] ?? "",
        "Email" => $_POST["email"] ?? "",
        "Contact Number" => $_POST["contact"] ?? "",
        "Address" => $_POST["address"] ?? "",
        "Selected Package" => $_POST["package"] ?? "",
        "Visit Date" => $_POST["visit_date"] ?? "",
        "Number of Visitors" => $_POST["number_visitors"] ?? "",
        "Purpose of Visit" => $_POST["purpose"] ?? "",
        "Remarks" => $_POST["remarks"] ?? ""
    ];

    $errors = [];

    foreach ($fields as $field => $value) {

        if (trim($value) == "") {

            $errors[] = $field . " is required.";

        }
    }

    if (count($errors) > 0) {

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Registration Error</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>

        <div class="container">

            <div class="error-box">

                <h2>Registration Error</h2>

                <?php

                foreach ($errors as $error) {

                    echo "<p>❌ " . htmlspecialchars($error) . "</p>";

                }

                ?>

                <a href="register.php" class="button">
                    Back to Registration
                </a>

            </div>

        </div>

        </body>
        </html>

        <?php

        exit;
    }

    /*
    Create safe filename from visitor name
    */

    $safeName = preg_replace(
        "/[^A-Za-z0-9_-]/",
        "_",
        $fields["Name"]
    );

    /*
    Make sure filename is unique
    */

    $filename = "registrations/" . $safeName . ".txt";

    $counter = 1;

    while (file_exists($filename)) {

        $filename = "registrations/" . $safeName . "_" . $counter . ".txt";

        $counter++;
    }

    /*
    Create and open text file using fopen()
    */

    $file = fopen($filename, "w");

    if ($file) {

        foreach ($fields as $field => $value) {

            fwrite(
                $file,
                $field . ": " . $value . PHP_EOL
            );

        }

        fclose($file);

        ?>

        <!DOCTYPE html>
        <html>

        <head>

            <title>Registration Successful</title>

            <link rel="stylesheet" href="style.css">

        </head>

        <body>

        <div class="container">

            <div class="success-box">

                <h2>Registration Successful!</h2>

                <p>
                    Visitor information has been successfully saved.
                </p>

                <p>
                    File created:
                    <strong><?php echo htmlspecialchars($filename); ?></strong>
                </p>

                <a href="index.php" class="button">
                    View Registration List
                </a>

            </div>

        </div>

        </body>

        </html>

        <?php

    } else {

        echo "Unable to create the file.";

    }

} else {

    header("Location: register.php");
    exit;

}
?>