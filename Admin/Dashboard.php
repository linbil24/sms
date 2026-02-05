<?php
session_start();

// Check if user is logged in
require_once '../auth/Security.php';
checkRole(['admin']);

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Enrollment System</title>
    <link rel="icon" type="image/x-icon" href="../Assets/image/logo.png">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/Dashboard.css">
</head>

<body>

    <!-- Sidebar -->
    <?php include 'Components/Side-bar.php'; ?>

    <div class="main-wrapper">
        <!-- Head-bar -->
        <?php include 'Components/Head-bar.php'; ?>

        <div class="content-area">

        </div>

</body>

</html>