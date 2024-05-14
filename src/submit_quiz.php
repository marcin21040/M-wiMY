<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji
$categoryId = $_GET['category_id'];

// Pobierz język z sesji
$language = $_SESSION['language'] ?? '';

// Ustal odpowiednią kolumnę tłumaczeń na podstawie wybranego języka
$translationColumn = '';
switch ($language) {
    case 'angielski':
        $translationColumn = 'translation_en';
        break;
    case 'niemiecki':
        $translationColumn = 'translation_de';
        break;
    case 'hiszpanski':
        $translationColumn = 'translation_es';
        break;
    case 'francuski':
        $translationColumn = 'translation_fr';
        break;
    default:
        die("Nieznany język.");
}

$correctAnswers = 0;
$totalQuestions = count($_POST['questions']);
$incorrectAnswers = [];

foreach ($_POST['questions'] as $index => $question) {
    $questionId = $question['id'];
    $correctAnswer = $question['translation']; // Korzystamy z dynamicznej kolumny translation
    $userAnswer = $_POST['answers'][$index]['translation'];

    if (strtolower(trim($correctAnswer)) === strtolower(trim($userAnswer))) {
        $correctAnswers++;
    } else {
        $incorrectAnswers[] = [
            'id' => $question['id'],
            'word' => $question['word'],
            'correct' => $correctAnswer,
            'user' => $userAnswer
        ];
    }
}

// Zapisz wynik do tabeli user_history
$stmt = $conn->prepare("INSERT INTO user_history (user_id, category_id, type, correct_answers, total_questions, language) VALUES (?, ?, 'quiz', ?, ?, ?)");
$stmt->bind_param("iiiis", $userId, $categoryId, $correctAnswers, $totalQuestions, $language);
$stmt->execute();
$stmt->close();

// Serializujemy błędne odpowiedzi, aby przekazać je przez URL
$incorrectIds = array_column($incorrectAnswers, 'id');
$incorrectIdsSerialized = urlencode(serialize($incorrectIds));
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
        <div class="result-options">
            <a href="words.php?category_id=<?php echo htmlspecialchars($_GET['category_id']); ?>&type=quiz" class="button">Zrób jeszcze raz</a>
            <a href="words.php?incorrect_ids=<?php echo $incorrectIdsSerialized; ?>" class="button">Zrób jeszcze raz błędne</a>
            <button class="button" onclick="toggleErrors()">Pokaż błędy</button>
            <a href="niemiecki.php" class="button">Powrót</a>
        </div>
        <div class="errors" style="display:none;">
            <h2>Błędy</h2>
            <?php if (!empty($incorrectAnswers)): ?>
                <ul>
                    <?php foreach ($incorrectAnswers as $error): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($error['word']); ?>:</strong> 
                            Poprawna odpowiedź: <?php echo htmlspecialchars($error['correct']); ?>, 
                            Twoja odpowiedź: <?php echo htmlspecialchars($error['user']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Wszystkie odpowiedzi były poprawne!</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function toggleErrors() {
            const errorsDiv = document.querySelector('.errors');
            errorsDiv.style.display = errorsDiv.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
