<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'cashier') {
    header("Location: ../../auth/log-reg.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Receipts - Cashier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1648bc;
            --bg: #f8fafc;
            --text-dark: #1e293b;
            --text-gray: #64748b;
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
        }

        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-box h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            color: var(--text-gray);
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 2px solid #f1f5f9;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
        }

        .btn-view {
            padding: 8px 16px;
            border-radius: 10px;
            border: none;
            background: #eef2ff;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-view:hover {
            background: var(--primary);
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5vh auto;
            width: 90%;
            max-width: 800px;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: modalSlide 0.3s ease-out;
        }

        @keyframes modalSlide {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 25px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .receipt-preview {
            background: #f1f5f9;
            border-radius: 15px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #cbd5e1;
        }

        .receipt-preview i {
            font-size: 3rem;
            color: #94a3b8;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-group label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-gray);
            margin-bottom: 5px;
        }

        .info-group p {
            font-weight: 700;
            color: var(--text-dark);
        }

        .modal-footer {
            padding: 20px;
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-approve {
            background: #10b981;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include '../Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include '../Components/header.php'; ?>
        <div class="content-area">
            <div class="header-box">
                <h1>Uploaded Receipts</h1>
                <p style="color: var(--text-gray);">Verify online payment submissions from students.</p>
            </div>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Reference No.</th>
                            <th>Amount</th>
                            <th>Date Uploaded</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="https://ui-avatars.com/api/?name=Mark+Lee&background=1648bc&color=fff"
                                        style="width: 36px; height: 36px; border-radius: 10px;">
                                    <div>
                                        <p style="font-weight: 700;">Mark Lee</p>
                                        <p style="font-size: 0.75rem; color: var(--text-gray);">2024-1002</p>
                                    </div>
                                </div>
                            </td>
                            <td style="font-family: monospace; font-weight: 600;">REF-9921004</td>
                            <td style="font-weight: 700; color: var(--primary);">₱12,500.00</td>
                            <td>Jan 11, 2024</td>
                            <td><button class="btn-view"
                                    onclick="openVerifyModal('Mark Lee', 'REF-9921004', '₱12,500.00', 'GCash')">Verify
                                    Payment</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div id="verifyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="font-weight: 800;">Verify Transaction</h2>
                <i class="fas fa-times" style="cursor: pointer; color: var(--text-gray);"
                    onclick="closeVerifyModal()"></i>
            </div>
            <div class="modal-body">
                <div class="receipt-preview">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <p style="position: absolute; margin-top: 60px; color: #94a3b8; font-weight: 500;">Proof of Payment
                        Preview</p>
                </div>
                <div>
                    <div class="info-group">
                        <label>Student Name</label>
                        <p id="modalName">Mark Lee</p>
                    </div>
                    <div class="info-group">
                        <label>Reference Number</label>
                        <p id="modalRef">REF-9921004</p>
                    </div>
                    <div class="info-group">
                        <label>Amount Submitted</label>
                        <p id="modalAmount">₱12,500.00</p>
                    </div>
                    <div class="info-group">
                        <label>Payment Method</label>
                        <p id="modalMethod">GCash</p>
                    </div>

                    <div style="margin-top: 20px;">
                        <label
                            style="display: block; font-size: 0.8rem; color: var(--text-gray); margin-bottom: 10px;">Internal
                            Note</label>
                        <textarea
                            style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #e2e8f0; height: 80px; outline: none; font-family: inherit;"
                            placeholder="Add remarks..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-reject" onclick="closeVerifyModal()">Reject Payment</button>
                <button class="btn-approve" onclick="closeVerifyModal()">Approve & Post</button>
            </div>
        </div>
    </div>

    <script>
        function openVerifyModal(name, ref, amount, method) {
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalRef').textContent = ref;
            document.getElementById('modalAmount').textContent = amount;
            document.getElementById('modalMethod').textContent = method;
            document.getElementById('verifyModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeVerifyModal() {
            document.getElementById('verifyModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('verifyModal')) {
                closeVerifyModal();
            }
        }
    </script>
</body>

</html>