# Database Setup (Revised for Login/Logout)

## Create Database
```sql
CREATE DATABASE IF NOT EXISTS SMS;
USE SMS;
```

## 1. Users Table (for auth/Login.php)
This table handles authentication for all roles.
```sql
CREATE TABLE IF NOT EXISTS users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL, -- 'admin', 'admission', 'cashier', 'superadmin', 'student'
    status VARCHAR(20) DEFAULT 'offline',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 2. Validation & Security Tables
Tables for tracking login attempts, password resets, and session validation.
```sql
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS login_logs (
    logId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
);
```

## 3. Courses Table
Reference table for the courses dropdown in the registration form (Picture 2).
```sql
CREATE TABLE IF NOT EXISTS courses (
    courseId INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    department VARCHAR(100)
);

INSERT INTO courses (course_name, course_code, department) VALUES 
('BS Information Technology', 'BSIT', 'College of Computer Studies'),
('BS Computer Science', 'BSCS', 'College of Computer Studies'),
('BS Business Administration', 'BSBA', 'College of Business');
```

## 4. Enrollments Table (for Student Registration - Picture 2)
This table stores all information from the multi-step registration wizard.
```sql
CREATE TABLE IF NOT EXISTS enrollments (
    enrollmentId INT AUTO_INCREMENT PRIMARY KEY,
    reference_code VARCHAR(20) UNIQUE NOT NULL, -- e.g., ENR25000001
    
    -- Step 1: Enrollment Information
    admission_type VARCHAR(50) NOT NULL, -- 'Freshman', 'Transferee'
    course_id INT, -- Linked to courses table
    year_level VARCHAR(50) NOT NULL,
    
    -- Step 2: Student Information
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100),
    last_name VARCHAR(100) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    birthdate DATE NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    address TEXT NOT NULL,
    
    -- Step 3: Documents (File Paths)
    birth_cert VARCHAR(255), -- PDF/Image
    form_138 VARCHAR(255), -- PDF/Image
    id_picture VARCHAR(255) NOT NULL, -- Image
    form_137 VARCHAR(255),
    good_moral VARCHAR(255),
    barangay_clearance VARCHAR(255),
    
    -- Step 4: Parent/Guardian Information
    guardian_first VARCHAR(100) NOT NULL,
    guardian_middle VARCHAR(100),
    guardian_last VARCHAR(100) NOT NULL,
    guardian_email VARCHAR(255) NOT NULL,
    guardian_contact VARCHAR(20) NOT NULL,
    relationship VARCHAR(50) NOT NULL,
    guardian_address TEXT NOT NULL,
    
    -- Step 5: Educational Background
    primary_school VARCHAR(255) NOT NULL,
    primary_year VARCHAR(10) NOT NULL,
    secondary_school VARCHAR(255) NOT NULL,
    secondary_year VARCHAR(10) NOT NULL,
    
    -- Enrollment Tracking (from Picture 1)
    status VARCHAR(50) DEFAULT 'Pending Review', -- 'Enrolled', 'Pending Payment', 'Pending Review'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(courseId)
);
```

## Insert Initial Accounts
```sql
-- Initial testing accounts
INSERT INTO users (email, password, role, status) VALUES 
('admin@example.com', 'admin123', 'admin', 'offline'),
('admission@example.com', 'admission123', 'admission', 'offline'),
('cashier@example.com', 'cashier123', 'cashier', 'offline'),
('superadmin@example.com', 'superadmin123', 'superadmin', 'offline');

-- Example Enrollment Record (matches Picture 1)
INSERT INTO enrollments (reference_code, admission_type, course_id, year_level, first_name, last_name, gender, birthdate, contact_number, email, address, id_picture, guardian_first, guardian_last, guardian_email, guardian_contact, relationship, guardian_address, primary_school, primary_year, secondary_school, secondary_year, status) 
VALUES ('ENR25000001', 'Freshman', 1, 'First Year', 'Miguel Enrique', 'UY', 'Male', '2005-05-15', '09123456789', 'miguel@example.com', '123 Manila St', 'uploads/id/enr25000001.png', 'Juan', 'UY', 'juan@example.com', '09998887766', 'Father', '123 Manila St', 'Manila Primary', '2017', 'Manila Secondary', '2023', 'Enrolled');
```

