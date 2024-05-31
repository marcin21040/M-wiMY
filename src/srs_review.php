<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php');

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; 

$wordsToReview = getWordsDueForReview($userId);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przegląd SRS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dist/prod.css">
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function redirectToOverview() {
            window.location.href = 'zalogowany.php';
        }
    </script>
</head>
<body>


<div class="mainContent">
<h1 onclick="redirectToOverview()">Do powtórki </h1>
    <?php if (!empty($wordsToReview)): ?>
        <form action="srs_quiz.php" method="post">
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
                            <td><?php echo htmlspecialchars($word['translation_pl']); ?></td>
                            <td><?php echo htmlspecialchars($word['next_review']); ?></td>
                            <td><?php echo htmlspecialchars($word['repetitions']); ?></td>
                            <td><?php echo htmlspecialchars($word['review_interval']); ?></td>
                            <td><?php echo htmlspecialchars($word['ease']); ?></td>
                        </tr>
                        <input type="hidden" name="word_ids[]" value="<?php echo htmlspecialchars($word['id']); ?>">
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn">Rozpocznij Quiz</button>
        </form>
    <?php else: ?>
        <p>Brak słów do przeglądu na ten moment.</p>
    <?php endif; ?>
</div>
</body>
</html>
