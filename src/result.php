<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;
$incorrectIdsSerialized = isset($_GET['incorrect_ids']) ? $_GET['incorrect_ids'] : null;

$incorrectIds = unserialize(urldecode($incorrectIdsSerialized));

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

$correctAnswers = $_SESSION['correct_answers'] ?? 0;
$wrongAnswers = $_SESSION['wrong_answers'] ?? 0;
$percentage = ($correctAnswers / ($correctAnswers + $wrongAnswers)) * 100;

echo "<h1>Wyniki Quizu</h1>";
echo "<p>Liczba poprawnych odpowiedzi: $correctAnswers</p>";
echo "<p>Liczba błędnych odpowiedzi: $wrongAnswers</p>";
echo "<p>Wynik procentowy: " . number_format($percentage, 2) . "%</p>";

if (!empty($incorrectIds)) {
    echo "<h2>Błędy</h2>";
    echo "<table>";
    echo "<tr><th>Słowo</th><th>Poprawna odpowiedź</th><th>Twoja odpowiedź</th></tr>";

    // Pobierz błędne odpowiedzi
    $placeholders = implode(',', array_fill(0, count($incorrectIds), '?'));
    $types = str_repeat('i', count($incorrectIds));
    $stmt = $conn->prepare("SELECT id, word, $translationColumn as correct FROM words WHERE id IN ($placeholders)");
    $stmt->bind_param($types, ...$incorrectIds);
    $stmt->execute();
    $result = $stmt->get_result();
    $incorrectWords = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    foreach ($incorrectWords as $word) {
        $wordId = $word['id'];
        $wordText = $word['word'];
        $correctAnswer = $word['correct'];
        $userAnswer = $_SESSION['user_answers'][$wordId] ?? 'N/A';
        echo "<tr><td>$wordText</td><td>$correctAnswer</td><td>$userAnswer</td></tr>";
    }

    echo "</table>";
}

echo '<br><a href="zalogowany.php" class="btn">Powrót</a>';

