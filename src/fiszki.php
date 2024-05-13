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

// Pobierz losowe słowo z bazy danych
$query = "SELECT word, translation_english FROM words ORDER BY RAND() LIMIT 1";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $word = $row['word'];
    $translation_english = $row['translation_english'];
} else {
    $word = "Brak słów w bazie danych";
    $translation_english = "";
}

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz losowe słowo z bazy danych
    $query = "SELECT word, translation_english FROM words ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $word = $row['word'];
        $translation_english = $row['translation_english'];
    } else {
        $word = "Brak słów w bazie danych";
        $translation_english = "";
    }

    // Sprawdź, czy została przesłana poprawna odpowiedź
    if (isset($_POST['translation_english'])) {
        // Pobierz poprawną odpowiedź z bazy danych
        $query = "SELECT translation_english FROM words WHERE word = '$word'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $correct_translation = $row['translation_english'];

            // Sprawdź czy odpowiedź jest poprawna
            $user_translation = $_POST['translation_english'];
            if ($user_translation == $correct_translation) {
                $_SESSION['correct_answers']++;
            } else {
                $_SESSION['wrong_answers']++;
            }
        }
    }
    // Sprawdź, czy przycisk "Zagraj ponownie" został kliknięty
    if (isset($_POST['reset']) && $_POST['reset'] == 'true') {
        // Zresetuj odpowiedzi, wynik procentowy
        $_SESSION['correct_answers'] = 0;
        $_SESSION['wrong_answers'] = 0;
    }
}

// Wyświetl wynik poprawnych i błędnych odpowiedzi
function displayResult() {
    if (isset($_SESSION['correct_answers']) && isset($_SESSION['wrong_answers'])) {
        $correct_answers = $_SESSION['correct_answers'];
        $wrong_answers = $_SESSION['wrong_answers'];
        $total_answers = $correct_answers + $wrong_answers;
        if ($total_answers > 0) {
            $percentage_correct = ($correct_answers / $total_answers) * 100;
            echo "<p>Liczba poprawnych odpowiedzi: $correct_answers</p>";
            echo "<p>Liczba błędnych odpowiedzi: $wrong_answers</p>";
            echo "<p>Wynik procentowy: " . number_format($percentage_correct, 2) . "%</p>";
        }
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
    <title>Strona Główna</title>
    <script type="module" src="main.js" defer></script>
    <link rel="stylesheet" href="dist/prod.css">
    <script>
    function checkTranslation() {
        var translation = document.getElementById("translation_english").value;
        var word = document.getElementById("word").value; // Pobierz wartość słowa z ukrytego pola

        console.log("Translation:", translation);
        console.log("Word:", word); // Dodajemy console.log aby sprawdzić, czy wartości są prawidłowo pobierane

        var formData = new FormData();
        formData.append('translation_english', translation);
        formData.append('word', word);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_translation.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.querySelector('.result').innerHTML = xhr.responseText;
            } else {
                console.error('Wystąpił błąd: ' + xhr.statusText);
            }
        };
        xhr.send(formData);
    }
</script>

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
            <h1>Tłumaczenie słowa</h1>
            <p>Tłumacz słowo: "<?php echo $word; ?>"</p>
            <form id="translationForm" method="post">
    <input type="hidden" id="word" name="word" value="<?php echo $word; ?>">
    <label for="translation_english">Twoje tłumaczenie:</label>
    <input type="text" id="translation_english" name="translation_english" required>
    <button type="button" onclick="checkTranslation()">Sprawdź</button> <!-- Zmiana na type="button" -->
</form>

        </div>
    </header>

    <!-- Wyświetl wynik -->
    <div class="result">
        <?php include 'result.php'; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="reset" value="true">
            <button type="submit">Zagraj ponownie</button>
        </form>
        <form action="show_mistakes.php" method="post">
            <button type="submit">Pokaż błędne odpowiedzi</button>
        </form>
        <form action="niemiecki.php">
            <button type="submit">Wybierz inną kategorię fiszek</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>
