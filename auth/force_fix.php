<?php
require_once '../Database/config.php';

try {
    echo "<h1>Forcing Database Repair</h1>";

    // 1. STUDENTS TABLE
    echo "<h3>Fixing 'students' table...</h3>";
    
    // Drop logic is tricky if column doesn't exist, so we use a try-catch block for DROP
    try {
        $pdo->exec("ALTER TABLE students DROP COLUMN middle_name");
        echo "Dropped old 'middle_name' column from students.<br>";
    } catch (Exception $e) { /* Ignore drop error */ }

    // Re-add
    $pdo->exec("ALTER TABLE students ADD COLUMN middle_name VARCHAR(100) AFTER first_name");
    echo "<b style='color:green'>✔ Re-added 'middle_name' to students.</b><br>";

    // Fix Profile Image Name
    try {
        $pdo->exec("ALTER TABLE students CHANGE COLUMN profile_picture profile_image VARCHAR(255) DEFAULT 'default.jpg'");
        echo "<b style='color:green'>✔ Renamed profile_picture -> profile_image</b><br>";
    } catch (Exception $e) {
        // Maybe it's already profile_image?
        // Let's ensure profile_image exists
        try {
            $pdo->exec("ALTER TABLE students ADD COLUMN profile_image VARCHAR(255) DEFAULT 'default.jpg'");
        } catch (Exception $ex) {}
    }


    // 2. ENROLLMENTS TABLE
    echo "<h3>Fixing 'enrollments' table...</h3>";
    
    try {
        $pdo->exec("ALTER TABLE enrollments DROP COLUMN middle_name");
         echo "Dropped old 'middle_name' column from enrollments.<br>";
    } catch (Exception $e) { /* Ignore drop error */ }

    $pdo->exec("ALTER TABLE enrollments ADD COLUMN middle_name VARCHAR(100) AFTER first_name");
     echo "<b style='color:green'>✔ Re-added 'middle_name' to enrollments.</b><br>";

    
    // Ensure ADDRESS
     try {
        $pdo->exec("ALTER TABLE enrollments ADD COLUMN address TEXT NOT NULL AFTER email");
    } catch (Exception $e) {}


    echo "<h2>Repair Complete. Please try registering again.</h2>";

} catch (PDOException $e) {
    echo "<h2 style='color:red'>Error: " . $e->getMessage() . "</h2>";
}
?>
