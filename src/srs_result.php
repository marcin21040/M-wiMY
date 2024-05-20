<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); // Dodaj ten wiersz, aby załadować funkcje SRS

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

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

echo "<h1>Wyniki Quizu SRS</h1>";
echo "<p>Liczba poprawnych odpowiedzi: $correctAnswers</p>";
echo "<p>Liczba błędnych odpowiedzi: $wrongAnswers</p>";
echo "<p>Wynik procentowy: " . number_format($percentage, 2) . "%</p>";

if (!empty($incorrectIds)) {
    echo "<h2>Błędy</h2>";
    echo "<form method='post' action='submit_srs_evaluation.php'>";
    echo "<table>";
    echo "<tr><th>Słowo</th><th>Poprawna odpowiedź</th><th>Twoja odpowiedź</th><th>Ocena</th></tr>";

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
        echo "<tr>";
        echo "<td>$wordText</td>";
        echo "<td>$correctAnswer</td>";
        echo "<td>$userAnswer</td>";
        echo "<td>";
        echo "<select name='grades[$wordId]'>";
        echo "<option value='5'>5 - Bardzo łatwe</option>";
        echo "<option value='4'>4 - Łatwe</option>";
        echo "<option value='3'>3 - Średnie</option>";
        echo "<option value='2'>2 - Trudne</option>";
        echo "<option value='1'>1 - Bardzo trudne</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<button type='submit'>Zapisz oceny</button>";
    echo "</form>";
}

echo '<br><a href="zalogowany.php" class="btn">Powrót</a>';
?>
