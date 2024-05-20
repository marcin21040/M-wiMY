<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); // Zakładając, że masz funkcje SRS tutaj

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji

// Pobierz category_id z parametrów URL
$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

if ($categoryId === null) {
    die("Brak zdefiniowanej kategorii.");
}

// Debugowanie wartości category_id
echo "category_id: $categoryId<br>";

// Pobierz słowa do przeglądu
$wordsToReview = getWordsForReview($userId, $categoryId);

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przegląd SRS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .review-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .review-table th, .review-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .review-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<nav class="mainNav">
    <div class="mainNav__logo"><a href="zalogowany.php">MówiMY</a></div>
    <div class="mainNav__links">
        <a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>
    </div>
</nav>

<div class="mainContent">
    <h1>Przegląd SRS</h1>
    <?php if (!empty($wordsToReview)): ?>
        <table class="review-table">
            <thead>
                <tr>
                    <th>Słowo</th>
                    <th>Tłumaczenie</th>
                    <th>Następna powtórka</th>
                    <th>Ilość powtórzeń</th>
                    <th>Interwał powtórki</th>
                    <th>Łatwość</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($wordsToReview as $word): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($word['word']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_pl']); // lub inna kolumna tłumaczenia ?></td>
                        <td><?php echo htmlspecialchars($word['next_review']); ?></td>
                        <td><?php echo htmlspecialchars($word['repetitions']); ?></td>
                        <td><?php echo htmlspecialchars($word['review_interval']); ?></td>
                        <td><?php echo htmlspecialchars($word['ease']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Brak słów do przeglądu na ten moment.</p>
    <?php endif; ?>
</div>
</body>
</html>
