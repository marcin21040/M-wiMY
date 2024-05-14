<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    // Jeśli niezalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}

function getWordsByCategory($categoryId, $type) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT w.id, w.word, w.translation_pl, w.translation_de, w.translation_en, w.translation_es, w.translation_fr
        FROM words w
        JOIN word_categories wc ON w.id = wc.word_id
        JOIN categories c ON wc.category_id = c.id
        WHERE c.id = ? AND c.type = ?"
    );
    $stmt->bind_param("is", $categoryId, $type);
    $stmt->execute();
    $result = $stmt->get_result();
    $words = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $words;
}

if (isset($_GET['category_id']) && isset($_GET['type'])) {
    $categoryId = $_GET['category_id'];
    $type = $_GET['type'];
    $words = getWordsByCategory($categoryId, $type);

    // Losuj 10 słówek
    if (count($words) > 10) {
        $random_keys = array_rand($words, 10);
        $words = array_intersect_key($words, array_flip($random_keys));
    }
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
    <title>Słówka</title>
    <script type="module" src="main.js" defer></script>
    <link rel="stylesheet" href="dist/prod.css">
</head>
<body>

<nav class="mainNav">
    <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
    <div class="mainNav__links">
        <a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>
    </div>
    <div class="mainNav__icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g data-name="Layer 2" fill="#9197AE">
                <g data-name="menu-2">
                    <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                    <circle cx="4" cy="12" r="1" />
                    <rect x="7" y="11" width="14" height="2" rx=".94" ry=".94" />
                    <rect x="3" y="16" width="18" height="2" rx=".94" ry=".94" />
                    <rect x="3" y="6" width="18" height="2" rx=".94" ry=".94" />
                </g>
            </g>
        </svg>
    </div>
</nav>
<header class="mainHeading">
    <div class="mainHeading__content">
        <h1>Quiz słówek</h1>
    </div>
</header>

<?php if (isset($words) && !empty($words)): ?>
    <form method="post" action="submit_quiz.php" class="quiz-form">
        <?php foreach ($words as $index => $word): ?>
            <div class="word-item">
                <p>Oryginał: <?php echo htmlspecialchars($word['word']); ?></p>
                <label for="word-<?php echo $word['id']; ?>-de">Niemiecki:</label>
                <input type="text" id="word-<?php echo $word['id']; ?>-de" name="answers[<?php echo $index; ?>][de]" required>
                <input type="hidden" name="questions[<?php echo $index; ?>][id]" value="<?php echo $word['id']; ?>">
                <input type="hidden" name="questions[<?php echo $index; ?>][word]" value="<?php echo $word['word']; ?>">
                <input type="hidden" name="questions[<?php echo $index; ?>][de]" value="<?php echo $word['translation_de']; ?>">
            </div>
        <?php endforeach; ?>
        <button type="submit">Zakończ quiz</button>
    </form>
<?php else: ?>
    <p>Brak słów w tej kategorii.</p>
<?php endif; ?>

<script src="script.js"></script>
</body>
</html>
