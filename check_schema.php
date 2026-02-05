<?php
require_once 'Database/config.php';
try {
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables: " . implode(", ", $tables) . "\n";
    
    if (in_array('users', $tables)) {
        echo "Users columns: ";
        $cols = $pdo->query("DESCRIBE users")->fetchAll(PDO::FETCH_COLUMN);
        echo implode(", ", $cols) . "\n";
    }
    if (in_array('roles', $tables)) {
        echo "Roles columns: ";
        $cols = $pdo->query("DESCRIBE roles")->fetchAll(PDO::FETCH_COLUMN);
        echo implode(", ", $cols) . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
