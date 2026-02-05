<?php
require_once '../Database/config.php';

echo "<h1>Renaming Column 'middle_name' to 'mid_name'</h1>";

function fixColumn($pdo, $table) {
    echo "<h3>Table: $table</h3>";
    
    // Check if mid_name already exists
    $checkNew = $pdo->query("SHOW COLUMNS FROM `$table` LIKE 'mid_name'");
    if ($checkNew->rowCount() > 0) {
        echo "✔ 'mid_name' already exists.<br>";
        return;
    }

    // Check if middle_name exists
    $checkOld = $pdo->query("SHOW COLUMNS FROM `$table` LIKE 'middle_name'");
    if ($checkOld->rowCount() > 0) {
        // Rename
        try {
            $pdo->exec("ALTER TABLE `$table` CHANGE COLUMN `middle_name` `mid_name` VARCHAR(100) DEFAULT NULL");
            echo "✔ Renamed 'middle_name' to 'mid_name'.<br>";
        } catch (PDOException $e) {
            echo "✖ Error renaming: " . $e->getMessage() . "<br>";
        }
    } else {
        // Add new
        try {
            $pdo->exec("ALTER TABLE `$table` ADD COLUMN `mid_name` VARCHAR(100) DEFAULT NULL AFTER `first_name`");
            echo "✔ Added new column 'mid_name'.<br>";
        } catch (PDOException $e) {
            echo "✖ Error adding: " . $e->getMessage() . "<br>";
        }
    }
}

try {
    fixColumn($pdo, 'students');
    fixColumn($pdo, 'enrollments');
    echo "<h2>DONE. Database is ready for the new code.</h2>";
} catch (Exception $e) {
    echo "Global Error: " . $e->getMessage();
}
?>
