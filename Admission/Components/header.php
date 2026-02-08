<?php
// Unified Head-bar Component
?>
<div class="head-bar">
    <div class="head-left">
        <div class="burger-btn" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search here...">
        </div>
    </div>
    <div class="head-actions">
        <div class="notification">
            <i class="fas fa-bell"></i>
            <span class="badge"></span>
        </div>
        <div class="head-user">
            <img src="/sms/Assets/image/avatar.png" alt="User"
                onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['email']); ?>&background=1648bc&color=fff'">
        </div>
    </div>
</div>

<style>
    .head-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: white;
        border-bottom: 1px solid #edf2f7;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .head-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .burger-btn {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f7fafc;
        border-radius: 8px;
        color: #4a5568;
        cursor: pointer;
        transition: 0.3s;
    }

    .burger-btn:hover {
        background: #eef2ff;
        color: #1648bc;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #f7fafc;
        font-size: 0.9rem;
        outline: none;
        transition: 0.3s;
    }

    .search-box input:focus {
        border-color: #1648bc;
        background: white;
    }

    .head-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .notification {
        position: relative;
        cursor: pointer;
        color: #4a5568;
        font-size: 1.2rem;
    }

    .notification .badge {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
    }

    .head-user img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #edf2f7;
    }
</style>