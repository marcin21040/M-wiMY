<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); 

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; 
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($categoryId === null || $categoryId <= 0) {
    die("Nieprawidłowy category_id.");
}

$language = $_SESSION['language'] ?? '';

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

$_SESSION['user_answers'] = []; 
$_SESSION['correct_answers_list'] = []; 

foreach ($_POST['questions'] as $index => $question) {
    $questionId = $question['id'];
    $correctAnswer = $question['translation']; 
    $userAnswer = $_POST['answers'][$index]['translation'];

    $_SESSION['user_answers'][$questionId] = $userAnswer;
    $_SESSION['correct_answers_list'][$questionId] = $correctAnswer;
    
    error_log("Sprawdzanie pytania ID: $questionId, Poprawna odpowiedź: $correctAnswer, Odpowiedź użytkownika: $userAnswer");

    if (strtolower(trim($correctAnswer)) === strtolower(trim($userAnswer))) {
        $correctAnswers++;
        $grade = 5; 
    } else {
        $incorrectAnswers[] = [
            'id' => $questionId,
            'word' => $question['word'],
            'correct' => $correctAnswer,
            'user' => $userAnswer
        ];
        $grade = 1; 
    }

    $stmt = $conn->prepare("SELECT * FROM srs_words WHERE user_id = ? AND word_id = ?");
    $stmt->bind_param("ii", $userId, $questionId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        updateSRS($userId, $questionId, $grade); 
    } else {
        $nextReview = date('Y-m-d', strtotime("+1 day"));
        $stmt = $conn->prepare("INSERT INTO srs_words (user_id, word_id, next_review, repetitions, review_interval, ease) VALUES (?, ?, ?, 0, 1, 2.5)");
        $stmt->bind_param("iis", $userId, $questionId, $nextReview);
        $stmt->execute();
        updateSRS($userId, $questionId, $grade);
    }

    $stmt->close();
}

$stmt = $conn->prepare("INSERT INTO user_history (user_id, category_id, type, correct_answers, total_questions, language) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisiis", $userId, $categoryId, $type, $correctAnswers, $totalQuestions, $language);
$stmt->execute();
$stmt->close();

$_SESSION['correct_answers'] = $correctAnswers;
$_SESSION['wrong_answers'] = $totalQuestions - $correctAnswers;

$incorrectIds = array_column($incorrectAnswers, 'id');
$incorrectIdsSerialized = urlencode(serialize($incorrectIds));

header("Location: result.php?category_id=$categoryId&type=$type&incorrect_ids=$incorrectIdsSerialized");
exit();
