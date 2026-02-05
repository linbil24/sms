<?php
session_start();
require_once '../Database/config.php';

if (isset($_SESSION['userId'])) {
    try {
        // Update status to offline
        $stmt = $pdo->prepare("UPDATE users SET status = 'offline' WHERE userId = ?");
        $stmt->execute([$_SESSION['userId']]);
    } catch (PDOException $e) {
        // Silently fail or log
    }
}

// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header("Location: Login.php");
exit();
?>