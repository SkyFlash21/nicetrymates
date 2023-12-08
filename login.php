<?php
    session_start();
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the user credentials from the request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Connect to the MySQL database
        $servername = 'db';
        $db_username = "limited_user";
        $db_password = "ceciestunmotsdepasstrescompliquepourlimited_user";
        $db_name = "nicetrymates";

        $conn = new mysqli($servername, $db_username, $db_password, $db_name);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare the SQL statement to check if the user exists
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['hashedpassword'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Generate a token
                $token = uniqid();

                // Update the connection token in the database
                $stmt = $conn->prepare('UPDATE users SET connectiontoken = ? WHERE email = ?');
                $stmt->bind_param('ss', $token, $email);
                $stmt->execute();

                // Create a session
                $_SESSION['email'] = $email;
                $_SESSION['token'] = $token;

                // ajouter la condition remember me 
                if (isset($_POST['remember'])) {
                    setcookie('token', $token, time() + 60*60*24); // 1 jours
                }else{
                    setcookie('token', $token, time() + 60*10); // 10 minutes
                }

                // Update the last connection timestamp
                $stmt = $conn->prepare('UPDATE users SET lastconnection = NOW() WHERE email = ?');
                $stmt->bind_param('s', $email);
                $stmt->execute();

                // Redirect the user to the dashboard or any other page
                header('Location: question.html');
                exit();
            } else {
                echo 'Incorrect password';
            }
        } else {
            echo 'User not found';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
?>