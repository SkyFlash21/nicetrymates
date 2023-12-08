<?php
    session_start();

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
            // Create connection
            $servername = 'db5014871567.hosting-data.io';
            $db_username = 'dbu2245263';
            $db_password = "ceciestunmotsdepasstrescompliquepourlimited_user";
            $db_name = 'dbs12354220';
            $conn = new mysqli($servername, $db_username, $db_password, $db_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if user already exists
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<h2>Registration Failed</h2>";
                echo "<p>User with email $email already exists</p>";
            } else {
                // Generate connection token
                $connectionToken = uniqid();

                // Insert user into the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $lastConnection = date('Y-m-d H:i:s');
                $insertSql = "INSERT INTO users (username, email, hashedpassword, lastconnection, connectiontoken) VALUES ('$name', '$email', '$hashedPassword', '$lastConnection', '$connectionToken')";
                if ($conn->query($insertSql) === TRUE) {
                    setcookie('token', uniqid(), time() + 60*10); // 10 minutes
                    header('Location: question.html');
                } else {
                    echo "<h2>Registration Failed</h2>";
                    echo "<p>Error: " . $insertSql . "<br>" . $conn->error . "</p>";
                }
            }
            $conn->close();
            
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