<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Balance</title>
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

        .balance-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 40px;
            border-radius: 24px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.1);
        }
        
        .balance-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .balance-label {
            font-size: 1rem;
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .balance-amount {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: baseline;
            gap: 10px;
        }
        
        .currency {
             font-size: 2rem;
             color: #94a3b8;
             font-weight: 500;
        }

        .pay-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }
        
        .pay-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .breakdown-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .fee-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .fee-label {
            color: #64748b;
        }
        
        .fee-val {
            font-weight: 600;
            color: #1e293b;
        }
        
        .fee-row.total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #e2e8f0;
            font-size: 1.1rem;
            font-weight: 700;
        }
        
        .fee-row.total .fee-val {
            color: var(--primary);
        }

    </style>
</head>

<body>
    <?php include '../../Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include '../../Components/Header.php'; ?>
        <div class="content-area">
            <h1 class="page-title">Financial Balance</h1>
            
            <div class="balance-card">
                <div class="balance-label">Outstanding Balance</div>
                <div class="balance-amount">
                    <span class="currency">₱</span>
                    13,200.00
                </div>
                <a href="Upload-Receipt.php" class="pay-btn">
                    Pay Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="breakdown-card">
                <h3 class="section-title">Fee Breakdown (2nd Semester 2026-2027)</h3>
                
                <div class="fee-row">
                    <span class="fee-label">Tuition Fee (21 Units)</span>
                    <span class="fee-val">₱10,500.00</span>
                </div>
                <div class="fee-row">
                    <span class="fee-label">Miscellaneous Fees</span>
                    <span class="fee-val">₱2,500.00</span>
                </div>
                 <div class="fee-row">
                    <span class="fee-label">Laboratory Fee</span>
                    <span class="fee-val">₱1,500.00</span>
                </div>
                 <div class="fee-row">
                    <span class="fee-label">Less: Downpayment</span>
                    <span class="fee-val" style="color: #ef4444;">- ₱4,000.00</span>
                </div>
                 <div class="fee-row">
                    <span class="fee-label">Less: Scholarship Discount (10%)</span>
                    <span class="fee-val" style="color: #ef4444;">- ₱1,300.00</span>
                </div>
                
                <div class="fee-row total">
                    <span class="fee-label">Total Outstanding</span>
                    <span class="fee-val">₱9,200.00</span>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
