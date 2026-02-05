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
    <title>Applications Manager - Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1648bc;
            --bg: #f8fafc;
            --text: #1e293b;
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

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .table-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 2px solid #f1f5f9;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-approved {
            background: #f0fdf4;
            color: #15803d;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-view {
            background: #eef2ff;
            color: var(--primary);
        }

        .btn-view:hover {
            background: var(--primary);
            color: white;
        }

        /* Modal Styles */
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
            max-width: 600px;
            border-radius: 24px;
            overflow: hidden;
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
            padding: 25px;
        }

        .modal-footer {
            padding: 20px;
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .detail-row:last-child {
            border: none;
        }

        .detail-label {
            color: #64748b;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 700;
            color: var(--text);
        }
    </style>
</head>

<body>
    <?php include '../Components/Sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include '../Components/header.php'; ?>
        <div class="content-area">
            <div class="module-header">
                <div>
                    <h1 style="font-weight: 800; color: #1e293b;">Applications Manager</h1>
                    <p style="color: #64748b;">Oversee and audit student admission applications.</p>
                </div>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Reference ID</th>
                            <th>Applied Course</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 40px; height: 40px; background: #eef2ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 800;">
                                        JD</div>
                                    <div>
                                        <p style="font-weight: 700;">John Doe</p>
                                        <p style="font-size: 0.75rem; color: #64748b;">john@sms.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>#APP-2024-001</td>
                            <td>BS Architecture</td>
                            <td><span class="status-badge status-pending">Pending Review</span></td>
                            <td><button class="btn-action btn-view"
                                    onclick="openModal('John Doe', '#APP-2024-001', 'BS Architecture', 'Pending Review')">Manage</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 40px; height: 40px; background: #eef2ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 800;">
                                        JS</div>
                                    <div>
                                        <p style="font-weight: 700;">Jane Smith</p>
                                        <p style="font-size: 0.75rem; color: #64748b;">jane@sms.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>#APP-2024-002</td>
                            <td>BS Computer Science</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td><button class="btn-action btn-view"
                                    onclick="openModal('Jane Smith', '#APP-2024-002', 'BS Computer Science', 'Approved')">Manage</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Application Action Modal -->
    <div id="actionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="font-weight: 800; color: #1e293b;">Application Review</h2>
                <i class="fas fa-times" style="cursor: pointer; color: #64748b;" onclick="closeModal()"></i>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value" id="valName"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Application ID</span>
                    <span class="detail-value" id="valId"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Target Course</span>
                    <span class="detail-value" id="valCourse"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Current Status</span>
                    <span class="detail-value" id="valStatus"></span>
                </div>

                <div style="margin-top: 30px;">
                    <label style="display: block; margin-bottom: 10px; font-weight: 600;">Super Admin Override</label>
                    <select
                        style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; outline: none; font-family: inherit;">
                        <option>Keep Current Status</option>
                        <option>Force Approve</option>
                        <option>Force Reject</option>
                        <option>Request Re-evaluation</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal()"
                    style="padding: 12px 24px; border-radius: 12px; border: 1px solid #e2e8f0; background: white; font-weight: 600; cursor: pointer;">Cancel</button>
                <button onclick="closeModal()"
                    style="padding: 12px 24px; border-radius: 12px; background: var(--primary); color: white; border: none; font-weight: 600; cursor: pointer;">Save
                    Changes</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(name, id, course, status) {
            document.getElementById('valName').textContent = name;
            document.getElementById('valId').textContent = id;
            document.getElementById('valCourse').textContent = course;
            document.getElementById('valStatus').textContent = status;
            document.getElementById('actionModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('actionModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('actionModal')) {
                closeModal();
            }
        }
    </script>
</body>

</html>