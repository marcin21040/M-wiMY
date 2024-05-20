<?php
session_start();
require_once('connection.php');

if (isset($_SESSION['session_id'])) {
    $sessionId = $_SESSION['session_id']; 


    $stmt = $conn->prepare("UPDATE user_sessions SET logout_time = NOW(), session_time = TIMESTAMPDIFF(SECOND, login_time, NOW()) WHERE id = ?");
    $stmt->bind_param("i", $sessionId);
    $stmt->execute();
    $stmt->close();
}


session_destroy();


header("Location: login.php");
exit();

