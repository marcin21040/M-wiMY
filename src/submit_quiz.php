<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    // Jeśli niezalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}

$correctAnswers = 0;
$totalQuestions = count($_POST['questions']);

foreach ($_POST['questions'] as $index => $question) {
    $questionId = $question['id'];
    $correctAnswer = $question['de'];
    $userAnswer = $_POST['answers'][$index]['de'];

    if (strtolower(trim($correctAnswer)) === strtolower(trim($userAnswer))) {
        $correctAnswers++;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Wynik quizu</title>
</head>
<body>
    <div class="result">
        <h1>Twój wynik</h1>
        <p>Poprawne odpowiedzi: <?php echo $correctAnswers; ?> z <?php echo $totalQuestions; ?></p>
        <a href="index.php" class="button">Powrót do strony głównej</a>
    </div>
</body>
</html>
