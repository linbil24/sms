<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: ../../Auth/log-reg.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Dashboard - Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1648bc;
            --bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            padding: 40px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <?php include '../Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include '../Components/header.php'; ?>
        <div class="content-area">
            <h1 style="font-weight: 800; margin-bottom: 30px;">Admission Dashboard</h1>
            <div class="grid">
                <div class="card">
                    <h3>Total Applicants</h3>
                    <h2 style="color: var(--primary); font-size: 2.5rem;">2,450</h2>
                </div>
                <div class="card">
                    <h3>Approved This Month</h3>
                    <h2 style="color: #10b981; font-size: 2.5rem;">890</h2>
                </div>
                <div class="card">
                    <h3>Pending Evaluation</h3>
                    <h2 style="color: #f59e0b; font-size: 2.5rem;">125</h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>