<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database configuration
    include ("config.php");

    // Define variables and initialize with empty values
    $username = $email = $age = $password = "";
    $username_err = $email_err = $age_err = $password_err = "";

    // Validate username
    if (empty (trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty (trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate age
    if (empty (trim($_POST["age"]))) {
        $age_err = "Please enter your age.";
    } else {
        $age = trim($_POST["age"]);
    }

    // Validate password
    if (empty (trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before inserting into database
    if (empty ($username_err) && empty ($email_err) && empty ($age_err) && empty ($password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, age, password) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssis", $param_username, $param_email, $param_age, $param_password);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_age = $age;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Registration successful
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}