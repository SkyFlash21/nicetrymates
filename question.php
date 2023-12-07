<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    $questionId = (int)$_POST['question_id'];
    $answerId = (int)$_POST['answer_id'];

    // Generate the HTML response
    $response = "<h1>Thank you for submitting the form!</h1>";
    $response .= "<p>Question ID: $questionId</p>";
    $response .= "<p>Answer ID: $answerId</p>";

    // Send the HTML response
    echo $response;
}
?>
