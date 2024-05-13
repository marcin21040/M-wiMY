<?php
require_once('connection.php');
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
    <link rel="stylesheet" href="niemiecki.scss" />
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

            <h1>Hiszpański</h1>

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
                    <!-- <h2 class="mainHeading__title">Kategorie fiszek</h2> -->
                    <div class="kategorie-fiszek__wrapper">
                        <a href="fiszki.php" class="kategorie-fiszek__item">dupa</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">dupa</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">szerszen</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">koton</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">dupa</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">dupa</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Czas</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Pogoda</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Praca</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Szkoła</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Sport</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Zdrowie</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Jedzenie</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Dom</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Rodzina</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Miasto</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Podróżowanie</a>
                        <a href="fiszki.php" class="kategorie-fiszek__item">Kultura</a>
                    </div>
                </div>

                <div class="kategorie-quizow">
                    <div class="kategorie-quizow__wrapper">
                        <a href="quizy.php" class="kategorie-fiszek__item">Podstawowe zwroty</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Kolory</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Liczby</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Zwierzęta</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Owoce</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Warzywa</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Czas</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Pogoda</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Praca</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Szkoła</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Sport</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Zdrowie</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Jedzenie</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Dom</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Rodzina</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Miasto</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Podróżowanie</a>
                        <a href="quizy.php" class="kategorie-fiszek__item">Kultura</a>
                    </div>
                </div>

            </div>
            

        </div>
    </header>

    <script>
        function redirectToRegister() {
            window.location.href = "register.php";
        }
    </script>
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