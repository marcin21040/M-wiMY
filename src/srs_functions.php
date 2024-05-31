<?php
require_once('connection.php');

function updateSRS($userId, $wordId, $grade) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM srs_words WHERE user_id = ? AND word_id = ?");
    $stmt->bind_param("ii", $userId, $wordId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $repetitions = $row['repetitions'];
        $interval = $row['review_interval'];
        $ease = $row['ease'];

        if ($grade >= 3) {
            $repetitions += 1;
            $interval = ($interval * $ease);
            $ease += 0.1 - (5 - $grade) * (0.08 + (5 - $grade) * 0.02);
        } else {
            $repetitions = 0;
            $interval = 1;
            $ease -= 0.1;
        }

        if ($ease < 1.3) {
            $ease = 1.3;
        }

        $nextReview = date('Y-m-d', strtotime("+$interval days"));

        $stmt = $conn->prepare("UPDATE srs_words SET next_review = ?, repetitions = ?, review_interval = ?, ease = ? WHERE user_id = ? AND word_id = ?");
        $stmt->bind_param("siidii", $nextReview, $repetitions, $interval, $ease, $userId, $wordId);
        $stmt->execute();
    }

    $stmt->close();
}

function getWordsForReview($userId) {
    global $conn;

    $today = date('Y-m-d');
    $stmt = $conn->prepare(
        "SELECT w.id, w.word, w.translation_pl, w.translation_de, w.translation_en, w.translation_es, w.translation_fr
        FROM words w
        JOIN srs_words s ON w.id = s.word_id
        WHERE s.user_id = ? AND s.next_review <= ?"
    );
    $stmt->bind_param("is", $userId, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $words = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $words;
}

function getWordsDueForReview($userId) {
    global $conn;

    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    $stmt = $conn->prepare(
        "SELECT w.id, w.word, w.translation_pl, w.translation_de, w.translation_en, w.translation_es, w.translation_fr, s.next_review, s.repetitions, s.review_interval, s.ease 
        FROM words w
        JOIN srs_words s ON w.id = s.word_id
        WHERE s.user_id = ? AND s.next_review >= ? AND s.next_review <= ?"
    );
    $stmt->bind_param("iss", $userId, $today, $tomorrow);
    $stmt->execute();
    $result = $stmt->get_result();
    $words = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $words;
}

function countWordsForReview($userId) {
    global $conn;

    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    
    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS count 
        FROM srs_words 
        WHERE user_id = ? AND next_review >= ? AND next_review <= ?"
    );
    $stmt->bind_param("iss", $userId, $today, $tomorrow);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count;
}

