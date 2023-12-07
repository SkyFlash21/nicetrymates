<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $terms = isset($_POST["terms"]) ? "Accepted" : "Not Accepted";

    // Perform basic validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password should be at least 6 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // If there are no validation errors, you can proceed with further actions
    if (empty($errors)) {
        // Process the data or store it in a database
        // For now, let's just display the submitted data
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Password: [hidden for security reasons]</p>";
        echo "<p>Terms & Conditions: $terms</p>";
    } else {
        // Display validation errors
        echo "<h2>Registration Failed</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
} else {
    // Redirect to the form if accessed directly without a POST request
    header("Location: index.html");
    exit();
}
?>
