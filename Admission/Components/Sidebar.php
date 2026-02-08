<?php
// Admission Sidebar Component
$current_page = basename($_SERVER['PHP_SELF']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admission';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'admission@sms.com';
?>
<div class="sidebar">
    <div class="sidebar-brand">
        <a href="/sms/Admission/Dashboard.php" class="brand-wrapper">
            <img src="/sms/Assets/image/logo.png" alt="Logo" class="sidebar-logo">
            <h2>Admission</h2>
        </a>
    </div>

    <div class="sidebar-menu">
        <!-- Dashboard Section -->
        <p class="menu-label">DASHBOARD</p>
        <ul class="main-menu">
            <li class="has-dropdown <?php echo ($current_page == 'Dashboard.php') ? 'active open' : ''; ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Dashboard.php?view=summary">Application Summary</a></li>
                    <li><a href="/sms/Admission/Dashboard.php?view=pending">Pending Evaluation</a></li>
                    <li><a href="/sms/Admission/Dashboard.php?view=notifications">Notifications</a></li>
                </ul>
            </li>
        </ul>

        <!-- Applications Section -->
        <p class="menu-label">ADMISSION PROCESS</p>
        <ul class="main-menu">
            <!-- Applications Dropdown -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-file-alt"></i>
                    <span>Applications</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/New-Applications.php">New Applications</a></li>
                    <li><a href="/sms/Admission/Modules/For-Evaluation.php">For Evaluation</a></li>
                    <li><a href="/sms/Admission/Modules/Approved.php">Approved</a></li>
                    <li><a href="/sms/Admission/Modules/Rejected.php">Rejected</a></li>
                    <li><a href="/sms/Admission/Modules/Archived.php">Archived</a></li>
                </ul>
            </li>

            <!-- Application Evaluation Dropdown -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-tasks"></i>
                    <span>Application Evaluation</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Document-Review.php">Document Review</a></li>
                    <li><a href="/sms/Admission/Modules/Exam-Results.php">Entrance Exam Results</a></li>
                    <li><a href="/sms/Admission/Modules/Interview-Assessment.php">Interview Assessment</a></li>
                    <li><a href="/sms/Admission/Modules/Evaluation-Summary.php">Evaluation Summary</a></li>
                </ul>
            </li>

            <!-- Student ID Management -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-id-card"></i>
                    <span>Student ID Management</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Generate-ID.php">Generate Student ID</a></li>
                    <li><a href="/sms/Admission/Modules/ID-Verification.php">ID Verification</a></li>
                    <li><a href="/sms/Admission/Modules/Print-Export-ID.php">Print / Export ID</a></li>
                    <li><a href="/sms/Admission/Modules/Lost-Replacement-IDs.php">Lost / Replacement IDs</a></li>
                </ul>
            </li>
        </ul>

        <!-- Requirements & Results -->
        <p class="menu-label">MANAGEMENT</p>
        <ul class="main-menu">
            <!-- Admission Requirements -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Admission Requirements</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Requirement-List.php">Requirement List</a></li>
                    <li><a href="/sms/Admission/Modules/Submission-Status.php">Submission Status</a></li>
                    <li><a href="/sms/Admission/Modules/Validation-Rules.php">Validation Rules</a></li>
                </ul>
            </li>

            <!-- Admission Results -->
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-poll"></i>
                    <span>Admission Results</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Passers-List.php">Passers List</a></li>
                    <li><a href="/sms/Admission/Modules/Waitlisted.php">Waitlisted</a></li>
                    <li><a href="/sms/Admission/Modules/Result-Notifications.php">Notifications</a></li>
                </ul>
            </li>
        </ul>

        <!-- Reports & Analytics -->
        <p class="menu-label">REPORTS & ANALYTICS</p>
        <ul class="main-menu">
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Applications-Summary.php">Applications Summary</a></li>
                    <li><a href="/sms/Admission/Modules/Evaluation-Statistics.php">Evaluation Statistics</a></li>
                    <li><a href="/sms/Admission/Modules/ID-Reports.php">Student ID Reports</a></li>
                </ul>
            </li>
        </ul>

        <!-- Settings Section -->
        <p class="menu-label">SYSTEM CONFIG</p>
        <ul class="main-menu">
            <li class="has-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="/sms/Admission/Modules/Admission-Year.php">Admission Year</a></li>
                    <li><a href="/sms/Admission/Modules/Cut-off-Score.php">Cut-off Score</a></li>
                    <li><a href="/sms/Admission/Modules/Notification-Templates.php">Notification Templates</a></li>
                </ul>
            </li>
            <li class="<?php echo ($current_page == 'Profile.php') ? 'active' : ''; ?>">
                <a href="/sms/modules/Profile.php">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="<?php echo ($current_page == 'Settings.php') ? 'active' : ''; ?>">
                <a href="/sms/modules/Settings.php">
                    <i class="fas fa-cog"></i>
                    <span>Account Settings</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="openLogoutModal()" style="color: #ef4444;">
                    <i class="fas fa-power-off"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-profile">
        <div class="profile-card">
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($email); ?>&background=1648bc&color=fff"
                alt="Profile">
            <div class="profile-info">
                <h4>Admission Staff</h4>
                <p><?php echo ucfirst($role); ?></p>
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
        transition: width 0.3s ease;
        z-index: 1000;
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
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .sidebar-menu {
        flex: 1;
        padding: 0 20px;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .sidebar-menu::-webkit-scrollbar {
        display: none;
    }

    .menu-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #94a3b8;
        margin: 20px 0 10px 10px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .sidebar-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu ul li {
        margin-bottom: 4px;
    }

    .sidebar-menu ul li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 15px;
        text-decoration: none;
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .sidebar-menu ul li.active>a {
        background: #f1f5f9;
        color: #1648bc;
        font-weight: 600;
    }

    .sidebar-menu ul li a:hover {
        background: #f8fafc;
        color: #1648bc;
    }

    .sidebar-menu ul li a i {
        width: 20px;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    /* Sub-menu Styles */
    .sub-menu {
        list-style: none;
        padding-left: 15px;
        margin-top: 2px;
        margin-bottom: 5px;
        border-left: 1px dashed #e2e8f0;
        margin-left: 24px;
        display: none;
    }

    .has-dropdown.open .sub-menu {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        font-size: 0.8rem !important;
        color: #64748b !important;
    }

    .sub-menu li a:hover {
        color: #1648bc !important;
        background: transparent !important;
    }

    .sub-menu li a i {
        font-size: 0.9rem !important;
    }

    /* Profile Section */
    .sidebar-profile {
        padding: 20px;
        border-top: 1px solid #edf2f7;
    }

    .profile-card {
        background: #f8fafc;
        padding: 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        border: 1px solid #f1f5f9;
    }

    .profile-card img {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        object-fit: cover;
    }

    .profile-info h4 {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .profile-info p {
        font-size: 0.7rem;
        color: #64748b;
        margin: 0;
    }

    .status-dot {
        position: absolute;
        bottom: 12px;
        left: 42px;
        width: 8px;
        height: 8px;
        background: #22c55e;
        border: 2px solid white;
        border-radius: 50%;
    }

    /* Collapsed State */
    .sidebar.collapsed {
        width: 85px;
    }

    .sidebar.collapsed .sidebar-brand h2,
    .sidebar.collapsed .menu-label,
    .sidebar.collapsed .sidebar-menu ul li a span,
    .sidebar.collapsed .arrow-icon,
    .sidebar.collapsed .profile-info,
    .sidebar.collapsed .status-dot,
    .sidebar.collapsed .sub-menu {
        display: none !important;
    }

    .sidebar.collapsed .sidebar-brand {
        padding: 20px 10px;
    }

    .sidebar.collapsed .sidebar-menu {
        padding: 0 15px;
    }

    .sidebar.collapsed .sidebar-menu ul li a {
        justify-content: center;
        padding: 12px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dropdown toggle
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = this.parentElement;

                // Toggle current dropdown
                const isOpen = parent.classList.contains('open');

                // Close other dropdowns
                document.querySelectorAll('.has-dropdown').forEach(item => {
                    item.classList.remove('open');
                });

                if (!isOpen) {
                    parent.classList.add('open');
                }
            });
        });

        // Sidebar toggle persistence (optional)
        const toggleBtn = document.getElementById('sidebar-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                document.querySelector('.sidebar').classList.toggle('collapsed');
            });
        }
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
    style="display:none; z-index: 9999; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden;">
    <div class="modal-content"
        style="max-width: 400px; text-align: center; border-radius: 24px; padding: 40px; margin: 15% auto; position: relative; background-color: #ffffff; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: none; font-family: 'Poppins', sans-serif;">
        <div
            style="width: 70px; height: 70px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 1.8rem;">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2 style="margin-bottom: 12px; color: #0f172a; font-weight: 700; font-size: 1.5rem;">Confirm Logout</h2>
        <p style="color: #64748b; margin-bottom: 32px; line-height: 1.6; font-size: 0.95rem;">Are you sure you want to
            end your session? Any unsaved changes might be lost.</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeLogoutModal()"
                style="flex: 1; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0; background: white; color: #475569; font-weight: 600; cursor: pointer; transition: 0.3s; font-family: inherit;">Stay
                Here</button>
            <a href="/sms/auth/logout.php"
                style="flex: 1; padding: 12px; border-radius: 12px; background: #ef4444; color: white; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s; font-family: inherit; font-size: 0.95rem; border: none; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);">Sign
                Out</a>
        </div>
    </div>
</div>