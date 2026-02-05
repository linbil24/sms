<?php
require_once '../Database/config.php';

function checkAndAddColumn($pdo, $table, $column, $definition, $afterColumn) {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        if ($stmt->rowCount() == 0) {
            $sql = "ALTER TABLE `$table` ADD COLUMN `$column` $definition";
            if ($afterColumn) {
                $sql .= " AFTER `$afterColumn`";
            }
            $pdo->exec($sql);
            echo "✔ Added '$column' to '$table'.\n";
        } else {
            echo "ℹ '$column' already exists in '$table'.\n";
        }
    } catch (PDOException $e) {
        echo "✖ Error adding '$column' to '$table': " . $e->getMessage() . "\n";
    }
}

try {
    echo "Starting Schema Repair...\n";

    // --- Students Table ---
    checkAndAddColumn($pdo, 'students', 'middle_name', "VARCHAR(100)", 'first_name');
    
    // Rename profile_picture to profile_image if needed
    $check_old_pic = $pdo->query("SHOW COLUMNS FROM students LIKE 'profile_picture'");
    if ($check_old_pic->rowCount() > 0) {
        $pdo->exec("ALTER TABLE students CHANGE COLUMN profile_picture profile_image VARCHAR(255) DEFAULT 'default.jpg'");
        echo "✔ Renamed 'profile_picture' in 'students'.\n";
    }

    // --- Enrollments Table ---
    checkAndAddColumn($pdo, 'enrollments', 'middle_name', "VARCHAR(100)", 'first_name');
    checkAndAddColumn($pdo, 'enrollments', 'address', "TEXT NOT NULL", 'email'); // Based on setup.sql order
    
    // Guardian & Education Columns (might be missing in old schema)
    checkAndAddColumn($pdo, 'enrollments', 'guardian_first', "VARCHAR(100) NOT NULL", 'id_picture');
    checkAndAddColumn($pdo, 'enrollments', 'guardian_middle', "VARCHAR(100)", 'guardian_first');
    checkAndAddColumn($pdo, 'enrollments', 'guardian_last', "VARCHAR(100) NOT NULL", 'guardian_middle');
    checkAndAddColumn($pdo, 'enrollments', 'guardian_email', "VARCHAR(255) NOT NULL", 'guardian_last');
    checkAndAddColumn($pdo, 'enrollments', 'guardian_contact', "VARCHAR(20) NOT NULL", 'guardian_email');
    checkAndAddColumn($pdo, 'enrollments', 'relationship', "VARCHAR(50) NOT NULL", 'guardian_contact');
    checkAndAddColumn($pdo, 'enrollments', 'guardian_address', "TEXT NOT NULL", 'relationship');
    
    checkAndAddColumn($pdo, 'enrollments', 'primary_school', "VARCHAR(255) NOT NULL", 'guardian_address');
    checkAndAddColumn($pdo, 'enrollments', 'primary_year', "VARCHAR(10) NOT NULL", 'primary_school');
    checkAndAddColumn($pdo, 'enrollments', 'secondary_school', "VARCHAR(255) NOT NULL", 'primary_year');
    checkAndAddColumn($pdo, 'enrollments', 'secondary_year', "VARCHAR(10) NOT NULL", 'secondary_school');

    echo "Repair Completed.\n";

} catch (PDOException $e) {
    echo "Critical Error: " . $e->getMessage() . "\n";
}
?>
