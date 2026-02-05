<?php
session_start();
require_once '../../Database/config.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'superadmin')) {
    header("Location: ../../Auth/log-reg.php");
    exit();
}

// Fetch Payments
try {
    $stmt = $pdo->query("SELECT p.*, e.first_name, e.last_name, e.reference_code, e.email as student_email FROM payments p JOIN enrollments e ON p.enrollment_id = e.enrollmentId ORDER BY p.created_at DESC");
    $payments = $stmt->fetchAll();
} catch (PDOException $e) {
    $payments = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments & Fees - SMS</title>
    <link rel="icon" type="image/x-icon" href="../../Assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>
    <?php include '../Components/Side-bar.php'; ?>
    <div class="main-wrapper">
        <?php include '../Components/Head-bar.php'; ?>
        <div class="content-area">
            <div class="table-container">
                <div class="table-header">
                    <h2>Recent Payments</h2>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Student Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($payments) > 0): ?>
                                <?php foreach ($payments as $payment): ?>
                                    <tr>
                                        <td class="ref-code"><?php echo htmlspecialchars($payment->transaction_id); ?></td>
                                        <td class="student-name">
                                            <?php echo htmlspecialchars($payment->last_name . ", " . $payment->first_name); ?>
                                        </td>
                                        <td style="font-weight:700; color:#059669;">
                                            ₱<?php echo number_format($payment->amount, 2); ?></td>
                                        <td><?php echo htmlspecialchars($payment->payment_method); ?></td>
                                        <td>
                                            <span
                                                class="status-badge <?php echo ($payment->status == 'Completed') ? 'status-enrolled' : 'status-pending-payment'; ?>">
                                                <?php echo htmlspecialchars($payment->status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn-view"
                                                onclick='viewPayment(<?php echo json_encode($payment); ?>)'>Details</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:50px;">
                                        <div style="opacity:0.5; margin-bottom:10px;"><i class="fas fa-receipt fa-3x"></i>
                                        </div>
                                        <p style="color:var(--text-gray);">No payment transactions found.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Detail Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h2><i class="fas fa-receipt"></i> Transaction Details</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body" id="paymentData">
                <!-- Populated by JS -->
            </div>
            <div class="modal-footer">
                <button class="btn-approve" onclick="window.print()">Print Receipt</button>
                <button class="btn-reject" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        function viewPayment(data) {
            const modal = document.getElementById('paymentModal');
            const container = document.getElementById('paymentData');

            const date = new Date(data.created_at).toLocaleDateString('en-US', {
                year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'
            });

            container.innerHTML = `
                <div style="text-align: center; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px dashed #eee;">
                    <h1 style="color: var(--primary-blue); margin: 0;">₱${parseFloat(data.amount).toLocaleString(undefined, { minimumFractionDigits: 2 })}</h1>
                    <p style="color: #10b981; font-weight: 600; margin: 5px 0;">Payment ${data.status}</p>
                </div>
                <div style="display: grid; gap: 15px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #718096;">Transaction ID:</span>
                        <span style="font-weight: 600;">${data.transaction_id}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #718096;">Student:</span>
                        <span style="font-weight: 600;">${data.last_name}, ${data.first_name}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #718096;">Ref Code:</span>
                        <span style="font-weight: 600;">${data.reference_code}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #718096;">Payment Method:</span>
                        <span style="font-weight: 600;">${data.payment_method}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #718096;">Date/Time:</span>
                        <span style="font-weight: 600;">${date}</span>
                    </div>
                </div>
            `;
            modal.style.display = "block";
        }

        function closeModal() {
            document.getElementById('paymentModal').style.display = "none";
        }

        window.onclick = function (event) {
            const modal = document.getElementById('paymentModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>