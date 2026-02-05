<?php
// Student Header Component
$student_name = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Student';
?>
<div class="header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search courses, documents...">
        </div>
    </div>

    <div class="header-right">
        <div class="action-btn notification-btn">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </div>

        <div class="user-profile">
            <div class="user-info">
                <span class="name">
                    <?php echo htmlspecialchars($student_name); ?>
                </span>
                <span class="role">Student</span>
            </div>
            <?php
            $avatar_url = isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])
                ? "/SMS/" . $_SESSION['profile_image']
                : "https://ui-avatars.com/api/?name=" . urlencode($student_name) . "&background=2563eb&color=fff";
            ?>
            <img src="<?php echo $avatar_url; ?>" alt="User" class="user-avatar">
        </div>
    </div>
</div>

<style>
    .header {
        height: 80px;
        background: white;
        padding: 0 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #edf2f7;
        position: sticky;
        top: 0;
        z-index: 900;
        transition: all 0.3s;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
        flex: 1;
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #64748b;
        cursor: pointer;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background: #f8fafc;
        padding: 12px 20px;
        border-radius: 12px;
        width: 100%;
        max-width: 400px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }

    .search-bar:focus-within {
        background: white;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-bar i {
        color: #94a3b8;
        margin-right: 12px;
    }

    .search-bar input {
        border: none;
        background: none;
        outline: none;
        width: 100%;
        color: #1e293b;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .action-btn {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        color: #64748b;
        font-size: 1.1rem;
        position: relative;
    }

    .action-btn:hover {
        background: #f8fafc;
        color: #2563eb;
    }

    .notification-btn .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 6px;
        border-radius: 12px;
        transition: background 0.2s;
    }

    .user-profile:hover {
        background: #f8fafc;
    }

    .user-info {
        text-align: right;
        display: flex;
        flex-direction: column;
    }

    .user-info .name {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e293b;
    }

    .user-info .role {
        font-size: 0.75rem;
        color: #64748b;
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        object-fit: cover;
    }

    @media (max-width: 1024px) {
        .header {
            padding: 0 20px;
        }

        .menu-toggle {
            display: block;
        }

        .user-info {
            display: none;
        }
    }
</style>

<script>
    // Toggle Sidebar mainly for Mobile
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            // Basic toggle logic - can be expanded if sidebar creates a class for mobile
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'flex';
                sidebar.style.position = 'absolute';
                sidebar.style.height = '100%';
                sidebar.style.boxShadow = '5px 0 15px rgba(0,0,0,0.1)';
            } else {
                sidebar.style.display = 'none';
            }
        });
    }
</script>