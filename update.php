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
Read existing data using fopen() mode r
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

    <title>Update Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <header>

        <h1>Visit PTSS 2026</h1>

        <p>Update Visitor Registration</p>

    </header>

    <section class="form-section">

        <h2>Update Registration</h2>

        <form action="update.php?file=<?php echo urlencode($fileName); ?>"
              method="POST">

            <div class="form-grid">

                <div class="form-group">

                    <label>Name</label>

                    <input type="text"
                           name="name"
                           value="<?php echo htmlspecialchars($data["Name"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>IC / Passport</label>

                    <input type="text"
                           name="ic_passport"
                           value="<?php echo htmlspecialchars($data["IC / Passport"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Institution</label>

                    <input type="text"
                           name="institution"
                           value="<?php echo htmlspecialchars($data["Institution"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           value="<?php echo htmlspecialchars($data["Email"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Contact Number</label>

                    <input type="text"
                           name="contact"
                           value="<?php echo htmlspecialchars($data["Contact Number"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Address</label>

                    <input type="text"
                           name="address"
                           value="<?php echo htmlspecialchars($data["Address"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Selected Package</label>

                    <select name="package">

                        <option value="">-- Select Package --</option>

                        <option value="Campus Discovery Tour"
                            <?php if (($data["Selected Package"] ?? "") == "Campus Discovery Tour") echo "selected"; ?>>
                            Campus Discovery Tour
                        </option>

                        <option value="Innovation Gallery Visit"
                            <?php if (($data["Selected Package"] ?? "") == "Innovation Gallery Visit") echo "selected"; ?>>
                            Innovation Gallery Visit
                        </option>

                        <option value="Short Professional Courses"
                            <?php if (($data["Selected Package"] ?? "") == "Short Professional Courses") echo "selected"; ?>>
                            Short Professional Courses
                        </option>

                        <option value="Guest House Stay"
                            <?php if (($data["Selected Package"] ?? "") == "Guest House Stay") echo "selected"; ?>>
                            Guest House Stay
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Visit Date</label>

                    <input type="date"
                           name="visit_date"
                           value="<?php echo htmlspecialchars($data["Visit Date"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Number of Visitors</label>

                    <input type="number"
                           name="number_visitors"
                           min="1"
                           value="<?php echo htmlspecialchars($data["Number of Visitors"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Purpose of Visit</label>

                    <input type="text"
                           name="purpose"
                           value="<?php echo htmlspecialchars($data["Purpose of Visit"] ?? ""); ?>">

                </div>

                <div class="form-group">

                    <label>Remarks</label>

                    <textarea name="remarks"><?php echo htmlspecialchars($data["Remarks"] ?? ""); ?></textarea>

                </div>

            </div>

            <div class="form-buttons">

                <button type="submit"
                        name="update"
                        class="button submit">

                    Save Update

                </button>

                <a href="index.php"
                   class="button cancel">

                    Cancel

                </a>

            </div>

        </form>

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

<?php

/*
Process UPDATE
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

        echo '<div class="container">';
        echo '<div class="error-box">';
        echo '<h2>Update Error</h2>';

        foreach ($errors as $error) {

            echo '<p>❌ ' .
                 htmlspecialchars($error) .
                 '</p>';

        }

        echo '<a href="update.php?file=' .
             urlencode($fileName) .
             '" class="button">';

        echo 'Back to Update';

        echo '</a>';

        echo '</div>';
        echo '</div>';

        exit;

    }

    /*
    Write updated data using fopen() mode w
    */

    $file = fopen($filePath, "w");

    if ($file) {

        foreach ($fields as $field => $value) {

            fwrite(
                $file,
                $field . ": " . $value . PHP_EOL
            );

        }

        fclose($file);

        /*
        If visitor name changed, rename file
        */

        $newSafeName = preg_replace(
            "/[^A-Za-z0-9_-]/",
            "_",
            $fields["Name"]
        );

        $newFilePath = "registrations/" .
                       $newSafeName .
                       ".txt";

        if ($newFilePath != $filePath) {

            $counter = 1;

            $originalPath = $newFilePath;

            while (file_exists($newFilePath)) {

                $newFilePath =
                    "registrations/" .
                    $newSafeName .
                    "_" .
                    $counter .
                    ".txt";

                $counter++;

            }

            rename($filePath, $newFilePath);

        }

        echo '<div class="container">';
        echo '<div class="success-box">';

        echo '<h2>Update Successful!</h2>';

        echo '<p>The registration has been successfully updated.</p>';

        echo '<a href="index.php" class="button">';
        echo 'Back to Registration List';
        echo '</a>';

        echo '</div>';
        echo '</div>';

    } else {

        echo "Unable to update the file.";

    }

}

?>