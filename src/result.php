<?php
if (isset($_SESSION['correct_answers']) && isset($_SESSION['wrong_answers'])) {
    $correct_answers = $_SESSION['correct_answers'];
    $wrong_answers = $_SESSION['wrong_answers'];
    $total_answers = $correct_answers + $wrong_answers;
    if ($total_answers > 0) {
        $percentage_correct = ($correct_answers / $total_answers) * 100;
        echo "<p>Liczba poprawnych odpowiedzi: $correct_answers</p>";
        echo "<p>Liczba błędnych odpowiedzi: $wrong_answers</p>";
        echo "<p>Wynik procentowy: " . number_format($percentage_correct, 2) . "%</p>";
    }
}

