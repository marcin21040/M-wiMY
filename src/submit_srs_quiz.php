<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); // Dodaj ten wiersz, aby załadować funkcje SRS

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji

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

$_SESSION['user_answers'] = []; // Przechowuj odpowiedzi użytkownika
$_SESSION['correct_answers_list'] = []; // Przechowuj poprawne odpowiedzi

foreach ($_POST['questions'] as $index => $question) {
    $questionId = $question['id'];
    $correctAnswer = $question['translation']; // Korzystamy z dynamicznej kolumny translation
    $userAnswer = $_POST['answers'][$index]['translation'];

    $_SESSION['user_answers'][$questionId] = $userAnswer; // Przechowuj odpowiedź użytkownika
    $_SESSION['correct_answers_list'][$questionId] = $correctAnswer; // Przechowuj poprawną odpowiedź
    
    // Debugowanie odpowiedzi
    error_log("Sprawdzanie pytania ID: $questionId, Poprawna odpowiedź: $correctAnswer, Odpowiedź użytkownika: $userAnswer");

    if (strtolower(trim($correctAnswer)) === strtolower(trim($userAnswer))) {
        $correctAnswers++;
        $grade = 5; // Ocena 5 dla poprawnych odpowiedzi
    } else {
        $incorrectAnswers[] = [
            'id' => $questionId,
            'word' => $question['word'],
            'correct' => $correctAnswer,
            'user' => $userAnswer
        ];
        $grade = 1; // Ocena 1 dla niepoprawnych odpowiedzi
    }

    // Zaktualizuj lub dodaj słowo do tabeli SRS
    $stmt = $conn->prepare("SELECT * FROM srs_words WHERE user_id = ? AND word_id = ?");
    $stmt->bind_param("ii", $userId, $questionId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        updateSRS($userId, $questionId, $grade); // Zaktualizuj istniejące słowo
    } else {
        // Dodaj nowe słowo
        $nextReview = date('Y-m-d', strtotime("+1 day"));
        $stmt = $conn->prepare("INSERT INTO srs_words (user_id, word_id, next_review, repetitions, review_interval, ease) VALUES (?, ?, ?, 0, 1, 2.5)");
        $stmt->bind_param("iis", $userId, $questionId, $nextReview);
        $stmt->execute();
        updateSRS($userId, $questionId, $grade); // Zaktualizuj nowe słowo
    }

    $stmt->close();
}

// Przechowaj dane w sesji
$_SESSION['correct_answers'] = $correctAnswers;
$_SESSION['wrong_answers'] = $totalQuestions - $correctAnswers;

// Serializujemy błędne odpowiedzi, aby przekazać je przez URL
$incorrectIds = array_column($incorrectAnswers, 'id');
$incorrectIdsSerialized = urlencode(serialize($incorrectIds));

header("Location: srs_result.php?incorrect_ids=$incorrectIdsSerialized");
exit();
