<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php'); // Dodajemy plik z funkcjami SRS

// Sprawdź czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    // Jeśli niezalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji
$wordsToReviewCount = countWordsForReview($userId);
// Sprawdź, czy użytkownik ma słowa do powtórki
$wordsToReview = getWordsDueForReview($userId);
$hasWordsToReview = !empty($wordsToReview);
?>

<!DOCTYPE html>
<html lang="en">

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
    <style style?>  .notification {
    background-color: #ffcc00;
    color: #000;
    padding: 15px;
    margin: 20px 0;
    border: 1px solid #ffa500;
    border-radius: 5px;
}
.notification a {
    color: #000;
    text-decoration: underline;
}</style>
</head>

<body>

    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="srs_review.php" class="mainNav__link">Wyniki</a>
            <a href="user_history.php" class="mainNav__link">Historia</a>
            <a href="logout.php" class="mainNav__link">Wyloguj się</a>
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

    <header class="mainHeading login_wrapper">
        <div class="mainHeading__content">
            <div class="language_wrapper intro">
                <a class="language" href="set_language.php?language=niemiecki">
                    <img src="dist/images/germany-flag.png">
                    <p>Niemiecki</p>
                </a>
                <a class="language" href="set_language.php?language=angielski">
                    <img src="dist/images/uk-flag.png">
                    <p>Angielski</p>
                </a>
                <a class="language" href="set_language.php?language=hiszpanski">
                    <img src="dist/images/spain-flag.png">
                    <p>Hiszpański</p>
                </a>
                <a class="language" href="set_language.php?language=francuski">
                    <img src="dist/images/france-flag.jpg">
                    <p>Francuski</p>
                </a>
            </div>
        </div>
    </header>

    <div class="mainContent">
        <?php if ($wordsToReviewCount > 0): ?>
            <div class="notification">
                <p>Masz <?php echo $wordsToReviewCount; ?> słów do powtórki. <a href="srs_review.php">Przejdź do powtórki</a></p>
            </div>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>

</html>

