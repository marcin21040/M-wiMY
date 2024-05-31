<?php
session_start();
require_once('connection.php');
require_once('srs_functions.php');

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;
$incorrectIdsSerialized = isset($_GET['incorrect_ids']) ? $_GET['incorrect_ids'] : null;

if ($categoryId === null || $categoryId <= 0) {
    die("Nieprawidłowy category_id.");
}

$incorrectIds = unserialize(urldecode($incorrectIdsSerialized));

$language = $_SESSION['language'] ?? '';

$translationColumn = '';
switch ($language) {
    case 'angielski':
        $translationColumn = 'translation_en';
        break;
    case 'niemiecki':
        $translationColumn = 'translation_de';
        break;
    case 'hiszpanski':
        $translationColumn = 'translation_es';
        break;
    case 'francuski':
        $translationColumn = 'translation_fr';
        break;
    default:
        die("Nieznany język.");
}

$correctAnswers = $_SESSION['correct_answers'] ?? 0;
$wrongAnswers = $_SESSION['wrong_answers'] ?? 0;
$percentage = ($correctAnswers / ($correctAnswers + $wrongAnswers)) * 100;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="dist/prod.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki Quizu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        select {
            padding: 5px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        form {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1>Wyniki Quizu</h1>
    <p>Liczba poprawnych odpowiedzi: <?php echo $correctAnswers; ?></p>
    <p>Liczba błędnych odpowiedzi: <?php echo $wrongAnswers; ?></p>
    <p>Wynik procentowy: <?php echo number_format($percentage, 2); ?>%</p>

    <?php if (!empty($incorrectIds)): ?>
        <h2>Błędy</h2>
        <form method='post' action='submit_evaluation.php'>
            <table>
                <tr><th>Słowo</th><th>Poprawna odpowiedź</th><th>Twoja odpowiedź</th><th>Ocena</th></tr>
                <?php
                $placeholders = implode(',', array_fill(0, count($incorrectIds), '?'));
                $types = str_repeat('i', count($incorrectIds));
                $stmt = $conn->prepare("SELECT id, word, $translationColumn as correct FROM words WHERE id IN ($placeholders)");
                $stmt->bind_param($types, ...$incorrectIds);
                $stmt->execute();
                $result = $stmt->get_result();
                $incorrectWords = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                foreach ($incorrectWords as $word):
                    $wordId = $word['id'];
                    $wordText = $word['word'];
                    $correctAnswer = $word['correct'];
                    $userAnswer = $_SESSION['user_answers'][$wordId] ?? 'N/A';
                ?>
                    <tr>
                        <td><?php echo $wordText; ?></td>
                        <td><?php echo $correctAnswer; ?></td>
                        <td><?php echo $userAnswer; ?></td>
                        <td>
                            <select name='grades[<?php echo $wordId; ?>]'>
                                <option value='5'>5 - Bardzo łatwe</option>
                                <option value='4'>4 - Łatwe</option>
                                <option value='3'>3 - Średnie</option>
                                <option value='2'>2 - Trudne</option>
                                <option value='1'>1 - Bardzo trudne</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type='hidden' name='category_id' value='<?php echo $categoryId; ?>'>
            <input type='hidden' name='type' value='<?php echo $type; ?>'>
            <button type='submit'>Zapisz oceny</button>
        </form>
    <?php endif; ?>

    <br><a href="zalogowany.php" class="btn">Powrót</a>
</body>
</html>
