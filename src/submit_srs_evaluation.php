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
$grades = $_POST['grades'] ?? [];

foreach ($grades as $wordId => $grade) {
    updateSRS($userId, $wordId, $grade);
}

header("Location: zalogowany.php");
exit();
?>
