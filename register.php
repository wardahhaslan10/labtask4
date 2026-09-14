<?php
/*
Course Code & Name : DFP40193 Web Programming
Full Name          : Your Name
Registration Number: Your Registration Number
Class              : Your Class
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Registration - Visit PTSS 2026</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <header>
        <h1>Visit PTSS 2026</h1>
        <p>New Visitor Registration</p>
    </header>

    <section class="form-section">

        <h2>Visitor Registration Form</h2>

        <form action="save.php" method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name">
                </div>

                <div class="form-group">
                    <label>IC / Passport</label>
                    <input type="text" name="ic_passport">
                </div>

                <div class="form-group">
                    <label>Institution</label>
                    <input type="text" name="institution">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address">
                </div>

                <div class="form-group">
                    <label>Selected Package</label>

                    <select name="package">

                        <option value="">-- Select Package --</option>

                        <option value="Campus Discovery Tour">
                            Campus Discovery Tour
                        </option>

                        <option value="Innovation Gallery Visit">
                            Innovation Gallery Visit
                        </option>

                        <option value="Short Professional Courses">
                            Short Professional Courses
                        </option>

                        <option value="Guest House Stay">
                            Guest House Stay
                        </option>

                    </select>

                </div>

                <div class="form-group">
                    <label>Visit Date</label>
                    <input type="date" name="visit_date">
                </div>

                <div class="form-group">
                    <label>Number of Visitors</label>
                    <input type="number" name="number_visitors" min="1">
                </div>

                <div class="form-group">
                    <label>Purpose of Visit</label>
                    <input type="text" name="purpose">
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks"></textarea>
                </div>

            </div>

            <div class="form-buttons">

                <button type="submit" class="button submit">
                    Register
                </button>

                <a href="index.php" class="button cancel">
                    Cancel
                </a>

            </div>

        </form>

    </section>

    <footer>
        <p>&copy; 2026 Visit PTSS | Politeknik Tuanku Syed Sirajuddin</p>
    </footer>

</div>

</body>
</html>