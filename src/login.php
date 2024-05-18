<?php
session_start();
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzenie, czy dane zostały przesłane
    if (isset($_POST['login']) && isset($_POST['Haslo'])) {
        // Odbierz dane z formularza
        $login = $_POST['login'];
        $Haslo = $_POST['Haslo'];

        // Zabezpieczenie przed SQL Injection
        $login = mysqli_real_escape_string($conn, $login);
        $Haslo = mysqli_real_escape_string($conn, $Haslo);

        // Zapytanie SQL do sprawdzenia poprawności logowania
        $query = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Sprawdź, czy użytkownik istnieje w bazie danych
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Sprawdź, czy hasło jest poprawne
                if (password_verify($Haslo, $row['Haslo'])) { // Sprawdzenie hasła z hashowaniem
                    $_SESSION['login'] = $login;
                    $_SESSION['user_id'] = $row['id']; // Ustawienie user_id w sesji

                    // Sprawdź, czy użytkownik jest administratorem
                    if ($row['is_admin']) {
                        header("Location: admin.php");
                    } else {
                        header("Location: zalogowany.php");
                    }
                    exit();
                } else {
                    echo "Niepoprawne hasło!";
                }
            } else {
                echo "Użytkownik o podanym loginie nie istnieje!";
            }
        } else {
            echo "Błąd zapytania: " . mysqli_error($conn);
        }
    } else {
        // Nie wszystkie pola zostały przesłane
        echo "Wszystkie pola są wymagane!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="dist/prod.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Strona Główna</title>
    <script type="module" src="main.js" defer></script>
</head>
<body>
    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="" class="mainNav__link">Zacznij naukę</a>
            <a href="" class="mainNav__link">O nas</a>
            <a href="" class="mainNav__link">Kontakt</a>
            <?php
            // Sprawdź, czy użytkownik jest zalogowany
            if (isset($_SESSION['login'])) {
                // Jeśli zalogowany, wyświetl link do wylogowania
                echo '<a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>';
            } else {
                // Jeśli niezalogowany, wyświetl link do logowania
                echo '<a href="login.php" class="mainNav__link">Zaloguj się</a>';
            }
            ?>
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
            <div class="login-form">
                <h2>Zaloguj się</h2>
                <form action="login.php" method="post">
                    <input type="text" name="login" placeholder="Login" required />
                    <input type="password" name="Haslo" placeholder="Hasło" required />
                    <button type="submit">Zaloguj się</button>
                </form>
            </div>
        </div>
    </header>

    <script>
        function redirectToRegister() {
            window.location.href = "register.php";
        }
    </script>

    <script src="script.js"></script>
</body>
</html>
