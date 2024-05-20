<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); // Dodaj ten wiersz, aby załadować funkcje SRS

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
$type = isset($_POST['type']) ? $_POST['type'] : null;
$grades = isset($_POST['grades']) ? $_POST['grades'] : [];

foreach ($grades as $wordId => $grade) {
    // Zaktualizuj SRS dla każdego słowa na podstawie oceny
    updateSRS($userId, $wordId, $grade);
}

header("Location: zalogowany.php");
exit();

