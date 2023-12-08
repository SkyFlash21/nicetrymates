<?php
$servername = 'db';
    $db_username = "limited_user";
    $db_password = "ceciestunmotsdepasstrescompliquepourlimited_user";
    $db_name = "nicetrymates";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);
    $token = $_COOKIE["token"];
    $stmt = $conn->prepare('SELECT * FROM users WHERE connectiontoken = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        http_response_code(401);
        exit;
    }

    $_SESSION['id'] = (int)$result->fetch_assoc()['id'];

    // Calculate total points for user
    $userId = $_SESSION['id'];
    $stmt = $conn->prepare('SELECT SUM(point_value) AS total_points
                            FROM user_answers
                            JOIN answers ON user_answers.answer_id = answers.id
                            WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $pointsResult = $stmt->get_result();
    $totalPoints = $pointsResult->fetch_assoc()['total_points'];

    echo "Total points: " . $totalPoints;
?>


