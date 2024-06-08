<?php
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzenie, czy dane zostały przesłane
    if (isset($_POST['login']) && isset($_POST['Haslo']) && isset($_POST['email'])) {
        // Odbierz dane z formularza
        $login = $_POST['login'];
        $Haslo = $_POST['Haslo']; // Poprawna nazwa zmiennej dla hasła
        $email = $_POST['email'];

        // Zabezpieczenie przed SQL Injection
        $login = mysqli_real_escape_string($conn, $login);
        $Haslo = mysqli_real_escape_string($conn, $Haslo); // Poprawna nazwa zmiennej dla hasła
        $email = mysqli_real_escape_string($conn, $email);

        // Hashowanie hasła
        $hashedPassword = password_hash($Haslo, PASSWORD_BCRYPT);

        // Zapytanie SQL do dodania użytkownika
        $query = "INSERT INTO users (login, Haslo, email) VALUES ('$login', '$hashedPassword', '$email')";

        // Wykonanie zapytania
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Użytkownik dodany pomyślnie, możesz przekierować gdziekolwiek chcesz
            header("Location: login.php");
            exit();
        } else {
            // Błąd dodawania użytkownika
            echo "Błąd podczas rejestracji użytkownika: " . mysqli_error($conn);
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
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="dist/prod.css">
  <title>Strona Główna</title>
  <script type="module" src="main.js" defer></script>
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
                <rect
                   width="24"
                   height="24"
                   transform="rotate(180 12 12)"
                   opacity="0"
                />
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
        <div class="registration-form">
            <h2>Rejestracja</h2>
            <form action="register.php" method="post">
                <input type="text" name="login" placeholder="Login" required />
                <input type="password" name="Haslo" placeholder="Hasło" required />
                <input type="email" name="email" placeholder="Email" required />
                <button type="submit">Zarejestruj się</button>
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
