<?php
// Super Admin Sidebar Component
$current_page = basename($_SERVER['PHP_SELF']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'superadmin';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'admin@sms.com';
?>
<div class="sidebar">
    <div class="sidebar-brand">
        <a href="/sms/Super-admin/Dashboard.php" class="brand-wrapper">
            <img src="/sms/Assets/image/logo.png" alt="Logo" class="sidebar-logo">
            <h2>Super Admin</h2>
        </a>
    </div>

    <div class="sidebar-menu">
        <p class="menu-label">MAIN</p>
        <ul>
            <li class="<?php echo ($current_page == 'Dashboard.php') ? 'active' : ''; ?>">
                <a href="/sms/Super-admin/Dashboard.php">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <p class="menu-label">SYSTEM MANAGEMENT</p>
        <ul class="main-menu">
            <!-- User Management Dropdown -->
            <li
                class="has-dropdown <?php echo (strpos($_SERVER['PHP_SELF'], 'Modules/User-Management') !== false) ? 'active open' : ''; ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-user-shield"></i>
                    <span>User Accounts</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Super-admin/Modules/User-Management.php">Staff Accounts</a></li>
                    <li><a href="/sms/Super-admin/Modules/Roles.php">Roles & Permissions</a></li>
                </ul>
            </li>
        </ul>

        <p class="menu-label">ADMISSION CONTROL</p>
        <ul class="main-menu">
            <!-- Admission Summary Dropdown -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-user-graduate"></i>
                    <span>Admission Hub</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Super-admin/submodules/Admission-Dashboard.php">Admission Dashboard</a></li>
                    <li><a href="/sms/Super-admin/submodules/Applications-Manager.php">Applications Manager</a></li>
                    <li><a href="/sms/Super-admin/submodules/Evaluation-Desk.php">Evaluation Desk</a></li>
                    <li><a href="/sms/Super-admin/submodules/Student-ID-Center.php">Student ID Center</a></li>
                    <li><a href="/sms/Super-admin/submodules/Requirements-Config.php">Requirements Config</a></li>
                </ul>
            </li>
        </ul>

        <p class="menu-label">ACCOUNT & SETTINGS</p>
        <ul>
            <li>
                <a href="/sms/modules/Profile.php"
                    class="<?php echo ($current_page == 'Profile.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </li>

            <li>
                <a href="/sms/modules/Settings.php"
                    class="<?php echo ($current_page == 'Settings.php') ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" onclick="openLogoutModal()" style="color: #ef4444;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="user-peek">
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($email); ?>&background=1648bc&color=fff"
                alt="User">
            <div class="user-peek-info">
                <h4>Super Admin</h4>
                <p><?php echo $email; ?></p>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-blue: #1648bc;
        --sidebar-bg: #ffffff;
        --text-gray: #718096;
        --text-dark: #2d3748;
        --hover-bg: #f8fafc;
        --active-blue: #eef2ff;
    }

    .sidebar {
        width: 280px;
        height: 100vh;
        background: var(--sidebar-bg);
        display: flex;
        flex-direction: column;
        border-right: 1px solid #edf2f7;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-brand {
        padding: 30px 25px;
    }

    .brand-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
    }

    .sidebar-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
    }

    .sidebar-brand h2 {
        color: var(--primary-blue);
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .sidebar-menu {
        flex: 1;
        padding: 0 15px;
        overflow-y: auto;
    }

    .sidebar-menu::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #edf2f7;
        border-radius: 10px;
    }

    .menu-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #a0aec0;
        margin: 25px 0 10px 15px;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .sidebar-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin-bottom: 4px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        text-decoration: none;
        color: var(--text-dark);
        font-size: 0.92rem;
        font-weight: 500;
        border-radius: 12px;
        transition: 0.2s ease;
    }

    .sidebar-menu a:hover {
        background: var(--hover-bg);
        color: var(--primary-blue);
    }

    .sidebar-menu li.active>a {
        background: var(--active-blue);
        color: var(--primary-blue);
        font-weight: 600;
    }

    .sidebar-menu a i {
        width: 20px;
        font-size: 1.1rem;
        opacity: 0.8;
    }

    /* Dropdown Logic */
    .has-dropdown .sub-menu {
        display: none;
        padding-left: 20px;
        margin-top: 5px;
    }

    .has-dropdown.open .sub-menu {
        display: block;
    }

    .has-dropdown .arrow-icon {
        margin-left: auto;
        font-size: 0.75rem;
        transition: transform 0.3s;
    }

    .has-dropdown.open .arrow-icon {
        transform: rotate(90deg);
    }

    .sub-menu a {
        padding: 10px 15px;
        font-size: 0.85rem;
    }

    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid #edf2f7;
    }

    .user-peek {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: var(--hover-bg);
        border-radius: 16px;
    }

    .user-peek img {
        width: 40px;
        height: 40px;
        border-radius: 12px;
    }

    .user-peek-info h4 {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .user-peek-info p {
        font-size: 0.75rem;
        color: var(--text-gray);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
    }
</style>

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const parent = button.parentElement;
            parent.classList.toggle('open');
        });
    });

    function openLogoutModal() {
        if (document.getElementById('logoutModal')) {
            document.getElementById('logoutModal').style.display = 'block';
        } else {
            alert('Logout clicked');
        }
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').style.display = 'none';
    }
</script>

<!-- Logout Modal -->
<div id="logoutModal" class="modal"
    style="display:none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    <div
        style="background: white; width: 90%; max-width: 400px; margin: 15vh auto; border-radius: 24px; padding: 40px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div
            style="width: 80px; height: 80px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 2rem;">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2 style="font-weight: 800; color: #1e293b; margin-bottom: 12px;">End Session?</h2>
        <p style="color: #64748b; margin-bottom: 32px; line-height: 1.6;">Are you sure you want to log out of the Super
            Admin panel?</p>
        <div style="display: flex; gap: 16px;">
            <button onclick="closeLogoutModal()"
                style="flex: 1; padding: 14px; border-radius: 14px; border: 1px solid #e2e8f0; background: white; color: #64748b; font-weight: 600; cursor: pointer;">Cancel</button>
            <a href="/sms/auth/logout.php"
                style="flex: 1; padding: 14px; border-radius: 14px; background: #ef4444; color: white; font-weight: 600; text-decoration: none;">Logout</a>
        </div>
    </div>
</div>