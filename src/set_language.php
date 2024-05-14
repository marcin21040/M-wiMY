<?php
session_start();

// Sprawdź, czy parametr 'language' jest ustawiony w URL
if (isset($_GET['language'])) {
    $language = $_GET['language'];

    // Ustaw język w sesji
    $_SESSION['language'] = $language;

    // Przekierowanie do odpowiedniej strony językowej
    switch ($language) {
        case 'niemiecki':
            header("Location: niemiecki.php");
            break;
        case 'angielski':
            header("Location: angielski.php");
            break;
        case 'hiszpanski':
            header("Location: hiszpanski.php");
            break;
        case 'francuski':
            header("Location: francuski.php");
            break;
        default:
            header("Location: zalogowany.php");
            break;
    }
    exit();
} else {
    // Jeśli parametr 'language' nie jest ustawiony, przekieruj użytkownika z powrotem na stronę zalogowanego
    header("Location: zalogowany.php");
    exit();
}
?>
