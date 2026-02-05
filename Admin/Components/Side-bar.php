<?php
// Admin Side-bar Component
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <div class="sidebar-brand">
        <a href="/sms/Admin/Dashboard.php" class="brand-wrapper">
            <img src="/sms/Assets/image/logo.png" alt="Logo" class="sidebar-logo">
            <h2>Admin</h2>
        </a>
    </div>

    <div class="sidebar-menu">
        <p class="menu-label">MAIN</p>
        <ul>
            <li class="<?php echo ($current_page == 'Dashboard.php') ? 'active' : ''; ?>">
                <a href="/sms/Admin/Dashboard.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>
        </ul>

        <p class="menu-label">MANAGEMENT</p>
        <ul>
            <li class="has-dropdown <?php echo ($current_page == 'Enrollment.php') ? 'active open' : ''; ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-user-graduate"></i>
                    <span>Enrollment</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admin/Module/Enrollment-Queue.php"><i class="fas fa-list-ol"></i> <span>Enrollment
                                Queue</span></a></li>
                    <li><a href="/sms/Admin/Module/Enrollment.php"><i class="fas fa-clipboard-list"></i>
                            <span>Enrollment List</span></a></li>
                    <li><a href="/sms/Admin/Module/Subject-Enrollment.php"><i class="fas fa-book"></i> <span>Subject
                                Enrollment</span></a></li>
                    <li><a href="/sms/Admin/Module/Section-Assignment.php"><i class="fas fa-users-viewfinder"></i>
                            <span>Section Assignment</span></a></li>
                    <li><a href="/sms/Admin/Module/Payments-Fees.php"><i class="fas fa-file-invoice-dollar"></i>
                            <span>Payments & Fees</span></a></li>
                    <li><a href="/sms/Admin/Module/Enrollment-History.php"><i class="fas fa-history"></i>
                            <span>Enrollment History</span></a></li>
                    <li><a href="/sms/Admin/Module/Reports.php"><i class="fas fa-chart-line"></i>
                            <span>Reports</span></a></li>
                </ul>
            </li>

            <li class="has-dropdown <?php echo ($current_page == 'User-Management.php') ? 'active open' : ''; ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-users-cog"></i>
                    <span>User Management</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admin/Submodules/Admin-Users.php"><i class="fas fa-user-shield"></i> <span>Admin
                                Users</span></a></li>
                    <li><a href="/sms/Admin/Submodules/Staff-Registration.php"><i class="fas fa-id-card-alt"></i>
                            <span>Staff / Registration</span></a></li>
                    <li><a href="/sms/Admin/Submodules/Student-Accounts.php"><i class="fas fa-user-graduate"></i>
                            <span>Student Accounts</span></a></li>
                    <li><a href="/sms/Admin/Submodules/Roles-Permissions.php"><i class="fas fa-user-tag"></i>
                            <span>Roles & Permissions</span></a></li>
                    <li><a href="/sms/Admin/Submodules/Account-Status.php"><i class="fas fa-user-check"></i>
                            <span>Account Status</span></a></li>
                </ul>
            </li>
        </ul>

        <!-- <p class="menu-label">OPERATIONS</p>
        <ul>
            <li><a href="#"><i class="fas fa-money-check-alt"></i> <span>Payments</span></a></li>
            <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> <span>Payment Queue</span></a></li>
        </ul> -->

        <p class="menu-label">ACCOUNT</p>
        <ul>
            <li class="<?php echo ($current_page == 'Profile.php') ? 'active' : ''; ?>">
                <a href="/sms/modules/Profile.php"><i class="fas fa-user-circle"></i> <span>Profile</span></a>
            </li>
            <li class="<?php echo ($current_page == 'Settings.php') ? 'active' : ''; ?>">
                <a href="/sms/modules/Settings.php"><i class="fas fa-sliders-h"></i> <span>Settings</span></a>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="openLogoutModal()" style="color: #ef4444;"><i
                        class="fas fa-power-off"></i> <span>Log Out</span></a>
            </li>
        </ul>
    </div>

    <div class="sidebar-profile">
        <div class="profile-card">
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['email']); ?>&background=1648bc&color=fff"
                alt="Profile">
            <div class="profile-info">
                <h4>Sample Admin</h4>
                <p>
                    <?php
                    if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'superadmin')) {
                        header("Location: /sms/auth/Login.php");
                        exit();
                    }
                    echo ucfirst($_SESSION['role']);
                    ?>
                </p>
            </div>
            <span class="status-dot"></span>
        </div>
    </div>
</div>

