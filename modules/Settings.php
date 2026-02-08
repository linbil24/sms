<?php
session_start();
require_once '../Database/config.php';

// Mock user data
$user_role = $_SESSION['role'] ?? 'Role';
$user_name = $_SESSION['username'] ?? 'User';

// Determine Sidebar to Include (Same logic as Profile.php)
$role = strtolower($user_role);
$sidebar_path = '';
$css_path = '';

switch ($role) {
    case 'admin':
        $sidebar_path = '../Admin/Components/Side-bar.php';
        $css_path = '../Admin/assets/admin.css';
        break;
    case 'superadmin':
    case 'super-admin':
        $sidebar_path = '../Super-admin/Components/Sidebar.php';
        $css_path = '../Super-admin/assets/admin.css';
        break;
    case 'admission':
        $sidebar_path = '../Admission/Components/Sidebar.php';
        $css_path = '../Admin/assets/admin.css';
        break;
    case 'cashier':
        $sidebar_path = '../Cashier/Components/Sidebar.php';
        $css_path = '../Admin/assets/admin.css';
        break;
    default:
        $sidebar_path = '../Admin/Components/Side-bar.php';
        $css_path = '../Admin/assets/admin.css';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - SMS</title>
    <link rel="icon" type="image/x-icon" href="../Assets/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_path); ?>">

    <style>
        .settings-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .settings-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 15px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .bg-security {
            background: #fee2e2;
            color: #ef4444;
        }

        .bg-notify {
            background: #eff6ff;
            color: #2563eb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #475569;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
        }

        .toggle-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .toggle-item:last-child {
            border-bottom: none;
        }

        .toggle-info h4 {
            margin: 0 0 5px 0;
            color: #1e293b;
            font-size: 1rem;
        }

        .toggle-info p {
            margin: 0;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Switch Toggle */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2563eb;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        .btn-action {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-outline {
            background: white;
            border: 1px solid #cbd5e1;
            color: #475569;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        /* PIN Input Styles */
        .pin-container {
            display: flex;
            gap: 8px;
        }

        .pin-box {
            width: 45px;
            height: 45px;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            transition: all 0.2s;
        }

        .pin-box:focus {
            border-color: #ea580c;
            /* Orange focus to match theme */
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.1);
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    if (file_exists($sidebar_path)) {
        include $sidebar_path;
    } else {
        echo "<!-- Sidebar Path Error: $sidebar_path not found -->";
    }
    ?>

    <div class="main-wrapper">
        <div
            style="background: white; padding: 15px 30px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: flex-end; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-weight: 600; color: #1e293b;">
                    <?php echo htmlspecialchars($user_name); ?>
                </span>
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user_name); ?>"
                    style="width: 35px; height: 35px; border-radius: 50%;" alt="Profile">
            </div>
        </div>

        <div class="content-area">
            <h1 style="font-size: 1.8rem; font-weight: 800; color: #1e293b; margin-bottom: 30px;">Settings</h1>

            <div class="settings-container">

                <!-- Security Settings -->
                <div class="settings-card">
                    <div class="card-header">
                        <div class="icon-box bg-security"><i class="fas fa-shield-alt"></i></div>
                        <h2 class="card-title">Security Settings</h2>
                    </div>

                    <form>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" placeholder="Enter current password">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                        <div style="text-align: right; margin-top: 10px;">
                            <button type="button" class="btn-action btn-outline"
                                style="margin-right: 10px;">Cancel</button>
                            <button type="button" class="btn-action btn-primary">Update Password</button>
                        </div>
                    </form>

                    <div style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Two-Factor Authentication (2FA)</h4>
                                <p>Add an extra layer of security to your account.</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="toggle-item">
                            <div class="toggle-info">
                                <h4>Login Alerts</h4>
                                <p>Receive emails about new sign-ins.</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- PIN Security -->
                <div class="settings-card">
                    <div class="card-header">
                        <div class="icon-box" style="background: #fff7ed; color: #ea580c;"><i class="fas fa-key"></i>
                        </div>
                        <h2 class="card-title">PIN Security</h2>
                    </div>

                    <p style="color: #64748b; margin-bottom: 20px; font-size: 0.9rem;">
                        Set a 4-digit Security PIN for sensitive transactions and account recovery.
                    </p>

                    <form id="pinForm">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label class="form-label">Current PIN</label>
                                <div class="pin-container" id="current-pin">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'current-pin-2')" id="current-pin-1">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'current-pin-3')" id="current-pin-2">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'current-pin-4')" id="current-pin-3">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, null)" id="current-pin-4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">New PIN</label>
                                <div class="pin-container" id="new-pin">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'new-pin-2')" id="new-pin-1">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'new-pin-3')" id="new-pin-2">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'new-pin-4')" id="new-pin-3">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, null)" id="new-pin-4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm PIN</label>
                                <div class="pin-container" id="confirm-pin">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'confirm-pin-2')" id="confirm-pin-1">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'confirm-pin-3')" id="confirm-pin-2">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, 'confirm-pin-4')" id="confirm-pin-3">
                                    <input type="password" class="pin-box" maxlength="1"
                                        oninput="moveToNext(this, null)" id="confirm-pin-4">
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right; margin-top: 15px;">
                            <button type="button" class="btn-action btn-primary" style="background: #ea580c;">Update
                                PIN</button>
                        </div>
                    </form>
                </div>

                <script>
                    function moveToNext(current, nextFieldId) {
                        if (current.value.length >= 1) {
                            if (nextFieldId) {
                                document.getElementById(nextFieldId).focus();
                            }
                        }
                    }
                </script>

                <!-- Preference Settings -->
                <div class="settings-card">
                    <div class="card-header">
                        <div class="icon-box bg-notify"><i class="fas fa-bell"></i></div>
                        <h2 class="card-title">Preferences</h2>
                    </div>

                    <div class="toggle-item">
                        <div class="toggle-info">
                            <h4>Email Notifications</h4>
                            <p>Get updates on enrollment queues and system status.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="toggle-item">
                        <div class="toggle-info">
                            <h4>Dark Mode</h4>
                            <p>Toggle system-wide dark appearance.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>