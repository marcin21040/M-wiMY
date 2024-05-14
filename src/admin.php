<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    // Jeśli niezalogowany, przekieruj go do strony logowania
    header("Location: login.php");
    exit();
}

// Pobierz kategorie z bazy danych
$categories = [];
$result = mysqli_query($conn, "SELECT id, name FROM categories");
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź, czy wszystkie wymagane pola zostały wypełnione
    if (!empty($_POST['word']) && !empty($_POST['translation_pl']) && !empty($_POST['translation_de']) && 
        !empty($_POST['translation_en']) && !empty($_POST['translation_es']) && !empty($_POST['translation_fr']) &&
        !empty($_POST['category_id'])) {

        // Pobierz dane z formularza
        $word = $_POST['word'];
        $translation_pl = $_POST['translation_pl'];
        $translation_de = $_POST['translation_de'];
        $translation_en = $_POST['translation_en'];
        $translation_es = $_POST['translation_es'];
        $translation_fr = $_POST['translation_fr'];
        $category_id = $_POST['category_id'];

        // Sprawdź, czy słowo już istnieje
        $query = "SELECT id FROM words WHERE word = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $word);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Słówko już istnieje w bazie danych.";
        } else {
            // Dodaj nowe słówko do tabeli words
            $query = "INSERT INTO words (word, translation_pl, translation_de, translation_en, translation_es, translation_fr) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $word, $translation_pl, $translation_de, $translation_en, $translation_es, $translation_fr);

            if ($stmt->execute()) {
                $word_id = $stmt->insert_id;
                
                // Przypisz słowo do wybranej kategorii
                $query = "INSERT INTO word_categories (word_id, category_id) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $word_id, $category_id);
                
                if ($stmt->execute()) {
                    echo "Słówko zostało dodane pomyślnie.";
                } else {
                    echo "Wystąpił błąd podczas przypisywania słówka do kategorii: " . $stmt->error;
                }
            } else {
                echo "Wystąpił błąd podczas dodawania słówka: " . $stmt->error;
            }
        }
    } else {
        echo "Wypełnij wszystkie pola formularza.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Panel Administratora</title>
</head>
<body>
    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>
        </div>
    </nav>

    <header class="mainHeading">
        <div class="mainHeading__content">
            <h1>Dodaj nowe słówko</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="word">Słowo:</label>
                <input type="text" id="word" name="word" required><br><br>
                <label for="translation_pl">Tłumaczenie (PL):</label>
                <input type="text" id="translation_pl" name="translation_pl" required><br><br>
                <label for="translation_de">Tłumaczenie (DE):</label>
                <input type="text" id="translation_de" name="translation_de" required><br><br>
                <label for="translation_en">Tłumaczenie (EN):</label>
                <input type="text" id="translation_en" name="translation_en" required><br><br>
                <label for="translation_es">Tłumaczenie (ES):</label>
                <input type="text" id="translation_es" name="translation_es" required><br><br>
                <label for="translation_fr">Tłumaczenie (FR):</label>
                <input type="text" id="translation_fr" name="translation_fr" required><br><br>
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <button type="submit">Dodaj słówko</button>
            </form>
        </div>
    </header>
</body>
</html>
