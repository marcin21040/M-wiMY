<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji

// Pobierz język z sesji
$language = $_SESSION['language'] ?? '';

// Pobierz słowa do przeglądu
$words = getWordsDueForReview($userId);

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
        $translationColumn = 'word'; // Domyślna kolumna, jeśli język nie jest ustawiony prawidłowo
        break;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Przegląd SRS</title>
    <script type="module" src="main.js" defer></script>
    <link rel="stylesheet" href="dist/prod.css">
</head>
<body>
<nav class="mainNav">
    <div class="mainNav__logo"><a href="zalogowany.php">MówiMY</a></div>
    <div class="mainNav__links">
        <a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>
    </div>
</nav>
<header class="mainHeading login_wrapper words_wrapper">
    <div class="mainHeading__content">
        <h1>Przegląd SRS</h1>

        <?php if (!empty($words)): ?>
            <form method="post" action="submit_srs_quiz.php" class="quiz-form">
                <?php foreach ($words as $index => $word): ?>
                    <div class="word-item">
                        <p>Oryginał: <?php echo htmlspecialchars($word['word']); ?></p>
                        <label for="word-<?php echo $word['id']; ?>-translation"><?php echo ucfirst($language); ?>:</label>
                        <input type="text" id="word-<?php echo $word['id']; ?>-translation" name="answers[<?php echo $index; ?>][translation]" required>
                        <input type="hidden" name="questions[<?php echo $index; ?>][id]" value="<?php echo $word['id']; ?>">
                        <input type="hidden" name="questions[<?php echo $index; ?>][word]" value="<?php echo $word['word']; ?>">
                        <input type="hidden" name="questions[<?php echo $index; ?>][translation]" value="<?php echo $word[$translationColumn]; ?>">
                    </div>
                <?php endforeach; ?>
                <button type="submit">Zakończ quiz</button>
            </form>
        <?php else: ?>
            <p>Brak słów do przeglądu na ten moment.</p>
        <?php endif; ?>
    </div>
</header>

<script src="script.js"></script>
</body>
</html>
