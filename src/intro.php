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
    <link rel="stylesheet" href="/dist/prod.css">
</head>

<body>
    <!-- <header class="header_wrapper">
    <a>
  	<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" fill="#fff" height="30" viewBox="0 0 24 24">
<path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 11 21 L 11 15 L 13 15 L 13 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z M 12 4.7910156 L 18 10.191406 L 18 11 L 18 19 L 15 19 L 15 13 L 9 13 L 9 19 L 6 19 L 6 10.191406 L 12 4.7910156 z"></path>
</svg>
    </a>
    <h1 class="header__logo">MówiMY</h1>
    <a>
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg>
    </a>
  </header>
  
  <div class="intro__wrapper">
    <div class="container">
        <img src="/images/translation_intro.webp" alt="">
        <div class="intro__text">
            <h1>Witaj na stronie MówiMY</h1>
            <p>Wybierz język, który chcesz poznać</p>
        </div>
    </div>
  </div> -->

    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="" class="mainNav__link">Zacznij naukę</a>
            <a href="" class="mainNav__link">O nas</a>
            <a href="" class="mainNav__link">Kontakt</a>
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
            <img src="/images/germany-flag.png">
            <p>Niemiecki</p>
        </a>
        <a class="language">
            <img src="/images/uk-flag.png">
            <p>Angielski</p>
        </a>
        <div class="language">
            <img src="/images/spain-flag.png">
            <p>Hiszpański</p>
        </div>
        <div class="language">
            <img src="/images/france-flag.jpg">
            <p>Francuzki</p>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>