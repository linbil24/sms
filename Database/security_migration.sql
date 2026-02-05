-- Security & RBAC Implementation Migration

-- 1. Enhance 'permissions' table
-- Add 'module' column to categorize permissions
ALTER TABLE `permissions` ADD COLUMN `module` VARCHAR(50) DEFAULT 'System' AFTER `permission_key`;

-- 2. Populate Permissions
INSERT IGNORE INTO `permissions` (`permission_key`, `description`, `module`) VALUES
('user_view', 'View admin users', 'User Management'),
('user_add', 'Create new admin users', 'User Management'),
('user_edit', 'Edit admin users', 'User Management'),
('user_delete', 'Delete admin users', 'User Management'),

('student_view', 'View student profiles', 'Student Management'),
('student_add', 'Register new students', 'Student Management'),
('student_edit', 'Edit student details', 'Student Management'),
('student_delete', 'Delete student records', 'Student Management'),

('enrollment_view', 'View enrollment list', 'Enrollment'),
('enrollment_approve', 'Approve/Reject enrollments', 'Enrollment'),

('payment_view', 'View payment history', 'Financial'),
('payment_process', 'Process payments', 'Financial'),
('payment_void', 'Void transactions', 'Financial'),

('reports_view', 'Access system reports', 'Reports'),
('settings_access', 'Configure system settings', 'Settings');

-- 3. Audit Logs Table (New) for detailed tracking of sensitive actions
CREATE TABLE IF NOT EXISTS `audit_logs` (
    `logId` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL,
    `action` VARCHAR(50) NOT NULL,
    `module` VARCHAR(50) NOT NULL,
    `recordId` INT NULL, -- Affected ID (e.g., studentId)
    `details` TEXT, -- OLD and NEW values or description
    `ip_address` VARCHAR(45),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`userId`) REFERENCES `users`(`userId`) ON DELETE CASCADE
);
