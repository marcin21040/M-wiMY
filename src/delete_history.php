<?php
session_start();
require_once('connection.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Sprawdź, czy ID wpisu zostało przekazane
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $userId = $_SESSION['user_id'];

    // Usuń wpis tylko, jeśli należy do zalogowanego użytkownika
    $stmt = $conn->prepare("DELETE FROM user_history WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $stmt->execute();
    $stmt->close();
}

// Przekierowanie z powrotem do historii użytkownika
header("Location: user_history.php");
exit();
?>
