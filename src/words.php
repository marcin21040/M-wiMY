<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); 


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

$language = $_SESSION['language'] ?? '';


function getWordsByCategory($categoryId) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT w.id, w.word, w.translation_pl, w.translation_de, w.translation_en, w.translation_es, w.translation_fr
        FROM words w
        JOIN word_categories wc ON w.id = wc.word_id
        JOIN categories c ON wc.category_id = c.id
        WHERE c.id = ?"
    );
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $words = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $words;
}


function getWordsByIds($ids) {
    global $conn;
    $ids = implode(',', array_map('intval', $ids)); 
    $query = "SELECT id, word, translation_pl, translation_de, translation_en, translation_es, translation_fr FROM words WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);

 
    if (!$result) {
        return []; 
    }

    $words = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $words;
}


$words = [];
$categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;

if (isset($_POST['word_ids'])) {
    $wordIds = $_POST['word_ids'];
    $words = getWordsByIds($wordIds);
} elseif ($categoryId !== null && $type !== null) {
    if ($type === 'flashcard') {
        $words = getWordsByCategory($categoryId); 
    } else {
        $words = getWordsByCategory($categoryId);
        
        
        $words = array_unique($words, SORT_REGULAR);
        
        
        if (count($words) > 10) {
            shuffle($words); 
            $words = array_slice($words, 0, 10); 
        }
    }
}


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
        $translationColumn = 'word'; 
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
    <title>Strona Główna</title>
    <script type="module" src="main.js" defer></script>
    <link rel="stylesheet" href="dist/prod.css">
    <style>
        .flashcards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .flashcard {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .flashcard .original {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .flashcard .translation {
            font-size: 16px;
            color: #555;
        }

        .hidden-translation {
            display: none;
        }
    </style>
</head>
<body>
<nav class="mainNav">
    <div class="mainNav__logo"><a href="zalogowany.php">MówiMY</a></div>
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
<header class="mainHeading login_wrapper words_wrapper">
    <div class="mainHeading__content">
        <h1><?php echo $type === 'flashcard' ? 'Fiszki' : 'Quiz'; ?>: <?php echo htmlspecialchars($language); ?></h1>

        <?php if (!empty($words)): ?>
            <?php if ($type === 'flashcard'): ?>
                <div class="flashcards">
                    <?php foreach ($words as $index => $word): ?>
                        <div class="flashcard" id="flashcard-<?php echo $index; ?>" onclick="toggleTranslation('flashcard-<?php echo $index; ?>')">
                            <p class="original"><?php echo htmlspecialchars($word['word']); ?></p>
                            <p class="translation"><?php echo htmlspecialchars($word[$translationColumn]); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <form method="post" action="submit_quiz.php?category_id=<?php echo isset($categoryId) ? htmlspecialchars($categoryId) : ''; ?>&type=<?php echo isset($type) ? htmlspecialchars($type) : ''; ?>" class="quiz-form">
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
            <?php endif; ?>
        <?php else: ?>
            <p>Brak słów w tej kategorii.</p>
        <?php endif; ?>

    </div>
</header>

<script>
    function toggleTranslation(id) {
        var flashcard = document.getElementById(id);
        var translation = flashcard.querySelector('.translation');
        if (translation) {
            translation.classList.toggle('hidden-translation');
        }
    }
</script>

<script src="script.js"></script>
</body>
</html>
