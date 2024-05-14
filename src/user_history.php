<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id']; // Zakładam, że id użytkownika jest przechowywane w sesji

$query = "SELECT uh.id, c.name as category_name, uh.type, uh.correct_answers, uh.total_questions, uh.date, uh.language
          FROM user_history uh
          JOIN categories c ON uh.category_id = c.id
          WHERE uh.user_id = ?
          ORDER BY uh.date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$history = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Historia użytkownika</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Dodanie biblioteki Chart.js -->
    <style>
        .progress-bar-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 25px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-bar {
            height: 24px;
            background-color: #4caf50;
            text-align: center;
            color: white;
            line-height: 24px; /* Vertically center text */
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <div class="history">
        <h1>Historia użytkownika</h1>
        <?php if (!empty($history)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Kategoria</th>
                        <th>Typ</th>
                        <th>Język</th>
                        <th>Poprawne odpowiedzi</th>
                        <th>Całkowita liczba pytań</th>
                        <th>% Poprawnych odpowiedzi</th>
                        <th>Postęp</th>
                        <th>Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $entry): ?>
                        <?php
                            $percentage = round(($entry['correct_answers'] / $entry['total_questions']) * 100, 2);
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($entry['date']); ?></td>
                            <td><?php echo htmlspecialchars($entry['category_name']); ?></td>
                            <td><?php echo htmlspecialchars($entry['type']); ?></td>
                            <td><?php echo htmlspecialchars($entry['language']); ?></td>
                            <td><?php echo htmlspecialchars($entry['correct_answers']); ?></td>
                            <td><?php echo htmlspecialchars($entry['total_questions']); ?></td>
                            <td><?php echo $percentage; ?>%</td>
                            <td>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: <?php echo $percentage; ?>%">
                                        <?php echo $percentage; ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form method="post" action="delete_history.php">
                                    <input type="hidden" name="id" value="<?php echo $entry['id']; ?>">
                                    <button type="submit">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak danych do wyświetlenia.</p>
        <?php endif; ?>
    </div>

    <!-- Sekcja wykresów -->
    <div class="charts">
        <h2>Wykresy wyników</h2>
        <canvas id="historyChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('historyChart').getContext('2d');
        const historyData = <?php echo json_encode($history); ?>;

        // Grupowanie danych według języka i kategorii
        const groupedData = historyData.reduce((acc, entry) => {
            const date = entry.date.split(' ')[0]; // Usuwanie czasu z daty
            const key = `${entry.language} - ${entry.category_name}`;
            if (!acc[key]) {
                acc[key] = { dates: [], correctAnswers: [], totalQuestions: [] };
            }
            acc[key].dates.push(date);
            acc[key].correctAnswers.push(entry.correct_answers);
            acc[key].totalQuestions.push(entry.total_questions);
            return acc;
        }, {});

        // Kolory dla różnych kategorii
        const colors = [
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(123, 159, 241, 1)',
            'rgba(200, 200, 200, 1)',
            'rgba(100, 100, 100, 1)',
            'rgba(150, 150, 50, 1)'
        ];

        // Tworzenie zestawów danych
        const datasets = Object.keys(groupedData).map((key, index) => ({
            label: key,
            data: groupedData[key].correctAnswers.map((correct, i) => (correct / groupedData[key].totalQuestions[i] * 100).toFixed(2)),
            borderColor: colors[index % colors.length],
            borderWidth: 1,
            fill: false
        }));

        const labels = [...new Set(historyData.map(entry => entry.date.split(' ')[0]))]; // Unikalne daty

        const historyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return value + "%" }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
