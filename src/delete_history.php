<?php
session_start();
require_once('connection.php');


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $userId = $_SESSION['user_id'];


    $stmt = $conn->prepare("DELETE FROM user_history WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $stmt->execute();
    $stmt->close();
}


header("Location: user_history.php");
exit();

