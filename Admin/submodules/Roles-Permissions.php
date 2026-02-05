<?php
session_start();
require_once '../../Database/config.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'superadmin')) {
    header("Location: ../../Auth/log-reg.php");
    exit();
}

// Fetch Roles
try {
    $stmt = $pdo->query("SELECT * FROM roles_config");
    $roles = $stmt->fetchAll();
} catch (PDOException $e) {
    $roles = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles & Permissions - SMS</title>
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
                    <h2>System Roles</h2>
                    <button class="btn-view" onclick="openModal()"><i class="fas fa-plus"></i> New Role</button>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($roles) > 0): ?>
                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td class="student-name"><?php echo htmlspecialchars(ucfirst($role->role_name)); ?></td>
                                        <td><?php echo htmlspecialchars($role->description); ?></td>
                                        <td><span class="status-badge status-enrolled">Active</span></td>
                                        <td>
                                            <button onclick="openModal()" class="btn-view" style="padding: 6px 12px; font-size: 0.8rem; border:none; cursor:pointer;">Permissions</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center; padding:50px;">No roles configured.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Role Modal -->
    <div id="roleModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h2>Manage Role</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="roleForm">
                    <div class="info-item">
                        <label class="info-label">Role Name</label>
                        <input type="text" id="roleName" class="form-control"
                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; margin-top: 5px;"
                            placeholder="e.g. Registrar">
                    </div>
                    <div class="info-item">
                        <label class="info-label">Description</label>
                        <textarea id="roleDesc" rows="3"
                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; margin-top: 5px;"
                            placeholder="Describe the responsibilities of this role..."></textarea>
                    </div>

                    <div class="section-title">Permissions</div>
                    <div class="info-grid" style="grid-template-columns: 1fr;">
                        <label
                            style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                            <input type="checkbox" style="width: 18px; height: 18px;">
                            <span class="info-value">User Management (View, Add, Edit, Delete users)</span>
                        </label>
                        <label
                            style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                            <input type="checkbox" style="width: 18px; height: 18px;">
                            <span class="info-value">Course Management (Manage subjects and curricula)</span>
                        </label>
                        <label
                            style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                            <input type="checkbox" style="width: 18px; height: 18px;">
                            <span class="info-value">Enrollment Processing (Approve/Reject enrollments)</span>
                        </label>
                        <label
                            style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                            <input type="checkbox" style="width: 18px; height: 18px;">
                            <span class="info-value">Financial Access (View and process payments)</span>
                        </label>
                        <label
                            style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                            <input type="checkbox" style="width: 18px; height: 18px;">
                            <span class="info-value">System Settings (Configure system-wide settings)</span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-reject" onclick="closeModal()" style="background: #94a3b8;">Cancel</button>
                <button class="btn-approve" onclick="saveRole()">Save Role</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const modal = document.getElementById('roleModal');

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function saveRole() {
            // Placeholder for saving logic
            closeModal();
            Swal.fire('Success', 'Role has been saved successfully!', 'success');
        }

        // Close on outside click
        window.onclick = function (event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>