<?php
session_start();
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['translation_english']) && isset($_POST['word'])) {
    // Sprawdź czy została przesłana poprawna odpowiedź
    $user_translation = strtolower(trim($_POST['translation_english']));
    $word = $_POST['word']; // Pobierz wartość słowa przekazaną z formularza

    // Pobierz poprawną odpowiedź z bazy danych
    $query = "SELECT translation_english FROM words WHERE word = '$word'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $correct_translation = strtolower(trim($row['translation_english']));
    
        // Sprawdź czy odpowiedź jest poprawna
        if ($user_translation == $correct_translation) {
            $_SESSION['correct_answers']++;
        } else {
            $_SESSION['wrong_answers']++;
        }
    }

    // Zwróć nowy stan wyników
    include 'result.php';
}

