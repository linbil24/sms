-- Add middle_name column to enrollments table only
ALTER TABLE enrollments ADD COLUMN middle_name VARCHAR(100) AFTER first_name;
