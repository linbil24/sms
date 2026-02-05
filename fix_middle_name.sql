-- Add middle_name column to students table if it doesn't exist
ALTER TABLE students ADD COLUMN middle_name VARCHAR(100) AFTER first_name;

-- Add middle_name column to enrollments table if it doesn't exist  
ALTER TABLE enrollments ADD COLUMN middle_name VARCHAR(100) AFTER first_name;
