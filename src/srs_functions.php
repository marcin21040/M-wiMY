<?php
require_once('connection.php');


function getWordsForReview($userId, $categoryId) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT w.id, w.word, w.translation_pl, w.translation_en, w.translation_de, w.translation_es, w.translation_fr, s.next_review, s.repetitions, s.review_interval, s.ease 
        FROM words w
        JOIN srs_words s ON w.id = s.word_id
        JOIN word_categories wc ON w.id = wc.word_id
        WHERE s.user_id = ? AND wc.category_id = ? AND s.next_review <= CURDATE()
    ");
    $stmt->bind_param("ii", $userId, $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $words = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $words;
}




// Funkcja do aktualizacji SRS po quizie
function updateSRS($userId, $wordId, $correct) {
    global $conn;

    // Pobierz bieżące dane SRS dla danego słowa
    $stmt = $conn->prepare("SELECT repetitions, review_interval, ease FROM srs_words WHERE user_id = ? AND word_id = ?");
    $stmt->bind_param("ii", $userId, $wordId);
    $stmt->execute();
    $stmt->bind_result($repetitions, $interval, $ease);
    $stmt->fetch();
    $stmt->close();

    // Debugowanie bieżących wartości
    error_log("Bieżące wartości dla user_id: $userId, word_id: $wordId - repetitions: $repetitions, interval: $interval, ease: $ease");

    // Aktualizuj dane SRS na podstawie wyniku odpowiedzi
    if ($correct == 5) { // Ocena 5 dla poprawnych odpowiedzi
        $repetitions++;
        if ($repetitions == 1) {
            $interval = 1;
        } elseif ($repetitions == 2) {
            $interval = 6;
        } else {
            $interval = round($interval * $ease); // Zaokrąglamy do najbliższego dnia
            $interval = min($interval, 3650); // Ograniczenie do maksymalnie 10 lat (3650 dni)
        }
        $ease = min(2.5, $ease + 0.1); // Zwiększ łatwość o 0.1 dla poprawnych odpowiedzi, ale nie więcej niż 2.5
    } else { // Ocena 1 dla niepoprawnych odpowiedzi
        $repetitions = 0;
        $interval = 1;
        $ease = max(1.3, $ease - 0.2); // Zmniejsz łatwość o 0.2 dla błędnych odpowiedzi, ale nie mniej niż 1.3
    }

    // Debugowanie obliczonych wartości
    error_log("Zaktualizowane wartości dla user_id: $userId, word_id: $wordId - repetitions: $repetitions, interval: $interval, ease: $ease");

    // Oblicz datę następnej powtórki
    $nextReview = date('Y-m-d', strtotime("+$interval days"));
    error_log("Obliczona data next_review: $nextReview");

    // Zaktualizuj rekord w tabeli srs_words
    $stmt = $conn->prepare("UPDATE srs_words SET repetitions = ?, review_interval = ?, ease = ?, next_review = ? WHERE user_id = ? AND word_id = ?");
    if (!$stmt) {
        error_log("Błąd przygotowania zapytania: " . $conn->error);
        die("Błąd przygotowania zapytania: " . $conn->error);
    }
    $stmt->bind_param("iisdii", $repetitions, $interval, $ease, $nextReview, $userId, $wordId);
    $stmt->execute();
    if ($stmt->error) {
        error_log("Błąd wykonania zapytania: " . $stmt->error);
        die("Błąd wykonania zapytania: " . $stmt->error);
    }
    // Debugowanie po wykonaniu zapytania
    if ($stmt->affected_rows > 0) {
        error_log("Zapytanie SQL wykonane pomyślnie.");
    } else {
        error_log("Zapytanie SQL nie wprowadziło zmian.");
    }
    $stmt->close();
}

// Funkcja do dodania nowego słowa do SRS
function addNewWordToSRS($userId, $wordId) {
    global $conn;

    $nextReview = date('Y-m-d', strtotime("+1 day"));

    $stmt = $conn->prepare("INSERT INTO srs_words (user_id, word_id, next_review, repetitions, review_interval, ease) VALUES (?, ?, ?, 0, 1, 2.5)");
    $stmt->bind_param("iis", $userId, $wordId, $nextReview);
    $stmt->execute();
    if ($stmt->error) {
        error_log("Błąd przy dodawaniu nowego słowa: " . $stmt->error);
    } else {
        error_log("Dodano nowe słowo: user_id=$userId, word_id=$wordId, next_review=$nextReview");
    }
    $stmt->close();
}
