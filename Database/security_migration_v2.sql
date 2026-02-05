-- Security Update: Add Module Access Permissions
-- This ensures we can lock down directories in the RBAC system

INSERT IGNORE INTO `permissions` (`permission_key`, `description`, `module`) VALUES
('access_admission', 'Access to Admission Module', 'System Access'),
('access_cashier', 'Access to Cashier Module', 'System Access'),
('access_student_portal', 'Access to Student Portal', 'System Access');

-- Grant default access to existing roles so they don't get locked out immediately
-- (Assuming Role IDs: 1=Superadmin not needed, 2=Admin, 3=Registrar, 4=Admission)

-- Get Role IDs (Dynamic Subquery approach for safety)
SET @role_admission = (SELECT roleId FROM roles_config WHERE role_name = 'admission' LIMIT 1);
SET @role_cashier = (SELECT roleId FROM roles_config WHERE role_name = 'cashier' LIMIT 1); 

-- Get Permission IDs
SET @perm_admission = (SELECT permissionId FROM permissions WHERE permission_key = 'access_admission' LIMIT 1);
SET @perm_cashier = (SELECT permissionId FROM permissions WHERE permission_key = 'access_cashier' LIMIT 1);

-- Assign Permission: Admission Role -> Access Admission
INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (@role_admission, @perm_admission);

-- Assign Permission: Cashier Role -> Access Cashier
INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (@role_cashier, @perm_cashier);
