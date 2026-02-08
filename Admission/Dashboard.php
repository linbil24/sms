<?php
session_start();
require_once '../auth/Security.php';
checkRole(['admission']);
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Dashboard - SMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1648bc;
            --bg-light: #f7fafc;
            --text-dark: #2d3748;
            --text-gray: #718096;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-light);
            display: flex;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .content-area {
            padding: 30px;
            flex: 1;
        }

        .banner {
            background: linear-gradient(135deg, #1648bc 0%, #3b82f6 50%, #06b6d4 100%);
            padding: 40px;
            border-radius: 20px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(22, 72, 188, 0.2);
        }

        .banner h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .banner p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            border-left: 5px solid #1648bc;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
        }

        .stat-info span {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .stat-info h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-top: 5px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            background: #eef2ff;
            color: #1648bc;
        }
    </style>
</head>

<body>
    <?php include 'Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include 'Components/header.php'; ?>
        <div class="content-area">
            <div class="banner">
                <h1>Welcome Back, Admission!</h1>
                <p>You have 24 new applications to review today. Keep up the great work!</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>New Applications</span>
                        <h2>128</h2>
                    </div>
                    <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Pending Evaluation</span>
                        <h2>45</h2>
                    </div>
                    <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Total Enrolled</span>
                        <h2>1,240</h2>
                    </div>
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                </div>
            </div>
        </div>
        </div>
</body>

</html>