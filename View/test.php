<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'db5014871567.hosting-data.io';
    $db_username = 'dbu2245263';
    $db_password = "ceciestunmotsdepasstrescompliquepourlimited_user";
    $db_name = 'dbs12354220';

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
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>EcoBrain</title>
                <link rel="stylesheet" href="../Ressource/CSS/Question.css">
                <link rel="stylesheet" href="../Ressource/CSS/Default.css">
                <link rel="shortcut icon" type="imahe/png" href="../Ressource/Images/icone.png">
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script src="../Ressource/JS/questionnaire.js"></script>
            </head>
            <body>
                <form id='questionForm' class="column" action='question.php' method='post'>
                    <div class="card">
                        <table>
                            <tr>
                                <th>
                                    <img src="../Ressource/Images/imgHmEf.jpg" alt="Jane" style="width:100%">
                                </th>
                                <th>
                                    <div class="container">
                                        <h2><?=$question?></h2>;

                                        <?php
                                        foreach ($answers as $answer) {
                                            echo "<input type='radio' id='$answer[id]' name='answer' value='$answer[id]'>";
                                            echo "<label for='$answer[id]'>$answer[answer]</label><br>";
                                        }?>
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </div>
                <input type='hidden' name='question_id' value='$nextQuestionId'>
                <input type='submit' value='Submit'>
                </form>;
            </body>
            </html>
            <?php
        }
        
    }
}
?>