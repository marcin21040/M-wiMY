<?php
session_start(); // Uruchomienie sesji

// Ustawienie języka w sesji
$_SESSION['language'] = 'hiszpanski';

require_once('connection.php');

// Pobierz kategorie z bazy danych
$categories = [];
$result = mysqli_query($conn, "SELECT id, name FROM categories");
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Strona Główna</title>
    <script type="module" src="main.js" defer></script>
    <link rel="stylesheet" href="dist/prod.css">
    <link rel="stylesheet" href="niemiecki.scss">
</head>
<body>

<nav class="mainNav">
    <div class="mainNav__logo"><a href="zalogowany.php">MówiMY</a></div>
    <div class="mainNav__links">
        <a href="" class="mainNav__link">Zacznij naukę</a>
        <a href="" class="mainNav__link">O nas</a>
        <a href="" class="mainNav__link">Kontakt</a>
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
    <div class="mainHeading__content lang-niemiecki">
        <h1>SP Hiszpański SP</h1>
        <div class="fiszki-quizy">
            <article class="mainHeading__text">
                <p class="mainHeading__preTitle">Mówimy</p>
                <h2 class="mainHeading__title">Fiszki</h2>
                <p class="mainHeading__description">
                   Zacznij uczyć się przy pomocy fiszek. Wybierz kategorię i zacznij naukę.
                </p>
                <button class="cta" id="guzik-fiszki" onclick="myFunction()">Pokaż fiszki</button>
             </article>
             <article class="mainHeading__text">
                <p class="mainHeading__preTitle">Mówimy</p>
                <h2 class="mainHeading__title">Quizy</h2>
                <p class="mainHeading__description">
                    Sprawdź swoją wiedzę przy pomocy quizów. Wybierz kategorię i zacznij quiz.
                </p>
                <button class="cta" id="guzik-quizy" onclick="myFunction2()">Zacznij Quiz</button>
             </article>
        </div>
        <div class="kategorie-trybow">
            <div class="kategorie-fiszek">
                <div class="kategorie-fiszek__wrapper">
                    <?php foreach ($categories as $category): ?>
                        <a href="words.php?category_id=<?php echo $category['id']; ?>&type=flashcard" class="kategorie-fiszek__item"><?php echo $category['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="kategorie-quizow">
                <div class="kategorie-quizow__wrapper">
                    <?php foreach ($categories as $category): ?>
                        <a href="words.php?category_id=<?php echo $category['id']; ?>&type=quiz" class="kategorie-fiszek__item"><?php echo $category['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function myFunction() {
        document.querySelector(".kategorie-quizow__wrapper").style.display = 'none';
        document.querySelector(".kategorie-fiszek__wrapper").style.display = 'flex';
    }
    function myFunction2() {
        document.querySelector(".kategorie-fiszek__wrapper").style.display = 'none';
        document.querySelector(".kategorie-quizow__wrapper").style.display = 'flex';
    }
</script>

</body>
</html>
