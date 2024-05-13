<?php
session_start();

// Sprawdź czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    // Jeśli niezalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}

// Jeśli użytkownik jest zalogowany, możemy wykonać inne operacje, np. pobieranie danych użytkownika z bazy danych itp.
require_once('connection.php');

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź, czy wszystkie pola formularza zostały wypełnione
    if (!empty($_POST['word']) && !empty($_POST['translation']) && !empty($_POST['language'])) {
        // Pobierz dane z formularza
        $word = $_POST['word'];
        $translation = $_POST['translation'];
        $language = $_POST['language'];

        // Dopasuj nazwę kolumny do wybranego języka
        switch ($language) {
            case "english":
                $column = "translation_english";
                break;
            case "germany":
                $column = "translation_germany";
                break;
            case "french":
                $column = "translation_french";
                break;
            case "spain":
                $column = "translation_spain";
                break;
            default:
                $column = ""; // Domyślnie, gdy wybrano niepoprawny język
        }

        if (!empty($column)) {
            // Dodaj nowe słówko do odpowiedniej kolumny
            $query = "INSERT INTO words (word, $column) VALUES ('$word', '$translation')";
            if (mysqli_query($conn, $query)) {
                echo "Słówko zostało dodane pomyślnie.";
            } else {
                echo "Wystąpił błąd podczas dodawania słówka: " . mysqli_error($conn);
            }
        } else {
            echo "Wybierz poprawny język.";
        }
    } else {
        echo "Wypełnij wszystkie pola formularza.";
    }
}
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
    <title>Panel Administratora</title>
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
            <h1>Dodaj nowe słówko</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="word">Słowo:</label>
                <input type="text" id="word" name="word" required><br><br>
                <label for="translation">Tłumaczenie:</label>
                <input type="text" id="translation" name="translation" required><br><br>
                <label for="language">Język tłumaczenia:</label>
                <select id="language" name="language">
                    <option value="english">Angielski</option>
                    <option value="germany">Niemiecki</option>
                    <option value="french">Francuski</option>
                    <option value="spain">Hiszpański</option>
                </select><br><br>
                <button type="submit">Dodaj słówko</button>
            </form>
        </div>
    </header>



    <script src="script.js"></script>
</body>

</html>
