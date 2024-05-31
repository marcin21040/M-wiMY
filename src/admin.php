<?php
session_start();
require_once('connection.php');

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$categories = [];
$result = mysqli_query($conn, "SELECT id, name FROM categories");
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

$selected_category = isset($_GET['category_id']) ? $_GET['category_id'] : null;

$words = [];
if ($selected_category) {
    $stmt = $conn->prepare("SELECT w.id, w.word, w.translation_pl, w.translation_de, w.translation_en, w.translation_es, w.translation_fr FROM words w
                            JOIN word_categories wc ON w.id = wc.word_id WHERE wc.category_id = ?");
    $stmt->bind_param("i", $selected_category);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
        $words[] = $row;
    }
} else {
    $result = mysqli_query($conn, "SELECT * FROM words");
    while ($row = mysqli_fetch_assoc($result)) {
        $words[] = $row;
    }
}

$users = [];
$result = mysqli_query($conn, "SELECT id, login, email, is_admin FROM users");
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_word'])) {
    if (!empty($_POST['word']) && !empty($_POST['translation_pl']) && !empty($_POST['translation_de']) && 
        !empty($_POST['translation_en']) && !empty($_POST['translation_es']) && !empty($_POST['translation_fr']) &&
        !empty($_POST['category_id'])) {

        $word = $_POST['word'];
        $translation_pl = $_POST['translation_pl'];
        $translation_de = $_POST['translation_de'];
        $translation_en = $_POST['translation_en'];
        $translation_es = $_POST['translation_es'];
        $translation_fr = $_POST['translation_fr'];
        $category_id = $_POST['category_id'];

        $query = "SELECT id FROM words WHERE word = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $word);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Słówko już istnieje w bazie danych.";
        } else {
            $query = "INSERT INTO words (word, translation_pl, translation_de, translation_en, translation_es, translation_fr) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $word, $translation_pl, $translation_de, $translation_en, $translation_es, $translation_fr);

            if ($stmt->execute()) {
                $word_id = $stmt->insert_id;
                
                $query = "INSERT INTO word_categories (word_id, category_id) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $word_id, $category_id);
                
                if ($stmt->execute()) {
                    echo "Słówko zostało dodane pomyślnie.";
                    // Odśwież stronę po dodaniu słowa
                    header("Location: admin.php");
                    exit();
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_word'])) {
    $word_id = $_POST['word_id'];
    $query = "DELETE FROM words WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $word_id);
    if ($stmt->execute()) {
        echo "Słówko zostało usunięte pomyślnie.";
        header("Location: admin.php");
        exit();
    } else {
        echo "Wystąpił błąd podczas usuwania słówka: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "Użytkownik został usunięty pomyślnie.";
        // Odśwież stronę po usunięciu użytkownika
        header("Location: admin.php");
        exit();
    } else {
        echo "Wystąpił błąd podczas usuwania użytkownika: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['make_admin'])) {
    $user_id = $_POST['user_id'];
    $query = "UPDATE users SET is_admin = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "Użytkownik został mianowany administratorem.";
        header("Location: admin.php");
        exit();
    } else {
        echo "Wystąpił błąd podczas mianowania użytkownika administratorem: " . $stmt->error;
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
    <link rel="stylesheet" href="dist/prod.css">
</head>
<body>
    <nav class="mainNav">
        <div class="mainNav__logo"><a href="intro.php">MówiMY</a></div>
        <div class="mainNav__links">
            <a href="wyloguj.php" class="mainNav__link">Wyloguj się</a>
        </div>
    </nav>

    <div class="admin-wrapper">

        <div class="top-wrapper">
        <header class="mainHeading admin-panel">
        <div class="mainHeading__content">
            <h1>Dodaj nowe słówko</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="add_word" value="1">
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

    <div class="users-list admin-panel">
        <h2>Lista użytkowników</h2>
        <table>
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['login']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['is_admin'] ? 'Tak' : 'Nie'; ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete_user">Usuń</button>
                                <?php if (!$user['is_admin']): ?>
                                    <button type="submit" name="make_admin">Nadaj uprawnienia admina</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        </div>

    

    <div class="words-list admin-panel">
        <h2>Lista słów</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="category_filter">Filtruj według kategorii:</label>
            <select id="category_filter" name="category_id">
                <option value="">Wszystkie</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if ($selected_category == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filtruj</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Słowo</th>
                    <th>PL</th>
                    <th>DE</th>
                    <th>EN</th>
                    <th>ES</th>
                    <th>FR</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($words as $word): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($word['word']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_pl']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_de']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_en']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_es']); ?></td>
                        <td><?php echo htmlspecialchars($word['translation_fr']); ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="word_id" value="<?php echo $word['id']; ?>">
                                <button type="submit" name="delete_word">Usuń</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    
    </div>
</body>
</html>
