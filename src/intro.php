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
    
</head>

<body>


    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="login.php" class="mainNav__link">Zaloguj się</a>
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
            <article class="mainHeading__text">
                <p class="mainHeading__preTitle">Mówimy</p>
                <h2 class="mainHeading__title">Naucz się języków</h2>
                <p class="mainHeading__description">
                    Zacznij naukę języków obcych z nami. Znajdziesz tutaj kursy dla każdego poziomu zaawansowania.
                </p>
                <button class="cta" onclick="redirectToRegister()">Załóż konto</button>
            </article>

            <figure class="mainHeading__image">
                <img src="https://images.unsplash.com/photo-1535295972055-1c762f4483e5?q=80&w=2187&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" />
            </figure>
        </div>
    </header>

    <script>
        function redirectToRegister() {
            window.location.href = "register.php";
        }
    </script>

    <div class="language_wrapper intro">
        <a class="language" href="">
            <img src="dist/images/germany-flag.png">
            <p>Niemiecki</p>
        </a>
        <a class="language">
            <img src="dist/images/uk-flag.png">
            <p>Angielski</p>
        </a>
        <div class="language">
            <img src="dist/images/spain-flag.png">
            <p>Hiszpański</p>
        </div>
        <div class="language">
            <img src="dist/images/france-flag.jpg">
            <p>Francuski</p>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>