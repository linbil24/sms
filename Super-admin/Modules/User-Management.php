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
    <title>User Management - Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1648bc;
            --bg-light: #f8fafc;
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
            padding: 40px;
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .module-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .btn-primary {
            background: var(--primary-blue);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(22, 72, 188, 0.2);
        }

        .table-card {
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
            padding: 15px 20px;
            background: #f8fafc;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 1px solid #edf2f7;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .status-pill {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-active {
            background: #ecfdf5;
            color: #10b981;
        }

        .status-inactive {
            background: #fee2e2;
            color: #ef4444;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--text-gray);
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-action:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
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
            max-width: 500px;
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
            padding: 25px 30px;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            outline: none;
            font-family: inherit;
        }

        .modal-footer {
            padding: 25px 30px;
            background: #f8fafc;
            border-top: 1px solid #edf2f7;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
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
                    <h1>User Management</h1>
                    <p style="color: var(--text-gray);">Manage system administrators and staff accounts.</p>
                </div>
                <button class="btn-primary" onclick="openUserModal()">
                    <i class="fas fa-plus"></i> Add New User
                </button>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>User Info</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=1648bc&color=fff"
                                        style="width: 40px; height: 40px; border-radius: 10px;">
                                    <div>
                                        <p style="font-weight: 700;">Admin User</p>
                                        <p style="font-size: 0.8rem; color: var(--text-gray);">admin@sms.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span style="font-weight: 600;">Super Admin</span></td>
                            <td><span class="status-pill status-active">Active</span></td>
                            <td>Jan 11, 2024</td>
                            <td>
                                <button class="btn-action" onclick="editUser('Admin User')"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn-action" style="color: #ef4444;"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <img src="https://ui-avatars.com/api/?name=Admission+Test&background=1648bc&color=fff"
                                        style="width: 40px; height: 40px; border-radius: 10px;">
                                    <div>
                                        <p style="font-weight: 700;">Sarah Miller</p>
                                        <p style="font-size: 0.8rem; color: var(--text-gray);">sarah.m@sms.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span style="font-weight: 600;">Admission</span></td>
                            <td><span class="status-pill status-active">Active</span></td>
                            <td>Jan 10, 2024</td>
                            <td>
                                <button class="btn-action" onclick="editUser('Sarah Miller')"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn-action" style="color: #ef4444;"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle" style="font-weight: 800; color: var(--text-dark);">Add New User</h2>
                <i class="fas fa-times" style="cursor: pointer; color: var(--text-gray);"
                    onclick="closeUserModal()"></i>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="e.g. John Doe">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="e.g. john@sms.com">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select>
                        <option>Super Admin</option>
                        <option>Admission</option>
                        <option>Cashier</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Initial Password</label>
                    <input type="password" placeholder="********">
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeUserModal()"
                    style="padding: 12px 24px; border-radius: 12px; border: 1px solid #e2e8f0; background: white; font-weight: 600; cursor: pointer;">Cancel</button>
                <button onclick="saveUser()" class="btn-primary">Create Account</button>
            </div>
        </div>
    </div>

    <script>
        function openUserModal() {
            document.getElementById('modalTitle').textContent = 'Add New User';
            document.getElementById('userModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeUserModal() {
            document.getElementById('userModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function editUser(name) {
            document.getElementById('modalTitle').textContent = 'Edit User: ' + name;
            document.getElementById('userModal').style.display = 'block';
        }

        function saveUser() {
            alert('User profile updated successfully!');
            closeUserModal();
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('userModal')) {
                closeUserModal();
            }
        }
    </script>
</body>

</html>