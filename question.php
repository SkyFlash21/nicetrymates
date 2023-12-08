<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'db';
    $db_username = "limited_user";
    $db_password = "ceciestunmotsdepasstrescompliquepourlimited_user";
    $db_name = "nicetrymates";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);
    $token = $_COOKIE['token'];
    $stmt = $conn->prepare('SELECT * FROM users WHERE connectiontoken = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        setcookie('token', '', time() - 3600);
        http_response_code(401);
        exit;
    } else {
        $_SESSION['id'] = (int)$result->fetch_assoc()['id'];
        
        // get user id from the database from the token
        if (isset($_POST['answer']) && isset($_POST['question_id'])) {
            
            $questionId = (int)$_POST['question_id'];
            $answerId = (int)$_POST['answer'];
            $stmt = $conn->prepare('INSERT INTO user_answers (user_id, question_id, answer_id) VALUES (?, ?, ?)');
            $stmt->bind_param('iii', $_SESSION['id'], $questionId, $answerId); // Updated line
            $stmt->execute();
        }

        // get the greater answered question id from the database for the user if none set it to 0
        $stmt = $conn->prepare('SELECT MAX(question_id) AS max_question_id FROM user_answers WHERE user_id = ?');
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $greaterQuestionId = $row['max_question_id'];
        if ($greaterQuestionId === null) {
            $greaterQuestionId = 0;
        }
        $nextQuestionId = $greaterQuestionId + 1;

        // get the question from the database if not we redirect to the result page
        $stmt = $conn->prepare('SELECT * FROM questions WHERE id = ?');
        $stmt->bind_param('i', $nextQuestionId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            header('Location: result.php');
        }else{
            $question = $result->fetch_assoc()['question'];

            // get the answers from the database
            $stmt = $conn->prepare('SELECT * FROM answers WHERE question_id = ?');
            $stmt->bind_param('i', $nextQuestionId);
            $stmt->execute();
            $result = $stmt->get_result();
            $answers = array();
            while ($row = $result->fetch_assoc()) {
                $answers[] = $row;
            }
    
            // create form "id=questionFrom" with the question and the answers, the input have their id from the database as id 
            echo "<form id='questionForm' action='question.php' method='post'>";
            echo "<h2>$question</h2>";
            foreach ($answers as $answer) {
                echo "<input type='radio' id='$answer[id]' name='answer' value='$answer[id]'>";
                echo "<label for='$answer[id]'>$answer[answer]</label><br>";
            }
            echo "<input type='hidden' name='question_id' value='$nextQuestionId'>";
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
        }
        
    }
}
?>