<style>
    .sidebar {
        width: 260px;
        height: 100vh;
        background: white;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #edf2f7;
        position: sticky;
        top: 0;
    }

    .sidebar-brand {
        padding: 25px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .brand-wrapper {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .sidebar-logo {
        width: 45px;
        height: auto;
        border-radius: 8px;
        border: 1px solid #000;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.05));
    }

    .sidebar-brand h2 {
        color: #1648bc;
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* State when collapsed */
    .sidebar.collapsed .sidebar-brand h2 {
        display: none;
    }

    .sidebar.collapsed .sidebar-brand {
        padding: 20px 15px;
        justify-content: center;
    }

    .sidebar.collapsed .sidebar-logo {
        width: 35px;
    }

    .sidebar-menu {
        flex: 1;
        padding: 0 20px;
        overflow-y: auto;
        scrollbar-width: none;
        /* Hide scrollbar for Firefox */
        -ms-overflow-style: none;
        /* Hide scrollbar for IE/Edge */
    }

    .sidebar-menu::-webkit-scrollbar {
        display: none;
        /* Hide scrollbar for Chrome/Safari */
    }

    .menu-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #a0aec0;
        margin: 20px 0 10px 10px;
        letter-spacing: 1px;
    }

    .sidebar-menu ul {
        list-style: none;
    }

    .sidebar-menu ul li {
        margin-bottom: 5px;
    }

    .sidebar-menu ul li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        text-decoration: none;
        color: #4a5568;
        font-size: 0.95rem;
        font-weight: 500;
        border-radius: 10px;
        transition: 0.3s;
    }

    .sidebar-menu ul li.active a {
        background: #eef2ff;
        color: #1648bc;
    }

    .sidebar-menu ul li a:hover {
        background: #f7fafc;
        color: #1648bc;
    }

    .sidebar-menu ul li a i {
        width: 20px;
        font-size: 1.1rem;
    }

    /* Sub-menu Styles */
    .sub-menu {
        list-style: none;
        padding-left: 15px;
        margin-top: 2px;
        margin-bottom: 5px;
        border-left: 1px dashed #edf2f7;
        margin-left: 24px;
        display: none;
        /* Initially hidden */
    }

    .has-dropdown.open .sub-menu {
        display: block;
    }

    .arrow-icon {
        margin-left: auto;
        font-size: 0.7rem !important;
        transition: transform 0.3s ease;
    }

    .has-dropdown.open .arrow-icon {
        transform: rotate(90deg);
    }

    .sub-menu li a {
        padding: 8px 15px !important;
        font-size: 0.85rem !important;
        color: #718096 !important;
    }

    .sub-menu li a:hover {
        color: #1648bc !important;
        background: transparent !important;
    }

    .sub-menu li a i {
        font-size: 0.9rem !important;
    }

    /* Hide sub-menu labels when collapsed */
    .sidebar.collapsed .sub-menu,
    .sidebar.collapsed .arrow-icon {
        display: none !important;
    }

    .sidebar-profile {
        padding: 20px;
        border-top: 1px solid #edf2f7;
    }

    .profile-card {
        background: #f8fafc;
        padding: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        border: 1px solid #edf2f7;
    }

    .profile-card img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .profile-info h4 {
        font-size: 0.85rem;
        font-weight: 700;
        color: #2d3748;
    }

    .profile-info p {
        font-size: 0.75rem;
        color: #718096;
    }

    .status-dot {
        position: absolute;
        bottom: 15px;
        left: 45px;
        width: 10px;
        height: 10px;
        background: #48bb78;
        border: 2px solid white;
        border-radius: 50%;
    }

    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar.collapsed .sidebar-brand h2,
    .sidebar.collapsed .menu-label,
    .sidebar.collapsed .sidebar-menu ul li a span,
    .sidebar.collapsed .profile-info,
    .sidebar.collapsed .status-dot {
        display: none;
    }

    .sidebar {
        transition: width 0.3s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sidebar toggle
        const toggleBtn = document.getElementById('sidebar-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                document.querySelector('.sidebar').classList.toggle('collapsed');
            });
        }

        // Dropdown toggle
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = this.parentElement;

                // Toggle current dropdown
                parent.classList.toggle('open');

                // Optional: Close other dropdowns
                document.querySelectorAll('.has-dropdown').forEach(item => {
                    if (item !== parent) {
                        item.classList.remove('open');
                    }
                });
            });
        });
    });

    function openLogoutModal() {
        document.getElementById('logoutModal').style.display = 'block';
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').style.display = 'none';
    }

    window.onclick = function (event) {
        const modal = document.getElementById('logoutModal');
        if (event.target == modal) {
            closeLogoutModal();
        }
    }
</script>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="modal"
    style="display:none; z-index: 9999; background: rgba(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden;">
    <div class="modal-content"
        style="max-width: 400px; text-align: center; border-radius: 20px; padding: 40px; margin: 15% auto; position: relative; background-color: #fefefe; border: 1px solid #888;">
        <div
            style="width: 80px; height: 80px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">
            <i class="fas fa-power-off"></i>
        </div>
        <h2 style="margin-bottom: 10px; color: #1e1e1e; font-weight: 700;">Confirm Logout</h2>
        <p style="color: #666; margin-bottom: 30px; line-height: 1.5;">Are you sure you want to log out? Your current
            session will be ended.</p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button onclick="closeLogoutModal()"
                style="flex: 1; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: white; color: #4a5568; font-weight: 600; cursor: pointer; transition: 0.3s;">Cancel</button>
            <a href="/sms/auth/logout.php"
                style="flex: 1; padding: 12px; border-radius: 10px; background: #ef4444; color: white; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s;">Logout</a>
        </div>
    </div>
</div>