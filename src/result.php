<?php
session_start();
require_once('connection.php');

if (isset($_SESSION['correct_answers']) && isset($_SESSION['wrong_answers'])) {
    $correct_answers = $_SESSION['correct_answers'];
    $wrong_answers = $_SESSION['wrong_answers'];
    $total_answers = $correct_answers + $wrong_answers;

    $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $incorrectIds = isset($_GET['incorrect_ids']) ? unserialize(urldecode($_GET['incorrect_ids'])) : [];

    if ($total_answers > 0) {
        $percentage_correct = ($correct_answers / $total_answers) * 100;
        echo "<p>Liczba poprawnych odpowiedzi: $correct_answers</p>";
        echo "<p>Liczba błędnych odpowiedzi: $wrong_answers</p>";
        echo "<p>Wynik procentowy: " . number_format($percentage_correct, 2) . "%</p>";
    }

    echo '<div class="result-options">';
    echo '<a href="words.php?category_id=' . htmlspecialchars($categoryId) . '&type=' . htmlspecialchars($type) . '" class="button">Zrób jeszcze raz</a>';
    echo '<a href="words.php?incorrect_ids=' . urlencode(serialize($incorrectIds)) . '&category_id=' . htmlspecialchars($categoryId) . '&type=' . htmlspecialchars($type) . '" class="button">Zrób jeszcze raz błędne</a>';
    echo '<button class="button" onclick="toggleErrors()">Pokaż błędy</button>';
    echo '<a href="niemiecki.php" class="button">Powrót</a>';
    echo '</div>';
}

if (!empty($incorrectIds)) {
    $ids = implode(',', array_map('intval', $incorrectIds));
    $query = "SELECT id, word, translation_pl, translation_de, translation_en, translation_es, translation_fr FROM words WHERE id IN ($ids)";
    $result = $conn->query($query);
    $incorrectAnswers = $result->fetch_all(MYSQLI_ASSOC);
    echo '<div class="errors" style="display:none;">';
    echo '<h2>Błędy</h2>';
    if (!empty($incorrectAnswers)) {
        echo '<ul>';
        foreach ($incorrectAnswers as $error) {
            $wordId = $error['id'];
            $userAnswer = isset($_SESSION['user_answers'][$wordId]) ? $_SESSION['user_answers'][$wordId] : 'N/A';
            $correctAnswer = isset($_SESSION['correct_answers_list'][$wordId]) ? $_SESSION['correct_answers_list'][$wordId] : 'N/A';
            echo '<li>';
            echo '<strong>' . htmlspecialchars($error['word']) . ':</strong> ';
            echo 'Poprawna odpowiedź: ' . htmlspecialchars($correctAnswer) . ', ';
            echo 'Twoja odpowiedź: ' . htmlspecialchars($userAnswer);
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Wszystkie odpowiedzi były poprawne!</p>';
    }
    echo '</div>';
}
?>

<script>
function toggleErrors() {
    const errorsDiv = document.querySelector('.errors');
    errorsDiv.style.display = errorsDiv.style.display === 'none' ? 'block' : 'none';
}
</script>
