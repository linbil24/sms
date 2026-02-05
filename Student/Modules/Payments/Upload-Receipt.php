<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Receipt</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #64748b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
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
            overflow-x: hidden;
        }

        .content-area {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .upload-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }

        .info-card {
            background: #1e293b;
            color: white;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .info-card h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 15px;
        }

        .bank-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
        }

        .bank-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            font-size: 1.2rem;
        }

        .bank-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .bank-text h4 {
            margin: 0;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: #f8fafc;
        }

        .upload-area input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .submit-btn {
            background: var(--primary);
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>
    <?php include '../../Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include '../../Components/Header.php'; ?>
        <div class="content-area">
            <h1 class="page-title">Upload Receipt</h1>
            <p style="color: #64748b; margin-bottom: 30px;">Please upload proof of payment for outstanding balances.</p>

            <div class="upload-container">
                <div class="info-card">
                    <h3>Bank Details</h3>

                    <div class="bank-item">
                        <div class="bank-icon"><i class="fas fa-university"></i></div>
                        <div class="bank-text">
                            <p>BDO Unibank</p>
                            <h4>0012-3456-7890</h4>
                        </div>
                    </div>

                    <div class="bank-item">
                        <div class="bank-icon"><i class="fas fa-mobile-alt"></i></div>
                        <div class="bank-text">
                            <p>GCash</p>
                            <h4>0917-123-4567</h4>
                        </div>
                    </div>

                    <div class="bank-item">
                        <div class="bank-icon"><i class="fas fa-money-bill-wave"></i></div>
                        <div class="bank-text">
                            <p>Landbank</p>
                            <h4>1234-5678-9012</h4>
                        </div>
                    </div>

                    <div style="margin-top: 30px; font-size: 0.85rem; opacity: 0.7;">
                        Note: Please ensure the account number is correct before transferring. Keep your receipt for
                        verification purposes.
                    </div>
                </div>

                <div class="form-card">
                    <form action="History.php" method="POST">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" class="form-input" placeholder="0.00" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Payment Date</label>
                                <input type="date" class="form-input" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Reference Number</label>
                            <input type="text" class="form-input" placeholder="Enter Transaction ID / Ref No." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" required>
                                <option value="">Select Channel</option>
                                <option>Online Banking</option>
                                <option>Over-the-Counter</option>
                                <option>E-Wallet (GCash/Maya)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Proof of Payment</label>
                            <div class="upload-area">
                                <i class="fas fa-cloud-upload-alt"
                                    style="font-size: 2rem; color: #cbd5e1; margin-bottom: 10px;"></i>
                                <p style="color: #64748b; font-size: 0.9rem;">Drag & drop or Click to Upload</p>
                                <input type="file" accept="image/*,.pdf" required>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Submit Payment</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>